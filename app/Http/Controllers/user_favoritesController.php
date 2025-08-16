<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user_favorites;

class user_favoritesController extends Controller
{
    public function index()
    {
        $user_favorites = user_favorites::all();
        return view('user_favorites.index', compact('user_favorites'));
    }
    public function create()
    {
        return view('user_favorites.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'recipe_id' => 'required'
        ]);
        
        return redirect()->route('user_favorites.index');
    }

    public function show(user_favorites $user_favorite)
    {
        return view('user_favorites.show', compact('user_favorite'));
    }

    public function edit(user_favorites $user_favorite)
    {
        return view('user_favorites.edit', compact('user_favorite')); 
    }

    public function update(Request $request, user_favorites $user_favorite)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'cocktail_id' => 'required'
        ]);
        
        $user_favorite->update($validated);
        return redirect()->route('user_favorites.index');
    }

    public function destroy(user_favorites $user_favorite)
    {
        $user_favorite->delete();
        return redirect()->route('user_favorites.index');
    }
}
