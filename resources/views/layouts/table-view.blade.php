<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Administración de Usuarios - The Alchemist's Folio</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <style>
        :root {
            --primary-color: #1a1a1a;
            --secondary-color: #ffffff;
            --accent-color: #ffd700;
            --accent-dark: #cc9900;
            --hover-color: #f0c400;
            --text-color: #e0e0e0;
            --text-dark: #333333;
            --text-muted: #9e9e9e;
            --background-dark: #1a1a1a;
            --background-card: #2a2a2a;
            --background-hover: #333333;
            --border-color: rgba(255, 255, 255, 0.1);
            --border-hover: rgba(255, 215, 0, 0.3);
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.2);
            --danger-color: #ff4444;
            --success-color: #00c851;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--background-dark);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .page-title {
            color: var(--accent-color);
            font-size: 2rem;
            font-family: 'Playfair Display', serif;
        }

        .table-container {
            background: var(--background-card);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            color: var(--text-color);
        }

        .data-table th {
            background: var(--background-dark);
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: var(--accent-color);
        }

        .data-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .data-table tr:hover {
            background: var(--background-hover);
        }

        .actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: var(--accent-color);
            color: var(--text-dark);
            border: none;
        }

        .btn-danger {
            background: var(--danger-color);
            color: var(--text-color);
            border: none;
        }

        .btn-edit {
            background: var(--background-dark);
            color: var(--accent-color);
            border: 1px solid var(--accent-color);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .modal.active {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background: var(--background-card);
            border-radius: 12px;
            width: 100%;
            max-width: 600px;
            position: relative;
            transform: translateY(-20px);
            transition: all 0.3s ease;
            opacity: 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            margin: 1rem;
            display: flex;
            flex-direction: column;
        }

        .modal.active .modal-content {
            transform: translateY(0);
            opacity: 1;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--border-color);
            background: var(--background-card);
            border-radius: 12px 12px 0 0;
        }

        .modal-title {
            color: var(--accent-color);
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .modal-title i {
            font-size: 1.2rem;
        }

        .close-modal {
            background: none;
            border: none;
            color: var(--text-muted);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-modal:hover {
            color: var(--accent-color);
            background: var(--background-dark);
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            color: var(--text-color);
            font-weight: 500;
            font-size: 0.9rem;
        }

        .form-group label i {
            color: var(--text-muted);
            font-size: 0.8rem;
        }

        .form-group label .required {
            color: var(--accent-color);
            margin-left: 0.25rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            background: var(--background-dark);
            border: 2px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-color);
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .form-control-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
        }

        .form-control:hover {
            border-color: var(--accent-color);
            opacity: 0.8;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        select.form-control {
            appearance: none;
            padding-right: 2.5rem;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23ffd700' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1rem;
        }

        .form-control[readonly],
        .form-control:disabled {
            background-color: var(--background-hover);
            cursor: not-allowed;
            opacity: 0.7;
        }

        .modal-body {
            flex: 1;
            padding: 1.5rem 2rem;
            overflow-y: auto;
            min-height: 100px;
            max-height: calc(90vh - 140px);
        }

        .modal-body::-webkit-scrollbar {
            width: 8px;
        }

        .modal-body::-webkit-scrollbar-track {
            background: var(--background-dark);
            border-radius: 4px;
        }

        .modal-body::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }

        .modal-body::-webkit-scrollbar-thumb:hover {
            background: var(--accent-color);
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            padding: 1.5rem 2rem;
            border-top: 1px solid var(--border-color);
            background: var(--background-card);
            border-radius: 0 0 12px 12px;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
        }

        .btn-outline:hover {
            background: var(--accent-color);
            color: var(--text-dark);
        }

        /* Nuevos estilos para el modal mejorado */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            width: 100%;
        }

        .select-wrapper, .input-wrapper {
            position: relative;
        }

        .select-wrapper::after {
            content: '';
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid var(--accent-color);
            pointer-events: none;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .modal-loader {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.9);
            display: none;
            justify-content: center;
            align-items: center;
            border-radius: 12px;
            gap: 1rem;
            color: var(--accent-color);
            animation: fadeIn 0.3s ease;
            z-index: 10;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .form-control.filled {
            border-color: var(--accent-color);
        }

        .form-control.error {
            border-color: var(--danger-color);
        }

        /* Mejorar la experiencia del focus */
        .form-control:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.15);
            transform: translateY(-1px);
        }

        /* Efecto hover en los botones */
        .btn {
            position: relative;
            overflow: hidden;
        }

        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.3s ease, height 0.3s ease;
        }

        .btn:hover::after {
            width: 200%;
            height: 200%;
        }

        .modal-loader.active {
            display: flex;
        }

        .modal-loader i {
            font-size: 2rem;
        }

        [data-loading="true"] {
            position: relative;
            pointer-events: none;
            opacity: 0.7;
        }

        .form-control:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        /* Animación del botón submit */
        .btn-primary:active {
            transform: scale(0.95);
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            .modal-content {
                margin: 1rem;
                max-height: calc(100vh - 2rem);
            }

            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Alert Styles */
        .alert {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 2rem;
            border-radius: 12px;
            background: #1a1a1a;
            color: var(--text-color);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.8);
            z-index: 1000;
            min-width: 320px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .alert.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        .alert-content h3 {
            margin-bottom: 1rem;
            font-size: 1.25rem;
            color: #ffd700;
        }

        .alert-content p {
            margin-bottom: 1.5rem;
            color: #fff;
        }

        .alert-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(-20px);
            }
        }

        .data-table tr {
            transition: all 0.3s ease;
        }

        /* Search and Filter Section */
        .table-tools {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--background-dark);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            border: 1px solid var(--border-color);
        }

        .search-box input {
            background: none;
            border: none;
            color: var(--text-color);
            font-size: 0.9rem;
            outline: none;
            width: 200px;
        }

        .search-box i {
            color: var(--text-muted);
        }

        .filters {
            display: flex;
            gap: 1rem;
        }

        .filter-select {
            background: var(--background-dark);
            border: 1px solid var(--border-color);
            color: var(--text-color);
            padding: 0.5rem;
            border-radius: 6px;
            outline: none;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
            margin-top: 1.5rem;
            align-items: center;
        }

        .page-btn {
            min-width: 40px;
            height: 40px;
            padding: 0.5rem;
            background: var(--background-dark);
            border: 1px solid var(--border-color);
            color: var(--text-color);
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .page-btn:hover {
            background: var(--background-hover);
            border-color: var(--accent-color);
            color: var(--accent-color);
        }

        .page-btn.active {
            background: var(--accent-color);
            color: var(--text-dark);
            border-color: var(--accent-color);
            pointer-events: none;
        }

        .page-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        .page-btn i {
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    @include('components.navbar')

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">{{ $tableName }}</h1>
            <button class="btn btn-primary" onclick="openModal()">
                <i class="fas fa-plus"></i>
                Agregar Registro
            </button>
            @if($tableName === 'Recipes')
            <button class="btn btn-primary" onclick="importFromApi()" style="margin-left: 10px;">
                <i class="fas fa-cloud-download-alt"></i>
                Importar desde API
            </button>
            @endif
        </div>

        <div class="table-container">
            <div class="table-tools">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar...">
                </div>
                @if(!empty($relationships))
                <div class="filters">
                    @foreach($relationships as $relation)
                    <select class="filter-select" name="filter_{{ $relation }}">
                        <option value="">Filtrar por {{ ucfirst($relation) }}</option>
                    </select>
                    @endforeach
                </div>
                @endif
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        @foreach($columns as $column)
                        <th>{{ ucfirst(str_replace('_', ' ', $column)) }}</th>
                        @endforeach
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                    <tr data-id="{{ $record->id }}">
                        @foreach($columns as $column)
                        <td>
                            @if(is_array($record->$column))
                                {{ json_encode($record->$column) }}
                            @else
                                {{ $record->$column }}
                            @endif
                        </td>
                        @endforeach
                        <td>
                            <div class="actions">
                                <button class="btn btn-edit" onclick="openModal({{ $record->id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger" onclick="confirmDelete({{ $record->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $records->links('vendor.pagination.custom') }}
        </div>
    </div>

    <!-- Modal de Edición -->
    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">
                    <span id="modalTitle">Editar Registro</span>
                </h2>
                <button class="close-modal" onclick="closeModal()" title="Cerrar">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editForm">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-grid">
                        @foreach($columns as $column)
                        @if($column != 'id' && $column != 'created_at' && $column != 'updated_at')
                        <div class="form-group">
                        @if($column == 'created_at' || $column == 'updated_at')
                            <input type="hidden" id="{{ $column }}" name="{{ $column }}">
                        @endif
                            <label for="{{ $column }}">
                                @if(strpos($column, '_id') !== false)
                                    <i class="fas fa-link"></i>
                                @elseif(strpos($column, 'is_') === 0)
                                    <i class="fas fa-toggle-on"></i>
                                @elseif(strpos($column, 'description') !== false)
                                    <i class="fas fa-align-left"></i>
                                @elseif(strpos($column, 'instructions') !== false)
                                    <i class="fas fa-list-ol"></i>
                                @elseif(strpos($column, 'name') !== false)
                                    <i class="fas fa-font"></i>
                                @elseif(strpos($column, 'email') !== false)
                                    <i class="fas fa-envelope"></i>
                                @else
                                    <i class="fas fa-edit"></i>
                                @endif
                                {{ ucfirst(str_replace('_', ' ', $column)) }}
                                <span class="required">*</span>
                            </label>
                            @if(strpos($column, '_id') !== false || $column === 'source')
                                <div class="select-wrapper">
                                    <select id="{{ $column }}" name="{{ $column }}" class="form-control" required data-loading="true">
                                        <option value="">Cargando opciones...</option>
                                    </select>
                                </div>
                            @elseif(strpos($column, 'is_') === 0)
                                <div class="select-wrapper">
                                    <select id="{{ $column }}" name="{{ $column }}" class="form-control" required>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            @elseif(strpos($column, 'description') !== false || strpos($column, 'instructions') !== false)
                                <textarea id="{{ $column }}" name="{{ $column }}" class="form-control" 
                                    rows="4" required 
                                    placeholder="Ingrese {{ strtolower(str_replace('_', ' ', $column)) }}..."
                                ></textarea>
                            @else
                                <div class="input-wrapper">
                                    <input type="text" id="{{ $column }}" name="{{ $column }}" class="form-control" 
                                        placeholder="Ingrese {{ strtolower(str_replace('_', ' ', $column)) }}..." required>
                                </div>
                            @endif
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" onclick="closeModal()">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save"></i> 
                        <span>Guardar Cambios</span>
                    </button>
                </div>
            </form>
            <div class="modal-loader" id="modalLoader">
                <i class="fas fa-spinner fa-spin"></i>
                <span>Cargando...</span>
            </div>
        </div>
    </div>

    <!-- Alert de Confirmación -->
    <div class="alert" id="deleteAlert">
        <div class="alert-content">
            <h3>¿Estás seguro?</h3>
            <p>Esta acción no se puede deshacer.</p>
            <div class="alert-actions">
                <button class="btn btn-outline" onclick="cancelDelete()">Cancelar</button>
                <button class="btn btn-danger" onclick="deleteRecord()">Eliminar</button>
            </div>
        </div>
    </div>

    @include('components.footer2')

    <script>
        async function importFromApi(letter = 'a') {
            try {
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                if (!csrfToken) {
                    throw new Error('Token CSRF no encontrado');
                }

                console.log('Importando letra:', letter);
                // Mostrar notificación de inicio
                showNotification(`Importando cócteles que empiezan con '${letter}'...`, 'info');

                const response = await fetch(`/admin/recipes/import/${letter}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                console.log(response);

                const data = await response.json();

                if (data.success) {
                    // Mostrar el resultado de la importación actual
                    showNotification(data.message, 'success');

                    // Si hay una siguiente letra, continuar con la importación
                    if (data.nextLetter) {
                        // Esperar 2 segundos antes de la siguiente importación
                        setTimeout(() => {
                            importFromApi(data.nextLetter);
                        }, 2000);
                    } else {
                        // Importación completada
                        showNotification('Importación completada exitosamente', 'success');
                        // Recargar la página después de 2 segundos
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }
                } else {
                    showNotification(data.message, 'error');
                    // Si hay una siguiente letra, intentar continuar a pesar del error
                    if (data.nextLetter) {
                        setTimeout(() => {
                            importFromApi(data.nextLetter);
                        }, 2000);
                    }
                }
            } catch (error) {
                showNotification(error.message || 'Error al importar las recetas', 'error');
            }
        }

        // Configuración CSRF para AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        // Funciones para el modal
        async function openModal(id = null) {
            const modal = document.getElementById('editModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalLoader = document.getElementById('modalLoader');
            const form = document.getElementById('editForm');
            const submitBtn = document.getElementById('submitBtn');
            
            // Resetear el formulario
            form.reset();

            // Configurar el modal
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.classList.add('active');
                modal.querySelector('.modal-content').style.opacity = '1';
                modal.querySelector('.modal-content').style.transform = 'translateY(0)';
            }, 10);
            
            // Actualizar título e icono según la acción
            modalTitle.innerHTML = id ? '<i class="fas fa-edit"></i> Editar Registro' : '<i class="fas fa-plus"></i> Nuevo Registro';
            submitBtn.innerHTML = id ? '<i class="fas fa-save"></i> Actualizar' : '<i class="fas fa-plus"></i> Crear';
            
            if (id) {
                try {
                    modalLoader.style.display = 'flex';
                    const tableNameForUrl = '{{ strtolower($tableName) }}'.replace(/\s+/g, '_');
                    $.ajax({
                        url: `/admin/${tableNameForUrl}/${id}`,
                        method: 'GET',
                        success: function(data) {
                    
                            if (data.success && data.record) {
                                // Llenar el formulario con los datos
                                $.each(data.record, function(key, value) {
                                    const input = document.getElementById(key);
                                    if (!input) return;

                                    if (input.tagName === 'SELECT') {
                                        if (input.name.startsWith('is_')) {
                                            // Para campos booleanos, simplemente establecer el valor
                                            input.value = value ? '1' : '0';
                                            $(input).trigger('change');
                                        } else {
                                            // Para otros selects, cargar las opciones
                                            loadRelatedOptions(input).then(() => {
                                                input.value = value || '';
                                                $(input).trigger('change');
                                            });
                                        }
                                    } else if (input.type === 'checkbox') {
                                        input.checked = Boolean(value);
                                    } else {
                                        input.value = value || '';
                                    }

                                    // Activar validación y efectos visuales
                                    $(input).trigger('input');
                                    input.classList.add('filled');
                                });
                            } else {
                                throw new Error(data.message || 'Error al cargar los datos');
                            }
                        },
                        error: function(xhr, status, error) {
                            showNotification('Error al cargar los datos: ' + error, 'error');
                        },
                        complete: function() {
                            modalLoader.style.display = 'none';
                        }
                    });
                } catch (error) {
                    console.error('Error:', error);
                    showNotification('Error al cargar los datos', 'error');
                }
            } else {
                // En modo creación, cargar opciones para selects
                const selects = document.querySelectorAll('select[name$="_id"]');
                await Promise.all([...selects].map(loadRelatedOptions));
            }

            // Enfocar el primer campo
            const firstInput = form.querySelector('input:not([type="hidden"]), select, textarea');
            if (firstInput) firstInput.focus();
        }

        function closeModal() {
            const modal = document.getElementById('editModal');
            const modalContent = modal.querySelector('.modal-content');
            
            // Animar el cierre
            modalContent.style.transform = 'translateY(20px)';
            modalContent.style.opacity = '0';
            modal.classList.remove('active');
            
            // Esperar a que termine la animación antes de ocultar completamente
            setTimeout(() => {
                modal.style.display = 'none';
                document.getElementById('editForm').reset();
                
                // Limpiar clases y estados
                const inputs = modal.querySelectorAll('.form-control');
                inputs.forEach(input => {
                    input.classList.remove('filled');
                    input.classList.remove('error');
                });
            }, 300);
        }

        // Funciones para la eliminación
        function confirmDelete(id) {
            const alert = document.getElementById('deleteAlert');
            alert.classList.add('active');
            alert.dataset.id = id;
        }

        function cancelDelete() {
            const alert = document.getElementById('deleteAlert');
            alert.classList.remove('active');
        }

        async function deleteRecord() {
            const alert = document.getElementById('deleteAlert');
            const id = alert.dataset.id;
            
            try {
                // Asegurar que el nombre de la tabla no tenga espacios
                const tableNameForUrl = '{{ strtolower($tableName) }}'.replace(/\s+/g, '_');
                const response = await fetch(`/database-admin/table/${tableNameForUrl}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                
                const data = await response.json();
                
                if (response.ok) {
                    // Primero mostrar la notificación
                    showNotification('Registro eliminado con éxito', 'success');
                    
                    // Ocultar el alert de confirmación
                    alert.classList.remove('active');
                    
                    // Eliminar la fila de la tabla
                    const row = document.querySelector(`tr[data-id="${id}"]`);
                    if (row) {
                        row.style.animation = 'fadeOut 0.3s ease forwards';
                        setTimeout(() => {
                            row.remove();
                            // Actualizar contador si existe
                            updateTableCounter();
                        }, 300);
                    }
                } else {
                    throw new Error(data.error || data.message || 'Error al eliminar el registro');
                }
            } catch (error) {
                showNotification(error.message || 'Error al eliminar el registro', 'error');
                // Ocultar el alert de confirmación después de mostrar el error
                alert.classList.remove('active');
            }
        }

        // Función para mostrar notificaciones
        function showNotification(message, type) {
            // Remover notificaciones anteriores
            const existingNotifications = document.querySelectorAll('.notification-toast');
            existingNotifications.forEach(notification => notification.remove());
            
            const notification = document.createElement('div');
            notification.className = `notification-toast ${type}`;
            notification.innerHTML = `
                <div class="notification-content">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                    <span>${message}</span>
                </div>
            `;
            document.body.appendChild(notification);

            // Agregar los estilos si no existen
            if (!document.getElementById('notification-styles')) {
                const styles = document.createElement('style');
                styles.id = 'notification-styles';
                styles.textContent = `
                    .notification-toast {
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        padding: 1rem 1.5rem;
                        border-radius: 8px;
                        background: #262626;
                        color: #ffffff;
                        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.8);
                        z-index: 1100;
                        min-width: 300px;
                        transform: translateX(120%);
                        animation: slideIn 0.3s forwards;
                        border: 2px solid;
                    }
                    .notification-toast.success {
                        border-color: var(--success-color);
                        background: linear-gradient(90deg, rgba(12, 82, 40, 0.75));
                        box-shadow: 0 4px 16px rgba(0, 200, 81, 0.2);
                    }
                    .notification-toast.error {
                        border-color: var(--danger-color);
                        background: linear-gradient(90deg, rgba(105, 8, 8, 0.85));
                        box-shadow: 0 4px 16px rgba(255, 68, 68, 0.2);
                    }
                    .notification-content {
                        display: flex;
                        align-items: center;
                        gap: 1rem;
                        padding: 0.5rem;
                    }
                    .notification-content i {
                        font-size: 1.5rem;
                        filter: drop-shadow(0 0 8px currentColor);
                    }
                    .notification-toast.success i {
                        color: var(--success-color);
                    }
                    .notification-toast.error i {
                        color: var(--danger-color);
                    }
                    .notification-content span {
                        font-weight: 600;
                        font-size: 1.1rem;
                        color: #ffffff;
                        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
                    }
                    @keyframes slideIn {
                        to {
                            transform: translateX(0);
                        }
                    }
                    @keyframes slideOut {
                        from {
                            transform: translateX(0);
                            opacity: 1;
                        }
                        to {
                            transform: translateX(100%);
                            opacity: 0;
                        }
                    }
                `;
                document.head.appendChild(styles);
            }

            // Remover después de 3 segundos con animación
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s forwards';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Función para cargar opciones en selects relacionados
        async function loadRelatedOptions(selectElement) {
            // Para campos enum y relaciones, usar el nombre del campo directamente
            const relationName = selectElement.name === 'source' ? 'source' : selectElement.name.replace('_id', '').toLowerCase();
            try {
                const response = await $.ajax({
                    url: `/admin/relations/${relationName}`,
                    method: 'GET'
                });

                if (response.success) {
                    $(selectElement)
                        .empty()
                        .append('<option value="">Seleccione...</option>')
                        .removeAttr('data-loading');

                    response.options.forEach(option => {
                        $(selectElement).append($('<option>', {
                            value: option.id,
                            text: option.name
                        }));
                    });
                } else {
                    console.warn(`No se pudieron cargar las opciones para ${relationName}`);
                    $(selectElement)
                        .empty()
                        .append('<option value="">No hay opciones disponibles</option>')
                        .attr('disabled', 'disabled');
                }
            } catch (error) {
                console.error('Error cargando opciones:', error);
                $(selectElement)
                    .empty()
                    .append('<option value="">Error cargando opciones</option>')
                    .attr('disabled', 'disabled');
            }
        }

        // Función para actualizar el contador de registros
        function updateTableCounter() {
            const tableRows = document.querySelectorAll('.data-table tbody tr');
            const totalRows = tableRows.length;
            
            // Actualizar el contador en el título si existe
            const titleCounter = document.querySelector('.page-title .counter');
            if (titleCounter) {
                titleCounter.textContent = `(${totalRows})`;
            }
            
            // Si no hay registros, mostrar mensaje
            const tableBody = document.querySelector('.data-table tbody');
            if (totalRows === 0) {
                const emptyRow = document.createElement('tr');
                emptyRow.innerHTML = `
                    <td colspan="${document.querySelectorAll('.data-table th').length}" class="text-center">
                        No hay registros disponibles
                    </td>
                `;
                tableBody.appendChild(emptyRow);
            }
        }

        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Cargar opciones solo para selects de relaciones y campos enum
            document.querySelectorAll('select[name$="_id"], select[name="source"]').forEach(loadRelatedOptions);

            // Manejar búsqueda
            const searchInput = document.querySelector('.search-box input');
            let searchTimeout;
            
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(async () => {
                    const searchTerm = this.value;
                    try {
                        const response = await fetch(`/admin/search?term=${searchTerm}`);
                        const data = await response.json();
                        
                        if (data.success) {
                            // Actualizar la tabla con los resultados
                            updateTableContent(data.records);
                        }
                    } catch (error) {
                        console.error('Error en la búsqueda:', error);
                    }
                }, 300);
            });
        });

        // Manejar envío del formulario
        document.getElementById('editForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const id = formData.get('id');
            const method = id ? 'PUT' : 'POST';
            const url = id ? `/admin/{{ strtolower($tableName) }}/${id}` : '/admin/{{ strtolower($tableName) }}';
            
            try {
                const formDataObj = {};
                formData.forEach((value, key) => {
                    // Manejar campos booleanos
                    if (key.startsWith('is_')) {
                        formDataObj[key] = value === '1' || value === 'true';
                    } 
                    // Manejar campos numéricos
                    else if (key === 'rate_limit' || key === 'rate_limit_reset_interval') {
                        formDataObj[key] = value === '' ? null : parseInt(value);
                    }
                    // Manejar campos de fecha
                    else if (key === 'last_used_at') {
                        formDataObj[key] = value === '' ? null : value;
                    }
                    // Otros campos
                    else {
                        formDataObj[key] = value === '' ? null : value;
                    }
                });
                console.log('Datos del formulario:', formDataObj);

                // Asegurar que el nombre de la tabla no tenga espacios
                const tableNameForUrl = '{{ strtolower($tableName) }}'.replace(/\s+/g, '_');
                const url = id ? 
                    `/database-admin/table/${tableNameForUrl}/${id}` : 
                    `/database-admin/table/${tableNameForUrl}/create`;

                const response = await fetch(url, {
                    method: method,
                    body: JSON.stringify(formDataObj),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    console.log('Respuesta del servidor:', data);
                    closeModal();
                    showNotification('Cambios guardados con éxito', 'success');
                    location.reload();
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                showNotification(error.message || 'Error al guardar los cambios', 'error');
            }
        });
    </script>
</body>
</html>
