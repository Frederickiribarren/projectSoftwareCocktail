<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bar Biblioteca</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    @include('components.navbar')
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                
                <h1 class="logo-text">Cocktail World</h1>
            </div>
            <nav class="sidebar-nav">
                <a href="#" class="nav-link active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-martini-glass-citrus"></i>
                    <span>Mis Recetas</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-wine-bottle"></i>
                    <span>Mi Bar</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Configuración</span>
                </a>
            </nav>
            <div class="sidebar-footer">
                <a href="#" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </div>
        </aside>
        <main class="main-content">
            <header class="main-header">
                <h2>Bienvenido, [Nombre de Usuario]</h2>
                <p>Explora y administra tus creaciones.</p>
            </header>
            <section class="dashboard-cards">
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-martini-glass-citrus"></i>
                    </div>
                    <div class="card-body">
                        <h3>Mis Recetas</h3>
                        <p>Gestiona tu colección de cócteles favoritos y creados.</p>
                        <a href="#" class="card-link">Ir a Mis Recetas &rarr;</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-wine-bottle"></i>
                    </div>
                    <div class="card-body">
                        <h3>Mi Bar</h3>
                        <p>Administra los ingredientes disponibles para ti.</p>
                        <a href="#" class="card-link">Ir a Mi Bar &rarr;</a>
                    </div>
                </div>
                 <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="card-body">
                        <h3>Nueva Receta</h3>
                        <p>Experimenta y crea nuevos tragos para añadir a tu coleccion</p>
                        <a href="#" class="card-link">Crear Nueva Receta &rarr;</a>
                    </div>
                </div>
            </section>
        </main>
    </div>
    
</body>
</html>