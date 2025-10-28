<section>
    <header class="mb-4">
        <h4 class="fw-bold mb-2">
            <i class="bi bi-lock text-warning"></i>
            Mettre à Jour le Mot de Passe
        </h4>
        <p class="text-muted small">
            Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <!-- Mot de passe actuel -->
        <div class="mb-3">
            <label for="update_password_current_password" class="form-label fw-bold">
                <i class="bi bi-key text-primary"></i> Mot de passe actuel
            </label>
            <input type="password" name="current_password" id="update_password_current_password"
                   class="form-control form-control-custom @error('current_password', 'updatePassword') is-invalid @enderror"
                   autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nouveau mot de passe -->
        <div class="mb-3">
            <label for="update_password_password" class="form-label fw-bold">
                <i class="bi bi-lock text-primary"></i> Nouveau mot de passe
            </label>
            <input type="password" name="password" id="update_password_password"
                   class="form-control form-control-custom @error('password', 'updatePassword') is-invalid @enderror"
                   autocomplete="new-password">
            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="text-muted">Minimum 8 caractères</small>
        </div>

        <!-- Confirmer le mot de passe -->
        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label fw-bold">
                <i class="bi bi-lock-fill text-primary"></i> Confirmer le mot de passe
            </label>
            <input type="password" name="password_confirmation" id="update_password_password_confirmation"
                   class="form-control form-control-custom @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                   autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Bouton de sauvegarde -->
        <div class="d-flex align-items-center gap-3 pt-3 border-top">
            <button type="submit" class="btn btn-warning btn-custom">
                <i class="bi bi-check-circle me-2"></i> Mettre à Jour
            </button>

            @if (session('status') === 'password-updated')
                <div class="alert alert-success py-2 px-3 mb-0 fade-in">
                    <small>
                        <i class="bi bi-check-circle"></i> Mot de passe mis à jour avec succès !
                    </small>
                </div>
            @endif
        </div>
    </form>
</section>
