@extends('layouts.app')


@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Encabezado de la receta -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-start mb-4">
                <h1 class="text-3xl font-bold text-gray-800">{{ $recipe->name }}</h1>
                <div class="flex space-x-2">
                    <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-secondary">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form method="POST" action="{{ route('recipes.destroy', $recipe) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta receta?')">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>

            @if($recipe->image_url)
                <img src="{{ $recipe->image_url }}" alt="{{ $recipe->name }}" class="w-full h-64 object-cover rounded-lg mb-4">
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-700 mb-2">Tipo de Copa</h3>
                    <p class="text-gray-600">{{ $recipe->glass_type }}</p>
                </div>
                @if($recipe->garnish)
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-700 mb-2">Decoración</h3>
                    <p class="text-gray-600">{{ $recipe->garnish }}</p>
                </div>
                @endif
                @if($recipe->source)
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-700 mb-2">Fuente</h3>
                    <p class="text-gray-600">{{ $recipe->source }}</p>
                </div>
                @endif
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Instrucciones</h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-700 leading-relaxed">{{ $recipe->instructions }}</p>
                </div>
            </div>

            <div class="flex justify-between items-center text-sm text-gray-500">
                <span>Creado: {{ $recipe->created_at->format('d/m/Y H:i') }}</span>
                @if($recipe->is_private)
                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">
                        <i class="fas fa-lock"></i> Privada
                    </span>
                @else
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full">
                        <i class="fas fa-globe"></i> Pública
                    </span>
                @endif
            </div>
        </div>

        <!-- Botón para regresar -->
        <div class="text-center">
            <a href="{{ route('recipes.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Volver a Recetas
            </a>
        </div>
    </div>
</div>
@endsection