<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class inventoriesController extends Controller
{
    public function index()
    {
        $inventories = inventories::all();
        return view('inventories.index', compact('inventories'));
    }
}
