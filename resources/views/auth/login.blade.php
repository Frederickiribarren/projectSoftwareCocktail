@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--background-dark) 100%);
            background-image: url({{ asset('img/login-img.png') }});
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(26, 26, 26, 0.7);
            z-index: -1;
        }
    </style>
    <main class="main-content">
        <div class="login-container">
            <div class="login-header">
                <h2>Bienvenido</h2>
                <p class="login-subtitle">Accede a tu cuenta de Cocktail World</p>
            </div>
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="input-group">
                    <label for="email">Email</label>
                    <div class="input-box">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="tu@email.com" required autofocus>
                        <i class='bx bxs-envelope'></i>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <div class="input-box">
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                
                <div class="form-options">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Recordarme</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">¿Olvidaste tu contraseña?</a>
                    @endif
                </div>
                
                <button type="submit" class="login-btn">Iniciar Sesión</button>
            </form>
            
            <div class="register-section">
                <p class="register-p">¿No tienes una cuenta?</p>
                <a href="{{ route('register') }}" class="register-link">Regístrate aquí</a>
            </div>
        </div>
    </main>
@endsection        