@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/recipe-create.css') }}">
<div class="container">
    <div class="recipe-form-card">
        <h1 class="recipe-form-title"><i class="fas fa-edit"></i> Editar Receta</h1>
        
        <form action="{{ route('user.recipes.update', $recipe) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre de la Receta *
                </label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $recipe->name }}" required>
            </div>

            <div class="form-group">
                <label for="glass_type" class="block text-sm font-medium text-gray-700 mb-2">
                    Tipo de Copa *
                </label>
                <select id="glass_type" name="glass_type" class="form-control" required>
                    <option value="">Selecciona un tipo de copa</option>
                    <option value="highball" {{ $recipe->glass_type == 'highball' ? 'selected' : '' }}>Highball</option>
                    <option value="rocks" {{ $recipe->glass_type == 'rocks' ? 'selected' : '' }}>Rocks/Old Fashioned</option>
                    <option value="martini" {{ $recipe->glass_type == 'martini' ? 'selected' : '' }}>Martini</option>
                    <option value="coupe" {{ $recipe->glass_type == 'coupe' ? 'selected' : '' }}>Coupe</option>
                    <option value="shot" {{ $recipe->glass_type == 'shot' ? 'selected' : '' }}>Shot</option>
                    <option value="wine" {{ $recipe->glass_type == 'wine' ? 'selected' : '' }}>Copa de Vino</option>
                </select>
            </div>

            <div class="form-group">
                <label for="instructions" class="block text-sm font-medium text-gray-700 mb-2">
                    Instrucciones *
                </label>
                <textarea id="instructions" name="instructions" rows="4" class="form-control" required>{{ $recipe->instructions }}</textarea>
            </div>

            <div class="form-group">
                <label for="garnish" class="block text-sm font-medium text-gray-700 mb-2">
                    Decoración
                </label>
                <input type="text" id="garnish" name="garnish" class="form-control" value="{{ $recipe->garnish }}">
            </div>

            <div class="form-group">
                <label for="image_url" class="block text-sm font-medium text-gray-700 mb-2">
                    URL de Imagen
                </label>
                <input type="url" id="image_url" name="image_url" class="form-control" value="{{ $recipe->image_url }}">
            </div>

            <div class="privacy-toggle">
                <label class="toggle-switch">
                    <input type="hidden" name="is_private" value="0">
                    <input type="checkbox" id="is_private" name="is_private" value="1" {{ $recipe->is_private ? 'checked' : '' }}>
                    <span class="toggle-slider"></span>
                    <span class="toggle-label">Mantener receta privada</span>
                </label>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('user.recipes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

