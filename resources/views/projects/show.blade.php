<x-app-layout>
    @section('title', $project->title)

    <div class="container my-4">
        <!-- En-tête du projet -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="glass-card p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h1 class="display-6 fw-bold mb-2">
                                <i class="bi bi-folder-open text-primary"></i>
                                {{ $project->title }}
                            </h1>
                            <div class="d-flex flex-wrap gap-3 text-muted small">
                                <span>
                                    <i class="bi bi-person-badge text-primary"></i>
                                    <strong>Encadrant:</strong> {{ $project->supervisor->name }}
                                </span>
                                <span>
                                    <i class="bi bi-calendar-event text-success"></i>
                                    <strong>Début:</strong> {{ $project->start_date->format('d/m/Y') }}
                                </span>
                                <span>
                                    <i class="bi bi-calendar-check text-danger"></i>
                                    <strong>Fin:</strong> {{ $project->end_date->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-end gap-2">
                            @if($project->status === 'en_attente')
                                <span class="badge bg-warning text-dark badge-custom">
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
                            
                            @if($project->isOverdue())
                                <span class="badge bg-danger badge-custom">
                                    <i class="bi bi-exclamation-triangle"></i> En retard
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="mt-3 pt-3 border-top">
                        <div class="d-flex gap-2">
                            @if(auth()->user()->isEtudiant() && $project->hasMember(auth()->user()))
                                <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning btn-custom">
                                    <i class="bi bi-pencil-square"></i> Modifier
                                </a>
                                <a href="{{ route('deliverables.create', $project) }}" class="btn btn-success-custom btn-custom">
                                    <i class="bi bi-cloud-upload"></i> Déposer un Livrable
                                </a>
                            @endif
                            @if(auth()->user()->isEnseignant() && $project->isSupervisor(auth()->user()))
                                <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning btn-custom">
                                    <i class="bi bi-pencil-square"></i> Modifier
                                </a>
                            @endif
                            <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary btn-custom ms-auto">
                                <i class="bi bi-arrow-left"></i> Retour
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Colonne principale -->
            <div class="col-lg-8">
                <!-- Description -->
                <div class="glass-card p-4 mb-4">
                    <h4 class="fw-bold mb-3">
                        <i class="bi bi-file-text text-primary"></i> Description
                    </h4>
                    <p class="text-muted">{{ $project->description }}</p>
                </div>

                <!-- Livrables -->
                <div class="glass-card p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold mb-0">
                            <i class="bi bi-file-earmark-arrow-up text-success"></i> Livrables
                            <span class="badge bg-primary">{{ $project->deliverables->count() }}</span>
                        </h4>
                    </div>

                    @if($project->deliverables->count() > 0)
                        <div class="list-group">
                            @foreach($project->deliverables as $deliverable)
                                <div class="list-group-item border-0 mb-2 shadow-sm rounded">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="fw-bold mb-1">
                                                {{ $deliverable->title }}
                                                <span class="badge bg-secondary ms-2">{{ $deliverable->version }}</span>
                                            </h6>
                                            <p class="text-muted small mb-2">{{ $deliverable->description }}</p>
                                            <div class="small text-muted">
                                                <i class="bi bi-person"></i> {{ $deliverable->user->name }} •
                                                <i class="bi bi-calendar"></i> {{ $deliverable->created_at->format('d/m/Y H:i') }}
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column align-items-end gap-2">
                                            @if($deliverable->status === 'en_attente')
                                                <span class="badge bg-warning text-dark">En Attente</span>
                                            @elseif($deliverable->status === 'valide')
                                                <span class="badge bg-success">Validé</span>
                                            @else
                                                <span class="badge bg-danger">Refusé</span>
                                            @endif
                                            
                                            <a href="{{ route('deliverables.download', $deliverable) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-download"></i> Télécharger
                                            </a>
                                        </div>
                                    </div>

                                    @if($deliverable->feedback)
                                        <div class="alert alert-info mt-2 mb-0 py-2">
                                            <small><strong>Feedback:</strong> {{ $deliverable->feedback }}</small>
                                        </div>
                                    @endif

                                    @if(auth()->user()->isEnseignant() && $project->isSupervisor(auth()->user()))
                                        <div class="mt-2 pt-2 border-top">
                                            <form method="POST" action="{{ route('deliverables.updateStatus', $deliverable) }}" class="row g-2">
                                                @csrf
                                                @method('PATCH')
                                                <div class="col-md-4">
                                                    <select name="status" class="form-select form-select-sm" required>
                                                        <option value="en_attente" {{ $deliverable->status === 'en_attente' ? 'selected' : '' }}>En Attente</option>
                                                        <option value="valide" {{ $deliverable->status === 'valide' ? 'selected' : '' }}>Valider</option>
                                                        <option value="refuse" {{ $deliverable->status === 'refuse' ? 'selected' : '' }}>Refuser</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="feedback" class="form-control form-control-sm" 
                                                           placeholder="Commentaire (optionnel)" value="{{ $deliverable->feedback }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="submit" class="btn btn-sm btn-primary w-100">
                                                        <i class="bi bi-check"></i> OK
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-inbox display-4 text-muted"></i>
                            <p class="text-muted mt-2 mb-0">Aucun livrable déposé pour le moment.</p>
                        </div>
                    @endif
                </div>

                <!-- Discussion (Commentaires) -->
                <div class="glass-card p-4 mb-4">
                    <h4 class="fw-bold mb-3">
                        <i class="bi bi-chat-dots text-info"></i> Discussion
                        <span class="badge bg-primary">{{ $project->comments->count() }}</span>
                    </h4>

                    <!-- Formulaire d'ajout de commentaire -->
                    <form method="POST" action="{{ route('comments.store', $project) }}" class="mb-4">
                        @csrf
                        <div class="mb-3">
                            <textarea name="content" class="form-control form-control-custom" rows="3" 
                                      placeholder="Ajouter un commentaire..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-custom">
                            <i class="bi bi-send"></i> Envoyer
                        </button>
                    </form>

                    <!-- Liste des commentaires -->
                    @if($project->comments->count() > 0)
                        <div class="list-group">
                            @foreach($project->comments->sortByDesc('created_at') as $comment)
                                <div class="list-group-item border-0 mb-2 shadow-sm rounded">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="bg-primary text-white rounded-circle p-2 me-2">
                                                    <i class="bi bi-person-fill"></i>
                                                </div>
                                                <div>
                                                    <strong>{{ $comment->user->name }}</strong>
                                                    <span class="badge bg-secondary ms-2">{{ $comment->user->role }}</span>
                                                    <br>
                                                    <small class="text-muted">
                                                        <i class="bi bi-clock"></i> {{ $comment->created_at->diffForHumans() }}
                                                    </small>
                                                </div>
                                            </div>
                                            <p class="mb-0">{{ $comment->content }}</p>
                                        </div>
                                        @if(auth()->id() === $comment->user_id || auth()->user()->isAdmin())
                                            <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger delete-confirm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="bi bi-chat display-4 text-muted"></i>
                            <p class="text-muted mt-2 mb-0">Aucun commentaire pour le moment.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Colonne latérale -->
            <div class="col-lg-4">
                <!-- Membres du projet -->
                <div class="glass-card p-4 mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-people-fill text-success"></i> Membres du Projet
                        <span class="badge bg-primary">{{ $project->members->count() }}</span>
                    </h5>
                    <div class="list-group">
                        @foreach($project->members as $member)
                            <div class="list-group-item border-0 mb-2 shadow-sm rounded">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-white rounded-circle p-2 me-3">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <strong>{{ $member->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $member->email }}</small>
                                    </div>
                                    @if($member->pivot->role === 'chef')
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-star-fill"></i> Chef
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">Membre</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Évaluation -->
                @if($project->evaluation)
                    <div class="glass-card p-4 mb-4">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-star-fill text-warning"></i> Évaluation
                        </h5>
                        <div class="text-center mb-3">
                            <div class="display-4 fw-bold text-primary">{{ $project->evaluation->note }}/20</div>
                            <small class="text-muted">Évalué par {{ $project->evaluation->evaluator->name }}</small>
                        </div>
                        @if($project->evaluation->comment)
                            <div class="alert alert-info">
                                <strong>Commentaire:</strong><br>
                                {{ $project->evaluation->comment }}
                            </div>
                        @endif
                    </div>
                @elseif(auth()->user()->isEnseignant() && $project->isSupervisor(auth()->user()))
                    <div class="glass-card p-4 mb-4">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-star text-warning"></i> Évaluer le Projet
                        </h5>
                        <form method="POST" action="{{ route('evaluations.store', $project) }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Note /20</label>
                                <input type="number" name="note" class="form-control form-control-custom" 
                                       min="0" max="20" step="0.5" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Commentaire</label>
                                <textarea name="comment" class="form-control form-control-custom" rows="4"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success-custom btn-custom w-100">
                                <i class="bi bi-check-circle"></i> Soumettre l'évaluation
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

