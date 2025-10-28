<x-app-layout>
    @section('title', 'Gestion des Projets')

    <div class="container my-4">
        <!-- En-tête -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="display-5 fw-bold mb-0">
                            <i class="bi bi-folder-fill text-primary"></i>
                            Gestion des Projets
                        </h1>
                        <p class="text-muted mb-0">Tous les projets de la plateforme</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres et recherche -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="glass-card p-4">
                    <form method="GET" action="{{ route('projects.index') }}" class="row g-3">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" name="search" value="{{ request('search') }}"
                                       class="form-control form-control-custom"
                                       placeholder="Rechercher un projet...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select form-control-custom">
                                <option value="">Tous les statuts</option>
                                <option value="en_attente" {{ request('status') === 'en_attente' ? 'selected' : '' }}>
                                    En Attente
                                </option>
                                <option value="en_cours" {{ request('status') === 'en_cours' ? 'selected' : '' }}>
                                    En Cours
                                </option>
                                <option value="termine" {{ request('status') === 'termine' ? 'selected' : '' }}>
                                    Terminé
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-custom me-2">
                                <i class="bi bi-funnel-fill me-1"></i> Filtrer
                            </button>
                            <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary btn-custom">
                                <i class="bi bi-arrow-clockwise me-1"></i> Réinitialiser
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Liste des projets -->
        <div class="row">
            <div class="col-12">
                @if($projects->count() > 0)
                    <div class="row g-4">
                        @foreach($projects as $project)
                            <div class="col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm h-100 glass-card">
                                    <div class="card-body d-flex flex-column">
                                        <!-- En-tête de la carte -->
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div class="flex-grow-1">
                                                <h5 class="card-title fw-bold mb-1">
                                                    <a href="{{ route('projects.show', $project) }}"
                                                       class="text-decoration-none text-dark stretched-link">
                                                        {{ $project->title }}
                                                    </a>
                                                </h5>
                                                @if($project->status === 'en_attente')
                                                    <span class="badge bg-warning badge-custom">
                                                        <i class="bi bi-clock"></i> En Attente
                                                    </span>
                                                @elseif($project->status === 'en_cours')
                                                    <span class="badge bg-info badge-custom">
                                                        <i class="bi bi-hourglass-split"></i> En Cours
                                                    </span>
                                                @else
                                                    <span class="badge bg-success badge-custom">
                                                        <i class="bi bi-check-circle"></i> Terminé
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <p class="card-text text-muted small mb-3">
                                            {{ Str::limit($project->description, 120) }}
                                        </p>

                                        <!-- Informations -->
                                        <div class="mb-3 small">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="bi bi-person-badge text-primary me-2"></i>
                                                <span><strong>Encadrant:</strong> {{ $project->supervisor->name }}</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="bi bi-people-fill text-success me-2"></i>
                                                <span><strong>Membres:</strong> {{ $project->members->count() }}</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-calendar-range text-info me-2"></i>
                                                <span>{{ $project->start_date->format('d/m/Y') }} - {{ $project->end_date->format('d/m/Y') }}</span>
                                            </div>
                                        </div>

                                        <!-- Alerte retard -->
                                        @if($project->isOverdue())
                                            <div class="alert alert-danger alert-sm py-2 mb-3">
                                                <i class="bi bi-exclamation-triangle-fill"></i>
                                                <small><strong>En retard !</strong></small>
                                            </div>
                                        @endif

                                        <!-- Bouton d'action -->
                                        <div class="mt-auto pt-3 border-top">
                                            <a href="{{ route('projects.show', $project) }}"
                                               class="btn btn-outline-primary btn-sm w-100 position-relative">
                                                Voir les détails <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $projects->links() }}
                    </div>
                @else
                    <div class="glass-card p-5 text-center">
                        <i class="bi bi-inbox display-1 text-muted"></i>
                        <p class="text-muted mt-3 mb-0">Aucun projet trouvé.</p>
                        @if(auth()->user()->isEtudiant())
                            <a href="{{ route('projects.create') }}" class="btn btn-primary mt-3 rounded-pill">
                                <i class="bi bi-plus-circle me-2"></i> Créer un projet
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

