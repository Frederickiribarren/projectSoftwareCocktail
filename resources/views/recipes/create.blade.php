@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/recipe-create.css') }}">
<div class="container">
    <div class="recipe-form-card">
        <h1 class="recipe-form-title"><i class="fas fa-magic"></i> Crear Nueva Receta</h1>
        
        <form action="{{ route('recipes.store') }}" method="POST" class="space-y-4" id="recipeForm">
            @csrf
            
            <div class="form-group">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre de la Receta *
                </label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="glass_type" class="block text-sm font-medium text-gray-700 mb-2">
                    Tipo de Copa *
                </label>
                <select id="glass_type" name="glass_type" class="form-control" required>
                    <option value="">Selecciona un tipo de copa</option>
                    <option value="highball">Highball</option>
                    <option value="rocks">Rocks/Old Fashioned</option>
                    <option value="martini">Martini</option>
                    <option value="coupe">Coupe</option>
                    <option value="shot">Shot</option>
                    <option value="wine">Copa de Vino</option>
                    <option value="other">Otro</option>
                </select>
            </div>

            <div class="ingredients-section mb-6">
                <h3 class="text-lg font-semibold mb-3">Ingredientes</h3>
                <div id="ingredientsList" class="space-y-3"></div>
                <button type="button" id="addIngredient" class="btn btn-outline mt-3">
                    <i class="fas fa-plus"></i> Agregar Ingrediente
                </button>
            </div>

            <div class="form-group">
                <label for="instructions" class="block text-sm font-medium text-gray-700 mb-2">
                    Instrucciones *
                </label>
                <textarea id="instructions" name="instructions" rows="4" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="garnish" class="block text-sm font-medium text-gray-700 mb-2">
                    Decoración
                </label>
                <input type="text" id="garnish" name="garnish" class="form-control">
            </div>

            <div class="form-group">
                <label for="image_url" class="block text-sm font-medium text-gray-700 mb-2">
                    URL de Imagen
                </label>
                <input type="url" id="image_url" name="image_url" class="form-control">
            </div>

            <div class="privacy-toggle">
                <label class="toggle-switch">
                    <input type="hidden" name="is_private" value="0">
                    <input type="checkbox" id="is_private" name="is_private" value="1">
                    <span class="toggle-slider"></span>
                    <span class="toggle-label">Mantener receta privada</span>
                </label>
            </div>

            <div class="flex justify-end space-x-4">
                <button type="button" onclick="history.back()" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar Receta
                </button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('js/recipe-form.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ingredientsList = document.getElementById('ingredientsList');
    const addIngredientBtn = document.getElementById('addIngredient');

    function createIngredientInput() {
        const ingredientDiv = document.createElement('div');
        ingredientDiv.className = 'ingredient-input flex items-center space-x-2';
        
        ingredientDiv.innerHTML = `
            <input type="text" name="ingredients[]" class="form-control flex-1" placeholder="Nombre del ingrediente" required>
            <input type="text" name="amounts[]" class="form-control w-32" placeholder="Cantidad (ej: 30ml, 1oz)" required>
            <button type="button" class="btn btn-danger remove-ingredient">
                <i class="fas fa-trash"></i>
            </button>
        `;

        ingredientDiv.querySelector('.remove-ingredient').addEventListener('click', function() {
            ingredientDiv.remove();
        });

        return ingredientDiv;
    }

    addIngredientBtn.addEventListener('click', function() {
        ingredientsList.appendChild(createIngredientInput());
    });

    // Agregar el primer ingrediente por defecto
    ingredientsList.appendChild(createIngredientInput());
});
</script>
@endsection

