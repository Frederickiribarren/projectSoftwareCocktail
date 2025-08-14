<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\SourceApi;
use App\Models\Ingredient;
use App\Models\RecipeIngredient;
use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class RecipeImportController extends Controller
{
    protected $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }
    public function importFromApi($letter = 'a')
    {
        try {
            // Obtener el token de TheCocktailDB
            $apiToken = SourceApi::where('name', 'TheCocktailDB')
                              ->where('is_active', true)
                              ->first();

            if (!$apiToken) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró un token válido para TheCocktailDB'
                ], 400);
            }

            // Usar la letra proporcionada
            $currentLetter = strtolower($letter);
            
            // Validar que sea una letra válida
            if (!preg_match('/^[a-z]$/', $currentLetter)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Letra inválida'
                ], 400);
            }

            // Inicializar contadores
            $importedCount = 0;
            $errors = [];

            \Log::info("Importando cócteles que empiezan con '{$currentLetter}'");

            // URL de la API
            $apiUrl = "https://www.thecocktaildb.com/api/json/v2/961249867/search.php?f={$currentLetter}";
            
            try {
                // Hacer la petición con más detalles de debug
                $response = Http::timeout(30)
                    ->withHeaders([
                        'Accept' => 'application/json',
                        'User-Agent' => 'Mozilla/5.0'
                    ])
                    ->get($apiUrl);
                
                \Log::info("Respuesta de la API:", [
                    'url' => $apiUrl,
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                
                if (!$response->successful()) {
                    return response()->json([
                        'success' => false,
                        'message' => "Error al obtener cócteles que empiezan con '{$currentLetter}'",
                        'status' => $response->status(),
                        'response' => $response->body(),
                        'url' => $apiUrl,
                        'nextLetter' => $this->getNextLetter($currentLetter)
                    ], 500);
                }
            }
            catch (\Exception $e) {
                \Log::error("Excepción al llamar a la API: " . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Error al conectar con la API: ' . $e->getMessage(),
                    'url' => $apiUrl,
                    'nextLetter' => $this->getNextLetter($currentLetter)
                ], 500);
            }

            // Decodificar la respuesta JSON
            $responseData = $response->json();
            \Log::info("Datos recibidos de la API:", ['data' => $responseData]);
            
            $drinks = $responseData['drinks'] ?? [];
            
            if (empty($drinks)) {
                \Log::info("No se encontraron cócteles que empiecen con '{$currentLetter}'");
                return response()->json([
                    'success' => true,
                    'message' => "No hay cócteles que empiecen con '{$currentLetter}'",
                    'nextLetter' => $this->getNextLetter($currentLetter),
                    'importedCount' => 0,
                    'responseData' => $responseData
                ]);
            }

            // Procesar todos los cócteles de la letra actual
            foreach ($drinks as $index => $drink) {
                try {
                    \Log::info("Procesando cóctel {$index} de " . count($drinks) . ": {$drink['strDrink']}");
                    
                    DB::beginTransaction();
                    try {
                        // Traducir los campos necesarios
                        $translatedName = $this->translationService->translateAndCache($drink['strDrink'] ?? '');
                        $translatedInstructions = $this->translationService->translateAndCache($drink['strInstructions'] ?? '');
                        $translatedGlass = $this->translationService->translateAndCache($drink['strGlass'] ?? '');
                        $translatedGarnish = isset($drink['strGarnish']) && $drink['strGarnish'] ? 
                            $this->translationService->translateAndCache($drink['strGarnish']) : null;

                        // Preparar los datos de la receta
                        $recipeData = [
                            'name_en' => $drink['strDrink'] ?? '',
                            'instructions' => $translatedInstructions ?: null,
                            'glass_type' => $translatedGlass ?: null,
                            'source' => 'system',
                            'image_url' => $drink['strDrinkThumb'] ?? null,
                            'is_private' => false,
                            'user_id' => 1, // ID del usuario admin o sistema
                            'source_api_id' => $apiToken->id
                        ];

                        // Agregar garnish solo si existe
                        if ($translatedGarnish !== null) {
                            $recipeData['garnish'] = $translatedGarnish;
                        }

                        // Crear o actualizar la receta
                        $recipe = Recipe::updateOrCreate(
                            ['name' => $translatedName ?: $drink['strDrink']], // Usar el nombre traducido o el original si la traducción falla
                            $recipeData
                        );

                        // Procesar ingredientes y medidas
                        $existingIngredients = [];
                        for ($i = 1; $i <= 15; $i++) {
                            $ingredientName = $drink["strIngredient{$i}"] ?? null;
                            $measure = $drink["strMeasure{$i}"] ?? null;

                            if (!empty($ingredientName)) {
                                // Normalizar y traducir el nombre del ingrediente
                                $ingredientName = trim($ingredientName);
                                $translatedName = $this->translationService->translateAndCache($ingredientName);
                                
                                \Log::info("Traduciendo ingrediente:", [
                                    'original' => $ingredientName,
                                    'traducido' => $translatedName
                                ]);

                                // Crear o encontrar el ingrediente
                                $ingredient = Ingredient::firstOrCreate(
                                    ['name' => $translatedName],
                                    [
                                        'description' => $this->translationService->translateAndCache("Ingredient imported from TheCocktailDB"),
                                        'source_api_id' => $apiToken->id,
                                        'category' => 'Sin Categorizar',
                                        'is_active' => true,
                                        'is_alcoholic' => 0 
                                    ]
                                );

                                // Evitar duplicados en la misma receta
                                if (!in_array($ingredient->id, $existingIngredients)) {
                                    // Convertir la medida a decimal y extraer la unidad
                                    $amount = $this->convertToDecimal($measure);
                                    
                                    // Crear o actualizar la relación con la medida
                                    RecipeIngredient::updateOrCreate(
                                        [
                                            'recipe_id' => $recipe->id,
                                            'ingredient_id' => $ingredient->id
                                        ],
                                        [
                                            'amount' => $amount ?? 0,
                                            'unit' => $measure ? $this->translationService->translateAndCache($measure) : 'Al gusto',
                                            'notes' => null
                                        ]
                                    );

                                    $existingIngredients[] = $ingredient->id;
                                }
                            }
                        }

                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollBack();
                        throw $e;
                    }

                    $importedCount++;
                } catch (\Exception $e) {
                    \Log::error("Error importando {$drink['strDrink']}: " . $e->getMessage());
                    $errors[] = "Error al importar {$drink['strDrink']}: " . $e->getMessage();
                }
            }

            $nextLetter = $this->getNextLetter($currentLetter);
            $isComplete = $nextLetter === false;

            $message = "Se importaron {$importedCount} cócteles que empiezan con '{$currentLetter}'.";
            if (count($errors) > 0) {
                $message .= " Hubo " . count($errors) . " errores.";
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'errors' => $errors,
                'nextLetter' => $nextLetter,
                'isComplete' => $isComplete,
                'importedCount' => $importedCount,
                'currentLetter' => $currentLetter
            ]);

        } catch (\Exception $e) {
            \Log::error("Error general en la importación: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al importar las recetas: ' . $e->getMessage(),
                'nextLetter' => $this->getNextLetter($currentLetter)
            ], 500);
        }
    }

    /**
     * Obtiene la siguiente letra del alfabeto
     * @param string $letter Letra actual
     * @return string|false La siguiente letra o false si es la última
     */
    private function getNextLetter($letter)
    {
        if ($letter === 'z') {
            return false;
        }
        return chr(ord($letter) + 1);
    }

    /**
     * Convierte una medida en texto a un valor decimal
     * @param string|null $measure La medida en texto (ej: "1 3/4 shot")
     * @return float|null El valor decimal o null si no se puede convertir
     */
    private function convertToDecimal($measure)
    {
        if (empty($measure)) {
            return null;
        }

        // Limpiamos la cadena
        $measure = trim(strtolower($measure));

        // Patrones comunes y sus valores decimales
        $fractions = [
            '1/4' => 0.25,
            '1/2' => 0.5,
            '3/4' => 0.75,
            '1/3' => 0.33,
            '2/3' => 0.67,
            '1/8' => 0.125,
            '1/6' => 0.167,
        ];

        // Inicializamos el total
        $total = 0;

        // Buscar números enteros
        if (preg_match('/(\d+)\s*(?=\s|$)/', $measure, $matches)) {
            $total += intval($matches[1]);
        }

        // Buscar fracciones conocidas
        foreach ($fractions as $fraction => $decimal) {
            if (strpos($measure, $fraction) !== false) {
                $total += $decimal;
            }
        }

        return $total > 0 ? $total : null;
    }
}
