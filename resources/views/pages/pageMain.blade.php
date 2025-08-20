
@extends('layouts.app')

@section('title', 'Cocktail World')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mision.css') }}">
    <link rel="stylesheet" href="{{ asset('css/typesPreparation.css') }}">
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

   <section class="mision">
    <div class="mision-container">
        <div class="mision-image-container">
            <div class="mision-image"></div>
        </div>
        <div class="mision-content">
            <h3 class="mision-title">Más que Cócteles, Creamos Conexiones</h3>
            <p class="mision-description">En Cocktail World, vemos la coctelería como algo más que una simple mezcla de bebidas; es un arte, una forma de expresión y una excusa perfecta para conectar. Nuestra misión es construir el puente entre la curiosidad del principiante y la maestría del experto, ofreciendo un espacio donde la pasión por los sabores es el idioma universal. Aquí no solo encontrarás un recetario, sino las historias detrás de cada trago, las técnicas para perfeccionar tu arte y la inspiración para experimentar. Pero esta comunidad no está completa sin ti.</p>
        </div>
    </div>
   </section>

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
@endsection
