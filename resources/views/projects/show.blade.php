@extends('layouts.ap')

@section('title', $project->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- HEADER DU PROJET --}}
    <div class="mb-8 animate-fade-in">
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-sky-600">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">

                {{-- TITRE + INFOS --}}
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-sky-800 flex items-center gap-3 mb-2">
                        <i class="bi bi-folder-open text-sky-600"></i>
                        {{ $project->title }}
                    </h1>

                    <div class="flex flex-wrap gap-4 text-slate-600 text-sm">
                        <span class="flex items-center gap-1">
                            <i class="bi bi-person-badge text-sky-600"></i>
                            <strong>Encadrant:</strong> {{ $project->supervisor->name }}
                        </span>
                        <span class="flex items-center gap-1">
                            <i class="bi bi-calendar-event text-green-600"></i>
                            <strong>Début:</strong> {{ $project->start_date->format('d/m/Y') }}
                        </span>
                        <span class="flex items-center gap-1">
                            <i class="bi bi-calendar-check text-red-600"></i>
                            <strong>Fin:</strong> {{ $project->end_date->format('d/m/Y') }}
                        </span>
                    </div>
                </div>

                {{-- BADGES STATUS --}}
                <div class="flex flex-col items-end gap-2">
                    @if($project->status === 'en_attente')
                        <span class="px-3 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded-full">
                            <i class="bi bi-clock"></i> En Attente
                        </span>
                    @elseif($project->status === 'en_cours')
                        <span class="px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-full">
                            <i class="bi bi-hourglass-split"></i> En Cours
                        </span>
                    @else
                        <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">
                            <i class="bi bi-check-circle"></i> Terminé
                        </span>
                    @endif

                    @if($project->isOverdue())
                        <span class="px-3 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full">
                            <i class="bi bi-exclamation-triangle"></i> En retard
                        </span>
                    @endif
                </div>
            </div>

            {{-- ACTIONS --}}
            <div class="mt-4 pt-4 border-t flex flex-wrap gap-2">
                @if(auth()->user()->isEtudiant() && $project->hasMember(auth()->user()))
                    <a href="{{ route('projects.edit', $project) }}" 
                       class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                        <i class="bi bi-pencil-square"></i> Modifier
                    </a>

                    <a href="{{ route('deliverables.create', $project) }}" 
                       class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        <i class="bi bi-cloud-upload"></i> Déposer un Livrable
                    </a>
                @endif

                @if(auth()->user()->isEnseignant() && $project->isSupervisor(auth()->user()))
                    <a href="{{ route('projects.edit', $project) }}" 
                       class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                        <i class="bi bi-pencil-square"></i> Modifier
                    </a>
                @endif

                <a href="{{ route('projects.index') }}" 
                   class="ml-auto px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- COLONNE GAUCHE --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- DESCRIPTION --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h2 class="text-xl font-bold text-sky-800 mb-3 flex items-center gap-2">
                    <i class="bi bi-file-text text-sky-600"></i>
                    Description
                </h2>
                <p class="text-gray-600">{{ $project->description }}</p>
            </div>

            {{-- LIVRABLES --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-sky-800 flex items-center gap-2">
                        <i class="bi bi-file-earmark-arrow-up text-green-600"></i>
                        Livrables
                        <span class="px-2 py-0.5 text-xs bg-sky-100 text-sky-700 rounded-full">
                            {{ $project->deliverables->count() }}
                        </span>
                    </h2>
                </div>

                @if($project->deliverables->count() > 0)
                    <div class="space-y-4">
                        @foreach($project->deliverables as $deliverable)
                            <div class="bg-gray-50 rounded-xl p-4 shadow border border-gray-200">
                                <div class="flex justify-between">
                                    <div class="flex-1">

                                        <h3 class="font-semibold text-gray-800 mb-1">
                                            {{ $deliverable->title }}
                                            <span class="px-2 py-0.5 text-xs bg-gray-200 rounded-full">{{ $deliverable->version }}</span>
                                        </h3>

                                        <p class="text-gray-600 text-sm mb-2">{{ $deliverable->description }}</p>

                                        <p class="text-xs text-gray-500">
                                            <i class="bi bi-person"></i> {{ $deliverable->user->name }} •
                                            <i class="bi bi-calendar"></i> {{ $deliverable->created_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>

                                    {{-- STATUS --}}
                                    <div class="flex flex-col items-end gap-2">

                                        @if($deliverable->status === 'en_attente')
                                            <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">En Attente</span>
                                        @elseif($deliverable->status === 'valide')
                                            <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">Validé</span>
                                        @else
                                            <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded-full">Refusé</span>
                                        @endif

                                        <a href="{{ route('deliverables.download', $deliverable) }}" 
                                           class="px-3 py-1 text-xs border border-sky-500 text-sky-700 rounded-lg hover:bg-sky-50 transition">
                                            <i class="bi bi-download"></i> Télécharger
                                        </a>
                                    </div>
                                </div>

                                {{-- FEEDBACK --}}
                                @if($deliverable->feedback)
                                    <div class="mt-3 px-3 py-2 bg-blue-50 text-blue-700 rounded">
                                        <small><strong>Feedback :</strong> {{ $deliverable->feedback }}</small>
                                    </div>
                                @endif

                                {{-- FORMULAIRE ENSEIGNANT --}}
                                @if(auth()->user()->isEnseignant() && $project->isSupervisor(auth()->user()))
                                    <form method="POST" action="{{ route('deliverables.updateStatus', $deliverable) }}" 
                                          class="grid grid-cols-1 sm:grid-cols-6 gap-2 mt-3 pt-3 border-t">
                                        @csrf
                                        @method('PATCH')

                                        <select name="status" class="col-span-2 p-2 border rounded" required>
                                            <option value="en_attente" {{ $deliverable->status === 'en_attente' ? 'selected' : '' }}>En Attente</option>
                                            <option value="valide" {{ $deliverable->status === 'valide' ? 'selected' : '' }}>Valider</option>
                                            <option value="refuse" {{ $deliverable->status === 'refuse' ? 'selected' : '' }}>Refuser</option>
                                        </select>

                                        <input type="text" name="feedback" 
                                               value="{{ $deliverable->feedback }}"
                                               placeholder="Commentaire"
                                               class="col-span-3 p-2 border rounded">

                                        <button type="submit" 
                                                class="col-span-1 bg-sky-600 text-white rounded hover:bg-sky-700 transition">
                                            OK
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6">
                        <i class="bi bi-inbox text-5xl text-gray-300"></i>
                        <p class="text-gray-500 mt-2">Aucun livrable pour le moment.</p>
                    </div>
                @endif
            </div>

            {{-- COMMENTAIRES --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h2 class="text-xl font-bold text-sky-800 mb-4 flex items-center gap-2">
                    <i class="bi bi-chat-dots text-blue-500"></i>
                    Discussion
                    <span class="px-2 py-0.5 text-xs bg-sky-100 text-sky-700 rounded-full">
                        {{ $project->comments->count() }}
                    </span>
                </h2>

                {{-- Form --}}
                <form method="POST" action="{{ route('comments.store', $project) }}" class="mb-4">
                    @csrf
                    <textarea name="content" rows="3"
                              class="w-full p-3 border rounded-xl focus:ring-sky-400"
                              placeholder="Ajouter un commentaire..." required>
                    </textarea>

                    <button class="mt-2 px-4 py-2 bg-sky-600 text-white rounded-xl hover:bg-sky-700 transition">
                        <i class="bi bi-send"></i> Envoyer
                    </button>
                </form>

                {{-- Liste --}}
                @if($project->comments->count() > 0)
                    <div class="space-y-4">
                        @foreach($project->comments->sortByDesc('created_at') as $comment)
                            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 shadow flex gap-3">

                                <div class="bg-sky-600 text-white rounded-full h-10 w-10 flex items-center justify-center">
                                    <i class="bi bi-person-fill"></i>
                                </div>

                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <strong>{{ $comment->user->name }}</strong>
                                        <span class="px-2 py-0.5 bg-gray-200 rounded text-xs">
                                            {{ $comment->user->role }}
                                        </span>
                                    </div>

                                    <small class="text-gray-500 block mb-2">
                                        <i class="bi bi-clock"></i> {{ $comment->created_at->diffForHumans() }}
                                    </small>

                                    <p>{{ $comment->content }}</p>
                                </div>

                                @if(auth()->id() === $comment->user_id || auth()->user()->isAdmin())
                                    <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-800">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500 mt-6">
                        Aucun commentaire pour le moment.
                    </p>
                @endif
            </div>

        </div>

        {{-- COLONNE DROITE --}}
        <div class="space-y-8">

            {{-- MEMBRES --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h2 class="text-xl font-bold text-sky-800 mb-4 flex items-center gap-2">
                    <i class="bi bi-people-fill text-green-600"></i>
                    Membres du Projet
                    <span class="px-2 py-0.5 text-xs bg-sky-100 text-sky-700 rounded-full">
                        {{ $project->members->count() }}
                    </span>
                </h2>

                @foreach($project->members as $member)
                <div class="flex items-center gap-3 bg-gray-50 p-3 mb-3 rounded-lg border">
                    <div class="bg-sky-600 text-white rounded-full h-10 w-10 flex items-center justify-center">
                        <i class="bi bi-person-fill"></i>
                    </div>

                    <div class="flex-1">
                        <strong>{{ $member->name }}</strong><br>
                        <small class="text-gray-500">{{ $member->email }}</small>
                    </div>

                    @if($member->pivot->role === 'chef')
                        <span class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded text-xs">
                            <i class="bi bi-star-fill"></i> Chef
                        </span>
                    @else
                        <span class="px-2 py-0.5 bg-gray-200 rounded text-xs">Membre</span>
                    @endif
                </div>
                @endforeach
            </div>

            {{-- EVALUATION --}}
            @if($project->evaluation)
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-xl font-bold text-sky-800 mb-4 flex items-center gap-2">
                        <i class="bi bi-star-fill text-yellow-500"></i>
                        Évaluation
                    </h2>

                    <div class="text-center mb-4">
                        <div class="text-4xl font-bold text-sky-700">
                            {{ $project->evaluation->note }}/20
                        </div>
                        <small class="text-gray-500">
                            Évalué par {{ $project->evaluation->evaluator->name }}
                        </small>
                    </div>

                    @if($project->evaluation->comment)
                        <div class="bg-blue-50 text-blue-700 p-3 rounded">
                            <strong>Commentaire :</strong><br>
                            {{ $project->evaluation->comment }}
                        </div>
                    @endif
                </div>

            @elseif(auth()->user()->isEnseignant() && $project->isSupervisor(auth()->user()))
                <div class="bg-white rounded-2xl shadow p-6">
                    <h2 class="text-xl font-bold text-sky-800 mb-4 flex items-center gap-2">
                        <i class="bi bi-star text-yellow-500"></i>
                        Évaluer le Projet
                    </h2>

                    <form method="POST" action="{{ route('evaluations.store', $project) }}" class="space-y-4">
                        @csrf

                        <div>
                            <label class="font-semibold text-gray-700">Note /20</label>
                            <input type="number" name="note" min="0" max="20" step="0.5"
                                   class="mt-1 w-full p-3 border rounded-xl" required>
                        </div>

                        <div>
                            <label class="font-semibold text-gray-700">Commentaire</label>
                            <textarea name="comment" rows="4"
                                      class="mt-1 w-full p-3 border rounded-xl"></textarea>
                        </div>

                        <button class="w-full px-4 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 transition">
                            <i class="bi bi-check-circle"></i> Soumettre l'évaluation
                        </button>
                    </form>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection


