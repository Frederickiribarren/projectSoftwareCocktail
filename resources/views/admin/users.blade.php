@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gray-900 rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-accent-color">Gestión de Usuarios</h1>
            <button class="btn btn-primary" onclick="openModal('createUserModal')">
                <i class='bx bx-plus'></i> Nuevo Usuario
            </button>
        </div>

        <!-- Filtros -->
        <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="form-group">
                <input type="text" id="searchUser" placeholder="Buscar usuarios..." class="w-full">
            </div>
            <div class="form-group">
                <select id="roleFilter" class="w-full">
                    <option value="">Todos los roles</option>
                    <option value="admin">Administrador</option>
                    <option value="professional">Profesional</option>
                    <option value="hobbyist">Aficionado</option>
                </select>
            </div>
            <div class="form-group">
                <select id="sortFilter" class="w-full">
                    <option value="newest">Más recientes</option>
                    <option value="oldest">Más antiguos</option>
                    <option value="name">Nombre A-Z</option>
                    <option value="name-desc">Nombre Z-A</option>
                </select>
            </div>
        </div>

        <!-- Tabla de Usuarios -->
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-background-card">
                        <th class="px-4 py-2 text-left text-accent-color">Nombre</th>
                        <th class="px-4 py-2 text-left text-accent-color">Email</th>
                        <th class="px-4 py-2 text-left text-accent-color">Rol</th>
                        <th class="px-4 py-2 text-left text-accent-color">Fecha de registro</th>
                        <th class="px-4 py-2 text-left text-accent-color">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-b border-border-color hover:bg-background-hover transition-colors">
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded text-sm
                                {{ $user->role === 'admin' ? 'bg-error-color text-white' : '' }}
                                {{ $user->role === 'professional' ? 'bg-warning-color text-dark' : '' }}
                                {{ $user->role === 'hobbyist' ? 'bg-success-color text-white' : '' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">
                            <div class="flex space-x-2">
                                <button class="btn btn-icon" onclick="openModal('editUserModal', {{ $user->id }})">
                                    <i class='bx bx-edit-alt'></i>
                                </button>
                                <button class="btn btn-icon text-error-color" onclick="confirmDelete({{ $user->id }})">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</div>

<!-- Modal Crear Usuario -->
<div id="createUserModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Crear Nuevo Usuario</h2>
            <button class="close-modal" onclick="closeModal('createUserModal')">
                <i class='bx bx-x'></i>
            </button>
        </div>
        <form id="createUserForm" method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role">Rol</label>
                <select id="role" name="role" required>
                    <option value="hobbyist">Aficionado</option>
                    <option value="professional">Profesional</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-outline" onclick="closeModal('createUserModal')">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Editar Usuario -->
<div id="editUserModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Editar Usuario</h2>
            <button class="close-modal" onclick="closeModal('editUserModal')">
                <i class='bx bx-x'></i>
            </button>
        </div>
        <form id="editUserForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="edit_name">Nombre</label>
                <input type="text" id="edit_name" name="name" required>
            </div>
            <div class="form-group">
                <label for="edit_email">Email</label>
                <input type="email" id="edit_email" name="email" required>
            </div>
            <div class="form-group">
                <label for="edit_role">Rol</label>
                <select id="edit_role" name="role" required>
                    <option value="hobbyist">Aficionado</option>
                    <option value="professional">Profesional</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-outline" onclick="closeModal('editUserModal')">Cancelar</button>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(modalId, userId = null) {
    const modal = document.getElementById(modalId);
    modal.classList.add('active');

    if (userId && modalId === 'editUserModal') {
        // Aquí cargarías los datos del usuario para editar
        fetch(`/admin/users/${userId}`)
            .then(response => response.json())
            .then(user => {
                document.getElementById('edit_name').value = user.name;
                document.getElementById('edit_email').value = user.email;
                document.getElementById('edit_role').value = user.role;
                document.getElementById('editUserForm').action = `/admin/users/${userId}`;
            });
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove('active');
}

function confirmDelete(userId) {
    if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
        fetch(`/admin/users/${userId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }).then(response => {
            if (response.ok) {
                window.location.reload();
            }
        });
    }
}

// Filtrado en tiempo real
document.getElementById('searchUser').addEventListener('input', function(e) {
    // Implementar lógica de búsqueda
});

document.getElementById('roleFilter').addEventListener('change', function(e) {
    // Implementar filtrado por rol
});

document.getElementById('sortFilter').addEventListener('change', function(e) {
    // Implementar ordenamiento
});
</script>
@endsection
