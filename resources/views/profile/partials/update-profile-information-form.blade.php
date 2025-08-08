<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="profile-form">
        @csrf
        @method('patch')

        <div class="input-group">
            <label class='bx bxs-user' for="name"> Nombre</label>
            <div class="input-box">
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
               
            </div>
            <x-input-error :messages="$errors->get('name')" class="error-message" />
        </div>

        <div class="input-group">
            
            <label class='bx bxs-envelope' for="email"> Email</label>
            <div class="input-box">
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                
            </div>
            <x-input-error :messages="$errors->get('email')" class="error-message" />
        </div>

        <div class="form-actions">
            <button type="submit" class="action-button">Guardar Cambios</button>

            @if (session('status') === 'profile-updated')
                <p class="success-message">Guardado correctamente</p>
            @endif
        </div>
    </form>
</section>
