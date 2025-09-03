@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/user-recipes.css') }}">
<link rel="stylesheet" href="{{ asset('css/user-recipe-modal.css') }}">
<div class="page-container">
    <main class="main-content-recipes">
        <header class="page-header">
            <h1 class="page-title">Mis Recetas</h1>
            <p class="page-subtitle">Gestiona tu colección personal de cócteles.</p>
        </header>

        <section class="search-section">
            <div class="search-container">
                <div class="search-bar">
                    <input type="text" id="searchInput" class="search-input" placeholder="Buscar en mis recetas...">
                    <button class="search-button" id="searchBtn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <div class="filters-container">
                    <div class="filter-group">
                        <label class="filter-label">Tipo de Copa</label>
                        <select id="glassFilter" class="filter-select">
                            <option value="">Todas las copas</option>
                            <option value="highball">Highball</option>
                            <option value="rocks">Rocks/Old Fashioned</option>
                            <option value="martini">Martini</option>
                            <option value="coupe">Coupe</option>
                            <option value="shot">Shot</option>
                            <option value="wine">Copa de Vino</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Estado</label>
                        <select id="privacyFilter" class="filter-select">
                            <option value="">Todos</option>
                            <option value="public">Públicas</option>
                            <option value="private">Privadas</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Ordenar por</label>
                        <select id="sortSelect" class="filter-select">
                            <option value="newest">Más recientes</option>
                            <option value="oldest">Más antiguos</option>
                            <option value="name-asc">Nombre A-Z</option>
                            <option value="name-desc">Nombre Z-A</option>
                        </select>
                    </div>

                    <button class="clear-filters-btn" id="clearFilters">
                        <i class="fas fa-times"></i>
                        Limpiar Filtros
                    </button>

                    <a href="{{ route('user.recipes.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nueva Receta
                    </a>
                </div>
            </div>
        </section>

        @if($recipes->isEmpty())
            <div class="no-results">
                <i class="fas fa-cocktail"></i>
                <h3>Aún no has creado ninguna receta</h3>
                <p>¡Comienza a crear tu colección personal de cócteles!</p>
                <a href="{{ route('user.recipes.create') }}" class="btn btn-primary mt-4">
                    Crear mi primera receta
                </a>
            </div>
        @else
            <section class="results-section">
                <div class="recipes-grid">
                    @foreach($recipes as $recipe)
                        <div class="recipe-card" data-recipe-id="{{ $recipe->id }}">
                            <div class="recipe-content-wrapper" style="cursor: pointer;">
                                <div class="recipe-image">
                                    @if($recipe->image_url)
                                        <img src="{{ $recipe->image_url }}" alt="{{ $recipe->name }}" loading="lazy">
                                        <div class="recipe-placeholder" style="display: none;">
                                            <i class="fas fa-cocktail"></i>
                                        </div>
                                    @else
                                        <div class="recipe-placeholder">
                                            <i class="fas fa-cocktail"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="recipe-content">
                                    <h3 class="recipe-title">{{ $recipe->name }}</h3>
                                    <p class="recipe-description">{{ Str::limit($recipe->instructions, 100) }}</p>
                                </div>
                            </div>
                            <div class="recipe-meta">
                                <div class="recipe-info">
                                    <span class="recipe-glass">
                                        <i class="fas fa-glass-martini-alt"></i>
                                        {{ $recipe->glass_type }}
                                    </span>
                                    @if($recipe->is_private)
                                        <span class="recipe-privacy">
                                            <i class="fas fa-lock"></i> Privada
                                        </span>
                                    @endif
                                </div>
                                <div class="recipe-actions" onclick="event.stopPropagation();">
                                    <button class="btn-icon" 
                                            title="Editar receta"
                                            onclick="window.location.href='{{ route('user.recipes.edit', $recipe) }}'">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('user.recipes.destroy', $recipe) }}" 
                                          method="POST" 
                                          class="inline-block"
                                          onsubmit="return confirm('¿Estás seguro de eliminar esta receta?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn-icon delete-btn" 
                                                title="Eliminar receta">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const recipeCards = document.querySelectorAll('.recipe-card .recipe-content-wrapper');
    
    recipeCards.forEach(card => {
        card.addEventListener('click', async function() {
            const recipeId = this.parentElement.dataset.recipeId;
            try {
                const response = await fetch(`/user/recipes/${recipeId}/detail`);
                if (!response.ok) throw new Error('Network response was not ok');
                const recipe = await response.json();
                showRecipeModal(recipe);
            } catch (error) {
                console.error('Error:', error);
            }
        });
    });
});

function showRecipeModal(recipe) {
    const modal = document.createElement('div');
    modal.className = 'recipe-modal';
    modal.innerHTML = `
        <div class="modal-content">
            <div class="modal-header">
                <h2>${recipe.name}</h2>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                ${recipe.image_url ? `
                    <div class="recipe-image-large">
                        <img src="${recipe.image_url}" alt="${recipe.name}" 
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                        <div class="recipe-placeholder" style="display: none;">
                            <i class="fas fa-cocktail"></i>
                        </div>
                    </div>
                ` : `
                    <div class="recipe-placeholder">
                        <i class="fas fa-cocktail"></i>
                    </div>
                `}
                
                <div class="recipe-details">
                    <div class="recipe-meta-info">
                        <span class="glass-type">
                            <i class="fas fa-glass-martini-alt"></i> ${recipe.glass_type}
                        </span>
                        ${recipe.is_private ? `
                            <span class="privacy-badge">
                                <i class="fas fa-lock"></i> Privada
                            </span>
                        ` : ''}
                    </div>

                    <div class="recipe-section">
                        <h3>Instrucciones</h3>
                        <p>${recipe.instructions}</p>
                    </div>

                    ${recipe.garnish ? `
                        <div class="recipe-section">
                            <h3>Decoración</h3>
                            <p>${recipe.garnish}</p>
                        </div>
                    ` : ''}
                    
                    <div class="recipe-actions-modal">
                        <a href="/user/recipes/${recipe.id}/edit" class="btn btn-edit">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <button onclick="deleteRecipe(${recipe.id})" class="btn btn-delete">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;

    document.body.appendChild(modal);
    setTimeout(() => modal.classList.add('show'), 10);

    modal.querySelector('.close-modal').addEventListener('click', () => closeModal(modal));
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal(modal);
    });
}

function closeModal(modal) {
    modal.classList.remove('show');
    setTimeout(() => modal.remove(), 300);
}

function deleteRecipe(recipeId) {
    if (confirm('¿Estás seguro de que quieres eliminar esta receta?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/user/recipes/${recipeId}`;
        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection


