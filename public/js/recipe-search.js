// ================================
// SISTEMA DE BÚSQUEDA Y FILTROS PARA RECETAS OPTIMIZADO
// Conectado con Base de Datos Local Laravel
// ================================

class RecipeSearchFilter {
    constructor() {
        this.recipes = [];
        this.filteredRecipes = [];
        this.allRecipes = [];
        this.displayedRecipes = []; // Recetas que se muestran actualmente (paginación visual)
        this.currentFilters = {
            search: '',
            category: '',
            base: '',
            difficulty: '',
            time: '',
            alcoholic: ''
        };
        this.currentSort = 'name-asc';
        this.apiBaseUrl = '/api'; // API local de Laravel
        this.currentPage = 1;
        this.lastPage = 1;
        this.isLoading = false;
        this.debounceTimer = null;
        
        // Paginación visual (frontend)
        this.itemsPerPage = 20;
        this.currentDisplayPage = 1;
        this.totalDisplayPages = 1;
        
        this.init();
    }

    async init() {
        console.log('🚀 Iniciando sistema de búsqueda de recetas...');
        this.setupEventListeners();
        await this.loadAllRecipes(); // Cargar TODAS las recetas de una vez
        this.applyCurrentDisplay(); // Aplicar paginación visual
        console.log('✅ Inicialización completa. Recetas cargadas:', this.allRecipes.length);
        
        // Cargar opciones de filtros en segundo plano (no bloquea la UI)
        setTimeout(() => this.loadFilterOptions(), 100);
    }

    // Cargar TODAS las recetas de una vez para filtrado local eficiente
    async loadAllRecipes() {
        console.log('📦 Cargando todas las recetas...');
        this.showLoading();
        
        try {
            const allRecipes = [];
            let currentPage = 1;
            let hasMorePages = true;
            
            while (hasMorePages) {
                console.log(`📄 Cargando página ${currentPage}...`);
                const response = await this.fetchRecipes({}, currentPage, 50); // 50 por página para ser eficiente
                
                if (response.success && response.data.length > 0) {
                    allRecipes.push(...response.data);
                    
                    // Verificar si hay más páginas
                    if (currentPage >= response.pagination.last_page) {
                        hasMorePages = false;
                    } else {
                        currentPage++;
                    }
                } else {
                    hasMorePages = false;
                }
            }
            
            this.allRecipes = allRecipes;
            this.recipes = [...allRecipes]; // Copia para filtrado
            this.filteredRecipes = [...allRecipes]; // Inicialmente sin filtros
            
            console.log(`✅ Todas las recetas cargadas: ${allRecipes.length} total`);
            
        } catch (error) {
            console.error('💥 Error cargando todas las recetas:', error);
            this.showError('Error al cargar las recetas desde la base de datos.');
        } finally {
            this.hideLoading();
        }
    }

    // Cargar recetas destacadas para carga inicial rápida
    async loadFeaturedRecipes() {
        console.log('🔍 Iniciando carga de recetas destacadas...');
        this.showLoading();
        
        try {
            const url = `${this.apiBaseUrl}/recipes/featured?limit=12`;
            console.log('📡 Haciendo petición a:', url);
            
            const response = await fetch(url);
            console.log('📊 Respuesta recibida:', response.status, response.statusText);
            
            if (!response.ok) {
                throw new Error(`Error ${response.status}: ${response.statusText}`);
            }
            
            const data = await response.json();
            console.log('📦 Datos recibidos:', data);
            
            if (data.success) {
                console.log('✅ Recetas cargadas exitosamente:', data.data.length);
                this.recipes = data.data;
                this.allRecipes = data.data;
            } else {
                console.error('❌ Respuesta no exitosa:', data);
            }
            
        } catch (error) {
            console.error('💥 Error cargando recetas destacadas:', error);
            // Si falla, usar el método original pero con menos datos
            await this.loadInitialData();
        } finally {
            this.hideLoading();
        }
    }

    // Cargar datos iniciales (fallback)
    async loadInitialData() {
        try {
            const recipesResponse = await this.fetchRecipes({}, 1, 50); // 50 iniciales (una página completa)
            
            if (recipesResponse.success) {
                this.recipes = recipesResponse.data;
                this.allRecipes = recipesResponse.data;
                this.currentPage = recipesResponse.pagination.current_page;
                this.lastPage = recipesResponse.pagination.last_page;
                console.log(`📊 Página ${this.currentPage} de ${this.lastPage} cargada`);
            }
            
        } catch (error) {
            console.error('Error cargando datos:', error);
            this.showError('Error al cargar las recetas desde la base de datos.');
        }
    }

    // Obtener recetas de la API local (optimizado)
    async fetchRecipes(filters = {}, page = 1, perPage = 50) {
        const params = new URLSearchParams({
            page: page,
            per_page: Math.min(perPage, 50), // Máximo 50 por consulta
            ...filters
        });

        const response = await fetch(`${this.apiBaseUrl}/recipes?${params}`);
        
        if (!response.ok) {
            throw new Error(`Error ${response.status}: ${response.statusText}`);
        }
        
        return await response.json();
    }

    // Cargar opciones para los filtros (async, no bloquea)
    async loadFilterOptions() {
        try {
            // Usar Promise.allSettled para que no falle si una API falla
            const [ingredientsResult, glassResult] = await Promise.allSettled([
                fetch(`${this.apiBaseUrl}/ingredients`),
                fetch(`${this.apiBaseUrl}/glass-types`)
            ]);
            
            if (ingredientsResult.status === 'fulfilled' && ingredientsResult.value.ok) {
                const ingredientsData = await ingredientsResult.value.json();
                if (ingredientsData.success) {
                    this.populateIngredientFilter(ingredientsData.data.all);
                }
            }
            
            if (glassResult.status === 'fulfilled' && glassResult.value.ok) {
                const glassData = await glassResult.value.json();
                if (glassData.success) {
                    this.populateGlassFilter(glassData.data);
                }
            }
            
        } catch (error) {
            console.error('Error cargando opciones de filtros:', error);
        }
    }

    // Poblar filtro de ingredientes
    populateIngredientFilter(ingredients) {
        const baseFilter = document.getElementById('baseFilter');
        if (!baseFilter) return;
        
        const currentValue = baseFilter.value;
        
        // Usar un fragmento de documento para mejor rendimiento
        const fragment = document.createDocumentFragment();
        
        // Agregar ingredientes únicos
        const uniqueIngredients = [...new Set(ingredients)].sort();
        uniqueIngredients.forEach(ingredient => {
            const option = document.createElement('option');
            option.value = ingredient.toLowerCase();
            option.textContent = ingredient;
            fragment.appendChild(option);
        });
        
        // Limpiar y agregar de una vez
        while (baseFilter.children.length > 1) {
            baseFilter.removeChild(baseFilter.lastChild);
        }
        baseFilter.appendChild(fragment);
        baseFilter.value = currentValue;
    }

    // Poblar filtro de tipos de vaso
    populateGlassFilter(glassTypes) {
        console.log('Tipos de vasos disponibles:', glassTypes);
    }

    setupEventListeners() {
        // Búsqueda con debounce optimizado
        const searchInput = document.getElementById('searchInput');
        const searchBtn = document.getElementById('searchBtn');
        
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                console.log('🔍 Búsqueda cambiada a:', e.target.value);
                clearTimeout(this.debounceTimer);
                this.debounceTimer = setTimeout(() => {
                    this.currentFilters.search = e.target.value.trim();
                    this.applyFilters();
                }, 400); // Aumentado a 400ms para menos llamadas
            });
        }
        
        if (searchBtn) {
            searchBtn.addEventListener('click', () => {
                this.currentFilters.search = searchInput.value.trim();
                this.applyFilters();
            });
        }
        
        // Filtros
        const categoryFilter = document.getElementById('categoryFilter');
        const baseFilter = document.getElementById('baseFilter');
        const difficultyFilter = document.getElementById('difficultyFilter');
        const timeFilter = document.getElementById('timeFilter');
        const sortSelect = document.getElementById('sortSelect');
        
        if (categoryFilter) {
            categoryFilter.addEventListener('change', (e) => {
                console.log('🏷️ Categoría cambiada a:', e.target.value);
                this.currentFilters.category = e.target.value;
                this.applyFilters();
            });
        }
        
        if (baseFilter) {
            baseFilter.addEventListener('change', (e) => {
                console.log('🥃 Base cambiada a:', e.target.value);
                this.currentFilters.base = e.target.value;
                this.applyFilters();
            });
        }
        
        if (difficultyFilter) {
            difficultyFilter.addEventListener('change', (e) => {
                console.log('📊 Dificultad cambiada a:', e.target.value);
                this.currentFilters.difficulty = e.target.value;
                this.applyFilters();
            });
        }
        
        if (timeFilter) {
            timeFilter.addEventListener('change', (e) => {
                this.currentFilters.time = e.target.value;
                this.applyFilters();
            });
        }
        
        // Ordenamiento
        if (sortSelect) {
            sortSelect.addEventListener('change', (e) => {
                this.currentSort = e.target.value;
                this.applySorting();
            });
        }
        
        // Botón limpiar filtros
        const clearBtn = document.getElementById('clearFilters');
        if (clearBtn) {
            clearBtn.addEventListener('click', () => this.clearFilters());
        }
    }

    // Aplicar filtros (ahora completamente local)
    async applyFilters() {
        console.log('🔍 Aplicando filtros con:', this.currentFilters);
        
        if (this.isLoading) return; // Evitar múltiples llamadas simultáneas
        
        this.showLoading();
        
        try {
            // Resetear a la página 1 cuando se aplican filtros
            this.currentDisplayPage = 1;
            
            // Aplicar todos los filtros localmente
            this.filteredRecipes = this.allRecipes.filter(recipe => {
                
                // Filtro por búsqueda (nombre)
                if (this.currentFilters.search) {
                    const searchTerm = this.currentFilters.search.toLowerCase();
                    if (!recipe.name.toLowerCase().includes(searchTerm)) {
                        return false;
                    }
                }
                
                // Filtro por categoría "sin-alcohol" (usando el campo alcoholic del backend)
                if (this.currentFilters.category === 'sin-alcohol') {
                    if (recipe.alcoholic !== 'non-alcoholic') {
                        return false;
                    }
                } 
                // Otros filtros de categoría se omiten por ahora ya que no tenemos ese campo en el backend
                
                // Filtro por ingrediente base (buscar en la lista de ingredientes)
                if (this.currentFilters.base) {
                    const base = this.currentFilters.base.toLowerCase();
                    const hasIngredient = recipe.ingredients && recipe.ingredients.some(ing => {
                        let ingName = '';
                        if (typeof ing === 'string') {
                            ingName = ing;
                        } else if (ing && typeof ing === 'object' && ing.name) {
                            ingName = ing.name;
                        }
                        // Permitir variantes usando includes
                        return ingName && ingName.toLowerCase().includes(base);
                    });
                    if (!hasIngredient) {
                        return false;
                    }
                }
                
                // Filtro por dificultad (usando el campo del backend)
                if (this.currentFilters.difficulty && recipe.difficulty !== this.currentFilters.difficulty) {
                    return false;
                }
                
                // Filtro por tiempo (basado en número de ingredientes)
                if (this.currentFilters.time) {
                    const ingredientCount = recipe.ingredients ? recipe.ingredients.length : 0;
                    switch (this.currentFilters.time) {
                        case 'rapido':
                            if (ingredientCount > 3) return false;
                            break;
                        case 'medio':
                            if (ingredientCount <= 3 || ingredientCount > 6) return false;
                            break;
                        case 'largo':
                            if (ingredientCount <= 6) return false;
                            break;
                    }
                }
                
                return true;
            });
            
            console.log(`🎯 Filtros aplicados: ${this.allRecipes.length} → ${this.filteredRecipes.length} recetas`);
            
            // Aplicar ordenamiento
            this.applySorting();
            
            // Aplicar paginación visual
            this.applyCurrentDisplay();
            
        } catch (error) {
            console.error('💥 Error aplicando filtros:', error);
            this.showError('Error al aplicar los filtros');
        } finally {
            this.hideLoading();
        }
    }

    // Aplicar ordenamiento
    applySorting() {
        const recipesToSort = this.filteredRecipes.length > 0 ? this.filteredRecipes : this.allRecipes;
        
        recipesToSort.sort((a, b) => {
            switch (this.currentSort) {
                case 'name-asc':
                    return a.name.localeCompare(b.name);
                case 'name-desc':
                    return b.name.localeCompare(a.name);
                case 'difficulty-asc':
                    const diffOrder = { 'facil': 1, 'intermedio': 2, 'dificil': 3 };
                    return (diffOrder[a.difficulty] || 4) - (diffOrder[b.difficulty] || 4);
                case 'difficulty-desc':
                    const diffOrderDesc = { 'dificil': 1, 'intermedio': 2, 'facil': 3 };
                    return (diffOrderDesc[a.difficulty] || 4) - (diffOrderDesc[b.difficulty] || 4);
                case 'ingredients-asc':
                    return a.ingredients.length - b.ingredients.length;
                case 'ingredients-desc':
                    return b.ingredients.length - a.ingredients.length;
                default:
                    return 0;
            }
        });
    }

    renderRecipes(recipes) {
        const grid = document.getElementById('recipesGrid');
        const noResults = document.getElementById('noResults');
        
        if (!grid) return;
        
        this.hideLoading();
        
        if (recipes.length === 0) {
            grid.innerHTML = '';
            if (noResults) noResults.style.display = 'block';
            return;
        }
        
        if (noResults) noResults.style.display = 'none';
        
        // Usar innerHTML una sola vez para mejor rendimiento
        const cardsHTML = recipes.map(recipe => this.createRecipeCardHTML(recipe)).join('');
        grid.innerHTML = cardsHTML;
        
        // Agregar event listeners de una vez
        this.setupCardListeners();
    }

    createRecipeCardHTML(recipe) {
        return `
            <div class="recipe-card" data-recipe-id="${recipe.id}">
                <div class="recipe-image">
                    <img src="${recipe.imageThumb || recipe.image}" alt="${recipe.name}" 
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="recipe-placeholder" style="display: none;">🍹</div>
                </div>
                <div class="recipe-content">
                    <h3 class="recipe-title">${recipe.name}</h3>
                    <p class="recipe-description">${recipe.description}</p>
                    <div class="recipe-meta">
                        <span class="recipe-difficulty difficulty-${recipe.difficulty}">
                            ${this.translateDifficulty(recipe.difficulty)}
                        </span>
                        <span class="recipe-alcoholic ${recipe.alcoholic}">
                            ${recipe.alcoholic === 'alcoholic' ? '🍸 Con alcohol' : '🥤 Sin alcohol'}
                        </span>
                    </div>
                    <div class="recipe-extra-info">
                            <small class="ingredient-count" style="color: var(--text-muted);">${recipe.ingredients.length} ingredientes</small>
                            ${recipe.glass ? `<small class=\"glass-type\" style=\"color: var(--text-muted);\">Servir en: ${recipe.glass}</small>` : ''}
                            ${recipe.author ? `<small class=\"recipe-author\" style=\"color: var(--text-muted);\">Por: ${recipe.author}</small>` : ''}
                    </div>
                </div>
            </div>
        `;
    }

    setupCardListeners() {
        const cards = document.querySelectorAll('.recipe-card');
        cards.forEach(card => {
            card.addEventListener('click', () => {
                const recipeId = card.dataset.recipeId;
                this.showRecipeDetail(recipeId);
            });
        });
    }

    showRecipeDetail(recipeId) {
        const recipe = this.recipes.find(r => r.id == recipeId) || 
                     this.filteredRecipes.find(r => r.id == recipeId);
        
        if (recipe) {
            this.createRecipeModal(recipe);
        }
    }

    createRecipeModal(recipe) {
        // Crear modal dinámicamente
        const modal = document.createElement('div');
        modal.className = 'recipe-modal';
        modal.innerHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <h2>${recipe.name}</h2>
                    <button class="close-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="recipe-image-large">
                        <img src="${recipe.image}" alt="${recipe.name}" onerror="this.style.display='none'">
                    </div>
                    <div class="recipe-details">
                        <div class="recipe-info">
                            <span class="difficulty difficulty-${recipe.difficulty}">
                                ${this.translateDifficulty(recipe.difficulty)}
                            </span>
                            <span class="alcoholic-status ${recipe.alcoholic}">
                                ${recipe.alcoholic === 'alcoholic' ? 'Con alcohol' : 'Sin alcohol'}
                            </span>
                            ${recipe.glass ? `<span class="glass">Servir en: ${recipe.glass}</span>` : ''}
                            ${recipe.author ? `<span class="author">Creado por: ${recipe.author}</span>` : ''}
                        </div>
                        
                        <div class="ingredients-section">
                            <h3>Ingredientes (${recipe.ingredients.length}):</h3>
                            <ul class="ingredients-list">
                                ${recipe.ingredients.map(ingredient => `<li>${ingredient}</li>`).join('')}
                            </ul>
                        </div>
                        
                        ${recipe.instructions ? `
                            <div class="instructions-section">
                                <h3>Instrucciones:</h3>
                                <p class="instructions">${recipe.instructions}</p>
                            </div>
                        ` : ''}
                        
                        ${recipe.garnish ? `
                            <div class="garnish-section">
                                <h3>Decoración:</h3>
                                <p class="garnish">${recipe.garnish}</p>
                            </div>
                        ` : ''}
                    </div>
                </div>
            </div>
        `;

        // Agregar estilos del modal
        this.addModalStyles();
        
        // Agregar modal al DOM
        document.body.appendChild(modal);
        
        // Event listeners
        const closeBtn = modal.querySelector('.close-modal');
        closeBtn.addEventListener('click', () => this.closeModal(modal));
        
        modal.addEventListener('click', (e) => {
            if (e.target === modal) this.closeModal(modal);
        });
        
        // Mostrar modal con animación
        setTimeout(() => modal.classList.add('show'), 10);
    }

    addModalStyles() {
        if (document.getElementById('modal-styles')) return;
        
        const styles = document.createElement('style');
        styles.id = 'modal-styles';
        styles.textContent = `
            .recipe-modal {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.8);
                z-index: 10000;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: opacity 0.3s ease;
            }
            
            .recipe-modal.show {
                opacity: 1;
            }
            
            .modal-content {
                background: var(--background-card);
                border-radius: 15px;
                max-width: 600px;
                max-height: 80vh;
                width: 90%;
                overflow-y: auto;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .modal-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1.5rem;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }
            
            .modal-header h2 {
                color: var(--accent-color);
                margin: 0;
                font-size: 1.5rem;
                font-family: var(--font-h1-h2-h3);
            }
            
            .close-modal {
                background: none;
                border: none;
                font-size: 2rem;
                color: var(--text-color);
                cursor: pointer;
                transition: color 0.3s ease;
            }
            
            .close-modal:hover {
                color: var(--accent-color);
            }
            
            .modal-body {
                padding: 1.5rem;
                font-family: var(--font-p);
            }
            
            .recipe-image-large img {
                width: 100%;
                max-height: 200px;
                object-fit: cover;
                border-radius: 10px;
                margin-bottom: 1rem;
            }
            
            .recipe-info {
                display: flex;
                gap: 1rem;
                margin-bottom: 1.5rem;
                flex-wrap: wrap;
                font-family: var(--font-p);
            }
            
            .recipe-info span {
                padding: 0.5rem 1rem;
                border-radius: 15px;
                font-size: 0.9rem;
                font-weight: 600;
            }
            
            .ingredients-section, .instructions-section, .garnish-section {
                margin-bottom: 1.5rem;
            }
            
            .ingredients-section h3, .instructions-section h3, .garnish-section h3 {
                color: var(--accent-color);
                margin-bottom: 0.8rem;
                font-size: 1.2rem;
                font-family: var(--font-h1-h2-h3);
            }
            
            .ingredients-list {
                list-style: none;
                padding: 0;
            }
            
            .ingredients-list li {
                padding: 0.5rem 0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                color: var(--text-color);
                font-family: var(--font-p);
            }
            
            .instructions, .garnish {
                line-height: 1.6;
                color: var(--text-color);
                font-family: var(--font-p);
            }
            
            .alcoholic-status.alcoholic {
                background: #e74c3c;
                color: white;
            }
            
            .alcoholic-status.non-alcoholic {
                background: #27ae60;
                color: white;
            }
            
            .glass, .author {
                background: var(--accent-color);
                color: var(--primary-color);
            }
            
            /* Estilos para paginación */
            .pagination-controls {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 10px;
                margin: 2rem 0;
                padding: 1rem;
            }
            
            .pagination-btn {
                padding: 0.5rem 1rem;
                border: 2px solid var(--accent-color);
                background: transparent;
                color: var(--accent-color);
                border-radius: 5px;
                cursor: pointer;
                transition: all 0.3s ease;
                font-size: 0.9rem;
                min-width: 40px;
            }
            
            .pagination-btn:hover {
                background: var(--accent-color);
                color: var(--primary-color);
                transform: translateY(-2px);
            }
            
            .pagination-btn.active {
                background: var(--accent-color);
                color: var(--primary-color);
                font-weight: bold;
            }
            
            .pagination-dots {
                color: var(--text-color);
                padding: 0 0.5rem;
                font-size: 1.2rem;
            }
        `;
        
        document.head.appendChild(styles);
    }

    closeModal(modal) {
        modal.classList.remove('show');
        setTimeout(() => {
            document.body.removeChild(modal);
        }, 300);
    }

    clearFilters() {
        // Resetear filtros
        this.currentFilters = {
            search: '',
            category: '',
            base: '',
            difficulty: '',
            time: '',
            alcoholic: ''
        };
        
        // Limpiar inputs
        const elements = ['searchInput', 'categoryFilter', 'baseFilter', 'difficultyFilter', 'timeFilter', 'sortSelect'];
        elements.forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.value = id === 'sortSelect' ? 'name-asc' : '';
            }
        });
        
        this.currentSort = 'name-asc';
        this.currentDisplayPage = 1;
        
        // Resetear a todas las recetas sin filtros
        this.filteredRecipes = [...this.allRecipes];
        this.applySorting();
        this.applyCurrentDisplay();
    }

    updateResultsCount(count) {
        const resultsCount = document.getElementById('resultsCount');
        if (resultsCount) {
            resultsCount.textContent = `Encontradas ${count} recetas`;
        }
    }

    showLoading() {
        const grid = document.getElementById('recipesGrid');
        if (grid) {
            grid.innerHTML = `
                <div class="loading-spinner" style="grid-column: 1 / -1; text-align: center; padding: 2rem; font-family: var(--font-p);">
                    <div style="display: inline-block; width: 40px; height: 40px; border: 3px solid #f3f3f3; border-top: 3px solid var(--accent-color); border-radius: 50%; animation: spin 1s linear infinite;"></div>
                    <p style="margin-top: 1rem; color: var(--text-color);">Cargando recetas...</p>
                </div>
            `;
        }
    }

    hideLoading() {
        const spinner = document.querySelector('.loading-spinner');
        if (spinner) {
            spinner.remove();
        }
    }

    showError(message) {
        const grid = document.getElementById('recipesGrid');
        if (grid) {
            grid.innerHTML = `
                <div class="error-message" style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: #e74c3c; font-family: var(--font-p);">
                    <i class="fas fa-exclamation-triangle" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <h3 style="font-family: var(--font-h1-h2-h3);">Error al cargar recetas</h3>
                    <p>${message}</p>
                    <button onclick="location.reload()" style="margin-top: 1rem; padding: 0.5rem 1rem; background: var(--accent-color); color: var(--primary-color); border: none; border-radius: 5px; cursor: pointer; font-family: var(--font-p);">
                        Intentar de nuevo
                    </button>
                </div>
            `;
        }
    }

    translateDifficulty(difficulty) {
        const translations = {
            facil: 'Fácil',
            intermedio: 'Intermedio',
            dificil: 'Difícil'
        };
        return translations[difficulty] || difficulty;
    }

    // Aplicar paginación visual (frontend) a las recetas filtradas
    applyCurrentDisplay() {
        const recipesToShow = this.filteredRecipes.length > 0 ? this.filteredRecipes : this.recipes;
        
        // Calcular paginación
        this.totalDisplayPages = Math.ceil(recipesToShow.length / this.itemsPerPage);
        if (this.currentDisplayPage > this.totalDisplayPages) {
            this.currentDisplayPage = 1;
        }
        
        // Obtener recetas para la página current
        const startIndex = (this.currentDisplayPage - 1) * this.itemsPerPage;
        const endIndex = startIndex + this.itemsPerPage;
        this.displayedRecipes = recipesToShow.slice(startIndex, endIndex);
        
        console.log(`📄 Mostrando página ${this.currentDisplayPage}/${this.totalDisplayPages} (${this.displayedRecipes.length} de ${recipesToShow.length} recetas)`);
        
        // Renderizar y actualizar interfaz
        this.renderRecipes(this.displayedRecipes);
        this.updateResultsCount(recipesToShow.length);
        this.renderPagination();
    }

    // Ir a una página específica
    goToPage(page) {
        if (page >= 1 && page <= this.totalDisplayPages) {
            this.currentDisplayPage = page;
            this.applyCurrentDisplay();
        }
    }

    // Renderizar controles de paginación
    renderPagination() {
        const existingPagination = document.querySelector('.pagination-controls');
        if (existingPagination) {
            existingPagination.remove();
        }

        if (this.totalDisplayPages <= 1) return; // No mostrar paginación si solo hay 1 página

        const grid = document.getElementById('recipesGrid');
        if (!grid || !grid.parentNode) return;

        const paginationDiv = document.createElement('div');
        paginationDiv.className = 'pagination-controls';
        paginationDiv.style.cssText = `
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 2rem 0;
            padding: 1rem;
        `;

        let paginationHTML = '';

        // Botón anterior
        if (this.currentDisplayPage > 1) {
            paginationHTML += `<button onclick="recipeFilter.goToPage(${this.currentDisplayPage - 1})" class="pagination-btn">← Anterior</button>`;
        }

        // Números de página
        const maxButtons = 5;
        let startPage = Math.max(1, this.currentDisplayPage - Math.floor(maxButtons / 2));
        let endPage = Math.min(this.totalDisplayPages, startPage + maxButtons - 1);

        if (endPage - startPage + 1 < maxButtons) {
            startPage = Math.max(1, endPage - maxButtons + 1);
        }

        if (startPage > 1) {
            paginationHTML += `<button onclick="recipeFilter.goToPage(1)" class="pagination-btn">1</button>`;
            if (startPage > 2) {
                paginationHTML += `<span class="pagination-dots">...</span>`;
            }
        }

        for (let i = startPage; i <= endPage; i++) {
            const isActive = i === this.currentDisplayPage;
            paginationHTML += `<button onclick="recipeFilter.goToPage(${i})" class="pagination-btn ${isActive ? 'active' : ''}">${i}</button>`;
        }

        if (endPage < this.totalDisplayPages) {
            if (endPage < this.totalDisplayPages - 1) {
                paginationHTML += `<span class="pagination-dots">...</span>`;
            }
            paginationHTML += `<button onclick="recipeFilter.goToPage(${this.totalDisplayPages})" class="pagination-btn">${this.totalDisplayPages}</button>`;
        }

        // Botón siguiente
        if (this.currentDisplayPage < this.totalDisplayPages) {
            paginationHTML += `<button onclick="recipeFilter.goToPage(${this.currentDisplayPage + 1})" class="pagination-btn">Siguiente →</button>`;
        }

        paginationDiv.innerHTML = paginationHTML;
        grid.parentNode.insertBefore(paginationDiv, grid.nextSibling);
    }

    // Renderizar botón "Cargar más"
    renderLoadMoreButton() {
        const grid = document.getElementById('recipesGrid');
        if (!grid) return;

        // Remover botón existente si existe
        const existingBtn = document.querySelector('.load-more-btn');
        if (existingBtn) existingBtn.remove();

        // Solo mostrar si hay más páginas
        if (this.currentPage < this.lastPage) {
            const loadMoreBtn = document.createElement('div');
            loadMoreBtn.className = 'load-more-btn';
            loadMoreBtn.innerHTML = `
                <button onclick="recipeFilter.loadMoreRecipes()" 
                        style="padding: 1rem 2rem; background: var(--accent-color); color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 1rem; margin: 2rem auto; display: block;">
                    Cargar más recetas (${this.currentPage}/${this.lastPage})
                </button>
            `;
            grid.parentNode.insertBefore(loadMoreBtn, grid.nextSibling);
        }
    }

    // Cargar más recetas (append en lugar de replace)
    async loadMoreRecipes() {
        if (this.isLoading || this.currentPage >= this.lastPage) return;

        this.isLoading = true;
        const btn = document.querySelector('.load-more-btn button');
        if (btn) {
            btn.textContent = 'Cargando...';
            btn.disabled = true;
        }

        try {
            const response = await this.fetchRecipes(this.currentFilters, this.currentPage + 1);
            
            if (response.success && response.data.length > 0) {
                // Agregar las nuevas recetas a las existentes
                this.recipes = [...this.recipes, ...response.data];
                this.allRecipes = [...this.allRecipes, ...response.data];
                
                // Actualizar información de paginación
                this.currentPage = response.pagination.current_page;
                this.lastPage = response.pagination.last_page;
                
                // Agregar las nuevas tarjetas al grid existente
                const grid = document.getElementById('recipesGrid');
                if (grid) {
                    const newCardsHTML = response.data.map(recipe => this.createRecipeCardHTML(recipe)).join('');
                    grid.insertAdjacentHTML('beforeend', newCardsHTML);
                }
                
                // Actualizar contador y botón
                this.updateResultsCount(this.recipes.length);
                this.renderLoadMoreButton();
                this.setupCardListeners();
            }
            
        } catch (error) {
            console.error('Error cargando más recetas:', error);
        } finally {
            this.isLoading = false;
        }
    }
}

// Agregar estilo para la animación de carga
const loadingStyles = document.createElement('style');
loadingStyles.textContent = `
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
`;
document.head.appendChild(loadingStyles);

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    window.recipeFilter = new RecipeSearchFilter();
});
