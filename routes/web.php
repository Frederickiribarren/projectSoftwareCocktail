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
