<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class user_recipe_notesController extends Controller
{
    public function index()
    {
        $user_recipe_notes = user_recipe_notes::all();
        return view('user_recipe_notes.index', compact('user_recipe_notes'));
    }
}
