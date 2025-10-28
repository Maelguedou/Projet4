<x-app-layout>
    @section('title', 'Tableau de bord')

    <div class="container my-4">
        <!-- En-tête avec animation -->
        <div class="row mb-4 fade-in-up">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="display-5 fw-bold mb-0">
                            <i class="bi bi-speedometer2 text-primary"></i>
                            Tableau de bord
                        </h1>
                        <p class="text-muted mb-0">
                            Bienvenue, <strong>{{ auth()->user()->name }}</strong>
                            @if(auth()->user()->isEtudiant())
                                <span class="badge bg-primary">Étudiant</span>
                            @elseif(auth()->user()->isEnseignant())
                                <span class="badge bg-success">Enseignant</span>
                            @else
                                <span class="badge bg-danger">Administrateur</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cartes de statistiques -->
        <div class="row g-4 mb-4">
            <!-- Total Projets -->
            <div class="col-md-4">
                <div class="stat-card border-primary position-relative">
                    <i class="bi bi-folder-fill stat-icon text-primary"></i>
                    <div class="position-relative">
                        <small class="text-muted text-uppercase fw-bold">Total Projets</small>
                        <h2 class="display-4 fw-bold text-primary mb-0 counter" data-target="{{ $totalProjects }}">0</h2>
                        <p class="text-muted mb-0 mt-2">
                            <i class="bi bi-graph-up text-success"></i>
                            Tous vos projets
                        </p>
                    </div>
                </div>
            </div>

            <!-- En Cours -->
            <div class="col-md-4">
                <div class="stat-card border-info position-relative">
                    <i class="bi bi-hourglass-split stat-icon text-info"></i>
                    <div class="position-relative">
                        <small class="text-muted text-uppercase fw-bold">En Cours</small>
                        <h2 class="display-4 fw-bold text-info mb-0 counter" data-target="{{ $ongoingProjects }}">0</h2>
                        <p class="text-muted mb-0 mt-2">
                            <i class="bi bi-lightning-fill text-warning"></i>
                            Projets actifs
                        </p>
                    </div>
                </div>
            </div>

            <!-- Terminés -->
            <div class="col-md-4">
                <div class="stat-card border-success position-relative">
                    <i class="bi bi-check-circle-fill stat-icon text-success"></i>
                    <div class="position-relative">
                        <small class="text-muted text-uppercase fw-bold">Terminés</small>
                        <h2 class="display-4 fw-bold text-success mb-0 counter" data-target="{{ $completedProjects }}">0</h2>
                        <p class="text-muted mb-0 mt-2">
                            <i class="bi bi-trophy-fill text-warning"></i>
                            Projets complétés
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des projets -->
        <div class="row">
            <div class="col-12">
                <div class="glass-card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-bold mb-0">
                            <i class="bi bi-list-ul text-primary me-2"></i>
                            @if(auth()->user()->isEtudiant())
                                Mes Projets
                            @elseif(auth()->user()->isEnseignant())
                                Projets Supervisés
                            @else
                                Projets Récents
                            @endif
                        </h3>
                        <a href="{{ route('projects.index') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                            <i class="bi bi-eye me-1"></i> Voir tout
                        </a>
                    </div>

                    @if($projects->count() > 0)
                        <div class="row g-3">
                            @foreach($projects as $project)
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm h-100 hover-lift" style="transition: all 0.3s ease;">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <h5 class="card-title mb-0">
                                                    <a href="{{ route('projects.show', $project) }}" class="text-decoration-none text-dark fw-bold">
                                                        {{ $project->title }}
                                                    </a>
                                                </h5>
                                                @if($project->status === 'en_attente')
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="bi bi-clock"></i> En Attente
                                                    </span>
                                                @elseif($project->status === 'en_cours')
                                                    <span class="badge bg-info">
                                                        <i class="bi bi-hourglass-split"></i> En Cours
                                                    </span>
                                                @else
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-circle"></i> Terminé
                                                    </span>
                                                @endif
                                            </div>

                                            <p class="card-text text-muted small">
                                                {{ Str::limit($project->description, 100) }}
                                            </p>

                                            <div class="d-flex flex-wrap gap-3 mt-3 small">
                                                <div>
                                                    <i class="bi bi-person-badge text-primary"></i>
                                                    <strong>Encadrant:</strong> {{ $project->supervisor->name }}
                                                </div>
                                                <div>
                                                    <i class="bi bi-calendar-event text-success"></i>
                                                    {{ $project->start_date->format('d/m/Y') }}
                                                </div>
                                                <div>
                                                    <i class="bi bi-calendar-check text-danger"></i>
                                                    {{ $project->end_date->format('d/m/Y') }}
                                                </div>
                                            </div>

                                            @if($project->isOverdue())
                                                <div class="alert alert-danger alert-sm mt-3 mb-0 py-2">
                                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                                    <small><strong>En retard !</strong></small>
                                                </div>
                                            @endif

                                            <div class="mt-3 pt-3 border-top">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">
                                                        <i class="bi bi-people-fill"></i>
                                                        {{ $project->members->count() }} membre(s)
                                                    </small>
                                                    <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-primary rounded-pill">
                                                        Voir détails <i class="bi bi-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-inbox display-1 text-muted"></i>
                            <p class="text-muted mt-3 mb-0">Aucun projet pour le moment.</p>
                            @if(auth()->user()->isEtudiant())
                                <a href="{{ route('projects.create') }}" class="btn btn-primary mt-3 rounded-pill">
                                    <i class="bi bi-plus-circle me-2"></i> Créer votre premier projet
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
        }
    </style>
    @endpush
</x-app-layout>
