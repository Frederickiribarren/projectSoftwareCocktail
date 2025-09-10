<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IngredientsController extends Controller
{
    // Mantiene la vista original sin alterar estructura visual
    public function inventory()
    {
        return view('pages.inventory');
    }

    // Listar ingredientes del usuario (pivot) con datos base del ingrediente
    public function list(Request $request)
    {
        $user = $request->user();
        $ingredients = Ingredient::orderBy('name')->get()->map(function($ing) use ($user) {
            $pivot = $user->ingredients()->where('ingredient_id',$ing->id)->first();
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
            ];
        });
        return response()->json($ingredients);
    }

    // Crear ingrediente + asociar al usuario
    public function store(Request $request)
    {
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
        $existing = Ingredient::whereRaw('LOWER(name)=?', [mb_strtolower($nameNorm)])->first();
        if ($existing) {
            // Si existe, solo asociar/actualizar cantidad al usuario
            $quantity = $data['stock'] ?? 0;
            $user = $request->user();
            if ($user->ingredients()->where('ingredient_id',$existing->id)->exists()) {
                $user->ingredients()->updateExistingPivot($existing->id, ['quantity'=>$quantity]);
            } else {
                $user->ingredients()->attach($existing->id, ['quantity'=>$quantity]);
            }
            return response()->json(['message'=>'Asociado ingrediente existente','ingredient_id'=>$existing->id],200);
        }
        $ingredient = Ingredient::create([
            'name' => $nameNorm,
            'category' => $data['category'],
            'brand' => $data['brand'] ?? null,
            'unit' => $data['unit'],
            'is_alcoholic' => $data['is_alcoholic'] ?? false,
            'flavor_profile_tags' => $data['flavors'] ?? [],
            'description' => $data['description'] ?? null,
        ]);
        $request->user()->ingredients()->attach($ingredient->id, ['quantity' => $data['stock'] ?? 0]);
        return response()->json(['message'=>'Ingrediente creado','ingredient_id'=>$ingredient->id],201);
    }

    // Actualizar ingrediente (solo si lo usa un único usuario) o stock del pivot
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
        DB::transaction(function() use ($data,$ingredient,$user) {
            if (array_key_exists('stock',$data)) {
                if ($user->ingredients()->where('ingredient_id',$ingredient->id)->exists()) {
                    $user->ingredients()->updateExistingPivot($ingredient->id, ['quantity'=>$data['stock']]);
                } else {
                    $user->ingredients()->attach($ingredient->id, ['quantity'=>$data['stock']]);
                }
            }
            if (isset($data['name']) || isset($data['category']) || array_key_exists('brand',$data) || isset($data['unit']) || array_key_exists('flavors',$data) || array_key_exists('is_alcoholic',$data) || array_key_exists('description',$data)) {
                $usersCount = $ingredient->users()->count();
                if ($usersCount > 1) {
                    abort(422,'No se puede editar este ingrediente porque lo usan varios usuarios.');
                }
                if (isset($data['name'])) {
                    $exists = Ingredient::whereRaw('LOWER(name)=?', [mb_strtolower($data['name'])])
                        ->where('id','!=',$ingredient->id)->exists();
                    if ($exists) abort(422,'Nombre ya existe.');
                    $ingredient->name = trim($data['name']);
                }
                foreach (['category','brand','unit','description'] as $f) {
                    if (array_key_exists($f,$data)) { $ingredient->$f = $data[$f]; }
                }
                if (array_key_exists('is_alcoholic',$data)) $ingredient->is_alcoholic = $data['is_alcoholic'];
                if (array_key_exists('flavors',$data)) $ingredient->flavor_profile_tags = $data['flavors'];
                $ingredient->save();
            }
        });
        return response()->json(['message'=>'Actualizado']);
    }

    // Quitar ingrediente del usuario; eliminar si nadie más lo usa
    public function destroy(Request $request, Ingredient $ingredient)
    {
        $user = $request->user();
        $user->ingredients()->detach($ingredient->id);
        if ($ingredient->users()->count() === 0) { $ingredient->delete(); }
        return response()->json(['message'=>'Eliminado']);
    }
}
