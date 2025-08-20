@extends('layouts.app')

@section('title', 'Explorar Recetas - Bar Biblioteca')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/recipes.css') }}">

    <div class="page-container"> 
        
        
        <main class="main-content-recipes"> 
            <header class="page-header">
                <h1 class="page-title">Recetas del Mundo</h1>
                <p class="page-subtitle">Descubre las maravillas del mundo de la cockteleria.</p>
            </header>

            
            <section class="search-section">
                <div class="search-bar">
                    <input type="text" class="search-input" placeholder="Buscar cócteles...">
                    <button class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </section>

            
           
        </main>
    </div>

@endsection