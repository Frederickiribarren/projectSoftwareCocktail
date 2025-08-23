@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <div class="dashboard-container">
        <main class="main-content">
            <header class="main-header">
                <div class="header-content">
                    <div class="user-info">
                        <h2>Bienvenido, {{ Auth::user()->name }}</h2>
                        <p>
                            @if(Auth::user()->isAdmin())
                                <span class="role-badge admin">Administrador</span>
                                Gestiona todo el sistema y usuarios.
                            @elseif(Auth::user()->isProfessional())
                                <span class="role-badge professional">Bartender Profesional</span>
                                Herramientas avanzadas para profesionales.
                            @else
                                <span class="role-badge hobbyist">Entusiasta</span>
                                Explora y crea tus cócteles favoritos.
                            @endif
                        </p>
                    </div>
                </div>
            </header>

            <section class="dashboard-cards">
                {{-- Tarjetas básicas para todos los roles --}}
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="card-body">
                        <h3>Nueva Receta</h3>
                        <p>Experimenta y crea nuevos tragos para añadir a tu colección</p>
                        <a href="{{ route('create') }}" class="card-link">Crear Nueva Receta &rarr;</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-sticky-note"></i>
                    </div>
                    <div class="card-body">
                        <h3>Mis Notas</h3>
                        <p>Guarda tus ideas y recetas en un solo lugar.</p>
                        <a href="{{ route('user_recipe_notes.index') }}" class="card-link">Ver Mis Notas &rarr;</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-wine-bottle"></i>
                    </div>
                    <div class="card-body">
                        <h3>Mi Bar</h3>
                        <p>Administra los ingredientes disponibles para ti.</p>
                        <a href="{{ route('inventory') }}" class="card-link">Ir a Mi Bar &rarr;</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-plane"></i>
                    </div>
                    <div class="card-body">
                        <h3>Modo Viaje</h3>
                        <p>Optimiza tus recetas según los ingredientes disponibles en tu destino.</p>
                        <a href="{{ route('travel') }}" class="card-link">Ir a Modo Viaje &rarr;</a>
                    </div>
                </div>

                {{-- Tarjetas específicas para Professional y Admin --}}
                @if(Auth::user()->isProfessional() || Auth::user()->isAdmin())
                    <div class="card professional-card">
                        <div class="card-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="card-body">
                            <h3>Análisis Profesional</h3>
                            <p>Estadísticas avanzadas y métricas de tus recetas.</p>
                            <a href="#" class="card-link">Ver Análisis &rarr;</a>
                        </div>
                    </div>

                    <div class="card professional-card">
                        <div class="card-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-body">
                            <h3>Recetas Públicas</h3>
                            <p>Explora y comparte recetas con la comunidad.</p>
                            <a href="#" class="card-link">Ver Recetas Públicas &rarr;</a>
                        </div>
                    </div>
                @endif

                {{-- Tarjetas específicas para Hobbyist y superiores --}}
                @unless(Auth::user()->isAdmin())
                    <div class="card">
                        <div class="card-icon">
                            <i class="fas fa-martini-glass-citrus"></i>
                        </div>
                        <div class="card-body">
                            <h3>Mis Recetas</h3>
                            <p>Gestiona tu colección de cócteles favoritos y creados.</p>
                            <a href="#" class="card-link">Ir a Mis Recetas &rarr;</a>
                        </div>
                    </div>
                @endunless

                {{-- Tarjetas solo para Admin --}}
                @if(Auth::user()->isAdmin())
                    <div class="card admin-card">
                        <div class="card-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <div class="card-body">
                            <h3>Base de Datos</h3>
                            <p>Gestiona y organiza todas las recetas del sistema.</p>
                            <a href="{{ route('database.admin') }}" class="card-link">Administrar BD &rarr;</a>
                        </div>
                    </div>

                    <div class="card admin-card">
                        <div class="card-icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div class="card-body">
                            <h3>Gestión de Usuarios</h3>
                            <p>Administra usuarios y sus permisos en el sistema.</p>
                            <a href="#" class="card-link">Gestionar Usuarios &rarr;</a>
                        </div>
                    </div>

                    <div class="card admin-card">
                        <div class="card-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="card-body">
                            <h3>Configuración del Sistema</h3>
                            <p>Configuraciones avanzadas y parámetros del sistema.</p>
                            <a href="#" class="card-link">Configurar Sistema &rarr;</a>
                        </div>
                    </div>

                    <div class="card admin-card">
                        <div class="card-icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div class="card-body">
                            <h3>Reportes y Estadísticas</h3>
                            <p>Análisis completo del uso del sistema y tendencias.</p>
                            <a href="#" class="card-link">Ver Reportes &rarr;</a>
                        </div>
                    </div>
                @endif

                {{-- Tarjeta de configuración personal para todos --}}
                <div class="card">
                    <div class="card-icon">
                        <i class="fas fa-user-cog"></i>
                    </div>
                    <div class="card-body">
                        <h3>Mi Perfil</h3>
                        <p>Personaliza tu experiencia y preferencias.</p>
                        <a href="{{ route('profile.edit') }}" class="card-link">Editar Perfil &rarr;</a>
                    </div>
                </div>
            </section>
        </main>
    </div>
@endsection