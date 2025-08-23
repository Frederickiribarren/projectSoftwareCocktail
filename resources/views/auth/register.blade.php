@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <main class="main-content">
        <div class="register-container">
            <div class="register-header">
                <h2>Únete a Cocktail World</h2>
                <p class="register-subtitle">Crea tu cuenta y comienza tu viaje en la coctelería</p>
            </div>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="input-group">
                    <label for="name">Nombre</label>
                    <div class="input-box">
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                        <i class='bx bxs-user'></i>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="error-message" />
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <div class="input-box">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        <i class='bx bxs-envelope'></i>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="error-message" />
                </div>

                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <div class="input-box">
                        <input type="password" id="password" name="password" required>
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="error-message" />
                </div>

                <div class="input-group">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <div class="input-box">
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                </div>
                
                <button type="submit" class="register-btn">Crear Cuenta</button>
            </form>
            
            <div class="login-section">
                <p>¿Ya tienes una cuenta?</p>
                <a href="{{ route('login') }}" class="login-link">Inicia sesión aquí</a>
            </div>
        </div>
    </main>
@endsection 
