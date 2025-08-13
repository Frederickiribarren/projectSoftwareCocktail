<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.pageMain');
})->name('inicio');

Route::get('/recipes', function () {
    $recipes = \App\Models\Recipe::all();
    return view('pages.recipes', compact('recipes'));
})->name('recipes');

Route::delete('/recipes/{recipe}', function($recipe) {
    \App\Models\Recipe::destroy($recipe);
    return redirect()->route('recipes')->with('success', 'Receta eliminada correctamente');
})->name('recipes.destroy')->middleware(['auth', 'verified']);

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

Route::get('/index', function () {
    $ingredients = \App\Models\Ingredient::all();
    $userIngredients = auth()->user()->ingredients->pluck('id')->toArray();
    return view('layouts.index', compact('ingredients', 'userIngredients'));
})->middleware(['auth', 'verified'])->name('index');

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

Route::post('/inventory/update', function (Request $request) {
    $user = auth()->user();
    $ingredientIds = $request->ingredients ?? [];
    $user->ingredients()->sync($ingredientIds);
    return redirect()->back()->with('success', 'Inventario actualizado correctamente');
})->middleware(['auth', 'verified'])->name('inventory.update');

require __DIR__.'/auth.php';
