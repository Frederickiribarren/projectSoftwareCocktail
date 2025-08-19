<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario - The Alchemist's Folio</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap');
        
        :root {
            /* Colores principales */
            --primary-color: #1a1a1a;
            --secondary-color: #ffffff;
            --accent-color: #ffd700;
            --accent-dark: #cc9900;
            --hover-color: #f0c400;
            
            /* Textos */
            --text-color: #e0e0e0;
            --text-dark: #333333;
            --text-muted: #9e9e9e;
            --text-error: #ff4444;
            --text-success: #00C851;
            --text-warning: #ffbb33;
            
            /* Fondos */
            --background-light: #ffffff;
            --background-dark: #1a1a1a;
            --background-card: #2a2a2a;
            --background-hover: #333333;
            --background-active: #404040;
            
            /* Estados */
            --success-color: #00C851;
            --error-color: #ff4444;
            --warning-color: #ffbb33;
            --info-color: #33b5e5;
            
            /* Bordes y sombras */
            --border-color: rgba(255, 255, 255, 0.1);
            --border-hover: rgba(255, 215, 0, 0.3);
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.2);
            --shadow-lg: 0 8px 16px rgba(0, 0, 0, 0.3);
            
            /* Gradientes */
            --gradient-dark: linear-gradient(145deg, #222222, #333333);
            --gradient-accent: linear-gradient(145deg, var(--accent-color), var(--accent-dark));
            
            /* Espaciado */
            --spacing-xs: 0.25rem;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
            
            /* Bordes */
            --border-radius-sm: 4px;
            --border-radius-md: 8px;
            --border-radius-lg: 12px;
            --border-radius-full: 9999px;
            
            /* Transiciones */
            --transition-fast: 0.15s ease;
            --transition-normal: 0.3s ease;
            --transition-slow: 0.5s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: 'Montserrat', sans-serif;
            color: var(--text-color);
            background-color: var(--background-dark);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .header h1 {
            font-family: 'Playfair Display', serif;
            color: var(--accent-color);
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .header p {
            color: var(--text-color);
            max-width: 600px;
            margin: 0 auto;
        }

        .inventory-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .inventory-section {
            background: var(--gradient-dark);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .inventory-section:hover {
            border-color: var(--accent-color);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .section-header h2 {
            color: var(--accent-color);
            font-size: 1.25rem;
            margin: 0;
        }

        .section-header i {
            color: var(--accent-color);
            font-size: 1.5rem;
        }

        .search-bar {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .search-bar input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-color);
            font-size: 1rem;
        }

        .search-bar i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--accent-color);
        }

        .category-tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }

        .category-tab {
            padding: 0.5rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            color: var(--text-color);
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.3s ease;
        }

        .category-tab.active {
            background: var(--accent-color);
            color: var(--primary-color);
            border-color: var(--accent-color);
        }

        .ingredient-list {
            display: grid;
            gap: var(--spacing-md);
            padding: var(--spacing-md);
            background: var(--gradient-dark);
            border-radius: var(--border-radius-lg);
            border: 1px solid var(--border-color);
        }

        .ingredient-header {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 0.8fr;
            padding: var(--spacing-md);
            background: var(--background-card);
            border-radius: var(--border-radius-md);
            font-weight: 600;
            color: var(--accent-color);
            margin-bottom: var(--spacing-md);
        }

        .ingredient-item {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 0.8fr;
            align-items: center;
            padding: var(--spacing-md);
            background: var(--background-card);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius-md);
            transition: all var(--transition-normal);
        }

        .ingredient-item:hover {
            border-color: var(--accent-color);
            background: var(--background-hover);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .ingredient-item.dragging {
            opacity: 0.5;
            transform: scale(1.02);
            box-shadow: var(--shadow-lg);
        }

        .ingredient-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .ingredient-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--accent-color);
            border-radius: 8px;
            color: var(--primary-color);
        }

        .ingredient-details h3 {
            color: var(--text-color);
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .ingredient-details p {
            color: var(--text-color);
            font-size: 0.875rem;
            opacity: 0.7;
        }

        .ingredient-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            padding: var(--spacing-sm) var(--spacing-md);
            border: none;
            border-radius: var(--border-radius-md);
            font-weight: 600;
            cursor: pointer;
            transition: all var(--transition-normal);
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-sm);
            min-height: 2.5rem;
        }

        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .btn:active::after {
            width: 200%;
            height: 200%;
            opacity: 0;
        }

        .btn i {
            font-size: 1.2em;
            transition: transform var(--transition-fast);
        }

        .btn:hover i {
            transform: scale(1.1);
        }

        .btn-primary {
            background: var(--gradient-accent);
            color: var(--primary-color);
            box-shadow: var(--shadow-sm);
        }

        .btn-primary:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
        }

        .btn-outline:hover {
            background: rgba(255, 215, 0, 0.1);
            box-shadow: var(--shadow-sm);
            transform: translateY(-2px);
        }

        .btn-icon {
            padding: var(--spacing-sm);
            border-radius: var(--border-radius-md);
            color: var(--text-color);
            background: transparent;
            transition: all var(--transition-normal);
        }

        .btn-icon:hover {
            color: var(--accent-color);
            background: rgba(255, 215, 0, 0.1);
        }

        .btn[disabled] {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-loading {
            position: relative;
            pointer-events: none;
        }

        .btn-loading::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 1.2em;
            height: 1.2em;
            border: 2px solid transparent;
            border-top-color: currentColor;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
            transform: translate(-50%, -50%);
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            background: var(--background-card);
            padding: var(--spacing-xs);
            border-radius: var(--border-radius-md);
            border: 2px solid var(--border-color);
            transition: all var(--transition-normal);
        }

        .quantity-control:hover {
            border-color: var(--border-hover);
        }

        .quantity-control:focus-within {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
        }

        .quantity-btn {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--gradient-accent);
            border: none;
            border-radius: var(--border-radius-sm);
            color: var(--primary-color);
            cursor: pointer;
            transition: all var(--transition-normal);
            font-weight: bold;
            font-size: 1.2rem;
        }

        .quantity-btn:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .quantity-btn:active {
            transform: translateY(0);
        }

        .quantity-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            min-width: 120px;
        }

        .quantity-input {
            width: 100%;
            padding: var(--spacing-sm) var(--spacing-md);
            background: transparent;
            border: none;
            color: var(--text-color);
            font-size: 1rem;
            text-align: center;
            font-family: inherit;
        }

        .quantity-input:focus {
            outline: none;
        }

        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .unit {
            color: var(--text-muted);
            font-size: 0.9rem;
            padding-right: var(--spacing-sm);
            user-select: none;
        }

        .stock-status {
            font-size: 0.85rem;
            font-weight: 500;
            padding: var(--spacing-xs) var(--spacing-sm);
            border-radius: var(--border-radius-sm);
            margin-top: var(--spacing-xs);
            text-align: center;
            transition: all var(--transition-normal);
        }

        .stock-status.out {
            background-color: rgba(255, 68, 68, 0.1);
            color: var(--error-color);
        }

        .stock-status.low {
            background-color: rgba(255, 187, 51, 0.1);
            color: var(--warning-color);
        }

        .stock-status.ok {
            background-color: rgba(0, 200, 81, 0.1);
            color: var(--success-color);
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--gradient-dark);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
        }

        .stat-card h3 {
            color: var(--accent-color);
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .stat-card p {
            color: var(--text-color);
            font-size: 0.875rem;
            opacity: 0.8;
        }

        .filter-options {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
            background: var(--gradient-dark);
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        .filter-select {
            padding: 0.75rem 1rem;
            background: var(--background-card);
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius-md);
            color: var(--text-color);
            min-width: 180px;
            appearance: none;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23ffd700' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.7rem center;
            background-size: 1.2em;
            padding-right: 2.5rem;
            transition: all var(--transition-normal);
        }

        .filter-select:hover {
            border-color: var(--border-hover);
        }

        .filter-select:focus {
            border-color: var(--accent-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
        }

        .filter-select option {
            padding: 0.75rem 1rem;
            background-color: var(--background-dark);
            color: var(--text-color);
            cursor: pointer;
        }

        /* Estilos para Firefox */
        .filter-select:-moz-focusring {
            color: transparent;
            text-shadow: 0 0 0 var(--text-color);
        }

        /* Estilos para el menú desplegable en navegadores webkit */
        .filter-select::-webkit-listbox {
            background-color: var(--background-dark);
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius-md);
            padding: 0.5rem 0;
        }

        .filter-select option:hover,
        .filter-select option:focus,
        .filter-select option:active,
        .filter-select option:checked {
            background-color: var(--accent-color);
            color: var(--text-dark);
        }

        .toggle-switch {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .toggle-switch input[type="checkbox"] {
            appearance: none;
            width: 40px;
            height: 20px;
            background: var(--background-card);
            border: 2px solid var(--border-color);
            border-radius: 20px;
            position: relative;
            cursor: pointer;
        }

        .toggle-switch input[type="checkbox"]::before {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            background: var(--text-color);
            border-radius: 50%;
            top: 0;
            left: 0;
            transition: transform 0.3s;
        }

        .toggle-switch input[type="checkbox"]:checked {
            background: var(--accent-color);
            border-color: var(--accent-dark);
        }

        .toggle-switch input[type="checkbox"]:checked::before {
            transform: translateX(20px);
            background: var(--text-dark);
        }

        .toggle-switch label {
            cursor: pointer;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: var(--background-dark);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 2rem;
            width: 90%;
            max-width: 500px;
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .modal-header h2 {
            color: var(--accent-color);
            margin: 0;
        }

        .close-modal {
            background: transparent;
            border: none;
            color: var(--text-color);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        .form-group {
            position: relative;
            margin-bottom: var(--spacing-lg);
        }

        .form-group label {
            display: block;
            margin-bottom: var(--spacing-xs);
            color: var(--text-color);
            font-size: 0.9rem;
            transition: color var(--transition-fast);
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group select {
            width: 100%;
            padding: var(--spacing-md);
            background: var(--background-card);
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius-md);
            color: var(--text-color);
            font-size: 1rem;
            transition: all var(--transition-normal);
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
            outline: none;
        }

        .form-group input:hover,
        .form-group select:hover {
            border-color: var(--border-hover);
        }

        .form-group .helper-text {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: var(--spacing-xs);
        }

        .form-group.error input {
            border-color: var(--error-color);
        }

        .form-group.error .helper-text {
            color: var(--text-error);
        }

        .form-group.success input {
            border-color: var(--success-color);
        }

        .form-group.success .helper-text {
            color: var(--text-success);
        }

        .form-group select {
            appearance: none;
            width: 100%;
            padding: var(--spacing-md);
            background-color: var(--background-card);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23ffd700' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.7rem center;
            background-size: 1.2em;
            padding-right: 2.5rem;
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius-md);
            color: var(--text-color);
            cursor: pointer;
            transition: all var(--transition-normal);
        }

        .form-group select:hover {
            border-color: var(--border-hover);
        }

        .form-group select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
            outline: none;
        }

        .form-group select option {
            background-color: var(--background-dark);
            color: var(--text-color);
            padding: var(--spacing-md);
        }

        .form-group input[type="number"] {
            -moz-appearance: textfield;
        }

        .form-group input[type="number"]::-webkit-outer-spin-button,
        .form-group input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
        }

        .flavor-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .flavor-tag {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            background: var(--accent-color);
            color: var(--text-dark);
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .filter-options {
                flex-direction: column;
                align-items: stretch;
            }

            .toggle-switch {
                justify-content: space-between;
            }

            .modal-content {
                width: 95%;
                margin: 1rem;
            }
        }
    </style>
</head>
<body>
    @include('components.navbar')

    <div class="container">
        <div class="header">
            <h1>Mi Inventario</h1>
            <p>Gestiona tus ingredientes y descubre nuevas posibilidades para crear cócteles únicos.</p>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <h3>24</h3>
                <p>Ingredientes Totales</p>
            </div>
            <div class="stat-card">
                <h3>15</h3>
                <p>Recetas Posibles</p>
            </div>
            <div class="stat-card">
                <h3>8</h3>
                <p>Categorías</p>
            </div>
        </div>

        <div class="inventory-container">
            <div class="filters-section">
                <div class="search-bar">
                    <i class='bx bx-search'></i>
                    <input type="text" placeholder="Buscar ingredientes..." id="searchInput">
                </div>

                <div class="category-tabs">
                    <div class="category-tab active" data-category="all">Todos</div>
                    <div class="category-tab" data-category="spirits">Spirits</div>
                    <div class="category-tab" data-category="liqueurs">Licores</div>
                    <div class="category-tab" data-category="juices">Jugos</div>
                    <div class="category-tab" data-category="mixers">Mixers</div>
                    <div class="category-tab" data-category="others">Otros</div>
                </div>

                <div class="filter-options">
                    <select class="filter-select" id="brandFilter">
                        <option value="">Todas las Marcas</option>
                        <option value="premium">Premium</option>
                        <option value="standard">Standard</option>
                        <option value="house">Casa</option>
                    </select>
                    <select class="filter-select" id="stockFilter">
                        <option value="">Stock</option>
                        <option value="low">Bajo Stock</option>
                        <option value="out">Sin Stock</option>
                        <option value="ok">Stock OK</option>
                    </select>
                    <div class="toggle-switch">
                        <input type="checkbox" id="alcoholicFilter">
                        <label for="alcoholicFilter">Solo Alcohólicos</label>
                    </div>
                    <button class="btn btn-outline" id="addIngredientBtn">
                        <i class='bx bx-plus'></i> Agregar Nuevo
                    </button>
                </div>
            </div>

            <div class="ingredient-list">
                <div class="ingredient-header">
                    <div class="ingredient-col">Ingrediente</div>
                    <div class="ingredient-col">Marca</div>
                    <div class="ingredient-col">Stock</div>
                    <div class="ingredient-col">Acciones</div>
                </div>
                <!-- Los ingredientes se cargarán dinámicamente aquí -->
            </div>

            <!-- Template para los items de ingredientes -->
            <template id="ingredient-template">
                <div class="ingredient-item">
                    <div class="ingredient-info">
                        <div class="ingredient-icon">
                            <i class='bx bx-drink'></i>
                        </div>
                        <div class="ingredient-details">
                            <h3 class="ingredient-name"></h3>
                            <p class="ingredient-category"></p>
                            <div class="flavor-tags"></div>
                        </div>
                    </div>
                    <div class="ingredient-brand"></div>
                    <div class="stock-control">
                        <div class="quantity-control">
                            <button class="quantity-btn decrease">-</button>
                            <div class="quantity-input-wrapper">
                                <input type="number" class="quantity-input" min="0" step="1">
                                <span class="unit"></span>
                            </div>
                            <button class="quantity-btn increase">+</button>
                        </div>
                        <div class="stock-status"></div>
                    </div>
                    <div class="ingredient-actions">
                        <button class="btn btn-icon" title="Editar">
                            <i class='bx bx-edit-alt'></i>
                        </button>
                        <button class="btn btn-icon" title="Notas">
                            <i class='bx bx-note'></i>
                        </button>
                        <button class="btn btn-icon" title="Eliminar">
                            <i class='bx bx-trash'></i>
                        </button>
                    </div>
                </div>
            </template>
        </div>

        <!-- Modal para agregar/editar ingrediente -->
        <div class="modal" id="ingredientModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Agregar Ingrediente</h2>
                    <button class="close-modal"><i class='bx bx-x'></i></button>
                </div>
                <form id="ingredientForm">
                    <div class="form-group">
                        <label for="ingredientName">Nombre</label>
                        <input type="text" id="ingredientName" required>
                    </div>
                    <div class="form-group">
                        <label for="ingredientCategory">Categoría</label>
                        <select id="ingredientCategory" required>
                            <option value="spirits">Spirits</option>
                            <option value="liqueurs">Licores</option>
                            <option value="juices">Jugos</option>
                            <option value="mixers">Mixers</option>
                            <option value="others">Otros</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ingredientBrand">Marca</label>
                        <input type="text" id="ingredientBrand">
                    </div>
                    <div class="form-group">
                        <label for="ingredientUnit">Unidad de Medida</label>
                        <select id="ingredientUnit" required>
                            <option value="unit">Unidades</option>
                            <option value="ml">Mililitros (ml)</option>
                            <option value="bottle">Botellas</option>
                            <option value="can">Latas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ingredientStock">Stock Inicial</label>
                        <input type="number" id="ingredientStock" min="0" step="1">
                    </div>
                    <div class="form-group">
                        <label for="ingredientFlavors">Sabores (separados por coma)</label>
                        <input type="text" id="ingredientFlavors" placeholder="Ej: Dulce, Cítrico, Amargo">
                    </div>
                    <div class="form-group">
                        <label for="ingredientAlcoholic">¿Contiene Alcohol?</label>
                        <input type="checkbox" id="ingredientAlcoholic">
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-outline" onclick="closeModal()">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('components.footer')

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        .loading {
            position: relative;
            overflow: hidden;
        }

        .loading::after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(255, 255, 255, 0.1), 
                transparent);
            animation: shimmer 2s infinite;
        }

        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        .tooltip {
            position: relative;
        }

        .tooltip::before {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: var(--spacing-xs) var(--spacing-sm);
            background: var(--background-dark);
            color: var(--text-color);
            font-size: 0.8rem;
            border-radius: var(--border-radius-sm);
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all var(--transition-fast);
            z-index: 1000;
        }

        .tooltip:hover::before {
            opacity: 1;
            visibility: visible;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Estado global del inventario
            let currentIngredients = [];
            let activeFilters = {
                category: 'all',
                brand: '',
                stock: '',
                alcoholic: false,
                search: ''
            };

            // Funciones de filtrado
            function filterIngredients() {
                return currentIngredients.filter(ingredient => {
                    const matchesCategory = activeFilters.category === 'all' || 
                                         ingredient.category.toLowerCase() === activeFilters.category;
                    const matchesBrand = !activeFilters.brand || 
                                       ingredient.brand.toLowerCase().includes(activeFilters.brand.toLowerCase());
                    const matchesStock = !activeFilters.stock || ingredient.status === activeFilters.stock;
                    const matchesAlcoholic = !activeFilters.alcoholic || ingredient.isAlcoholic;
                    const matchesSearch = !activeFilters.search || 
                                       ingredient.name.toLowerCase().includes(activeFilters.search.toLowerCase());

                    return matchesCategory && matchesBrand && matchesStock && matchesAlcoholic && matchesSearch;
                });
            }

            function getUnitAbbreviation(unit) {
                const units = {
                    'unit': 'unidades',
                    'ml': 'mililitros',
                    'bottle': 'botellas',
                    'can': 'latas'
                };
                return units[unit] || unit;
            }

            function updateIngredientList() {
                const filteredIngredients = filterIngredients();
                const list = document.querySelector('.ingredient-list');
                const header = list.querySelector('.ingredient-header');
                list.innerHTML = '';
                list.appendChild(header);

                filteredIngredients.forEach(ingredient => {
                    const template = document.getElementById('ingredient-template');
                    const clone = document.importNode(template.content, true);
                    
                    clone.querySelector('.ingredient-name').textContent = ingredient.name;
                    clone.querySelector('.ingredient-category').textContent = ingredient.category;
                    clone.querySelector('.ingredient-brand').textContent = ingredient.brand;
                    clone.querySelector('.quantity-input').value = ingredient.stock;
                    clone.querySelector('.unit').textContent = getUnitAbbreviation(ingredient.unit);

                    const flavorTags = clone.querySelector('.flavor-tags');
                    ingredient.flavors.forEach(flavor => {
                        const tag = document.createElement('span');
                        tag.className = 'flavor-tag';
                        tag.textContent = flavor;
                        flavorTags.appendChild(tag);
                    });

                    const stockStatus = clone.querySelector('.stock-status');
                    updateStockStatus(stockStatus, ingredient.stock);

                    // Añadir el ingrediente al DOM
                    list.appendChild(clone);
                });
            }

            function updateStockStatus(element, stock) {
                if (stock === 0) {
                    element.textContent = 'Sin stock';
                    element.className = 'stock-status out';
                } else if (stock < 200) {
                    element.textContent = 'Bajo';
                    element.className = 'stock-status low';
                } else {
                    element.textContent = 'OK';
                    element.className = 'stock-status';
                }
            }

            // Event Listeners
            document.querySelectorAll('.category-tab').forEach(tab => {
                tab.addEventListener('click', () => {
                    document.querySelectorAll('.category-tab').forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    activeFilters.category = tab.dataset.category;
                    updateIngredientList();
                });
            });

            document.getElementById('brandFilter').addEventListener('change', function() {
                activeFilters.brand = this.value;
                updateIngredientList();
            });

            document.getElementById('stockFilter').addEventListener('change', function() {
                activeFilters.stock = this.value;
                updateIngredientList();
            });

            document.getElementById('alcoholicFilter').addEventListener('change', function() {
                activeFilters.alcoholic = this.checked;
                updateIngredientList();
            });

            document.getElementById('searchInput').addEventListener('input', function() {
                activeFilters.search = this.value;
                updateIngredientList();
            });

            // Control de cantidad
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('quantity-btn')) {
                    const input = e.target.closest('.quantity-control').querySelector('.quantity-input');
                    const currentValue = parseInt(input.value) || 0;
                    const step = 1; // Ahora incrementamos de uno en uno
                    
                    if (e.target.classList.contains('increase')) {
                        input.value = currentValue + step;
                    } else if (e.target.classList.contains('decrease')) {
                        input.value = Math.max(0, currentValue - step);
                    }

                    const stockStatus = e.target.closest('.stock-control').querySelector('.stock-status');
                    updateStockStatus(stockStatus, parseInt(input.value));
                }
            });

            // Modal de ingredientes
            const modal = document.getElementById('ingredientModal');
            const addIngredientBtn = document.getElementById('addIngredientBtn');
            const closeModalBtn = modal.querySelector('.close-modal');
            
            function openModal() {
                modal.classList.add('active');
            }

            function closeModal() {
                modal.classList.remove('active');
                document.getElementById('ingredientForm').reset();
            }

            addIngredientBtn.addEventListener('click', openModal);
            closeModalBtn.addEventListener('click', closeModal);

            document.getElementById('ingredientForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const unit = document.getElementById('ingredientUnit').value;
                const newIngredient = {
                    name: document.getElementById('ingredientName').value,
                    category: document.getElementById('ingredientCategory').value,
                    brand: document.getElementById('ingredientBrand').value,
                    stock: parseInt(document.getElementById('ingredientStock').value) || 0,
                    unit: unit,
                    flavors: document.getElementById('ingredientFlavors').value.split(',').map(f => f.trim()),
                    isAlcoholic: document.getElementById('ingredientAlcoholic').checked,
                    status: 'ok'
                };

                currentIngredients.push(newIngredient);
                updateIngredientList();
                closeModal();
            });

            // Inicialización
            // Aquí normalmente cargarías los ingredientes desde el backend
            currentIngredients = [
                {
                    name: "Gin Hendrick's",
                    category: "Spirits",
                    brand: "Hendrick's",
                    stock: 2,
                    unit: 'bottle',
                    flavors: ["Pepino", "Rosa"],
                    isAlcoholic: true,
                    status: 'ok'
                },
                {
                    name: "Tónica Fever-Tree",
                    category: "Mixers",
                    brand: "Fever-Tree",
                    stock: 6,
                    unit: 'unit',
                    flavors: ["Cítrico", "Quinina"],
                    isAlcoholic: false,
                    status: 'low'
                }
            ];

            updateIngredientList();
        });
    </script>
</body>
</html>
