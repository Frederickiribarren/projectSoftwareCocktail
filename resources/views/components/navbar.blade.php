<style>
        .top-navbar { 
            position: fixed; 
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background-color: var(--primary-color);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            height: var(--navbar-height);
        }


        .container-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 10vh;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .logo {
            width: 50px;
            height: 50px;
            background-image: url({{ asset('img/cocktail-logo.png') }});
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            border-radius: 50%;
            border: 2px solid var(--accent-color);
        }

        .nav-links {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 25px;
            margin: 0;
            padding: 0;
        }

        .nav-links li a {
            text-decoration: none;
            color: var(--secondary-color);
            text-transform: uppercase;
            font-size: 14px;
            font-weight: 500;
            padding: 5px 0;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-links li a:hover {
            color: var(--accent-color);
        }

        .nav-links li a.cta-button {
            background-color: var(--accent-color);
            color: var(--primary-color);
            padding: 10px 20px;
            border-radius: 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .nav-links li a.cta-button:hover {
            background-color: var(--hover-color);
            color: var(--primary-color);
        }

        /* Estilos para el menú desplegable */
        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: var(--primary-color);
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 5px;
            top: 100%;
            left: 0;
            padding: 10px 0;
        }

        .dropdown-content a {
            color: var(--secondary-color) !important;
            padding: 12px 16px !important;
            text-decoration: none;
            display: block;
            text-transform: none !important;
            font-size: 13px !important;
            font-weight: 400 !important;
        }

        .dropdown-content a:hover {
            background-color: var(--accent-color);
            color: var(--primary-color) !important;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        </style>

        <nav class="top-navbar">
        <div class="container-navbar">
            <div class="logo"></div>
            <div>
                <ul class="nav-links">
                    <li><a href="{{ route('inicio') }}">Inicio</a></li>
                    <li class="dropdown">
                        <a href="">Recetas</a>
                        <div class="dropdown-content">
                            <a href="">Cócteles Clásicos</a>
                            <a href="">Cócteles Modernos</a>
                            <a href="">Sin Alcohol</a>
                            <a href="">Temporada</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="">Biblioteca</a>
                        <div class="dropdown-content">
                            <a href="">Libros de Cócteles</a>
                            <a href="">Utensilios de Bar</a>
                            <a href="">Ingredientes</a>
                        </div>
                    </li>
                    <li><a href="">Contacto</a></li>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                </ul>
            </div>
            <div>
                <ul class="nav-links">
                    <li><a href="">Iniciar Sesión</a></li>
                    <li><a href="" class="cta-button">Registrarse</a></li>
                </ul>
            </div>
        </div>
    </nav>
