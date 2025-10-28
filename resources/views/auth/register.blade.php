<x-guest-layout>
    <!-- Titre -->
    <div class="text-center mb-4">
        <h4 class="fw-bold mb-1">Inscription</h4>
        <p class="text-muted small">Créez votre compte CampusConnect</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">
                <i class="bi bi-person text-primary"></i> Nom complet
            </label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   class="form-control form-control-custom @error('name') is-invalid @enderror"
                   placeholder="Jean Dupont" required autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label fw-bold">
                <i class="bi bi-envelope text-primary"></i> Email
            </label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                   class="form-control form-control-custom @error('email') is-invalid @enderror"
                   placeholder="jean.dupont@campus.com" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Role -->
        <div class="mb-3">
            <label for="role" class="form-label fw-bold">
                <i class="bi bi-shield-check text-primary"></i> Rôle
            </label>
            <select name="role" id="role" class="form-select form-control-custom @error('role') is-invalid @enderror" required>
                <option value="">-- Sélectionnez votre rôle --</option>
                <option value="etudiant" {{ old('role') === 'etudiant' ? 'selected' : '' }}>Étudiant</option>
                <option value="enseignant" {{ old('role') === 'enseignant' ? 'selected' : '' }}>Enseignant</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="text-muted">
                <i class="bi bi-info-circle"></i> Choisissez votre statut
            </small>
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
            <small class="text-muted">Minimum 8 caractères</small>
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-bold">
                <i class="bi bi-lock-fill text-primary"></i> Confirmer le mot de passe
            </label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="form-control form-control-custom @error('password_confirmation') is-invalid @enderror"
                   placeholder="••••••••" required>
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Bouton d'inscription -->
        <button type="submit" class="btn btn-success-custom btn-custom w-100 mb-3">
            <i class="bi bi-person-plus me-2"></i> S'inscrire
        </button>

        <!-- Lien vers login -->
        <hr class="my-3">
        <div class="text-center">
            <p class="text-muted small mb-2">Vous avez déjà un compte ?</p>
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-custom w-100">
                <i class="bi bi-box-arrow-in-right me-2"></i> Se Connecter
            </a>
        </div>
    </form>
</x-guest-layout>
