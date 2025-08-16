<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.pageMain');
})->name('inicio');

Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes');
Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy')->middleware(['auth', 'verified']);

Route::get('/login', function () {
    return view('pages.ingreso');
})->name('login');

//Revisar group:function para reducir las rutas que requiera el middleware de autenticación//

Route::get('/show', function () {
    return view('layouts.show');
})->middleware(['auth', 'verified'])->name('show');



Route::get('/edit', function () {
    return view('layouts.edit');
})->middleware(['auth', 'verified'])->name('edit');

Route::get('/inventory', [IngredientsController::class, 'inventory'])->middleware(['auth', 'verified'])->name('inventory');

Route::post('/inventory/update', [IngredientsController::class, 'updateInventory'])->middleware(['auth', 'verified'])->name('inventory.update');

Route::get('/create', function () {
    return view('recipes.create');
})->middleware(['auth', 'verified'])->name('create');

Route::get('/travel', function () {
    return view('layouts.travel');
})->middleware(['auth', 'verified'])->name('travel');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
