<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pageMain');
})->name('inicio');


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/login', function () {
    return view('ingreso');
})->name('login');


Route::get('/recipes', function () {
    return view('recipes');
})->name('recipes');


// estas deberian ser las vistas 
 Route::get('/inventory', function () {
    return view('inventory.index');
})->name('inventory.index');

Route::get('/recipes/create', function () {
    return view('recipes.create');
})->name('recipes.create');

Route::get('/travel', function () {
    return view('travel.index');
})->name('travel.index');
