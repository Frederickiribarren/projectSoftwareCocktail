
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocktail World</title>
    <!-- Fuentes del sistema -->
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/bartender-and-cocktail">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    
    <!-- CSS e iconos -->
    <link rel="stylesheet" href="{{ asset('css/resetHtml.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuariorecipenotes.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>   
  @include('components.navbar')

    <div class="notes-container">
        <h1 class="notes-title">Mis Notas de Recetas</h1>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('user_recipe_notes.create') }}" class="create-note-btn">
            <i class='bx bx-plus'></i> Crear Nueva Nota
        </a>

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

    @include('components.footer')
</body>
</html>



