<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<nav class="top-navbar">
    <div class="container-navbar">
        <div class="brand-container">
            <div class="logo" style="background-image: url({{ asset('img/logo3.png') }});"></div>
            <p class="brand-title">COCKTAIL WORLD</p>
        </div>
        <!-- Menú de navegación -->
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
                        <a href="{{ route('user_recipe_notes.index') }}" class="dropdown-link">Mis Notas de Recetas</a>
                        <a href="{{ route('inventories.index') }}" class="dropdown-link">Libros de Cócteles</a>
                        <a href="" class="dropdown-link">Utensilios de Bar</a>
                        <a href="" class="dropdown-link">Ingredientes</a>
                    </div>
                </li>
                <li><a href="" class="nav-link-main">Contacto</a></li>
                @auth
                <li><a href="{{ route('dashboard') }}" class="nav-link-main">Dashboard</a></li>
                @endauth
            </ul>
        </div>
        <div>
            <!--Revisar el css para la responsividad del navbar, cuando cambia por autentificación -->
            <div>
            <ul class="nav-links">
                @auth
                    <li>
                        <div class="dropdown">
                            <i class='bx bxs-user'></i>
                            <a href="#" class="nav-link-main">{{ Auth::user()->name }}</a>
                            <div class="dropdown-content">
                                <a href="{{ route('dashboard') }}" class="dropdown-link">Dashboard</a>
                                <a href="{{ route('profile.edit') }}" class="dropdown-link">Perfil</a>
                                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                    @csrf
                                    <a href="{{ route('logout') }}" class="dropdown-link"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        Cerrar Sesión
                                    </a>
                                </form>
                            </div>
                        </div>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="nav-link-main">Iniciar Sesión</a></li>
                    <li><a href="{{ route('register') }}" class="cta-button">Registrarse</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
