@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis Notas de Recetas</h1>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('user_recipe_notes.create') }}" class="btn btn-primary mb-3">Crear Nueva Nota</a>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Receta</th>
                    <th>Nota</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($user_recipe_notes as $note)
                    <tr>
                        <td>{{ $note->recipe->name ?? 'N/A' }}</td>
                        <td>{{ $note->note }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('user_recipe_notes.show', $note) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('user_recipe_notes.edit', $note) }}" class="btn btn-primary btn-sm">Editar</a>
                                <form action="{{ route('user_recipe_notes.destroy', $note) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No hay notas disponibles</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection