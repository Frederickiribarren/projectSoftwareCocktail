<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mi Perfil - The Alchemist's Folio</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap');
        
        :root {
            --primary-color: #1a1a1a;
            --secondary-color: #ffffff;
            --accent-color: #ffd700;
            --accent-dark: #cc9900;
            --hover-color: #f0c400;
            --text-color: #e0e0e0;
            --text-dark: #333333;
            --text-muted: #9e9e9e;
            --background-dark: #1a1a1a;
            --background-card: #2a2a2a;
            --background-hover: #333333;
            --border-color: rgba(255, 255, 255, 0.1);
            --border-hover: rgba(255, 215, 0, 0.3);
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--background-dark);
            color: var(--text-color);
            font-family: 'Montserrat', sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .profile-header h1 {
            color: var(--accent-color);
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-family: 'Playfair Display', serif;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 2rem;
        }

        .profile-sidebar {
            background: var(--background-card);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
        }

        .avatar-container {
            position: relative;
            width: 200px;
            height: 200px;
            margin: 0 auto 1.5rem;
        }

        .avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--accent-color);
        }

        .avatar-upload {
            position: absolute;
            bottom: 0;
            right: 0;
            background: var(--accent-color);
            color: var(--text-dark);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .avatar-upload:hover {
            background: var(--hover-color);
            transform: scale(1.1);
        }

        .profile-status {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: var(--accent-color);
            color: var(--text-dark);
            border-radius: 20px;
            font-weight: 600;
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-item {
            text-align: center;
            padding: 1rem;
            background: var(--background-dark);
            border-radius: 8px;
        }

        .stat-value {
            font-size: 1.5rem;
            color: var(--accent-color);
            font-weight: 700;
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .profile-content {
            background: var(--background-card);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: var(--shadow-md);
        }

        .profile-section {
            margin-bottom: 2rem;
        }

        .profile-section:last-child {
            margin-bottom: 0;
        }

        .section-title {
            color: var(--accent-color);
            font-size: 1.25rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            background: var(--background-dark);
            border: 2px solid var(--border-color);
            border-radius: 6px;
            color: var(--text-color);
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--accent-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .preferences-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .preference-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            background: var(--background-dark);
            border-radius: 8px;
        }

        .toggle-switch {
            position: relative;
            width: 50px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: var(--background-card);
            transition: .4s;
            border-radius: 34px;
            border: 2px solid var(--border-color);
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 2px;
            bottom: 2px;
            background-color: var(--text-muted);
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: var(--accent-color);
            border-color: var(--accent-dark);
        }

        input:checked + .toggle-slider:before {
            transform: translateX(26px);
            background-color: var(--text-dark);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: var(--accent-color);
            color: var(--text-dark);
        }

        .btn-primary:hover {
            background: var(--hover-color);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
        }

        .btn-outline:hover {
            background: rgba(255, 215, 0, 0.1);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }

            .avatar-container {
                width: 150px;
                height: 150px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    @include('components.navbar')

    <div class="container">
        <div class="profile-header">
            <h1>Mi Perfil</h1>
        </div>

        <div class="profile-grid">
            <aside class="profile-sidebar">
                <div class="avatar-container">
                    <img src="{{ asset('img/default-avatar.png') }}" 
                         alt="Avatar de Usuario" 
                         class="avatar">
                    <div class="avatar-upload" title="Cambiar foto de perfil">
                        <i class='bx bx-camera'></i>
                        <input type="file" id="avatar-input" hidden accept="image/*">
                    </div>
                </div>

                <div class="profile-status">
                    <span class="status-badge">Usuario</span>
                </div>

                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-value">0</div>
                        <div class="stat-label">Recetas</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">0</div>
                        <div class="stat-label">Favoritos</div>
                    </div>
                </div>
            </aside>

            <main class="profile-content">
                <form action="#" method="POST" id="profile-form">
                    <div class="profile-section">
                        <h2 class="section-title">Información Personal</h2>
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" value="Usuario de Ejemplo" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="usuario@ejemplo.com" required>
                        </div>
                        <div class="form-group">
                            <label for="bio">Biografía</label>
                            <textarea id="bio" name="bio">Esta es una biografía de ejemplo.</textarea>
                        </div>
                    </div>

                    <div class="profile-section">
                        <h2 class="section-title">Cambiar Contraseña</h2>
                        <div class="form-group">
                            <label for="current_password">Contraseña Actual</label>
                            <input type="password" id="current_password" name="current_password">
                        </div>
                        <div class="form-group">
                            <label for="new_password">Nueva Contraseña</label>
                            <input type="password" id="new_password" name="new_password">
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">Confirmar Nueva Contraseña</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation">
                        </div>
                    </div>

                    <div class="profile-section">
                        <h2 class="section-title">Preferencias</h2>
                        <div class="preferences-grid">
                            <div class="preference-item">
                                <span>Notificaciones por Email</span>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="preferences[email_notifications]">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            <div class="preference-item">
                                <span>Perfil Público</span>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="preferences[public_profile]">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-outline" onclick="window.history.back()">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </main>
        </div>
    </div>

    @include('components.footer')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manejo de la subida de avatar
        const avatarInput = document.getElementById('avatar-input');
        const avatarImg = document.querySelector('.avatar');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        document.querySelector('.avatar-upload').addEventListener('click', () => {
            avatarInput.click();
        });

        avatarInput.addEventListener('change', async function(e) {
            if (this.files && this.files[0]) {
                const formData = new FormData();
                formData.append('avatar', this.files[0]);
                formData.append('_token', csrfToken);

                try {
                    const response = await fetch('www.urltest.com', {
                        method: 'POST',
                        body: formData
                    });

                    if (response.ok) {
                        const data = await response.json();
                        avatarImg.src = data.path;
                        showNotification('Avatar actualizado exitosamente', 'success');
                    } else {
                        throw new Error('Error al actualizar el avatar');
                    }
                } catch (error) {
                    showNotification(error.message, 'error');
                }
            }
        });

        // Validación del formulario
        const profileForm = document.getElementById('profile-form');
        profileForm.addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('new_password_confirmation').value;

            if (newPassword && newPassword !== confirmPassword) {
                e.preventDefault();
                showNotification('Las contraseñas no coinciden', 'error');
            }
        });

        // Función para mostrar notificaciones
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    });
    </script>

    <style>
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 2rem;
            border-radius: 6px;
            color: var(--text-dark);
            font-weight: 500;
            z-index: 1000;
            animation: slideIn 0.3s ease;
        }

        .notification.success {
            background-color: var(--accent-color);
        }

        .notification.error {
            background-color: #ff4444;
            color: white;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @if($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    @foreach($errors->all() as $error)
                        showNotification('{{ $error }}', 'error');
                    @endforeach
                });
            </script>
        @endif

        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    showNotification('{{ session("success") }}', 'success');
                });
            </script>
        @endif
    </style>
</body>
</html>