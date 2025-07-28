<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class user_favoritesController extends Controller
{
    public function index()
    {
        $user_favorites = user_favorites::all();
        return view('user_favorites.index', compact('user_favorites'));
    }
}
