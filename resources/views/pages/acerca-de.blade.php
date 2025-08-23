@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/acercade.css') }}">
    <div class="container">
        <h1 class="title-acerca-de">Acerca de Cocktail World</h1>

        <div class="content-acerca-de">
            <div class="img-acerca-de"></div>
                <div class="content-acerca-de-text">
                    <p class="text-acerca-de">Bienvenido a Cocktail World, un proyecto dedicado a la creación y difusión de recetas de cócteles. Nuestro objetivo es proporcionar a los amantes de la mixología las herramientas y conocimientos necesarios para explorar el fascinante mundo de las bebidas.</p>
                    <br>
                    <p class="text-acerca-de">Se creó como parte de un proyecto de instituto para dar vida a la cultura del cóctel. Creemos en la importancia de la educación y la creatividad en la mixología, y estamos comprometidos a ofrecer un espacio donde todos puedan aprender y experimentar.</p>
                    <br>
                    <p class="text-acerca-de">Únete a nosotros en este viaje a través del mundo de los cócteles y descubre tu próximo trago favorito.</p>
                </div>
            </div>
            <div class="content-title-fundadores">
                <h3 class="title-fundadores">
                    Fundadores
                </h3>
            </div>
                <div class="content-fundadores">
                    <div class="card-fundador">
                        <div class="img-fundador img-frederick"></div>
                        <div class="info-fundador">
                            <h4 class="nombre-fundador">Frederick Iribarren</h4>
                            <p class="rol-fundador">Desarrollador & Programador</p>
                            <p class="desc-fundador">Estudiante de programación. Co-fundador y encargado del desarrollo de Cocktail World. </p>
                        </div>
                    </div>
                    <div class="card-fundador">
                        <div class="img-fundador"></div>
                        <div class="info-fundador">
                            <h4 class="nombre-fundador">Alejandro Gambin</h4>
                            <p class="rol-fundador">Desarrollador & Programador</p>
                            <p class="desc-fundador">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus ad vero, aut temporibus architecto error dolore, sed ex laboriosam tempore voluptatum qui necessitatibus voluptatem repellat consequuntur iste assumenda facilis! Reprehenderit!</p>
                        </div>
                    </div>
                    <div class="card-fundador">
                        <div class="img-fundador"></div>
                        <div class="info-fundador">
                            <h4 class="nombre-fundador">Franco Zuñiga</h4>
                            <p class="rol-fundador">Desarrollador & Programador</p>
                            <p class="desc-fundador">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officiis vel at ipsa velit obcaecati vitae suscipit eum porro illo! Quae laborum explicabo modi labore qui repudiandae architecto facilis sapiente praesentium.</p>
                        </div>
                    </div>
                    <div class="card-fundador">
                        <div class="img-fundador"></div>
                        <div class="info-fundador">
                            <h4 class="nombre-fundador">Raul Cabellos</h4>
                            <p class="rol-fundador">Desarrollador & Programador</p>
                            <p class="desc-fundador">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis ea, hic culpa possimus est nam. Expedita consequatur esse, eligendi voluptates totam alias dolores sint non voluptate, ex animi tempore quisquam?</p>
                        </div>
                    </div>
                    <div class="card-fundador">
                        <div class="img-fundador"></div>
                        <div class="info-fundador">
                            <h4 class="nombre-fundador">Arturo Chacon</h4>
                            <p class="rol-fundador">Desarrollador & Programador</p>
                            <p class="desc-fundador">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil dolorem sequi distinctio, placeat facilis possimus quam! Impedit dicta eum dolor autem? Fugit omnis praesentium, fugiat eligendi impedit neque quam esse?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection