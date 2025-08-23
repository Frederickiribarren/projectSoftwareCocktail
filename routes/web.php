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


// Rutas públicas
Route::get('/', function () {
    return view('pages.pageMain');
})->name('inicio');

Route::get('/login', function () {
    return view('pages.ingreso');
})->name('login');

// Explorar recetas públicas
Route::get('/explorar-recetas', function () {
    return view('pages.recipes');
})->name('recipes.explore');

// Acerca de
Route::get('/acerca-de', function () {
    return view('pages.acerca-de');
})->name('acerca-de');

    

// ================================
// RUTAS PROTEGIDAS POR ROLES
// ================================

// Rutas solo para ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Panel de administración de base de datos
    Route::prefix('database-admin')->group(function () {
        Route::get('/', [DatabaseAdminController::class, 'index'])->name('database.admin');
        Route::get('/table/{table}', [DatabaseAdminController::class, 'showTable'])->name('table.view');
        Route::get('/table/{table}/records', [DatabaseAdminController::class, 'getFilteredRecords'])->name('table.records');
        Route::post('/table/{table}/create', [DatabaseAdminController::class, 'createRecord'])->name('table.create');
        Route::put('/table/{table}/{id}', [DatabaseAdminController::class, 'updateRecord'])->name('table.update');
        Route::delete('/table/{table}/{id}', [DatabaseAdminController::class, 'deleteRecord'])->name('table.delete');
    });
    
    // Gestión de usuarios (solo admin)
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::get('/usuario/index', [UserController::class, 'index'])->name('usuario.index');
    Route::resource('usuario', UserController::class);
    
    // Importación de recetas desde API
    Route::post('/admin/recipes/import-from-api', [RecipeImportController::class, 'importFromApi'])
        ->name('recipes.import');
    
    // Configuración del sistema
    Route::get('/system-settings', function () {
        return view('admin.system-settings');
    })->name('admin.system.settings');
    
    // Reportes y estadísticas
    Route::get('/admin/reports', function () {
        return view('admin.reports');
    })->name('admin.reports');
});

// Rutas para PROFESSIONAL y ADMIN
Route::middleware(['auth', 'role:admin,professional'])->group(function () {
    // Análisis profesional
    Route::get('/analytics', function () {
        return view('pages.analytics');
    })->name('analytics');
    
    // Recetas públicas
    Route::get('/public-recipes', function () {
        return view('pages.public-recipes');
    })->name('public.recipes');
    
    // Herramientas profesionales
    Route::get('/professional-tools', function () {
        return view('pages.professional-tools');
    })->name('professional.tools');
});

// Rutas para todos los usuarios autenticados (HOBBYIST, PROFESSIONAL, ADMIN)
Route::middleware(['auth'])->group(function () {
    // Dashboard principal
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');
    
    // Gestión personal
    Route::get('/inventory', [IngredientsController::class, 'inventory'])->name('inventory');
    Route::post('/inventory/update', [IngredientsController::class, 'updateInventory'])->name('inventory.update');
    
    // Modo viaje
    Route::get('/travel', function () {
        return view('pages.travel');
    })->name('travel');

    // Creación de recetas
    Route::get('/create', function () {
        return view('recipes.create');
    })->name('create');
    
    // Mostrar detalles de receta
    Route::get('/show', function () {
        return view('layouts.show');
    })->name('show');
    
    // Gestión de recetas personales
    Route::resource('recipes', RecipeController::class);
    
    // Notas personales
    Route::resource('user_recipe_notes', user_recipe_notesController::class);
    Route::get('/user_recipe_notes', [user_recipe_notesController::class, 'index'])->name('user_recipe_notes.index');
    
    // Inventarios
    Route::get('/inventories', [inventoriesController::class, 'index'])->name('inventories.index');
    
    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile-view', function () {
        return view('layouts.edit');
    })->name('edit');
});

// ================================
// RUTAS ESPECIALES DE ADMINISTRACIÓN
// ================================

// Rutas administrativas específicas (solo admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
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

// Incluir rutas de autenticación
require __DIR__.'/auth.php';
