<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        return view('pages.recipes', compact('recipes'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'instructions' => 'required',
            'glass_type' => 'required',
            'garnish' => 'nullable',
            'image_url' => 'nullable|url',
            'source' => 'nullable',
            'is_private' => 'boolean',
            'source_api_id' => 'nullable'
        ]);

        $validated['user_id'] = auth()->id();
        
        $recipe = Recipe::create($validated);

        return redirect()->route('recipes.show', $recipe)
            ->with('success', 'Recipe created successfully.');
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'instructions' => 'required',
            'glass_type' => 'required',
            'garnish' => 'nullable',
            'image_url' => 'nullable|url',
            'source' => 'nullable',
            'is_private' => 'boolean',
        ]);

        $recipe->update($validated);

        return redirect()->route('recipes.show', $recipe)
            ->with('success', 'Receta actualizada correctamente.');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Receta eliminada correctamente');
    }
}
