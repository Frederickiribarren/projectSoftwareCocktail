<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="profile-form">
        @csrf
        @method('put')

        <div class="input-group">
            <label for="current_password">Contraseña Actual</label>
            <div class="input-box">
                <input type="password" id="current_password" name="current_password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="error-message" />
        </div>

        <div class="input-group">
            <label for="password">Nueva Contraseña</label>
            <div class="input-box">
                <input type="password" id="password" name="password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="error-message" />
        </div>

        <div class="input-group">
            <label for="password_confirmation">Confirmar Nueva Contraseña</label>
            <div class="input-box">
                <input type="password" id="password_confirmation" name="password_confirmation" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="error-message" />
        </div>

        <div class="form-actions">
            <button type="submit" class="action-button">Actualizar Contraseña</button>

            @if (session('status') === 'password-updated')
                <p class="success-message">Contraseña actualizada correctamente</p>
            @endif
        </div>
    </form>
</section>
