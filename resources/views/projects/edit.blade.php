<x-app-layout>
    @section('title', 'Modifier le Projet')

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- En-tête -->
                <div class="mb-4">
                    <h1 class="display-6 fw-bold">
                        <i class="bi bi-pencil-square text-warning"></i>
                        Modifier le Projet
                    </h1>
                    <p class="text-muted">{{ $project->title }}</p>
                </div>

                <!-- Formulaire -->
                <div class="glass-card p-4">
                    <form method="POST" action="{{ route('projects.update', $project) }}">
                        @csrf
                        @method('PUT')

                        <!-- Titre -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-bold">
                                <i class="bi bi-pencil text-primary"></i> Titre du Projet *
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" 
                                   class="form-control form-control-custom @error('title') is-invalid @enderror" required>
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
                                      class="form-control form-control-custom @error('description') is-invalid @enderror" required>{{ old('description', $project->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Dates -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label fw-bold">
                                    <i class="bi bi-calendar-event text-success"></i> Date de Début *
                                </label>
                                <input type="date" name="start_date" id="start_date" 
                                       value="{{ old('start_date', $project->start_date->format('Y-m-d')) }}" 
                                       class="form-control form-control-custom @error('start_date') is-invalid @enderror" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label fw-bold">
                                    <i class="bi bi-calendar-check text-danger"></i> Date de Fin *
                                </label>
                                <input type="date" name="end_date" id="end_date" 
                                       value="{{ old('end_date', $project->end_date->format('Y-m-d')) }}" 
                                       class="form-control form-control-custom @error('end_date') is-invalid @enderror" required>
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Statut -->
                        <div class="mb-4">
                            <label for="status" class="form-label fw-bold">
                                <i class="bi bi-flag text-warning"></i> Statut
                            </label>
                            <select name="status" id="status" class="form-select form-control-custom">
                                <option value="en_attente" {{ old('status', $project->status) === 'en_attente' ? 'selected' : '' }}>
                                    En Attente
                                </option>
                                <option value="en_cours" {{ old('status', $project->status) === 'en_cours' ? 'selected' : '' }}>
                                    En Cours
                                </option>
                                <option value="termine" {{ old('status', $project->status) === 'termine' ? 'selected' : '' }}>
                                    Terminé
                                </option>
                            </select>
                        </div>

                        <!-- Boutons -->
                        <div class="d-flex gap-2 pt-3 border-top">
                            <button type="submit" class="btn btn-warning btn-custom">
                                <i class="bi bi-check-circle me-2"></i> Mettre à Jour
                            </button>
                            <a href="{{ route('projects.show', $project) }}" class="btn btn-outline-secondary btn-custom">
                                <i class="bi bi-x-circle me-2"></i> Annuler
                            </a>
                            @if(auth()->user()->isAdmin() || (auth()->user()->isEtudiant() && $project->hasMember(auth()->user())))
                                <form method="POST" action="{{ route('projects.destroy', $project) }}" class="ms-auto">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger-custom btn-custom delete-confirm">
                                        <i class="bi bi-trash me-2"></i> Supprimer
                                    </button>
                                </form>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

