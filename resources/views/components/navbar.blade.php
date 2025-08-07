<nav class="top-navbar">
    <div class="container-navbar">
        <div class="brand-container">
            <div class="logo" style="background-image: url({{ asset('img/logo3.png') }});"></div>
            <p class="brand-title">COCKTAIL WORLD</p>
        </div>
        <div>
            <ul class="nav-links">
                <li><a href="{{ route('inicio') }}" class="nav-link-main">Inicio</a></li>
                <li class="dropdown">
                    <a href="{{ route('recipes') }}" class="nav-link-main">Recetas</a>
                    <div class="dropdown-content">
                        <a href="" class="dropdown-link">Cócteles Clásicos</a>
                        <a href="" class="dropdown-link">Cócteles Modernos</a>
                        <a href="" class="dropdown-link">Sin Alcohol</a>
                        <a href="" class="dropdown-link">Temporada</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="" class="nav-link-main">Biblioteca</a>
                    <div class="dropdown-content">
                        <a href="" class="dropdown-link">Libros de Cócteles</a>
                        <a href="" class="dropdown-link">Utensilios de Bar</a>
                        <a href="" class="dropdown-link">Ingredientes</a>
                    </div>
                </li>
                <li><a href="" class="nav-link-main">Contacto</a></li>
                <li><a href="{{ route('dashboard') }}" class="nav-link-main">Dashboard</a></li>
            </ul>
        </div>
        <div>
            <ul class="nav-links">
                <li><a href="{{ route('login') }}" class="nav-link-main">Iniciar Sesión</a></li>
                <li><a href="" class="cta-button">Registrarse</a></li>
            </ul>
        </div>
    </div>
</nav>
