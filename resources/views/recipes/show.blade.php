@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/recipe-show.css') }}">
<div class="container-recipe-show flex justify-center items-center min-h-[80vh]">
    <div class="recipe-card-show">
        <!-- Imagen -->
        @if($recipe->image_url)
            <div class="recipe-image-show">
                <img src="{{ $recipe->image_url }}" alt="{{ $recipe->name }}">
            </div>
        @endif
        <!-- Encabezado -->
        <div class="recipe-header-show">
            <h1 class="recipe-title-show">{{ $recipe->name }}</h1>
            <div class="recipe-meta-show">
                <span><i class="fas fa-calendar-alt"></i> {{ $recipe->created_at->format('d/m/Y H:i') }}</span>
                @if($recipe->is_private)
                    <span class="badge-private"><i class="fas fa-lock"></i> Privada</span>
                @else
                    <span class="badge-public"><i class="fas fa-globe"></i> Pública</span>
                @endif
            </div>
        </div>
        <!-- Info columnas -->
        <div class="recipe-info-columns-show">
            <div class="info-col-show">
                <h3>Tipo de Copa</h3>
                <p>{{ $recipe->glass_type }}</p>
            </div>
            <div class="info-col-show">
                <h3>Decoración</h3>
                <p>{{ $recipe->garnish ? $recipe->garnish : '-' }}</p>
            </div>
            <div class="info-col-show">
                <h3>Fuente</h3>
                <p>{{ $recipe->source ? $recipe->source : '-' }}</p>
            </div>
        </div>
        <!-- Instrucciones -->
        <div class="recipe-section-show">
            <h2>Instrucciones</h2>
            <div class="instructions-box-show">
                <p>{{ $recipe->instructions }}</p>
            </div>
        </div>
        <!-- Botones -->
        <div class="recipe-actions-show">
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
    <!-- Botón para regresar -->
</div>
<div class="text-center mt-8">
    <a href="{{ route('recipes.index') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Volver a Recetas
    </a>
</div>
@endsection