@extends('layouts.app')

@section('title', 'Editar Receta')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Receta</h1>
            
            <form action="{{ route('recipes.update', $recipe) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre de la Receta *
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $recipe->name) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="instructions" class="block text-sm font-medium text-gray-700 mb-2">
                        Instrucciones *
                    </label>
                    <textarea id="instructions" 
                              name="instructions" 
                              rows="4" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                              required>{{ old('instructions', $recipe->instructions) }}</textarea>
                    @error('instructions')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="glass_type" class="block text-sm font-medium text-gray-700 mb-2">
                        Tipo de Copa *
                    </label>
                    <select id="glass_type" 
                            name="glass_type" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            required>
                        <option value="">Selecciona un tipo de copa</option>
                        <option value="highball" {{ old('glass_type', $recipe->glass_type) == 'highball' ? 'selected' : '' }}>Highball</option>
                        <option value="rocks" {{ old('glass_type', $recipe->glass_type) == 'rocks' ? 'selected' : '' }}>Rocks/Old Fashioned</option>
                        <option value="martini" {{ old('glass_type', $recipe->glass_type) == 'martini' ? 'selected' : '' }}>Martini</option>
                        <option value="coupe" {{ old('glass_type', $recipe->glass_type) == 'coupe' ? 'selected' : '' }}>Coupe</option>
                        <option value="shot" {{ old('glass_type', $recipe->glass_type) == 'shot' ? 'selected' : '' }}>Shot</option>
                        <option value="wine" {{ old('glass_type', $recipe->glass_type) == 'wine' ? 'selected' : '' }}>Copa de Vino</option>
                        <option value="other" {{ old('glass_type', $recipe->glass_type) == 'other' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('glass_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="garnish" class="block text-sm font-medium text-gray-700 mb-2">
                        Decoración
                    </label>
                    <input type="text" 
                           id="garnish" 
                           name="garnish" 
                           value="{{ old('garnish', $recipe->garnish) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           placeholder="Ej: Rodaja de limón, cereza, etc.">
                    @error('garnish')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image_url" class="block text-sm font-medium text-gray-700 mb-2">
                        URL de Imagen
                    </label>
                    <input type="url" 
                           id="image_url" 
                           name="image_url" 
                           value="{{ old('image_url', $recipe->image_url) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           placeholder="https://ejemplo.com/imagen.jpg">
                    @error('image_url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="source" class="block text-sm font-medium text-gray-700 mb-2">
                        Fuente
                    </label>
                    <input type="text" 
                           id="source" 
                           name="source" 
                           value="{{ old('source', $recipe->source) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           placeholder="Ej: Libro de coctelería, chef, etc.">
                    @error('source')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" 
                           id="is_private" 
                           name="is_private" 
                           value="1"
                           {{ old('is_private', $recipe->is_private) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_private" class="ml-2 block text-sm text-gray-700">
                        Mantener receta privada
                    </label>
                </div>

                <div class="flex space-x-4 pt-4">
                    <button type="submit" class="btn btn-primary flex-1">
                        <i class="fas fa-save"></i> Actualizar Receta
                    </button>
                    <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-secondary flex-1 text-center">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
