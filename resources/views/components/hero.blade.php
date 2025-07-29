<style>
    #hero {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 90vh; 
        }

        #hero .wrapper {
            display: grid;
            grid-auto-flow: column;
            grid-auto-columns: 100vw; /* Cada slide ocupa todo el ancho */
            animation: slideShow 30s infinite; /* 10s por cada imagen */
        }

        #hero .slide {
            width: 100vw;
            height: 90vh;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            display: flex;
            align-items: center;
            justify-content: start;
            position: relative;
            padding-top: 15vh; 
            padding-left: 50px;
        }

        .slide-content {
            display: flex;
            flex-direction: column;
            max-width: 60%;
            padding-top: 150px;
        }

        #hero .slide-1 {
            background-image: url({{ asset('img/HERO1.png') }});
        }

        #hero .slide-2 {
            background-image: url({{ asset('img/HERO.png') }});
        }

        #hero .slide-3 {
            background-image: url({{ asset('img/HERO3.png') }});
        }

        #hero .slide h1 {
            color: var(--accent-color);
            font-size: 3rem;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.7);
            text-align: left;
            margin: 0 0 20px 0;
            padding: 20px;
            max-width: 90%;
            background: rgba(0, 0, 0, 0.2); /* Fondo semitransparente para mejor legibilidad */
            border-radius: 10px;
        }

        #hero .slide p {
            color: var(--secondary-color);
            font-size: 1.2rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            text-align: left; /* Mantener alineación izquierda */
            margin: 0;
            padding: 20px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            line-height: 1.6;
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
            <div class="slide-content">
                <h1>Descubre el Arte de la Coctelería</h1>
                <p>La coctelería es mucho más que mezclar bebidas: es una forma de expresión creativa que combina técnica, sabor, estética y personalidad. Cada cóctel cuenta una historia, equilibrando ingredientes con precisión para lograr experiencias sensoriales únicas.</p>
            </div>
        </div>
        <div class="slide slide-2">
            <div class="slide-content">
                <h1>Recetas Clásicas y Modernas</h1>
                <p>Las recetas clásicas de coctelería son el alma de los bares: elegantes, equilibradas y con carácter. Piezas como el Martini, Daiquiri o Manhattan han resistido el paso del tiempo gracias a su simplicidad y perfección. Cada uno es una obra maestra donde cada ingrediente tiene su papel protagónico.<br>
                Las recetas modernas, en cambio, rompen moldes. Bartenders actuales experimentan con técnicas como infusiones, clarificados, fermentaciones y espumas para crear cócteles visualmente impactantes y sabores sorprendentes. Aquí hay espacio para la ciencia, la narrativa personal y la reinterpretación de lo tradicional.
                </p>
            </div>
        </div>
        <div class="slide slide-3">
            <div class="slide-content">
                <h1>Tu Biblioteca Personal de Cócteles</h1>
                <p>Imagina tener una colección personalizada de recetas que combine clásicos refinados con creaciones modernas, adaptadas a tus gustos, ingredientes favoritos y hasta el clima o la ocasión. Esta biblioteca no solo guarda fórmulas, sino que evoluciona contigo: desde tu primer mojito hasta tu versión única del Espresso Martini.</p>
            </div>
        </div>
    </div>
</header>