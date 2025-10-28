<section>
    <header class="mb-4">
        <h4 class="fw-bold mb-2">
            <i class="bi bi-person-badge text-primary"></i>
            Informations du Profil
        </h4>
        <p class="text-muted small">
            Mettez à jour les informations de votre compte et votre adresse email.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <!-- Nom -->
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">
                <i class="bi bi-person text-primary"></i> Nom complet
            </label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                   class="form-control form-control-custom @error('name') is-invalid @enderror"
                   required autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label fw-bold">
                <i class="bi bi-envelope text-primary"></i> Email
            </label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                   class="form-control form-control-custom @error('email') is-invalid @enderror"
                   required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-2 py-2">
                    <small>
                        <i class="bi bi-exclamation-triangle"></i>
                        Votre adresse email n'est pas vérifiée.
                        <button form="send-verification" class="btn btn-link btn-sm p-0 text-decoration-underline">
                            Cliquez ici pour renvoyer l'email de vérification.
                        </button>
                    </small>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <div class="alert alert-success mt-2 py-2">
                        <small>
                            <i class="bi bi-check-circle"></i>
                            Un nouveau lien de vérification a été envoyé à votre adresse email.
                        </small>
                    </div>
                @endif
            @endif
        </div>

        <!-- Rôle (lecture seule) -->
        <div class="mb-3">
            <label class="form-label fw-bold">
                <i class="bi bi-shield-check text-primary"></i> Rôle
            </label>
            <div>
                @if($user->role === 'admin')
                    <span class="badge bg-danger badge-custom">
                        <i class="bi bi-shield-fill-check"></i> Administrateur
                    </span>
                @elseif($user->role === 'enseignant')
                    <span class="badge bg-info badge-custom">
                        <i class="bi bi-person-badge"></i> Enseignant
                    </span>
                @else
                    <span class="badge bg-primary badge-custom">
                        <i class="bi bi-mortarboard"></i> Étudiant
                    </span>
                @endif
            </div>
        </div>

        <!-- Bouton de sauvegarde -->
        <div class="d-flex align-items-center gap-3 pt-3 border-top">
            <button type="submit" class="btn btn-primary-custom btn-custom">
                <i class="bi bi-check-circle me-2"></i> Enregistrer
            </button>

            @if (session('status') === 'profile-updated')
                <div class="alert alert-success py-2 px-3 mb-0 fade-in">
                    <small>
                        <i class="bi bi-check-circle"></i> Profil mis à jour avec succès !
                    </small>
                </div>
            @endif
        </div>
    </form>
</section>
