@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/travel.css') }}">
    <div class="container">
        <div class="header">
            <h1 class="title">Modo Viaje</h1>
            <p>Optimiza tus recetas según los ingredientes disponibles en tu destino. Perfecto para vacaciones, viajes de trabajo o cuando tienes recursos limitados.</p>
        </div>

        <div class="travel-grid">
            <div class="travel-card">
                <h3><i class='bx bx-map-alt'></i>Configura tu Destino</h3>
                <div class="input-group">
                    <label class="input-label" for="location">Ubicación</label>
                    <input type="text" id="location" class="input-field" placeholder="Ej: Hotel en Barcelona">
                </div>
                <div class="input-group">
                    <label class="input-label" for="duration">Duración de la Estancia</label>
                    <input type="number" id="duration" class="input-field" placeholder="Número de días">
                </div>
                <button class="btn">Guardar Destino</button>
            </div>

            <div class="travel-card">
                <h3><i class='bx bx-cabinet'></i>Inventario de Viaje</h3>
                <div class="input-group">
                    <label for="ingredients">Ingredientes Disponibles</label>
                    <input type="text" id="ingredients" class="input-field" placeholder="Añade ingredientes disponibles">
                </div>
                <div class="tag-container">
                    <span class="tag">Vodka <i class='bx bx-x'></i></span>
                    <span class="tag">Jugo de Naranja <i class='bx bx-x'></i></span>
                    <span class="tag">Tónica <i class='bx bx-x'></i></span>
                </div>
                <button class="btn btn-outline" style="margin-top: 1rem;">Añadir Ingrediente</button>
            </div>

            <div class="travel-card">
                <h3><i class='bx bx-book-heart'></i>Recetas Sugeridas</h3>
                <p style="margin-bottom: 1rem;">Basado en tu inventario de viaje actual, estas son las recetas que puedes preparar:</p>
                <div class="tag-container">
                    <span class="tag">Screwdriver</span>
                    <span class="tag">Vodka Tonic</span>
                </div>
                <button class="btn" style="margin-top: 1rem;">Ver Todas las Recetas</button>
            </div>

            <div class="travel-card">
                <h3><i class='bx bx-map'></i>Mis Viajes</h3>
                <div class="saved-trips">
                    <div class="trip-item">
                        <div class="trip-header">
                            <h4>Barcelona 2025</h4>
                            <span class="trip-date">15 - 20 Ago</span>
                        </div>
                        <div class="trip-details">
                            <p>5 recetas guardadas</p>
                            <p>8 ingredientes disponibles</p>
                        </div>
                        <button class="btn btn-outline btn-sm">Ver Detalles</button>
                    </div>
                    <div class="trip-item">
                        <div class="trip-header">
                            <h4>Madrid 2025</h4>
                            <span class="trip-date">1 - 5 Sep</span>
                        </div>
                        <div class="trip-details">
                            <p>3 recetas guardadas</p>
                            <p>6 ingredientes disponibles</p>
                        </div>
                        <button class="btn btn-outline btn-sm">Ver Detalles</button>
                    </div>
                </div>
                <button class="btn" style="width: 100%; margin-top: 1rem;">
                    <i class='bx bx-plus'></i> Nuevo Viaje
                </button>
            </div>
        </div>

    </div>

    <!-- Modal de Detalles del Viaje -->
    <div id="tripModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTripTitle">Detalles del Viaje</h2>
                <button class="close-modal"><i class='bx bx-x'></i></button>
            </div>
            <div class="modal-body">
                <div class="trip-detail-section">
                    <h3><i class='bx bx-map-pin'></i> Información del Destino</h3>
                    <ul class="trip-detail-list">
                        <li>
                            <span>Ubicación:</span>
                            <span id="modalLocation"></span>
                        </li>
                        <li>
                            <span>Fechas:</span>
                            <span id="modalDates"></span>
                        </li>
                        <li>
                            <span>Duración:</span>
                            <span id="modalDuration"></span>
                        </li>
                    </ul>
                </div>
                <div class="trip-detail-section">
                    <h3><i class='bx bx-cabinet'></i> Inventario del Viaje</h3>
                    <div id="modalIngredients" class="tag-container">
                        <!-- Los ingredientes se insertarán dinámicamente -->
                    </div>
                </div>
                <div class="trip-detail-section">
                    <h3><i class='bx bx-book-heart'></i> Recetas Sugeridas</h3>
                    <div id="modalRecipes" class="recipes-container">
                        <!-- Las recetas se insertarán dinámicamente -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline">Editar Viaje</button>
                <button class="btn">Guardar Cambios</button>
            </div>
        </div>
    </div>

    <script>
        // Funcionalidad del Modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('tripModal');
            const closeBtn = modal.querySelector('.close-modal');
            const tripButtons = document.querySelectorAll('.btn-sm');

            // Datos de ejemplo para los viajes
            const tripData = {
                'Barcelona 2025': {
                    location: 'Hotel Arts Barcelona',
                    dates: '15 - 20 Ago, 2025',
                    duration: '5 días',
                    ingredients: ['Vodka', 'Gin', 'Tónica', 'Jugo de Naranja', 'Lima', 'Hielo'],
                    recipes: [
                        {
                            name: 'Gin Tonic',
                            difficulty: 'Fácil',
                            ingredients: [
                                '60ml Gin',
                                '200ml Tónica',
                                'Hielo',
                                'Rodaja de Lima'
                            ],
                            instructions: 'Llena un vaso con hielo. Vierte el gin y completa con tónica. Garnish con una rodaja de lima.'
                        },
                        {
                            name: 'Screwdriver',
                            difficulty: 'Fácil',
                            ingredients: [
                                '50ml Vodka',
                                '150ml Jugo de Naranja',
                                'Hielo'
                            ],
                            instructions: 'En un vaso con hielo, vierte el vodka y completa con jugo de naranja. Revuelve suavemente.'
                        }
                    ]
                },
                'Madrid 2025': {
                    location: 'Apartamento Centro Madrid',
                    dates: '1 - 5 Sep, 2025',
                    duration: '4 días',
                    ingredients: ['Ron', 'Cola', 'Limón', 'Hielo', 'Tónica', 'Gin'],
                    recipes: ['Cuba Libre', 'Gin Tonic', 'Ron Collins']
                }
            };

            // Abrir modal
            tripButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const tripItem = this.closest('.trip-item');
                    const tripName = tripItem.querySelector('h4').textContent;
                    const tripInfo = tripData[tripName];

                    // Actualizar contenido del modal
                    document.getElementById('modalTripTitle').textContent = tripName;
                    document.getElementById('modalLocation').textContent = tripInfo.location;
                    document.getElementById('modalDates').textContent = tripInfo.dates;
                    document.getElementById('modalDuration').textContent = tripInfo.duration;

                    // Actualizar ingredientes
                    const ingredientsContainer = document.getElementById('modalIngredients');
                    ingredientsContainer.innerHTML = tripInfo.ingredients
                        .map(ing => `<span class="tag">${ing}</span>`)
                        .join('');

                    // Actualizar recetas
                    const recipesContainer = document.getElementById('modalRecipes');
                    recipesContainer.innerHTML = tripInfo.recipes
                        .map(recipe => `
                            <div class="recipe-item">
                                <div class="recipe-header">
                                    <h4>
                                        <i class='bx bx-cocktail'></i>
                                        ${recipe.name}
                                    </h4>
                                    <i class='bx bx-chevron-down'></i>
                                </div>
                                <div class="recipe-content">
                                    <div class="recipe-details">
                                        <div class="recipe-ingredients">
                                            <h5><i class='bx bx-list-ul'></i> Ingredientes</h5>
                                            <ul class="ingredient-list">
                                                ${recipe.ingredients.map(ing => `
                                                    <li><i class='bx bx-right-arrow-alt'></i>${ing}</li>
                                                `).join('')}
                                            </ul>
                                        </div>
                                        <div class="recipe-instructions">
                                            <h5><i class='bx bx-book-open'></i> Preparación</h5>
                                            <p>${recipe.instructions}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `).join('');

                    // Agregar funcionalidad de collapse a las recetas
                    const recipeHeaders = modal.querySelectorAll('.recipe-header');
                    recipeHeaders.forEach(header => {
                        header.addEventListener('click', () => {
                            const recipeItem = header.closest('.recipe-item');
                            recipeItem.classList.toggle('active');
                        });
                    });

                    modal.classList.add('active');
                });
            });

            // Cerrar modal
            closeBtn.addEventListener('click', () => {
                modal.classList.remove('active');
            });

            // Cerrar modal al hacer clic fuera
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.remove('active');
                }
            });
        });
    </script>

@endsection