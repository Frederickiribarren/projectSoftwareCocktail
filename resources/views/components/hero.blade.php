<style>
    #hero {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 90vh; /* Para ocultar las imágenes que salen del contenedor */
        }

        #hero .wrapper {
            display: grid;
            grid-auto-flow: column;
            grid-auto-columns: 100vw; /* Cada slide ocupa todo el ancho */
            animation: slideShow 15s infinite; /* 5s por cada imagen */
        }

        #hero .slide {
            width: 100vw;
            height: 90vh;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            position: relative;
            padding-top: 15vh; /* Ajusta este valor según necesites */
        }

        #hero .slide-1 {
            background-image: url({{ asset('img/HERO1.png') }});
        }

        #hero .slide-2 {
            background-image: url({{ asset('img/HERO.png') }});
        }

        #hero .slide-3 {
            background-image: url({{ asset('img/HERO2.png') }});
        }

        #hero .slide h1 {
            color: var(--accent-color);
            font-size: 3rem;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.7);
            text-align: center;
            margin: 0;
            padding: 20px;
            max-width: 90%;
            background: rgba(0, 0, 0, 0.3); /* Fondo semitransparente para mejor legibilidad */
            border-radius: 10px;
        }

        @keyframes slideShow {
            0%, 30% { transform: translateX(0); }
            33%, 63% { transform: translateX(-100vw); }
            66%, 96% { transform: translateX(-200vw); }
            100% { transform: translateX(0); }
        }
</style>

<header id="hero">
    <div class="wrapper">
        <div class="slide slide-1">
            <h1>Descubre el Arte de la Coctelería</h1>
        </div>
        <div class="slide slide-2">
            <h1>Recetas Clásicas y Modernas</h1>
        </div>
        <div class="slide slide-3">
            <h1>Tu Biblioteca Personal de Cócteles</h1>
        </div>
    </div>
</header>