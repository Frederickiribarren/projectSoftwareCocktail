<?php
namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientsApiController extends Controller
{
    // Crear ingrediente
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'unit' => 'required',
            'stock' => 'required|integer',
            'flavors' => 'required|array',
            'is_alcoholic' => 'required|boolean'
        ]);
        $ingredient = Ingredient::create([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'brand' => $validated['brand'],
            'unit' => $validated['unit'],
            'stock' => $validated['stock'],
            'flavor_profile_tags' => json_encode($validated['flavors']),
            'is_alcoholic' => $validated['is_alcoholic']
        ]);
        return response()->json($ingredient, 201);
    }

    // Leer todos los ingredientes
    public function index()
    {
        $ingredients = Ingredient::all();
        return response()->json($ingredients, 200);
    }

    // Leer ingrediente por ID
    public function show($id)
    {
        $ingredient = Ingredient::find($id);
        if (!$ingredient) {
            return response()->json(['message' => 'Ingrediente no encontrado'], 404);
        }
        return response()->json($ingredient, 200);
    }

    // Actualizar ingrediente
    public function update(Request $request, $id)
    {
        $ingredient = Ingredient::find($id);
        if (!$ingredient) {
            return response()->json(['message' => 'Ingrediente no encontrado'], 404);
        }
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'unit' => 'required',
            'stock' => 'required|integer',
            'flavors' => 'required|array',
            'is_alcoholic' => 'required|boolean'
        ]);
        $ingredient->update([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'brand' => $validated['brand'],
            'unit' => $validated['unit'],
            'stock' => $validated['stock'],
            'flavor_profile_tags' => json_encode($validated['flavors']),
            'is_alcoholic' => $validated['is_alcoholic']
        ]);
        return response()->json($ingredient, 200);
    }

    // Eliminar ingrediente
    public function destroy($id)
    {
        $ingredient = Ingredient::find($id);
        if (!$ingredient) {
            return response()->json(['message' => 'Ingrediente no encontrado'], 404);
        }
        $ingredient->delete();
        return response()->json(null, 204);
    }
}
