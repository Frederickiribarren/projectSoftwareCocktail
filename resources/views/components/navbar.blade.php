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
                <li><a href="{{ route('recipes.explore') }}" class="nav-link-main">Explorar Recetas</a></li>
                <li><a href="" class="nav-link-main">Técnicas e utensilios</a></li>
                <li><a href="{{ route('acerca-de') }}" class="nav-link-main">Acerca de</a></li>
                @auth
                <li><a href="{{ route('dashboard') }}" class="nav-link-main">Dashboard</a></li>
                <li><a href="{{ route('recipes.index') }}" class="nav-link-main">Mis Recetas</a></li>
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
