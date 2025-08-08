<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.pageMain');
})->name('inicio');

Route::get('/recipes', function () {
    return view('pages.recipes');
})->name('recipes');

Route::get('/show', function () {
    return view('layouts.show');
})->name('show');

Route::get('/login', function () {
    return view('pages.ingreso');
})->name('login');

Route::get('/edit', function () {
    return view('layouts.edit');
})->name('edit');

Route::get('/index', function () {
    return view('layouts.index');
})->name('index');

Route::get('/create', function () {
    return view('layouts.create');
})->name('create');

Route::get('/travel', function () {
    return view('layouts.travel');
})->name('travel');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
