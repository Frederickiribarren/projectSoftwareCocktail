<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - Cocktail World</title>
    
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/bartender-and-cocktail">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/resetHtml.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    @include('components.navbar')
    
    <div class="profile-container">
        <div class="profile-header">
            <h2>Perfil de Usuario</h2>
            <p>Gestiona tu información personal y configuración de cuenta</p>
        </div>

        <div class="profile-sections">
            <!-- Información del Perfil -->
            <div class="profile-card">
                <div class="card-header">
                    <h3>Información del Perfil</h3>
                    <p>Actualiza tu información personal y correo electrónico</p>
                </div>
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Actualizar Contraseña -->
            <div class="profile-card">
                <div class="card-header">
                    <h3>Actualizar Contraseña</h3>
                    <p>Asegura tu cuenta con una contraseña segura</p>
                </div>
                @include('profile.partials.update-password-form')
            </div>

            <!-- Eliminar Cuenta -->
            <div class="profile-card danger-zone">
                <div class="card-header">
                    <h3>Eliminar Cuenta</h3>
                    <p>Elimina permanentemente tu cuenta y todos tus datos</p>
                </div>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>

    @include('components.footer2')
</body>
</html>
