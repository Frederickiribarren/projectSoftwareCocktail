<?php

namespace App\Http\Controllers;

use App\Models\recipe;
use Illuminate\Http\Request;

class recipeController extends Controller
{
    public function index()
    {
        $recipe = recipe::all();
        return view('recipes.index', compact('recipes'));
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
}
