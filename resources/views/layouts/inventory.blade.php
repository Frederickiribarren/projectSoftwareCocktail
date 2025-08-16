<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario - The Alchemist's Folio</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/inventory.css') }}">
    <link rel="stylesheet" href="{{ asset('css/resetHtml.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>
<body>
    @include('components.navbar')

    <div class="container">
        <div class="header">
            <h1>Mi Inventario</h1>
            <p>Gestiona tus ingredientes y descubre nuevas posibilidades para crear cócteles únicos.</p>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <h3>24</h3>
                <p>Ingredientes Totales</p>
            </div>
            <div class="stat-card">
                <h3>15</h3>
                <p>Recetas Posibles</p>
            </div>
            <div class="stat-card">
                <h3>8</h3>
                <p>Categorías</p>
            </div>
        </div>

        <div class="inventory-container">
            <div class="filters-section">
                <div class="search-bar">
                    <i class='bx bx-search'></i>
                    <input type="text" placeholder="Buscar ingredientes..." id="searchInput">
                </div>

                <div class="category-tabs">
                    <div class="category-tab active" data-category="all">Todos</div>
                    <div class="category-tab" data-category="spirits">Spirits</div>
                    <div class="category-tab" data-category="liqueurs">Licores</div>
                    <div class="category-tab" data-category="juices">Jugos</div>
                    <div class="category-tab" data-category="mixers">Mixers</div>
                    <div class="category-tab" data-category="others">Otros</div>
                </div>

                <div class="filter-options">
                    <select class="filter-select" id="brandFilter">
                        <option value="">Todas las Marcas</option>
                        <option value="premium">Premium</option>
                        <option value="standard">Standard</option>
                        <option value="house">Casa</option>
                    </select>
                    <select class="filter-select" id="stockFilter">
                        <option value="">Stock</option>
                        <option value="low">Bajo Stock</option>
                        <option value="out">Sin Stock</option>
                        <option value="ok">Stock OK</option>
                    </select>
                    <div class="toggle-switch">
                        <input type="checkbox" id="alcoholicFilter">
                        <label for="alcoholicFilter">Solo Alcohólicos</label>
                    </div>
                    <button class="btn btn-outline" id="addIngredientBtn">
                        <i class='bx bx-plus'></i> Agregar Nuevo
                    </button>
                </div>
            </div>

            <div class="ingredient-list">
                <div class="ingredient-header">
                    <div class="ingredient-col">Ingrediente</div>
                    <div class="ingredient-col">Marca</div>
                    <div class="ingredient-col">Stock</div>
                    <div class="ingredient-col">Acciones</div>
                </div>
                <!-- Los ingredientes se cargarán dinámicamente aquí -->
            </div>

            <!-- Template para los items de ingredientes -->
            <template id="ingredient-template">
                <div class="ingredient-item">
                    <div class="ingredient-info">
                        <div class="ingredient-icon">
                            <i class='bx bx-drink'></i>
                        </div>
                        <div class="ingredient-details">
                            <h3 class="ingredient-name"></h3>
                            <p class="ingredient-category"></p>
                            <div class="flavor-tags"></div>
                        </div>
                    </div>
                    <div class="ingredient-brand"></div>
                    <div class="stock-control">
                        <div class="quantity-control">
                            <button class="quantity-btn decrease">-</button>
                            <div class="quantity-input-wrapper">
                                <input type="number" class="quantity-input" min="0" step="1">
                                <span class="unit"></span>
                            </div>
                            <button class="quantity-btn increase">+</button>
                        </div>
                        <div class="stock-status"></div>
                    </div>
                    <div class="ingredient-actions">
                        <button class="btn btn-icon" title="Editar">
                            <i class='bx bx-edit-alt'></i>
                        </button>
                        <button class="btn btn-icon" title="Notas">
                            <i class='bx bx-note'></i>
                        </button>
                        <button class="btn btn-icon" title="Eliminar">
                            <i class='bx bx-trash'></i>
                        </button>
                    </div>
                </div>
            </template>
        </div>

        <!-- Modal para agregar/editar ingrediente -->
        <div class="modal" id="ingredientModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Agregar Ingrediente</h2>
                    <button class="close-modal"><i class='bx bx-x'></i></button>
                </div>
                <form id="ingredientForm">
                    <div class="form-group">
                        <label for="ingredientName">Nombre</label>
                        <input type="text" id="ingredientName" required>
                    </div>
                    <div class="form-group">
                        <label for="ingredientCategory">Categoría</label>
                        <select id="ingredientCategory" required>
                            <option value="spirits">Spirits</option>
                            <option value="liqueurs">Licores</option>
                            <option value="juices">Jugos</option>
                            <option value="mixers">Mixers</option>
                            <option value="others">Otros</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ingredientBrand">Marca</label>
                        <input type="text" id="ingredientBrand">
                    </div>
                    <div class="form-group">
                        <label for="ingredientUnit">Unidad de Medida</label>
                        <select id="ingredientUnit" required>
                            <option value="unit">Unidades</option>
                            <option value="ml">Mililitros (ml)</option>
                            <option value="bottle">Botellas</option>
                            <option value="can">Latas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ingredientStock">Stock Inicial</label>
                        <input type="number" id="ingredientStock" min="0" step="1">
                    </div>
                    <div class="form-group">
                        <label for="ingredientFlavors">Sabores (separados por coma)</label>
                        <input type="text" id="ingredientFlavors" placeholder="Ej: Dulce, Cítrico, Amargo">
                    </div>
                    <div class="form-group">
                        <label for="ingredientAlcoholic">¿Contiene Alcohol?</label>
                        <input type="checkbox" id="ingredientAlcoholic">
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-outline" onclick="closeModal()">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('components.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modificamos para usar los datos de PHP
            let currentIngredients = @json($ingredients);
            let userIngredients = @json($userIngredients);
            let activeFilters = {
                category: 'all',
                brand: '',
                stock: '',
                alcoholic: false,
                search: ''
            };

            // Convertimos los ingredientes al formato necesario
            currentIngredients = currentIngredients.map(ingredient => ({
                id: ingredient.id,
                name: ingredient.name,
                category: ingredient.category || 'Others',
                brand: ingredient.brand || 'Generic',
                stock: ingredient.pivot?.quantity || 0,
                unit: ingredient.unit || 'unit',
                // Modificar esta línea - flavor_profile_tags ya es un array
                flavors: Array.isArray(ingredient.flavor_profile_tags) ? ingredient.flavor_profile_tags : [],
                isAlcoholic: ingredient.is_alcoholic || false,
                status: 'ok'
            }));

            // Funciones de filtrado
            function filterIngredients() {
                return currentIngredients.filter(ingredient => {
                    const matchesCategory = activeFilters.category === 'all' || 
                                         ingredient.category.toLowerCase() === activeFilters.category;
                    const matchesBrand = !activeFilters.brand || 
                                       ingredient.brand.toLowerCase().includes(activeFilters.brand.toLowerCase());
                    const matchesStock = !activeFilters.stock || ingredient.status === activeFilters.stock;
                    const matchesAlcoholic = !activeFilters.alcoholic || ingredient.isAlcoholic;
                    const matchesSearch = !activeFilters.search || 
                                       ingredient.name.toLowerCase().includes(activeFilters.search.toLowerCase());

                    return matchesCategory && matchesBrand && matchesStock && matchesAlcoholic && matchesSearch;
                });
            }

            function getUnitAbbreviation(unit) {
                const units = {
                    'unit': 'unidades',
                    'ml': 'mililitros',
                    'bottle': 'botellas',
                    'can': 'latas'
                };
                return units[unit] || unit;
            }

            function updateIngredientList() {
                const filteredIngredients = filterIngredients();
                const list = document.querySelector('.ingredient-list');
                const header = list.querySelector('.ingredient-header');
                list.innerHTML = '';
                list.appendChild(header);

                filteredIngredients.forEach(ingredient => {
                    const template = document.getElementById('ingredient-template');
                    const clone = document.importNode(template.content, true);
                    
                    clone.querySelector('.ingredient-name').textContent = ingredient.name;
                    clone.querySelector('.ingredient-category').textContent = ingredient.category;
                    clone.querySelector('.ingredient-brand').textContent = ingredient.brand;
                    clone.querySelector('.quantity-input').value = ingredient.stock;
                    clone.querySelector('.unit').textContent = getUnitAbbreviation(ingredient.unit);

                    const flavorTags = clone.querySelector('.flavor-tags');
                    ingredient.flavors.forEach(flavor => {
                        const tag = document.createElement('span');
                        tag.className = 'flavor-tag';
                        tag.textContent = flavor;
                        flavorTags.appendChild(tag);
                    });

                    const stockStatus = clone.querySelector('.stock-status');
                    updateStockStatus(stockStatus, ingredient.stock);

                    // Añadir el ingrediente al DOM
                    list.appendChild(clone);
                });
            }

            function updateStockStatus(element, stock) {
                if (stock === 0) {
                    element.textContent = 'Sin stock';
                    element.className = 'stock-status out';
                } else if (stock < 200) {
                    element.textContent = 'Bajo';
                    element.className = 'stock-status low';
                } else {
                    element.textContent = 'OK';
                    element.className = 'stock-status';
                }
            }

            // Event Listeners
            document.querySelectorAll('.category-tab').forEach(tab => {
                tab.addEventListener('click', () => {
                    document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    activeFilters.category = tab.dataset.category;
                    updateIngredientList();
                });
            });

            document.getElementById('brandFilter').addEventListener('change', function() {
                activeFilters.brand = this.value;
                updateIngredientList();
            });

            document.getElementById('stockFilter').addEventListener('change', function() {
                activeFilters.stock = this.value;
                updateIngredientList();
            });

            document.getElementById('alcoholicFilter').addEventListener('change', function() {
                activeFilters.alcoholic = this.checked;
                updateIngredientList();
            });

            document.getElementById('searchInput').addEventListener('input', function() {
                activeFilters.search = this.value;
                updateIngredientList();
            });

            // Control de cantidad
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('quantity-btn')) {
                    const input = e.target.closest('.quantity-control').querySelector('.quantity-input');
                    const currentValue = parseInt(input.value) || 0;
                    const step = 1; // Ahora incrementamos de uno en uno
                    
                    if (e.target.classList.contains('increase')) {
                        input.value = currentValue + step;
                    } else if (e.target.classList.contains('decrease')) {
                        input.value = Math.max(0, currentValue - step);
                    }

                    const stockStatus = e.target.closest('.stock-control').querySelector('.stock-status');
                    updateStockStatus(stockStatus, parseInt(input.value));
                }
            });

            // Modal de ingredientes
            const modal = document.getElementById('ingredientModal');
            const addIngredientBtn = document.getElementById('addIngredientBtn');
            const closeModalBtn = modal.querySelector('.close-modal');
            
            // Actualizar las funciones del modal
            function openModal() {
                modal.classList.add('active');
                document.getElementById('ingredientForm').reset();
            }

            function closeModal() {
                modal.classList.remove('active');
                document.getElementById('ingredientForm').reset();
            }

            // Event listeners del modal
            addIngredientBtn.addEventListener('click', openModal);
            closeModalBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });

            // Actualizar el manejador del formulario
            document.getElementById('ingredientForm').addEventListener('submit', async function(e) {
                e.preventDefault();
                const submitButton = this.querySelector('button[type="submit"]');
                submitButton.disabled = true;
                submitButton.textContent = 'Guardando...';
                
                const formData = {
                    ingredientName: document.getElementById('ingredientName').value,
                    ingredientCategory: document.getElementById('ingredientCategory').value,
                    ingredientBrand: document.getElementById('ingredientBrand').value,
                    ingredientUnit: document.getElementById('ingredientUnit').value,
                    ingredientStock: document.getElementById('ingredientStock').value || 0,
                    ingredientFlavors: document.getElementById('ingredientFlavors').value,
                    ingredientAlcoholic: document.getElementById('ingredientAlcoholic').checked
                };
                
                try {
                    const response = await fetch('{{ route("inventory.update") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(formData)
                    });

                    const data = await response.json();

                    if (response.ok) {
                        currentIngredients = data.ingredients.map(ingredient => ({
                            id: ingredient.id,
                            name: ingredient.name,
                            category: ingredient.category || 'Others',
                            brand: ingredient.brand || 'Generic',
                            stock: ingredient.users[0]?.pivot?.quantity || 0,
                            unit: ingredient.unit || 'unit',
                            flavors: Array.isArray(ingredient.flavor_profile_tags) ? ingredient.flavor_profile_tags : [],
                            isAlcoholic: ingredient.is_alcoholic || false,
                            status: 'ok'
                        }));
                        updateIngredientList();
                        closeModal();
                        
                        alert('Ingrediente agregado correctamente');
                    } else {
                        throw new Error(data.message || 'Error al guardar el ingrediente');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Error al guardar el ingrediente: ' + error.message);
                } finally {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Guardar';
                }
            });

            // Inicialización inicial
            updateIngredientList();
        });
    </script>
</body>
</html>
