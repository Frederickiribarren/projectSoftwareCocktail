<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.pageMain');
})->name('inicio');


Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');


Route::get('/login', function () {
    return view('pages.ingreso');
})->name('login');


Route::get('/recipes', function () {
    return view('pages.recipes');
})->name('recipes');

Route::get('/create', function () {
    return view('layouts.create');
})->name('create');

Route::get('/index', function () {
    return view('layouts.index');
})->name('index');

Route::get('/edit', function () {
    return view('layouts.edit');
})->name('edit');

Route::get('/show', function () {
    return view('layouts.show');
})->name('show');

Route::get('/travel', function () {
    return view('layouts.travel');
})->name('travel');
