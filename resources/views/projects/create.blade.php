<x-app-layout>
    @section('title', 'Créer un Nouveau Projet')

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- En-tête -->
                <div class="mb-4">
                    <h1 class="display-6 fw-bold">
                        <i class="bi bi-plus-circle text-primary"></i>
                        Créer un Nouveau Projet
                    </h1>
                    <p class="text-muted">Remplissez le formulaire ci-dessous pour créer un nouveau projet</p>
                </div>

                <!-- Formulaire -->
                <div class="glass-card p-4">
                    <form method="POST" action="{{ route('projects.store') }}">
                        @csrf

                        <!-- Titre -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">
                                <i class="bi bi-pencil text-primary"></i> Titre du Projet *
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" 
                                   class="form-control form-control-custom @error('title') is-invalid @enderror" 
                                   placeholder="Ex: Système de Gestion de Bibliothèque" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">
                                <i class="bi bi-file-text text-primary"></i> Description *
                            </label>
                            <textarea name="description" id="description" rows="5" 
                                      class="form-control form-control-custom @error('description') is-invalid @enderror" 
                                      placeholder="Décrivez votre projet en détail..." required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Minimum 50 caractères</small>
                        </div>

                        <!-- Dates -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label fw-bold">
                                    <i class="bi bi-calendar-event text-success"></i> Date de Début *
                                </label>
                                <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" 
                                       class="form-control form-control-custom @error('start_date') is-invalid @enderror" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label fw-bold">
                                    <i class="bi bi-calendar-check text-danger"></i> Date de Fin *
                                </label>
                                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" 
                                       class="form-control form-control-custom @error('end_date') is-invalid @enderror" required>
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Encadrant -->
                        <div class="mb-4">
                            <label for="supervisor_id" class="form-label fw-bold">
                                <i class="bi bi-person-badge text-info"></i> Encadrant *
                            </label>
                            <select name="supervisor_id" id="supervisor_id" 
                                    class="form-select form-control-custom @error('supervisor_id') is-invalid @enderror" required>
                                <option value="">-- Sélectionnez un encadrant --</option>
                                @foreach($enseignants as $enseignant)
                                    <option value="{{ $enseignant->id }}" {{ old('supervisor_id') == $enseignant->id ? 'selected' : '' }}>
                                        {{ $enseignant->name }} ({{ $enseignant->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('supervisor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Membres -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="bi bi-people-fill text-success"></i> Membres du Projet *
                            </label>
                            <div class="card border-primary">
                                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                                    @foreach($etudiants as $etudiant)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="members[]" 
                                                   value="{{ $etudiant->id }}" id="member_{{ $etudiant->id }}"
                                                   {{ in_array($etudiant->id, old('members', [])) ? 'checked' : '' }}
                                                   {{ $etudiant->id === auth()->id() ? 'checked disabled' : '' }}>
                                            <label class="form-check-label" for="member_{{ $etudiant->id }}">
                                                <strong>{{ $etudiant->name }}</strong>
                                                <small class="text-muted">({{ $etudiant->email }})</small>
                                                @if($etudiant->id === auth()->id())
                                                    <span class="badge bg-primary ms-2">Vous (Chef de projet)</span>
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                    <!-- Hidden input pour s'assurer que l'utilisateur actuel est toujours inclus -->
                                    <input type="hidden" name="members[]" value="{{ auth()->id() }}">
                                </div>
                            </div>
                            @error('members')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Vous êtes automatiquement ajouté comme chef de projet</small>
                        </div>

                        <!-- Statut -->
                        <div class="mb-4">
                            <label for="status" class="form-label fw-bold">
                                <i class="bi bi-flag text-warning"></i> Statut Initial
                            </label>
                            <select name="status" id="status" class="form-select form-control-custom">
                                <option value="en_attente" {{ old('status') === 'en_attente' ? 'selected' : '' }}>En Attente</option>
                                <option value="en_cours" {{ old('status', 'en_cours') === 'en_cours' ? 'selected' : '' }}>En Cours</option>
                            </select>
                        </div>

                        <!-- Boutons -->
                        <div class="d-flex gap-2 pt-3 border-top">
                            <button type="submit" class="btn btn-primary-custom btn-custom">
                                <i class="bi bi-check-circle me-2"></i> Créer le Projet
                            </button>
                            <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary btn-custom">
                                <i class="bi bi-x-circle me-2"></i> Annuler
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Aide -->
                <div class="alert alert-info mt-4">
                    <h6 class="alert-heading">
                        <i class="bi bi-info-circle"></i> Conseils
                    </h6>
                    <ul class="mb-0 small">
                        <li>Choisissez un titre clair et descriptif pour votre projet</li>
                        <li>La description doit contenir au moins 50 caractères</li>
                        <li>Assurez-vous que la date de fin est postérieure à la date de début</li>
                        <li>Vous serez automatiquement désigné comme chef de projet</li>
                        <li>Vous pouvez ajouter d'autres étudiants comme membres</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Validation des dates
        document.getElementById('start_date').addEventListener('change', function() {
            const startDate = this.value;
            const endDateInput = document.getElementById('end_date');
            endDateInput.min = startDate;
            
            if (endDateInput.value && endDateInput.value < startDate) {
                endDateInput.value = '';
            }
        });

        // Compteur de caractères pour la description
        const descriptionTextarea = document.getElementById('description');
        const charCountDiv = document.createElement('div');
        charCountDiv.className = 'small text-muted mt-1';
        descriptionTextarea.parentNode.appendChild(charCountDiv);

        function updateCharCount() {
            const count = descriptionTextarea.value.length;
            charCountDiv.textContent = `${count} caractères (minimum 50)`;
            charCountDiv.className = count >= 50 ? 'small text-success mt-1' : 'small text-danger mt-1';
        }

        descriptionTextarea.addEventListener('input', updateCharCount);
        updateCharCount();
    </script>
    @endpush
</x-app-layout>

