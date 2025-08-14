<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modo Viaje - The Alchemist's Folio</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap');
        
        :root {
            --primary-color: #1a1a1a;
            --secondary-color: #ffffff;
            --accent-color: #ffd700;
            --accent-dark: #cc9900;
            --hover-color: #f0c400;
            --text-color: #e0e0e0;
            --text-dark: #333333;
            --border-color: #4a4a4a;
            --background-light: #ffffff;
            --background-dark: #1a1a1a;
            --background-card: #2a2a2a;
            --success-color: #4CAF50;
            --error-color: #f44336;
            --gradient-dark: linear-gradient(145deg, #222222, #333333);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: 'Montserrat', sans-serif;
            color: var(--text-color);
        }

        body {
            background-color: var(--background-dark);
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 1200px;
            min-height: 80vh;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
            width: 100%;
        }

        .header h1 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 2.5rem;
            color: var(--accent-color);
            margin-bottom: 1rem;
        }

        .header p {
            font-size: 1.1rem;
            color: var(--text-color);
            max-width: 600px;
            margin: 0 auto;
        }

        
        .travel-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            width: 100%;
            margin-top: 2rem;
        }

        .travel-card {
            background: var(--gradient-dark);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid var(--border-color);
        }

        .travel-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
            border-color: var(--accent-color);
        }

        .travel-card h3 {
            color: var(--accent-color);
            font-size: 1.25rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .travel-card p {
            color: var(--text-color);
            line-height: 1.6;
        }

        .travel-card i {
            color: var(--accent-color);
            font-size: 1.5rem;
        }

        .input-group {
            margin-bottom: 1.5rem;
        }

        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--accent-color);
        }

        .input-field {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-color);
        }

        .input-field:focus {
            outline: none;
            border-color: var(--accent-color);
            background: rgba(255, 255, 255, 0.15);
        }

        .input-field::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .btn {
            background: var(--accent-color);
            color: var(--primary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: center;
            display: inline-block;
            text-decoration: none;
        }

        .btn:hover {
            background: var(--hover-color);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
        }

        .btn-outline:hover {
            background: var(--accent-color);
            color: var(--primary-color);
        }

        .tag-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .tag {
            background: rgba(255, 215, 0, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            color: var(--text-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid var(--accent-color);
        }

        .tag i {
            font-size: 1rem;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .header h1 {
                font-size: 2rem;
            }

            .travel-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @include('components.navbar')

    <div class="container">
        <div class="header">
            <h1 class="title">Modo Viaje</h1>
            <p>Optimiza tus recetas según los ingredientes disponibles en tu destino. Perfecto para vacaciones, viajes de trabajo o cuando tienes recursos limitados.</p>
        </div>

        <div class="travel-grid">
            <div class="travel-card">
                <h3><i class='bx bx-map-alt'></i>Configura tu Destino</h3>
                <div class="input-group">
                    <label for="location">Ubicación</label>
                    <input type="text" id="location" class="input-field" placeholder="Ej: Hotel en Barcelona">
                </div>
                <div class="input-group">
                    <label for="duration">Duración de la Estancia</label>
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

        <style>
            .saved-trips {
                margin-top: 1rem;
            }

            .trip-item {
                padding: 1rem;
                border: 1px solid var(--border-color);
                border-radius: 8px;
                margin-bottom: 1rem;
                transition: all 0.3s ease;
            }

            .trip-item:hover {
                border-color: var(--accent-color);
                background: rgba(255, 215, 0, 0.1);
            }

            .trip-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 0.5rem;
            }

            .trip-header h4 {
                color: var(--accent-color);
                margin: 0;
            }

            .trip-date {
                color: var(--text-color);
                font-size: 0.875rem;
            }

            .trip-details {
                margin: 0.5rem 0;
            }

            .trip-details p {
                color: var(--text-color);
                margin: 0.25rem 0;
                font-size: 0.875rem;
            }

            .btn-sm {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }

            /* Estilos del Modal */
            .modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.8);
                z-index: 1000;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .modal.active {
                display: flex;
                opacity: 1;
            }

            .modal-content {
                background: var(--gradient-dark);
                border: 1px solid var(--accent-color);
                border-radius: 12px;
                padding: 2rem;
                width: 90%;
                max-width: 600px;
                margin: auto;
                position: relative;
                transform: translateY(-20px);
                transition: transform 0.3s ease;
            }

            .modal.active .modal-content {
                transform: translateY(0);
            }

            .modal-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1.5rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid var(--border-color);
            }

            .modal-header h2 {
                color: var(--accent-color);
                font-size: 1.5rem;
                margin: 0;
            }

            .close-modal {
                background: none;
                border: none;
                color: var(--text-color);
                font-size: 1.5rem;
                cursor: pointer;
                padding: 0.5rem;
                transition: color 0.3s ease;
            }

            .close-modal:hover {
                color: var(--accent-color);
            }

            .modal-body {
                margin-bottom: 1.5rem;
            }

            .trip-detail-section {
                margin-bottom: 1.5rem;
            }

            .trip-detail-section h3 {
                color: var(--accent-color);
                font-size: 1.1rem;
                margin-bottom: 0.75rem;
            }

            .trip-detail-list {
                list-style: none;
                padding: 0;
            }

            .trip-detail-list li {
                color: var(--text-color);
                padding: 0.5rem 0;
                border-bottom: 1px solid var(--border-color);
                display: flex;
                justify-content: space-between;
            }

            .trip-detail-list li:last-child {
                border-bottom: none;
            }

            .modal-footer {
                display: flex;
                justify-content: flex-end;
                gap: 1rem;
                padding-top: 1rem;
                border-top: 1px solid var(--border-color);
            }

            /* Estilos para las recetas colapsables */
            .recipes-container {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .recipe-item {
                background: rgba(255, 215, 0, 0.05);
                border: 1px solid var(--border-color);
                border-radius: 8px;
                overflow: hidden;
                transition: all 0.3s ease;
            }

            .recipe-item:hover {
                border-color: var(--accent-color);
            }

            .recipe-header {
                padding: 1rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
                cursor: pointer;
                background: var(--gradient-dark);
            }

            .recipe-header h4 {
                color: var(--accent-color);
                margin: 0;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .recipe-header i {
                transition: transform 0.3s ease;
            }

            .recipe-content {
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease-out;
                padding: 0 1rem;
            }

            .recipe-item.active .recipe-content {
                max-height: 500px;
                padding: 1rem;
            }

            .recipe-item.active .recipe-header i {
                transform: rotate(180deg);
            }

            .recipe-details {
                display: grid;
                gap: 1rem;
            }

            .recipe-ingredients {
                margin-bottom: 1rem;
            }

            .recipe-ingredients h5, .recipe-instructions h5 {
                color: var(--accent-color);
                margin-bottom: 0.5rem;
                font-size: 0.9rem;
            }

            .ingredient-list {
                list-style: none;
                padding: 0;
                display: grid;
                gap: 0.5rem;
            }

            .ingredient-list li {
                color: var(--text-color);
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .ingredient-list li i {
                color: var(--accent-color);
                font-size: 0.8rem;
            }

            .recipe-instructions p {
                color: var(--text-color);
                line-height: 1.6;
                margin: 0;
            }
        </style>
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

    @include('components.footer2')
</body>
</html>