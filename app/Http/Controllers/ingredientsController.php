<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientsController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::all();
        $userIngredients = auth()->user()->ingredients->pluck('id')->toArray();
        return view('layouts.index', compact('ingredients', 'userIngredients'));
    }

    public function updateInventory(Request $request)
    {
        $user = auth()->user();
        $ingredientIds = $request->ingredients ?? [];
        $user->ingredients()->sync($ingredientIds);
        return redirect()->back()->with('success', 'Inventario actualizado correctamente');
    }
}
