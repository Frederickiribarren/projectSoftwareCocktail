<section class="space-y-6">
    <header>

    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="profile-form">
            @csrf
            @method('delete')

            <div class="delete-account-warning">
                <p>Una vez que tu cuenta sea eliminada, todos los recursos y datos serán eliminados permanentemente. Por favor, descarga cualquier información que desees conservar.</p>
            </div>

            <div class="input-group">
                <label for="password">Confirma tu contraseña para eliminar la cuenta</label>
                <div class="input-box">
                    <input type="password" id="password" name="password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <x-input-error :messages="$errors->userDeletion->get('password')" class="error-message" />
            </div>

            <div class="form-actions">
                <button type="submit" class="danger-button">Eliminar Cuenta</button>
            </div>
        </form>
    </x-modal>
</section>

<style>
    .profile-form {
        max-width: 100%;
    }

    .delete-account-warning {
        color: var(--text-secondary);
        margin-bottom: 2rem;
        padding: 1rem;
        border-left: 4px solid #ff4646;
        background-color: rgba(255, 70, 70, 0.1);
    }

    .danger-button {
        background-color: #ff4646;
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .danger-button:hover {
        background-color: #ff3333;
    }
</style>
