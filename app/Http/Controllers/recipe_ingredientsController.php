<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\recipe_ingredients;

class recipe_ingredientsController extends Controller
{
   public function index()
    {
        $recipe_ingredients = recipe_ingredients::all();
        return view('recipe_ingredients.index', compact('recipe_ingredients'));
    }
    public function create()
    {
        return view('recipe_ingredients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipe_id' => 'required',
            'ingredient_id' => 'required',
            'amount' => 'required',
        ]);

        recipe_ingredients::create($validated);
        return redirect()->route('recipe_ingredients.index');
    }

    public function show(recipe_ingredients $recipe_ingredient)
    {
        return view('recipe_ingredients.show', compact('recipe_ingredient'));
    }

    public function edit(recipe_ingredients $recipe_ingredient)
    {
        return view('recipe_ingredients.edit', compact('recipe_ingredient'));
    }

    public function update(Request $request, recipe_ingredients $recipe_ingredient)
    {
        $validated = $request->validate([
            'recipe_id' => 'required',
            'ingredient_id' => 'required',
            'amount' => 'required',
        ]);

        $recipe_ingredient->update($validated);
        return redirect()->route('recipe_ingredients.index');
    }

    public function destroy(recipe_ingredients $recipe_ingredient)
    {
        $recipe_ingredient->delete();
        return redirect()->route('recipe_ingredients.index');
    }
}
