<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserRecipesController extends Controller
{
    public function index()
    {
        $recipes = Recipe::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'instructions' => 'required|string',
            'glass_type' => 'required|string',
            'garnish' => 'nullable|string',
            'image_url' => 'nullable|url',
            'ingredients' => 'required|array',
            'amounts' => 'required|array',
        ]);

        $recipe = Recipe::create([
            'name' => $validated['name'],
            'instructions' => $validated['instructions'],
            'glass_type' => $validated['glass_type'],
            'garnish' => $validated['garnish'],
            'image_url' => $validated['image_url'],
            'user_id' => Auth::id(),
            'is_private' => $request->has('is_private') && $request->input('is_private') == '1',
        ]);

        // Guardar ingredientes
        foreach($request->ingredients as $index => $ingredientName) {
            if (!empty($ingredientName)) {
                // Buscar o crear el ingrediente
                $ingredient = \App\Models\Ingredient::firstOrCreate([
                    'name' => trim($ingredientName)
                ], [
                    'description' => '',
                    'is_alcoholic' => false
                ]);

                // Parsear la cantidad y unidad del campo amount
                $amountString = $request->amounts[$index];
                $amount = (float) preg_replace('/[^0-9.]/', '', $amountString);
                $unit = trim(preg_replace('/[0-9.]/', '', $amountString));
                
                if (empty($unit)) {
                    $unit = 'ml'; // Unidad por defecto
                }

                $recipe->recipeIngredients()->create([
                    'ingredient_id' => $ingredient->id,
                    'amount' => $amount,
                    'unit' => $unit
                ]);
            }
        }

        return redirect()->route('user.recipes.index')
            ->with('success', 'Receta creada exitosamente.');
    }

    public function show(Recipe $recipe)
    {
        if (! Gate::allows('view', $recipe)) {
            abort(403);
        }
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        if (! Gate::allows('update', $recipe)) {
            abort(403);
        }
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        if (! Gate::allows('update', $recipe)) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'instructions' => 'required|string',
            'glass_type' => 'required|string',
            'garnish' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        $recipe->update([
            'name' => $validated['name'],
            'instructions' => $validated['instructions'],
            'glass_type' => $validated['glass_type'],
            'garnish' => $validated['garnish'],
            'image_url' => $validated['image_url'],
            'is_private' => $request->has('is_private') && $request->input('is_private') == '1',
        ]);

        return redirect()->route('user.recipes.index')
            ->with('success', 'Receta actualizada exitosamente.');
    }

    public function destroy(Recipe $recipe)
    {
        if (! Gate::allows('delete', $recipe)) {
            abort(403);
        }
        $recipe->delete();
        return redirect()->route('user.recipes.index')
            ->with('success', 'Receta eliminada exitosamente.');
    }

    public function getDetail(Recipe $recipe)
    {
        if (! Gate::allows('view', $recipe)) {
            abort(403);
        }
        
        return response()->json([
            'id' => $recipe->id,
            'name' => $recipe->name,
            'instructions' => $recipe->instructions,
            'glass_type' => $recipe->glass_type,
            'garnish' => $recipe->garnish,
            'image_url' => $recipe->image_url,
            'is_private' => $recipe->is_private,
            'recipe_ingredients' => $recipe->recipe_ingredients,
            'created_at' => $recipe->created_at->format('d/m/Y')
        ]);
    }
}






