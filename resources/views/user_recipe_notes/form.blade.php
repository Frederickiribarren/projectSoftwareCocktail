<?php
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nueva Nota</h1>

    <form action="{{ route('user_recipe_notes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="recipe_id">Receta</label>
            <select name="recipe_id" id="recipe_id" class="form-control @error('recipe_id') is-invalid @enderror" required>
                <option value="">Selecciona una receta</option>
                @foreach($recipes as $recipe)
                    <option value="{{ $recipe->id }}">{{ $recipe->name }}</option>
                @endforeach
            </select>
            @error('recipe_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="note">Nota</label>
            <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror" required>{{ old('note') }}</textarea>
            @error('note')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('user_recipe_notes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection