<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatabaseAdminController;
use App\Http\Controllers\Admin\RecordController;
use App\Http\Controllers\RecipeImportController;


Route::get('/', function () {
    return view('pages.pageMain');
})->name('inicio');

// Rutas de administración
Route::prefix('admin')->group(function () {
    // Rutas específicas primero
    Route::get('relations/{name}', [RecordController::class, 'getRelations']);
    Route::get('search', [RecordController::class, 'search']);
    
    // Ruta para importar recetas
    Route::post('recipes/import/{letter?}', [RecipeImportController::class, 'importFromApi']);
    
    // Rutas dinámicas después
    Route::get('{table}/{id}', [RecordController::class, 'show']);
    Route::post('{table}', [RecordController::class, 'store']);
    Route::put('{table}/{id}', [RecordController::class, 'update']);
    Route::delete('{table}/{id}', [RecordController::class, 'destroy']);
});


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

// Rutas de perfil

Route::get('/profile', function () {
    return view('layouts.edit');
})->name('edit');


Route::get('/show', function () {
    return view('layouts.show');
})->name('show');

Route::get('/travel', function () {
    return view('layouts.travel');
})->name('travel');

Route::get('/inventory', function () {
    return view('layouts.inventory');
})->name('inventory');

// Rutas de administración de base de datos
Route::prefix('database-admin')->group(function () {
    Route::get('/', [DatabaseAdminController::class, 'index'])->name('database.admin');
    Route::get('/table/{table}', [DatabaseAdminController::class, 'showTable'])->name('table.view');
    Route::get('/table/{table}/records', [DatabaseAdminController::class, 'getFilteredRecords'])->name('table.records');
    Route::post('/table/{table}/create', [DatabaseAdminController::class, 'createRecord'])->name('table.create');
    Route::put('/table/{table}/{id}', [DatabaseAdminController::class, 'updateRecord'])->name('table.update');
    Route::delete('/table/{table}/{id}', [DatabaseAdminController::class, 'deleteRecord'])->name('table.delete');
});

// Rutas de administración
Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

Route::post('/admin/recipes/import-from-api', [RecipeImportController::class, 'importFromApi'])
    ->name('recipes.import');
