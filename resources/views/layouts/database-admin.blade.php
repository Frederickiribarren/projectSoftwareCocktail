<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Base de Datos - The Alchemist's Folio</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-header h1 {
            color: var(--accent-color);
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-family: 'Playfair Display', serif;
        }

        .page-header p {
            color: var(--text-muted);
            font-size: 1.1rem;
        }

        .database-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 1rem;
        }

        .table-card {
            background: var(--background-card);
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .table-card:hover {
            transform: translateY(-5px);
            border-color: var(--border-hover);
            box-shadow: var(--shadow-md);
        }

        .table-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--accent-color);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .table-card:hover::before {
            transform: scaleX(1);
        }

        .table-icon {
            font-size: 2rem;
            color: var(--accent-color);
            margin-bottom: 1rem;
        }

        .table-name {
            font-size: 1.25rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .table-description {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .table-stats {
            display: flex;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
            font-size: 0.9rem;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stat-item i {
            color: var(--accent-color);
        }

        .table-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
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

        .btn-outline {
            background: transparent;
            color: var(--accent-color);
            border: 1px solid var(--accent-color);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        @media (max-width: 768px) {
            .database-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @include('components.navbar')

    <div class="container">
        <div class="page-header">
            <h1>Administración de Base de Datos</h1>
            <p>Gestiona y monitorea las tablas del sistema</p>
        </div>

        <div class="database-grid">
            @foreach($tables as $tableName => $tableInfo)
            <div class="table-card">
                <div class="table-icon">
                    <i class="fas {{ $tableInfo['icon'] }}"></i>
                </div>
                <h3 class="table-name">{{ $tableInfo['name'] }}</h3>
                <p class="table-description">{{ $tableInfo['description'] }}</p>
                <div class="table-stats">
                    <div class="stat-item">
                        <i class="fas fa-database"></i>
                        <span>Registros: {{ $tableInfo['count'] }}</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-clock"></i>
                        <span>Última actualización: {{ $tableInfo['last_updated'] }}</span>
                    </div>
                </div>
                <div class="table-actions">
                    <a href="{{ route('table.view', $tableName) }}" class="btn btn-primary">
                        <i class="fas fa-eye"></i>
                        Ver Registros
                    </a>
                </div>
            </div>
            @endforeach

            <!-- Tabla Recipes -->
            <div class="table-card">
                <div class="table-icon">
                    <i class="fas fa-cocktail"></i>
                </div>
                <h3 class="table-name">Recipes</h3>
                <p class="table-description">Colección de recetas de cócteles y bebidas.</p>
                <div class="table-stats">
                    <div class="stat-item">
                        <i class="fas fa-database"></i>
                        <span>Registros: 0</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-clock"></i>
                        <span>Última actualización: Hoy</span>
                    </div>
                </div>
                <div class="table-actions">
                    <button class="btn btn-primary">
                        <i class="fas fa-eye"></i>
                        Ver Registros
                    </button>
                </div>
            </div>

            <!-- Tabla Ingredients -->
            <div class="table-card">
                <div class="table-icon">
                    <i class="fas fa-wine-bottle"></i>
                </div>
                <h3 class="table-name">Ingredients</h3>
                <p class="table-description">Catálogo de ingredientes disponibles para las recetas.</p>
                <div class="table-stats">
                    <div class="stat-item">
                        <i class="fas fa-database"></i>
                        <span>Registros: 0</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-clock"></i>
                        <span>Última actualización: Hoy</span>
                    </div>
                </div>
                <div class="table-actions">
                    <button class="btn btn-primary">
                        <i class="fas fa-eye"></i>
                        Ver Registros
                    </button>
                </div>
            </div>

            <!-- Tabla Recipe_Ingredients -->
            <div class="table-card">
                <div class="table-icon">
                    <i class="fas fa-mortar-pestle"></i>
                </div>
                <h3 class="table-name">Recipe_Ingredients</h3>
                <p class="table-description">Relación entre recetas e ingredientes con sus medidas.</p>
                <div class="table-stats">
                    <div class="stat-item">
                        <i class="fas fa-database"></i>
                        <span>Registros: 0</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-clock"></i>
                        <span>Última actualización: Hoy</span>
                    </div>
                </div>
                <div class="table-actions">
                    <button class="btn btn-primary">
                        <i class="fas fa-eye"></i>
                        Ver Registros
                    </button>
                </div>
            </div>

            <!-- Tabla User_Favorites -->
            <div class="table-card">
                <div class="table-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3 class="table-name">User_Favorites</h3>
                <p class="table-description">Recetas favoritas guardadas por los usuarios.</p>
                <div class="table-stats">
                    <div class="stat-item">
                        <i class="fas fa-database"></i>
                        <span>Registros: 0</span>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-clock"></i>
                        <span>Última actualización: Hoy</span>
                    </div>
                </div>
                <div class="table-actions">
                    <button class="btn btn-primary">
                        <i class="fas fa-eye"></i>
                        Ver Registros
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer2')
</body>
</html>
