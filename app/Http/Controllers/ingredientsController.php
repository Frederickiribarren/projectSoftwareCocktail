<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ingredientsController extends Controller
{
    public function index()
    {
        $ingredients = ingredients::all();
        return view('ingredients.index', compact('ingredients'));
    }
}
