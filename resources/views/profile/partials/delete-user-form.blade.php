<section>
    <header class="mb-4">
        <h4 class="fw-bold mb-2 text-danger">
            <i class="bi bi-trash text-danger"></i>
            Supprimer le Compte
        </h4>
        <p class="text-muted small">
            Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées.
            Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.
        </p>
    </header>

    <button type="button" class="btn btn-danger-custom btn-custom" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        <i class="bi bi-trash me-2"></i> Supprimer le Compte
    </button>

    <!-- Modal de confirmation -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmUserDeletionModalLabel">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Confirmer la Suppression
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-body">
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <strong>Attention !</strong> Cette action est irréversible.
                        </div>

                        <p class="mb-3">
                            Êtes-vous sûr de vouloir supprimer votre compte ?
                            Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées.
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">
                                <i class="bi bi-lock text-danger"></i>
                                Entrez votre mot de passe pour confirmer
                            </label>
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                   placeholder="Mot de passe" required>
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-2"></i> Annuler
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-2"></i> Supprimer Définitivement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@if($errors->userDeletion->isNotEmpty())
    @push('scripts')
    <script>
        // Ouvrir automatiquement le modal si erreur de validation
        document.addEventListener('DOMContentLoaded', function() {
            var modal = new bootstrap.Modal(document.getElementById('confirmUserDeletionModal'));
            modal.show();
        });
    </script>
    @endpush
@endif
