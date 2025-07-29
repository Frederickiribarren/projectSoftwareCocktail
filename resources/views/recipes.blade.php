<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorar Recetas - Bar Biblioteca</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/recipes.css') }}"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    @include('components.navbar') 

    <div class="page-container"> 
        
        
        <main class="main-content-recipes"> 
            <header class="page-header">
                <h1 class="page-title">Recetas del Mundo</h1>
                <p class="page-subtitle">Descubre las maravillas del mundo de la cockteleria.</p>
            </header>

            
            <section class="search-section">
                <div class="search-bar">
                    <input type="text" class="search-input" placeholder="Buscar cócteles...">
                    <button class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </section>

            
            <section class="cocktail-gallery">
                
                <div class="cocktail-card">
                    <img src="{{ asset('img/mojito.png') }}" alt="Mojito" class="card-image">
                    <div class="card-info">
                        <h3 class="card-title">Mojito Clásico</h3>
                        <p class="card-description">Un cóctel cubano refrescante, con ron, menta, lima y soda.</p>
                        <a href="#" class="card-link">Ver Receta &rarr;</a>
                    </div>
                </div>

                
                <div class="cocktail-card">
                    <img src="{{ asset('img/margarita.png') }}" alt="Margarita" class="card-image">
                    <div class="card-info">
                        <h3 class="card-title">Margarita Tradicional</h3>
                        <p class="card-description">El icónico cóctel mexicano con tequila, licor de naranja y jugo de lima.</p>
                        <a href="#" class="card-link">Ver Receta &rarr;</a>
                    </div>
                </div>

                
                <div class="cocktail-card">
                    <img src="{{ asset('img/michelada.png') }}" alt="michelada" class="card-image">
                    <div class="card-info">
                        <h3 class="card-title">Michelada</h3>
                        <p class="card-description">Para los amantes de lo picante, la cerveza, el limon, salsas y sal.</p>
                        <a href="#" class="card-link">Ver Receta &rarr;</a>
                    </div>
                </div>

                

            </section>
        </main>
    </div>
    
    
    @include('components.footer2') 

    
</body>
</html>