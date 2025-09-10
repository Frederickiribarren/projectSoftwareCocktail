@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/usuariorecipenotes.css') }}">
    <div class="notes-container">
        <h1 class="notes-title">Mis Notas de Recetas</h1>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <button id="createNoteBtn" class="btn btn-create">
            <i class='bx bx-plus'></i> Crear Nueva Nota
        </button>

        <table class="notes-table">
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
                            <div class="action-buttons">
                                <a href="{{ route('user_recipe_notes.show', $note) }}" class="btn btn-view">
                                    <i class='bx bx-show'></i> Ver
                                </a>
                                <a href="{{ route('user_recipe_notes.edit', $note) }}" class="btn btn-edit">
                                    <i class='bx bx-edit'></i> Editar
                                </a>
                                <form action="{{ route('user_recipe_notes.destroy', $note) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('¿Estás seguro?')">
                                        <i class='bx bx-trash'></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="empty-message">No hay notas disponibles</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('createNoteBtn').addEventListener('click', function(event) {
            // Aquí puedes agregar lógica adicional si es necesario
            
        });
    </script>
@endsection


