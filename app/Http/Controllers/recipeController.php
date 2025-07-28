<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class recipeController extends Controller
{
    public function index()
    {
        $recipe = recipe::all();
        return view('recipes.index', compact('recipes'));
    }
}
