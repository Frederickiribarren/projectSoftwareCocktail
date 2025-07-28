<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class recipe_ingredientsController extends Controller
{
   public function index()
    {
        $recipe_ingredients = recipe_ingredients::all();
        return view('recipe_ingredients.index', compact('recipe_ingredients'));
    }
}
