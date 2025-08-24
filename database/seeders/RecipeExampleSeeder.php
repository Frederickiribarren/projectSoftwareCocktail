<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\recipe;
use App\Models\Ingredient;
use App\Models\RecipeIngredient;
use App\Models\User;

class RecipeExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario ejemplo si no existe
        $user = User::firstOrCreate([
            'email' => 'admin@cocktails.com'
        ], [
            'name' => 'Administrador',
            'password' => bcrypt('password'),
            'role' => 'hobbyist',
            'status' => 'active'
        ]);

        // Crear ingredientes básicos si no existen
        $ingredients = [
            ['name' => 'Ron Blanco', 'is_alcoholic' => true],
            ['name' => 'Ron Dorado', 'is_alcoholic' => true],
            ['name' => 'Vodka', 'is_alcoholic' => true],
            ['name' => 'Gin', 'is_alcoholic' => true],
            ['name' => 'Tequila', 'is_alcoholic' => true],
            ['name' => 'Whiskey', 'is_alcoholic' => true],
            ['name' => 'Jugo de Limón', 'is_alcoholic' => false],
            ['name' => 'Jugo de Lima', 'is_alcoholic' => false],
            ['name' => 'Jugo de Naranja', 'is_alcoholic' => false],
            ['name' => 'Azúcar', 'is_alcoholic' => false],
            ['name' => 'Menta', 'is_alcoholic' => false],
            ['name' => 'Agua Tónica', 'is_alcoholic' => false],
            ['name' => 'Agua Mineral', 'is_alcoholic' => false],
            ['name' => 'Hielo', 'is_alcoholic' => false],
            ['name' => 'Sirope Simple', 'is_alcoholic' => false],
            ['name' => 'Granadina', 'is_alcoholic' => false],
            ['name' => 'Triple Sec', 'is_alcoholic' => true],
            ['name' => 'Amaretto', 'is_alcoholic' => true],
            ['name' => 'Vermut Rojo', 'is_alcoholic' => true],
            ['name' => 'Vermut Blanco', 'is_alcoholic' => true],
            ['name' => 'Champagne', 'is_alcoholic' => true],
        ];

        $createdIngredients = [];
        foreach ($ingredients as $ingredientData) {
            $createdIngredients[] = Ingredient::firstOrCreate(
                ['name' => $ingredientData['name']],
                $ingredientData
            );
        }

        // Crear recetas de ejemplo
        $recipes = [
            [
                'name' => 'Mojito Clásico',
                'instructions' => 'Machaca las hojas de menta con azúcar en el fondo del vaso. Agrega jugo de lima, ron blanco y hielo. Completa con agua mineral y decora con menta.',
                'glass_type' => 'Vaso alto',
                'garnish' => 'Hojas de menta fresca',
                'user_id' => $user->id,
                'is_private' => false,
                'ingredients' => [
                    ['Ron Blanco', '60', 'ml'],
                    ['Jugo de Lima', '30', 'ml'],
                    ['Azúcar', '2', 'cucharaditas'],
                    ['Menta', '10', 'hojas'],
                    ['Agua Mineral', '120', 'ml'],
                    ['Hielo', '200', 'gr']
                ]
            ],
            [
                'name' => 'Margarita Tradicional',
                'instructions' => 'Mezcla tequila, triple sec y jugo de limón con hielo en coctelera. Sirve en vaso con borde de sal.',
                'glass_type' => 'Copa margarita',
                'garnish' => 'Rodaja de limón y sal en el borde',
                'user_id' => $user->id,
                'is_private' => false,
                'ingredients' => [
                    ['Tequila', '50', 'ml'],
                    ['Triple Sec', '25', 'ml'],
                    ['Jugo de Limón', '25', 'ml'],
                    ['Hielo', '200', 'gr']
                ]
            ],
            [
                'name' => 'Gin Tonic Perfecto',
                'instructions' => 'Sirve gin en vaso con hielo, completa con agua tónica fría. Decora con rodaja de limón.',
                'glass_type' => 'Vaso alto',
                'garnish' => 'Rodaja de limón',
                'user_id' => $user->id,
                'is_private' => false,
                'ingredients' => [
                    ['Gin', '50', 'ml'],
                    ['Agua Tónica', '150', 'ml'],
                    ['Hielo', '200', 'gr']
                ]
            ],
            [
                'name' => 'Daiquiri Clásico',
                'instructions' => 'Mezcla ron blanco, jugo de lima y sirope simple en coctelera con hielo. Sirve colado.',
                'glass_type' => 'Copa martini',
                'garnish' => 'Rueda de lima',
                'user_id' => $user->id,
                'is_private' => false,
                'ingredients' => [
                    ['Ron Blanco', '60', 'ml'],
                    ['Jugo de Lima', '20', 'ml'],
                    ['Sirope Simple', '15', 'ml'],
                    ['Hielo', '200', 'gr']
                ]
            ],
            [
                'name' => 'Manhattan Clásico',
                'instructions' => 'Mezcla whiskey y vermut rojo con hielo. Cuela y sirve con cereza.',
                'glass_type' => 'Copa martini',
                'garnish' => 'Cereza al marrasquino',
                'user_id' => $user->id,
                'is_private' => false,
                'ingredients' => [
                    ['Whiskey', '60', 'ml'],
                    ['Vermut Rojo', '30', 'ml'],
                    ['Hielo', '200', 'gr']
                ]
            ],
            [
                'name' => 'Mimosa',
                'instructions' => 'Combina partes iguales de champagne y jugo de naranja en copa flauta.',
                'glass_type' => 'Copa flauta',
                'garnish' => 'Rodaja de naranja',
                'user_id' => $user->id,
                'is_private' => false,
                'ingredients' => [
                    ['Champagne', '100', 'ml'],
                    ['Jugo de Naranja', '100', 'ml']
                ]
            ],
            [
                'name' => 'Limonada Virgin',
                'instructions' => 'Mezcla jugo de limón con agua mineral y azúcar. Sirve con hielo y menta.',
                'glass_type' => 'Vaso alto',
                'garnish' => 'Hojas de menta y rodaja de limón',
                'user_id' => $user->id,
                'is_private' => false,
                'ingredients' => [
                    ['Jugo de Limón', '60', 'ml'],
                    ['Agua Mineral', '200', 'ml'],
                    ['Azúcar', '2', 'cucharaditas'],
                    ['Menta', '5', 'hojas'],
                    ['Hielo', '200', 'gr']
                ]
            ],
            [
                'name' => 'Amaretto Sour',
                'instructions' => 'Combina amaretto, jugo de limón y sirope simple en coctelera. Sirve con hielo.',
                'glass_type' => 'Vaso old fashioned',
                'garnish' => 'Rodaja de limón y cereza',
                'user_id' => $user->id,
                'is_private' => false,
                'ingredients' => [
                    ['Amaretto', '50', 'ml'],
                    ['Jugo de Limón', '25', 'ml'],
                    ['Sirope Simple', '15', 'ml'],
                    ['Hielo', '200', 'gr']
                ]
            ]
        ];

        foreach ($recipes as $recipeData) {
            $ingredientsData = $recipeData['ingredients'];
            unset($recipeData['ingredients']);

            $recipe = recipe::create($recipeData);

            // Agregar ingredientes a la receta
            foreach ($ingredientsData as $ingredientInfo) {
                $ingredientName = $ingredientInfo[0];
                $amount = $ingredientInfo[1];
                $unit = $ingredientInfo[2];

                $ingredient = Ingredient::where('name', $ingredientName)->first();
                
                if ($ingredient) {
                    RecipeIngredient::create([
                        'recipe_id' => $recipe->id,
                        'ingredient_id' => $ingredient->id,
                        'amount' => $amount,
                        'unit' => $unit,
                    ]);
                }
            }
        }

        $this->command->info('Se han creado ' . count($recipes) . ' recetas de ejemplo con sus ingredientes.');
    }
}
