<x-guest-layout>
    <!-- Titre -->
    <div class="text-center mb-4">
        <h4 class="fw-bold mb-1">Réinitialiser le Mot de Passe</h4>
        <p class="text-muted small">Créez un nouveau mot de passe sécurisé</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label fw-bold">
                <i class="bi bi-envelope text-primary"></i> Email
            </label>
            <input type="email" name="email" id="email" value="{{ old('email', $request->email) }}"
                   class="form-control form-control-custom @error('email') is-invalid @enderror"
                   required autofocus readonly>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label fw-bold">
                <i class="bi bi-lock text-primary"></i> Nouveau mot de passe
            </label>
            <input type="password" name="password" id="password"
                   class="form-control form-control-custom @error('password') is-invalid @enderror"
                   placeholder="••••••••" required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="text-muted">Minimum 8 caractères</small>
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-bold">
                <i class="bi bi-lock-fill text-primary"></i> Confirmer le mot de passe
            </label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="form-control form-control-custom @error('password_confirmation') is-invalid @enderror"
                   placeholder="••••••••" required autocomplete="new-password">
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Bouton -->
        <button type="submit" class="btn btn-primary-custom btn-custom w-100 mb-3">
            <i class="bi bi-check-circle me-2"></i> Réinitialiser le Mot de Passe
        </button>

        <!-- Retour à la connexion -->
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-decoration-none small">
                <i class="bi bi-arrow-left"></i> Retour à la connexion
            </a>
        </div>
    </form>
</x-guest-layout>
