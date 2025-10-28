<x-guest-layout>
    <!-- Titre -->
    <div class="text-center mb-4">
        <h4 class="fw-bold mb-1">Connexion</h4>
        <p class="text-muted small">Connectez-vous à votre compte</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
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

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label fw-bold">
                <i class="bi bi-lock text-primary"></i> Mot de passe
            </label>
            <input type="password" name="password" id="password"
                   class="form-control form-control-custom @error('password') is-invalid @enderror"
                   placeholder="••••••••" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
            <label class="form-check-label small" for="remember_me">
                Se souvenir de moi
            </label>
        </div>

        <!-- Bouton de connexion -->
        <button type="submit" class="btn btn-primary-custom btn-custom w-100 mb-3">
            <i class="bi bi-box-arrow-in-right me-2"></i> Se Connecter
        </button>

        <!-- Liens -->
        <div class="text-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none small">
                    <i class="bi bi-question-circle"></i> Mot de passe oublié ?
                </a>
            @endif
        </div>

        @if (Route::has('register'))
            <hr class="my-3">
            <div class="text-center">
                <p class="text-muted small mb-2">Vous n'avez pas de compte ?</p>
                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-custom w-100">
                    <i class="bi bi-person-plus me-2"></i> Créer un compte
                </a>
            </div>
        @endif
    </form>

    <!-- Comptes de test -->
    <div class="mt-4 p-3" style="background: rgba(255, 255, 255, 0.5); border-radius: 10px;">
        <p class="small fw-bold mb-2 text-center">
            <i class="bi bi-info-circle text-primary"></i> Comptes de test
        </p>
        <div class="small">
            <div class="mb-1">
                <strong>Étudiant:</strong> alice.bernard@campus.com
            </div>
            <div class="mb-1">
                <strong>Enseignant:</strong> marie.dupont@campus.com
            </div>
            <div class="mb-1">
                <strong>Admin:</strong> admin@campus.com
            </div>
            <div class="text-muted">
                <strong>Mot de passe:</strong> password
            </div>
        </div>
    </div>
</x-guest-layout>
