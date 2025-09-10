<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IngredientsController extends Controller
{
    // Vista
    public function inventory()
    {
        return view('pages.inventory');
    }

    // Listar ingredientes visibles (globales + privados del usuario) con su stock (pivot)
    public function list(Request $request)
    {
        $user = $request->user();
        $ingredients = Ingredient::whereNull('user_id')
            ->orWhere('user_id', $user->id)
            ->orderBy('name')
            ->get()
            ->map(function ($ing) use ($user) {
                $pivot = $user->ingredients()->where('ingredient_id', $ing->id)->first();
                return [
                    'id' => $ing->id,
                    'name' => $ing->name,
                    'category' => $ing->category,
                    'brand' => $ing->brand,
                    'unit' => $ing->unit,
                    'is_alcoholic' => $ing->is_alcoholic,
                    'flavors' => $ing->flavor_profile_tags ?? [],
                    'description' => $ing->description,
                    'stock' => $pivot ? $pivot->pivot->quantity : 0,
                    'has_user' => (bool)$pivot,
                    'is_private' => $ing->user_id !== null && $ing->user_id === $user->id,
                ];
            });
        return response()->json($ingredients);
    }

    // Crear (si ya existe global o privado del usuario => solo attach/update pivot; si no, crear privado con user_id)
    public function store(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'unit' => 'required|string|max:50',
            'stock' => 'nullable|integer|min:0',
            'flavors' => 'nullable|array',
            'is_alcoholic' => 'nullable|boolean',
            'description' => 'nullable|string|max:2000'
        ]);

        $nameNorm = trim($data['name']);
        $existing = Ingredient::whereRaw('LOWER(name)=?', [mb_strtolower($nameNorm)])
            ->where(function ($q) use ($user) {
                $q->whereNull('user_id')->orWhere('user_id', $user->id); // visible al usuario
            })
            ->first();

        $quantity = $data['stock'] ?? 0;

        if ($existing) {
            if ($user->ingredients()->where('ingredient_id', $existing->id)->exists()) {
                $user->ingredients()->updateExistingPivot($existing->id, ['quantity' => $quantity]);
            } else {
                $user->ingredients()->attach($existing->id, ['quantity' => $quantity]);
            }
            return response()->json(['message' => 'Ingrediente asociado', 'ingredient_id' => $existing->id], 200);
        }

        // Crear privado (solo visible para este usuario)
        $ingredient = Ingredient::create([
            'name' => $nameNorm,
            'category' => $data['category'],
            'brand' => $data['brand'] ?? null,
            'unit' => $data['unit'],
            'is_alcoholic' => $data['is_alcoholic'] ?? false,
            'flavor_profile_tags' => $data['flavors'] ?? [],
            'description' => $data['description'] ?? null,
            'user_id' => $user->id,
        ]);

        $user->ingredients()->attach($ingredient->id, ['quantity' => $quantity]);
        return response()->json(['message' => 'Ingrediente privado creado', 'ingredient_id' => $ingredient->id], 201);
    }

    // Actualizar: stock (pivot) siempre; datos del ingrediente solo si es privado del usuario o no compartido.
    public function update(Request $request, Ingredient $ingredient)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'category' => 'sometimes|required|string|max:255',
            'brand' => 'sometimes|nullable|string|max:255',
            'unit' => 'sometimes|required|string|max:50',
            'stock' => 'sometimes|integer|min:0',
            'flavors' => 'sometimes|array',
            'is_alcoholic' => 'sometimes|boolean',
            'description' => 'sometimes|nullable|string|max:2000'
        ]);
        $user = $request->user();

        DB::transaction(function () use ($data, $ingredient, $user) {
            if (array_key_exists('stock', $data)) {
                if ($user->ingredients()->where('ingredient_id', $ingredient->id)->exists()) {
                    $user->ingredients()->updateExistingPivot($ingredient->id, ['quantity' => $data['stock']]);
                } else {
                    $user->ingredients()->attach($ingredient->id, ['quantity' => $data['stock']]);
                }
            }

            $canEditIngredientRecord = ($ingredient->user_id !== null && $ingredient->user_id === $user->id) || $ingredient->users()->count() <= 1;

            if ($canEditIngredientRecord && (isset($data['name']) || isset($data['category']) || array_key_exists('brand', $data) || isset($data['unit']) || array_key_exists('flavors', $data) || array_key_exists('is_alcoholic', $data) || array_key_exists('description', $data))) {
                if (isset($data['name'])) {
                    $exists = Ingredient::whereRaw('LOWER(name)=?', [mb_strtolower($data['name'])])
                        ->where('id', '!=', $ingredient->id)
                        ->where(function ($q) use ($user) {
                            $q->whereNull('user_id')->orWhere('user_id', $user->id);
                        })
                        ->exists();
                    if ($exists) abort(422, 'Nombre ya existe.');
                    $ingredient->name = trim($data['name']);
                }
                foreach (['category', 'brand', 'unit', 'description'] as $f) {
                    if (array_key_exists($f, $data)) {
                        $ingredient->$f = $data[$f];
                    }
                }
                if (array_key_exists('is_alcoholic', $data)) $ingredient->is_alcoholic = $data['is_alcoholic'];
                if (array_key_exists('flavors', $data)) $ingredient->flavor_profile_tags = $data['flavors'];
                $ingredient->save();
            }
        });
        return response()->json(['message' => 'Actualizado']);
    }

    // Eliminar del inventario del usuario; si privado y sin uso borrar registro
    public function destroy(Request $request, Ingredient $ingredient)
    {
        $user = $request->user();
        $user->ingredients()->detach($ingredient->id);
        if ($ingredient->users()->count() === 0) { // nadie más lo tiene
            $ingredient->delete();
        }
        return response()->json(['message' => 'Eliminado']);
    }
}
