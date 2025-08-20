@extends('layouts.app')

@section('title', 'Dashboard - Bar Biblioteca')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <div class="dashboard-container">
       <!-- <aside class="sidebar">
            <div class="sidebar-header">
                
                <h1 class="logo-text">Cocktail World</h1>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('profile.edit') }}" class="nav-link">
                    <i class="fas fa-user"></i>
                    <span>Perfil</span>
                </a>
                <a href="{{ route('user_recipe_notes.index') }}" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>mis notas receta</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-martini-glass-citrus"></i>
                    <span>Mis Recetas</span>
                </a>
                <a href="{{ route('travel') }}" class="nav-link">
                    <i class="fas fa-plane"></i>
                    <span>Modo Viaje</span>
                </a>
                <a href="{{ route('inventory') }}" class="nav-link">
                    <i class="fas fa-wine-bottle"></i>
                    <span>Mi Bar</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Configuración</span>
                </a>
                <a href="{{ route('database.admin') }}" class="nav-link">
                    <i class="fas fa-database"></i>
                    <span>Administrar Base de Datos</span>
                </a>
            </nav>
            <div class="sidebar-footer">
                <a href="#" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </div>
        </aside>-->
        <main class="main-content">
            <header class="main-header">
                <h2>Bienvenido, {{ Auth::user()->name }}</h2>
                <p>Explora y administra tus creaciones.</p>
            </header>
            <section class="dashboard-cards">
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-martini-glass-citrus"></i>
                    </div>
                    <div class="card-body">
                        <h3>Mis Recetas</h3>
                        <p>Gestiona tu colección de cócteles favoritos y creados.</p>
                        <a href="#" class="card-link">Ir a Mis Recetas &rarr;</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-wine-bottle"></i>
                    </div>
                    <div class="card-body">
                        <h3>Mi Bar</h3>
                        <p>Administra los ingredientes disponibles para ti.</p>
                        <a href="{{ route('inventory') }}" class="card-link">Ir a Mi Bar &rarr;</a>
                    </div>
                </div>
                 <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="card-body">
                        <h3>Nueva Receta</h3>
                        <p>Experimenta y crea nuevos tragos para añadir a tu coleccion</p>
                        <a href="{{ route('create') }}" class="card-link">Crear Nueva Receta &rarr;</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-plane"></i>
                    </div>
                    <div class="card-body">
                        <h3>Modo Avión</h3>
                        <p>Optimiza tus recetas según los ingredientes disponibles en tu destino.</p>
                        <a href="{{ route('travel') }}" class="card-link">Ir a Modo Avión &rarr;</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-sticky-note"></i>
                    </div>
                    <div class="card-body">
                        <h3>Mis Notas</h3>
                        <p>Guarda tus ideas y recetas en un solo lugar.</p>
                        <a href="{{ route('user_recipe_notes.index') }}" class="card-link">Crear Nueva Nota &rarr;</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="card-body">
                        <h3>Configuración</h3>
                        <p>Personaliza tu experiencia y preferencias.</p>
                        <a href="#" class="card-link">Ir a Configuración &rarr;</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <div class="card-body">
                        <h3>Base de Datos</h3>
                        <p>Gestiona y organiza tus recetas en la base de datos.</p>
                        <a href="{{ route('database.admin') }}" class="card-link">Ir a Base de Datos &rarr;</a>
                    </div>
                </div>
            </section>
        </main>
   </div>
@endsection