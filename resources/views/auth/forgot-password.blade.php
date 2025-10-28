<x-guest-layout>
    <!-- Titre -->
    <div class="text-center mb-4">
        <h4 class="fw-bold mb-1">Mot de Passe Oublié ?</h4>
        <p class="text-muted small">Pas de problème ! Nous vous enverrons un lien de réinitialisation.</p>
    </div>

    <!-- Message d'information -->
    <div class="alert alert-info py-2 mb-3">
        <small>
            <i class="bi bi-info-circle"></i>
            Entrez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.
        </small>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label fw-bold">
                <i class="bi bi-envelope text-primary"></i> Email
            </label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                   class="form-control form-control-custom @error('email') is-invalid @enderror"
                   placeholder="votre.email@campus.com" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Bouton -->
        <button type="submit" class="btn btn-primary-custom btn-custom w-100 mb-3">
            <i class="bi bi-envelope-check me-2"></i> Envoyer le Lien de Réinitialisation
        </button>

        <!-- Retour à la connexion -->
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-decoration-none small">
                <i class="bi bi-arrow-left"></i> Retour à la connexion
            </a>
        </div>
    </form>
</x-guest-layout>
