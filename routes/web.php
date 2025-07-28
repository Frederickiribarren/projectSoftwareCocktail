<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pageMain');
})->name('inicio');


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');