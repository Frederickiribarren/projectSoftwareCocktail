<?php

namespace App\Http\Controllers;

use App\Models\recipe;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RecipeApiController extends Controller
{
    /**
     * Obtener todas las recetas con sus ingredientes
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = recipe::with(['ingredients', 'user'])
                ->select(['id', 'name', 'instructions', 'glass_type', 'garnish', 'image_url', 'user_id', 'source'])
                ->where('is_private', false);

            // Aplicar filtros
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where('name', 'like', "%{$search}%");
            }

            if ($request->has('glass_type') && !empty($request->glass_type)) {
                $query->where('glass_type', $request->glass_type);
            }

            if ($request->has('ingredient') && !empty($request->ingredient)) {
                $ingredientName = $request->ingredient;
                $query->whereHas('ingredients', function ($q) use ($ingredientName) {
                    $q->where('name', 'like', "%{$ingredientName}%");
                });
            }

            if ($request->has('alcoholic')) {
                $isAlcoholic = $request->alcoholic === 'alcoholic';
                $query->whereHas('ingredients', function ($q) use ($isAlcoholic) {
                    $q->where('is_alcoholic', $isAlcoholic);
                });
            }

            // Optimización: usar chunk para consultas grandes
            $perPage = min($request->get('per_page', 50), 50); // Máximo 50 por página
            $recipes = $query->paginate($perPage);

            // Formatear datos para el frontend
            $formattedRecipes = $recipes->getCollection()->map(function ($recipe) {
                return $this->formatRecipe($recipe);
            });

            return response()->json([
                'success' => true,
                'data' => $formattedRecipes,
                'pagination' => [
                    'current_page' => $recipes->currentPage(),
                    'last_page' => $recipes->lastPage(),
                    'per_page' => $recipes->perPage(),
                    'total' => $recipes->total(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar las recetas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener una receta específica
     */
    public function show($id): JsonResponse
    {
        try {
            $recipe = recipe::with(['ingredients', 'user'])
                ->where('is_private', false)
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $this->formatRecipe($recipe)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Receta no encontrada',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Obtener ingredientes únicos para filtros
     */
    public function getIngredients(): JsonResponse
    {
        try {
            $ingredients = Ingredient::select('name', 'is_alcoholic')
                ->distinct()
                ->orderBy('name')
                ->get();

            $alcoholic = $ingredients->where('is_alcoholic', true)->pluck('name');
            $nonAlcoholic = $ingredients->where('is_alcoholic', false)->pluck('name');

            return response()->json([
                'success' => true,
                'data' => [
                    'all' => $ingredients->pluck('name'),
                    'alcoholic' => $alcoholic,
                    'non_alcoholic' => $nonAlcoholic
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar ingredientes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener recetas populares/destacadas para carga inicial rápida
     */
    public function featured(Request $request): JsonResponse
    {
        try {
            // Usar cache para mejorar velocidad
            $cacheKey = 'featured_recipes_' . ($request->get('limit', 12));
            
            $recipes = \Cache::remember($cacheKey, 300, function () use ($request) { // Cache por 5 minutos
                return recipe::with(['ingredients', 'user:id,name'])
                    ->select(['id', 'name', 'instructions', 'glass_type', 'garnish', 'image_url', 'user_id', 'source'])
                    ->where('is_private', false)
                    ->limit($request->get('limit', 12))
                    ->orderBy('created_at', 'desc')
                    ->get();
            });

            // Formatear datos
            $formattedRecipes = $recipes->map(function ($recipe) {
                return $this->formatRecipe($recipe);
            });

            return response()->json([
                'success' => true,
                'data' => $formattedRecipes,
                'total' => $formattedRecipes->count()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar recetas destacadas',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getGlassTypes(): JsonResponse
    {
        try {
            $glassTypes = recipe::select('glass_type')
                ->where('is_private', false)
                ->whereNotNull('glass_type')
                ->distinct()
                ->orderBy('glass_type')
                ->pluck('glass_type');

            return response()->json([
                'success' => true,
                'data' => $glassTypes
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar tipos de vasos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Formatear receta para el frontend
     */
    private function formatRecipe($recipe): array
    {
        $ingredients = $recipe->ingredients->map(function ($ingredient) {
            $pivot = $ingredient->pivot;
            $amount = $pivot->amount ?? '';
            $unit = $pivot->unit ?? '';
            
            return [
                'name' => $ingredient->name,
                'amount' => $amount,
                'unit' => $unit,
                'full' => trim("{$amount} {$unit} {$ingredient->name}"),
                'is_alcoholic' => $ingredient->is_alcoholic
            ];
        });

        // Determinar si es alcohólico
        $hasAlcohol = $ingredients->contains('is_alcoholic', true);
        
        // Calcular dificultad basada en número de ingredientes
        $ingredientCount = $ingredients->count();
        $difficulty = 'facil';
        if ($ingredientCount > 5) {
            $difficulty = 'intermedio';
        }
        if ($ingredientCount > 8) {
            $difficulty = 'dificil';
        }

        // Detectar ingrediente base
        $alcoholicIngredients = $ingredients->where('is_alcoholic', true);
        $baseIngredient = $alcoholicIngredients->isNotEmpty() 
            ? $this->detectBaseSpirit($alcoholicIngredients->first()['name'])
            : 'sin-alcohol';

        return [
            'id' => $recipe->id,
            'name' => $recipe->name,
            'description' => $this->generateDescription($recipe, $ingredients),
            'instructions' => $recipe->instructions,
            'image' => $recipe->image_url ?: '/img/default-cocktail.jpg',
            'imageThumb' => $recipe->image_url ?: '/img/default-cocktail.jpg',
            'glass' => $recipe->glass_type,
            'garnish' => $recipe->garnish,
            'alcoholic' => $hasAlcohol ? 'alcoholic' : 'non-alcoholic',
            'difficulty' => $difficulty,
            'base' => $baseIngredient,
            'category' => $this->detectCategory($recipe, $ingredients),
            'ingredients' => $ingredients->pluck('full')->toArray(),
            'ingredientDetails' => $ingredients->toArray(),
            'author' => $recipe->user ? $recipe->user->name : 'Anónimo',
            'source' => $recipe->source
        ];
    }

    /**
     * Detectar el licor base principal
     */
    private function detectBaseSpirit($ingredientName): string
    {
        $name = strtolower($ingredientName);
        
        if (str_contains($name, 'vodka')) return 'vodka';
        if (str_contains($name, 'ron') || str_contains($name, 'rum')) return 'ron';
        if (str_contains($name, 'whiskey') || str_contains($name, 'whisky')) return 'whiskey';
        if (str_contains($name, 'gin') || str_contains($name, 'ginebra')) return 'gin';
        if (str_contains($name, 'tequila')) return 'tequila';
        if (str_contains($name, 'brandy') || str_contains($name, 'cognac')) return 'brandy';
        
        return 'licor';
    }

    /**
     * Detectar categoría del cóctel
     */
    private function detectCategory($recipe, $ingredients): string
    {
        $name = strtolower($recipe->name);
        $hasAlcohol = $ingredients->contains('is_alcoholic', true);
        
        if (!$hasAlcohol) return 'sin-alcohol';
        
        // Detectar por nombre o ingredientes
        if (str_contains($name, 'martini') || str_contains($name, 'manhattan')) return 'clasico';
        if (str_contains($name, 'mojito') || str_contains($name, 'piña')) return 'tropical';
        if (str_contains($name, 'cream') || str_contains($name, 'crema')) return 'cremoso';
        
        // Por número de ingredientes alcohólicos
        $alcoholicCount = $ingredients->where('is_alcoholic', true)->count();
        if ($alcoholicCount > 2) return 'fuerte';
        
        return 'refrescante';
    }

    /**
     * Generar descripción automática
     */
    private function generateDescription($recipe, $ingredients): string
    {
        $baseIngredients = $ingredients->where('is_alcoholic', true)->take(2)->pluck('name');
        $hasAlcohol = $baseIngredients->isNotEmpty();
        
        if (!$hasAlcohol) {
            return "Deliciosa bebida sin alcohol perfecta para cualquier ocasión.";
        }
        
        $base = $baseIngredients->first();
        $count = $ingredients->count();
        
        return "Exquisito cóctel a base de {$base} con {$count} ingredientes cuidadosamente seleccionados.";
    }
}
