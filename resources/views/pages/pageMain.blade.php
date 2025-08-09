<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocktail World</title>
    <!-- Fuentes del sistema -->
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/bartender-and-cocktail">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    
    <!-- CSS e iconos -->
    <link rel="stylesheet" href="{{ asset('css/resetHtml.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('css/typesPreparation.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>   
   @include('components.navbar')
   <header id="hero">
    <div class="wrapper">
        <div class="slide slide-1">
            <div class="slide-content">
                <h1 class="hero-title">Descubre el Arte de la Coctelería</h1>
                <p class="hero-description hide-mobile">La coctelería es mucho más que mezclar bebidas: es una forma de expresión creativa que combina técnica, sabor, estética y personalidad. Cada cóctel cuenta una historia, equilibrando ingredientes con precisión para lograr experiencias sensoriales únicas.</p>
            </div>
        </div>
        <div class="slide slide-2">
            <div class="slide-content">
                <h1 class="hero-title">Recetas Clásicas y Modernas</h1>
                <p class="hero-description hide-mobile">Las recetas clásicas de coctelería son el alma de los bares: elegantes, equilibradas y con carácter. <br>
                Las recetas modernas, en cambio, rompen moldes. Bartenders actuales experimentan con técnicas como infusiones, clarificados, fermentaciones y espumas para crear cócteles visualmente impactantes y sabores sorprendentes.
            </div>
        </div>
        <div class="slide slide-3">
            <div class="slide-content">
                <h1 class="hero-title">Tu Biblioteca Personal de Cócteles</h1>
                <p class="hero-description hide-mobile">Imagina tener una colección personalizada de recetas que combine clásicos refinados con creaciones modernas, adaptadas a tus gustos, ingredientes favoritos y hasta el clima o la ocasión. Esta biblioteca no solo guarda fórmulas, sino que evoluciona contigo: desde tu primer mojito hasta tu versión única del Espresso Martini.</p>
            </div>
        </div>
    </div>
</header>
   @include('components.separador')

   <section class="types-preparation">
       <div class="type-img">
        <div class="type-title">
            <h3 class="type-title-preparation">Técnicas de Preparación</h3>
        </div>
        <div class="type-list">
            <ol class="type-list-items">
                <li class="type-list-item">Directo</li>
                <li class="type-list-item">Refrescado</li>
                <li class="type-list-item">Batidos</li>
                <li class="type-list-item">Licuados</li>
                <li class="type-list-item">Doble Colado</li>
            </ol>
        </div>
        </div>
   </section>


   @include('components.footer')
</body>
</html>