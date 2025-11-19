@extends('layouts.ap')

@section('title', 'Gestion des Projets')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header --}}
    <div class="mb-8 animate-fade-in">
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-sky-600">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-sky-800 mb-2 flex items-center gap-3">
                        <i class="bi bi-folder-fill"></i>
                        Gestion des Projets
                    </h1>
                    <p class="text-slate-600">
                        Bienvenue, <strong class="text-sky-700">{{ auth()->user()->name }}</strong>
                        @if(auth()->user()->isEtudiant())
                            <span class="inline-flex items-center gap-1 ml-2 px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                Étudiant
                            </span>
                        @elseif(auth()->user()->isEnseignant())
                            <span class="inline-flex items-center gap-1 ml-2 px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                Enseignant
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 ml-2 px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                Administrateur
                            </span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Filtres et recherche --}}
    <div class="mb-8">
        <form method="GET" action="{{ route('projects.index') }}" class="flex flex-col sm:flex-row gap-4 items-center">
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="flex-1 p-3 rounded-xl border border-gray-200 shadow-sm focus:ring-2 focus:ring-sky-400"
                   placeholder="Rechercher un projet...">
            <select name="status" class="p-3 rounded-xl border border-gray-200 shadow-sm focus:ring-2 focus:ring-sky-400">
                <option value="">Tous les statuts</option>
                <option value="en_attente" {{ request('status') === 'en_attente' ? 'selected' : '' }}>En Attente</option>
                <option value="en_cours" {{ request('status') === 'en_cours' ? 'selected' : '' }}>En Cours</option>
                <option value="termine" {{ request('status') === 'termine' ? 'selected' : '' }}>Terminé</option>
            </select>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-sky-600 text-white rounded-xl hover:bg-sky-700 transition">
                    Filtrer
                </button>
                <a href="{{ route('projects.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">
                    Réinitialiser
                </a>
            </div>
        </form>
    </div>

    {{-- Liste des projets --}}
    @if($projects->count() > 0)
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($projects as $project)
        <div class="group bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-md border border-gray-200 overflow-hidden hover:shadow-xl transition">
            <div class="p-6 flex flex-col h-full">
                {{-- Titre et statut --}}
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-bold text-gray-800 line-clamp-2">
                        <a href="{{ route('projects.show', $project) }}" class="hover:text-sky-700 transition">
                            {{ $project->title }}
                        </a>
                    </h3>
                    @if($project->status === 'en_attente')
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                            En Attente
                        </span>
                    @elseif($project->status === 'en_cours')
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                            En Cours
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                            Terminé
                        </span>
                    @endif
                </div>

                {{-- Description --}}
                <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit($project->description, 120) }}</p>

                {{-- Informations --}}
                <div class="space-y-1 text-sm mb-4">
                    <p><strong>Encadrant:</strong> {{ $project->supervisor->name }}</p>
                    <p><strong>Membres:</strong> {{ $project->members->count() }}</p>
                    <p>{{ $project->start_date->format('d/m/Y') }} - {{ $project->end_date->format('d/m/Y') }}</p>
                </div>

                {{-- Alerte retard --}}
                @if($project->isOverdue())
                    <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 rounded">
                        <p class="text-red-700 text-sm font-medium">En retard !</p>
                    </div>
                @endif

                {{-- Bouton --}}
                <div class="mt-auto">
                    <a href="{{ route('projects.show', $project) }}" 
                       class="inline-flex justify-center w-full px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white font-medium rounded-xl transition transform hover:scale-105">
                        Voir les détails
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $projects->links() }}
    </div>
    @else
        <div class="text-center p-10 bg-white rounded-2xl shadow-md border border-gray-200">
            <i class="bi bi-inbox text-5xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg mb-4">Aucun projet trouvé.</p>
            @if(auth()->user()->isEtudiant())
                <a href="{{ route('projects.create') }}" class="px-6 py-3 bg-sky-600 text-white rounded-xl hover:bg-sky-700 transition">
                    Créer un projet
                </a>
            @endif
        </div>
    @endif

</div>
@endsection
