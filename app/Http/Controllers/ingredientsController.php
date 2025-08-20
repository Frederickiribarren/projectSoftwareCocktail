<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientsController extends Controller
{
    public function inventory()
    {
        $user = auth()->user();
        // Obtener ingredientes con la relación pivot
        $ingredients = Ingredient::with(['users' => function($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->get();

        // Debug para verificar datos
        \Log::info('Ingredients:', ['data' => $ingredients->toArray()]);
        
        return view('pages.inventory', [
            'ingredients' => $ingredients,
            'userIngredients' => $user->ingredients()->pluck('ingredients.id')->toArray()
        ]);
    }

    public function updateInventory(Request $request)
    {
        try {
            $user = auth()->user();
            $data = $request->all();

            if (!empty($data['ingredientName'])) {
                // Crear nuevo ingrediente
                $ingredient = Ingredient::create([
                    'name' => $data['ingredientName'],
                    'category' => $data['ingredientCategory'],
                    'brand' => $data['ingredientBrand'],
                    'unit' => $data['ingredientUnit'],
                    'is_alcoholic' => $data['ingredientAlcoholic'],
                    'flavor_profile_tags' => json_encode(explode(',', $data['ingredientFlavors'])),
                ]);

                // Agregar a la tabla pivote con cantidad
                $user->ingredients()->attach($ingredient->id, ['quantity' => $data['ingredientStock']]);

                return response()->json([
                    'success' => true,
                    'ingredients' => $this->getFormattedIngredients($user)
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Datos inválidos'
            ], 400);

        } catch (\Exception $e) {
            \Log::error('Error en updateInventory:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function getFormattedIngredients($user)
    {
        return Ingredient::with(['users' => function($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->get();
    }
}
