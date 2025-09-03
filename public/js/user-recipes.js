class UserRecipesManager {
    constructor() {
        this.init();
    }

    init() {
        this.recipeCards = document.querySelectorAll('.recipe-card');
        this.setupCardInteractions();
        this.setupModalTriggers();
    }

    setupModalTriggers() {
        this.recipeCards.forEach(card => {
            const contentWrapper = card.querySelector('.recipe-content-wrapper');
            if (contentWrapper) {
                contentWrapper.addEventListener('click', (e) => {
                    e.preventDefault();
                    const recipeId = card.dataset.recipeId;
                    if (recipeId) {
                        this.showRecipeModal(recipeId);
                    }
                });
            }
        });
    }

    setupCardInteractions() {
        this.recipeCards.forEach(card => {
            // Efecto hover mejorado
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-8px) scale(1.02)';
                card.style.boxShadow = '0 20px 50px rgba(0, 0, 0, 0.3)';
                
                // Efecto en la imagen
                const image = card.querySelector('.recipe-image img');
                if (image) {
                    image.style.transform = 'scale(1.1)';
                }
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) scale(1)';
                card.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.2)';
                
                const image = card.querySelector('.recipe-image img');
                if (image) {
                    image.style.transform = 'scale(1)';
                }
            });

            // Efecto click
            card.addEventListener('click', () => {
                card.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    card.style.transform = 'scale(1)';
                }, 100);
            });
        });
    }

    setupImageFallbacks() {
        document.querySelectorAll('.recipe-image img').forEach(img => {
            img.addEventListener('error', function() {
                this.style.display = 'none';
                const placeholder = this.parentElement.querySelector('.recipe-placeholder');
                if (placeholder) {
                    placeholder.style.display = 'flex';
                }
            });
        });
    }

    async showRecipeModal(recipeId) {
        try {
            const response = await fetch(`/user/recipes/${recipeId}/detail`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const recipe = await response.json();
            
            // Crear y mostrar el modal
            const modal = this.createModal(recipe);
            document.body.appendChild(modal);
            setTimeout(() => modal.classList.add('show'), 10);
        } catch (error) {
            console.error('Error loading recipe details:', error);
        }
    }

    createModal(recipe) {
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
                    ` : ''}
                    
                    <div class="recipe-details">
                        <div class="recipe-info">
                            <span class="glass-type">
                                <i class="fas fa-glass-martini-alt"></i>
                                ${recipe.glass_type}
                            </span>
                            ${recipe.is_private ? `
                                <span class="privacy-badge">
                                    <i class="fas fa-lock"></i> Privada
                                </span>
                            ` : ''}
                        </div>

                        <div class="recipe-section">
                            <h3>Ingredientes:</h3>
                            <ul class="ingredients-list">
                                ${recipe.recipe_ingredients.map(ing => `
                                    <li>${ing.amount} - ${ing.ingredient_text}</li>
                                `).join('')}
                            </ul>
                        </div>

                        <div class="recipe-section">
                            <h3>Instrucciones:</h3>
                            <p>${recipe.instructions}</p>
                        </div>

                        ${recipe.garnish ? `
                            <div class="recipe-section">
                                <h3>Decoración:</h3>
                                <p>${recipe.garnish}</p>
                            </div>
                        ` : ''}

                        <div class="recipe-actions-modal">
                            <a href="/user/recipes/${recipe.id}/edit" class="btn btn-edit">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <button class="btn btn-delete" onclick="deleteRecipe(${recipe.id})">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Event listeners del modal
        modal.querySelector('.close-modal').addEventListener('click', () => {
            this.closeModal(modal);
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) this.closeModal(modal);
        });

        return modal;
    }

    closeModal(modal) {
        modal.classList.remove('show');
        setTimeout(() => modal.remove(), 300);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new UserRecipesManager();
});
