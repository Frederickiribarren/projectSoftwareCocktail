@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/recipes.css') }}">

    <div class="page-container"> 
        <main class="main-content-recipes"> 
            <header class="page-header">
                <h1 class="page-title">Recetas del Mundo</h1>
                <p class="page-subtitle">Descubre las maravillas del mundo de la cockteleria.</p>
            </header>
            <section class="search-section">
                <div class="search-container">
                    <!-- Barra de búsqueda principal -->
                    <div class="search-bar">
                        <input type="text" id="searchInput" class="search-input" placeholder="Buscar cócteles por nombre...">
                        <button class="search-button" id="searchBtn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    
                    <!-- Filtros avanzados -->
                    <div class="filters-container">
                        <div class="filter-group">
                            <label class="filter-label">Categoría:</label>
                            <select id="categoryFilter" class="filter-select">
                                <option value="">Todas las categorías</option>
                                <option value="clasico">Clásicos</option>
                                <option value="tropical">Tropicales</option>
                                <option value="cremoso">Cremosos</option>
                                <option value="fuerte">Fuertes</option>
                                <option value="refrescante">Refrescantes</option>
                                <option value="sin-alcohol">Sin Alcohol</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Ingrediente Base:</label>
                            <select id="baseFilter" class="filter-select">
                                <option value="">Todos los ingredientes</option>
                                <option value="ron">Ron</option>
                                <option value="vodka">Vodka</option>
                                <option value="whiskey">Whiskey</option>
                                <option value="gin">Gin</option>
                                <option value="tequila">Tequila</option>
                                <option value="brandy">Brandy</option>
                                <option value="licor">Licores</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Dificultad:</label>
                            <select id="difficultyFilter" class="filter-select">
                                <option value="">Todas</option>
                                <option value="facil">Fácil</option>
                                <option value="intermedio">Intermedio</option>
                                <option value="dificil">Difícil</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Tiempo:</label>
                            <select id="timeFilter" class="filter-select">
                                <option value="">Cualquier tiempo</option>
                                <option value="rapido">Menos de 5 min</option>
                                <option value="medio">5-10 min</option>
                                <option value="largo">Más de 10 min</option>
                            </select>
                        </div>

                        <button class="clear-filters-btn" id="clearFilters">
                            <i class="fas fa-times"></i>
                            Limpiar Filtros
                        </button>
                    </div>
                </div>
            </section>

            <!-- Sección de resultados -->
            <section class="results-section">
                <div class="results-header">
                    <div class="results-count">
                        <span id="resultsCount">Mostrando todas las recetas</span>
                    </div>
                    <div class="sort-options">
                        <label>Ordenar por:</label>
                        <select id="sortSelect" class="sort-select">
                            <option value="name-asc">Nombre A-Z</option>
                            <option value="name-desc">Nombre Z-A</option>
                            <option value="difficulty-asc">Dificultad: Fácil primero</option>
                            <option value="difficulty-desc">Dificultad: Difícil primero</option>
                            <option value="time-asc">Tiempo: Rápido primero</option>
                            <option value="time-desc">Tiempo: Lento primero</option>
                        </select>
                    </div>
                </div>

                <!-- Grid de recetas -->
                <div class="recipes-grid" id="recipesGrid">
                    <!-- Las recetas se cargarán aquí dinámicamente -->
                    <div class="loading-spinner" id="loadingSpinner">
                        <i class="fas fa-spinner fa-spin"></i>
                        <p>Buscando recetas...</p>
                    </div>
                </div>

                <!-- Mensaje cuando no hay resultados -->
                <div class="no-results" id="noResults" style="display: none;">
                    <i class="fas fa-glass-martini-alt"></i>
                    <h3>No se encontraron recetas</h3>
                    <p>Intenta ajustar tus filtros de búsqueda</p>
                </div>
            </section>
        </main>
    </div>

    <!-- Script para funcionalidad de búsqueda y filtros -->
    <script src="{{ asset('js/recipe-search.js') }}"></script>
@endsection