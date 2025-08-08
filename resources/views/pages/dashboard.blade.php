<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bar Biblioteca</title>
    <!-- Fuentes del sistema -->
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/bartender-and-cocktail">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    
    <!-- CSS e iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/resetHtml.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
       

    </style>
</head>
<body>
    @include('components.navbar')
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                
                <h1 class="logo-text">Cocktail World</h1>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('profile.edit') }}" class="nav-link">
                    <i class="fas fa-user"></i>
                    <span>Perfil</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-martini-glass-citrus"></i>
                    <span>Mis Recetas</span>
                </a>
                <a href="{{ route('travel') }}" class="nav-link">
                    <i class="fas fa-plane"></i>
                    <span>Modo Viaje</span>
                </a>
                <a href="{{ route('index') }}" class="nav-link">
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
                <h2>Bienvenido, {{ Auth::user()->name }}</h2>
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
                        <a href="{{ route('index') }}" class="card-link">Ir a Mi Bar &rarr;</a>
                    </div>
                </div>
                 <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="card-body">
                        <h3>Nueva Receta</h3>
                        <p>Experimenta y crea nuevos tragos para añadir a tu coleccion</p>
                        <a href="{{ route('create') }}" class="card-link">Crear Nueva Receta &rarr;</a>
                    </div>
                </div>
            </section>
        </main>
    </div>
    @include('components.footer2')
</body>
</html>