<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\inventoriesController;
use App\Http\Controllers\user_recipe_notesController;
use App\Http\Controllers\UserController;
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

/*ruta notas*/ 
Route::middleware(['auth'])->group(function () {
    Route::resource('user_recipe_notes', user_recipe_notesController::class);
});

route::get('/user_recipe_notes', [user_recipe_notesController::class, 'index'])->name('user_recipe_notes.index');

/*rutas de inventories*/
Route::get('/inventories',[inventoriesController::class,'index'])->name('inventories.index');

Route::get('/usuario/index',[UserController::class, 'index'])->middleware(['auth', 'verified'])->name('usuario.index');
Route::resource('usuario',UserController::class);

Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes');
Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy')->middleware(['auth', 'verified']);

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
//Revisar group:function para reducir las rutas que requiera el middleware de autenticación//

Route::get('/show', function () {
    return view('layouts.show');
})->middleware(['auth', 'verified'])->name('show');



Route::get('/profile', function () {
    return view('layouts.edit');
})->name('edit');

})->middleware(['auth', 'verified'])->name('edit');

Route::get('/inventory', [IngredientsController::class, 'inventory'])->middleware(['auth', 'verified'])->name('inventory');

Route::post('/inventory/update', [IngredientsController::class, 'updateInventory'])->middleware(['auth', 'verified'])->name('inventory.update');

Route::get('/create', function () {
    return view('recipes.create');
})->middleware(['auth', 'verified'])->name('create');

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
