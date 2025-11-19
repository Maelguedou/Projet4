<x-app-layout>
    @section('title', 'Déposer un Livrable')

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- En-tête -->
                <div class="mb-4">
                    <h1 class="display-6 fw-bold">
                        <i class="bi bi-cloud-upload text-success"></i>
                        Déposer un Livrable
                    </h1>
                    <p class="text-muted">
                        <i class="bi bi-folder"></i> Projet: <strong>{{ $project->title }}</strong>
                    </p>
                </div>

                <!-- Formulaire -->
                <div class="glass-card p-4">
                    <form method="POST" action="{{ route('deliverables.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}">

                        <!-- Titre -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">
                                <i class="bi bi-pencil text-primary"></i> Titre du Livrable *
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                   class="form-control form-control-custom @error('title') is-invalid @enderror"
                                   placeholder="Ex: Rapport Final, Prototype V1, etc." required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">
                                <i class="bi bi-file-text text-primary"></i> Description
                            </label>
                            <textarea name="description" id="description" rows="3"
                                      class="form-control form-control-custom @error('description') is-invalid @enderror"
                                      placeholder="Décrivez brièvement ce livrable...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Version -->
                        <div class="mb-4">
                            <label for="version" class="form-label fw-bold">
                                <i class="bi bi-tag text-warning"></i> Version *
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-hash"></i>
                                </span>
                                <input type="text" name="version" id="version" value="{{ old('version', '1.0') }}"
                                       class="form-control form-control-custom @error('version') is-invalid @enderror"
                                       placeholder="Ex: 1.0, 2.1, V1, Version Finale" required>
                                @error('version')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">
                                <i class="bi bi-info-circle"></i>
                                Exemples: V1, V2, 1.0, 2.1, Version Finale, etc.
                            </small>
                        </div>

                        <!-- Fichier -->
                        <div class="mb-4">
                            <label for="file" class="form-label fw-bold">
                                <i class="bi bi-file-earmark-arrow-up text-success"></i> Fichier *
                            </label>
                            <input type="file" name="file" id="file"
                                   class="form-control form-control-custom @error('file') is-invalid @enderror"
                                   accept=".pdf,.doc,.docx,.zip,.rar" required>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="alert alert-info mt-2 py-2">
                                <small>
                                    <i class="bi bi-info-circle"></i>
                                    <strong>Formats acceptés:</strong> PDF, DOC, DOCX, ZIP, RAR<br>
                                    <strong>Taille maximale:</strong> 10 Mo
                                </small>
                            </div>
                        </div>

                        <!-- Aperçu du fichier sélectionné -->
                        <div id="file-preview" class="mb-4 d-none">
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle"></i>
                                <strong>Fichier sélectionné:</strong> <span id="file-name"></span>
                                (<span id="file-size"></span>)
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="d-flex gap-2 pt-3 border-top">
                            <button type="submit" class="btn btn-success-custom btn-custom">
                                <i class="bi bi-cloud-upload me-2"></i> Déposer le Livrable
                            </button>
                            <a href="{{ route('projects.show', $project) }}" class="btn btn-outline-secondary btn-custom">
                                <i class="bi bi-x-circle me-2"></i> Annuler
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Aide -->
                <div class="alert alert-warning mt-4">
                    <h6 class="alert-heading">
                        <i class="bi bi-exclamation-triangle"></i> Important
                    </h6>
                    <ul class="mb-0 small">
                        <li>Assurez-vous que votre fichier est complet et finalisé</li>
                        <li>Le fichier sera visible par tous les membres du projet et l'encadrant</li>
                        <li>Vous pouvez déposer plusieurs versions (V1, V2, Version Finale, etc.)</li>
                        <li>L'encadrant pourra valider ou refuser votre livrable</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Aperçu du fichier sélectionné
        document.getElementById('file').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('file-preview');
            const fileName = document.getElementById('file-name');
            const fileSize = document.getElementById('file-size');

            if (file) {
                fileName.textContent = file.name;
                const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
                fileSize.textContent = sizeMB + ' Mo';
                preview.classList.remove('d-none');

                // Vérifier la taille
                if (file.size > 10 * 1024 * 1024) {
                    alert('Le fichier est trop volumineux ! Taille maximale: 10 Mo');
                    e.target.value = '';
                    preview.classList.add('d-none');
                }
            } else {
                preview.classList.add('d-none');
            }
        });
    </script>
    @endpush
</x-app-layout>

