@extends('layouts.ap')

@section('title', 'Modifier le Projet')

@section('content')
<div class="max-w-4xl mx-auto py-10">

    <!-- En-tête -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold flex items-center gap-2">
            <i class="bi bi-pencil-square text-yellow-500 text-3xl"></i>
            Modifier le Projet
        </h1>
        <p class="text-gray-500 mt-1">{{ $project->title }}</p>
    </div>

    <!-- Formulaire -->
    <div class="bg-white/60 backdrop-blur-xl shadow-xl rounded-xl p-8 border border-gray-100">

        <form method="POST" action="{{ route('projects.update', $project) }}">
            @csrf
            @method('PUT')

            <!-- Titre -->
            <div class="mb-6">
                <label class="font-semibold mb-1 block">
                    <i class="bi bi-pencil text-indigo-500 mr-1"></i> Titre du Projet *
                </label>
                <input type="text" name="title" value="{{ old('title', $project->title) }}"
                       class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror"
                       required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label class="font-semibold mb-1 block">
                    <i class="bi bi-file-text text-indigo-500 mr-1"></i> Description *
                </label>
                <textarea name="description" rows="5"
                          class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror"
                          required>{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Dates -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="font-semibold mb-1 block">
                        <i class="bi bi-calendar-event text-green-600 mr-1"></i> Date de Début *
                    </label>
                    <input type="date" name="start_date"
                           value="{{ old('start_date', $project->start_date->format('Y-m-d')) }}"
                           class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 @error('start_date') border-red-500 @enderror"
                           required>
                    @error('start_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="font-semibold mb-1 block">
                        <i class="bi bi-calendar-check text-red-600 mr-1"></i> Date de Fin *
                    </label>
                    <input type="date" name="end_date"
                           value="{{ old('end_date', $project->end_date->format('Y-m-d')) }}"
                           class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 @error('end_date') border-red-500 @enderror"
                           required>
                    @error('end_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Statut -->
            <div class="mb-6">
                <label class="font-semibold mb-1 block">
                    <i class="bi bi-flag text-yellow-500 mr-1"></i> Statut
                </label>

                <select name="status"
                        class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="en_attente" {{ old('status', $project->status) == 'en_attente' ? 'selected' : '' }}>En Attente</option>
                    <option value="en_cours" {{ old('status', $project->status) == 'en_cours' ? 'selected' : '' }}>En Cours</option>

                    @if(auth()->user()->isEnseignant())
                    <option value="termine" {{ old('status', $project->status) == 'termine' ? 'selected' : '' }}>Terminé</option>
                    @endif
                </select>
            </div>

            <!-- Boutons -->
            <div class="flex items-center gap-3 pt-4 border-t">

                <button type="submit"
                        class="px-5 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow">
                    <i class="bi bi-check-circle mr-1"></i> Mettre à Jour
                </button>

                <a href="{{ route('projects.show', $project) }}"
                   class="px-5 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 text-gray-700">
                    <i class="bi bi-x-circle mr-1"></i> Annuler
                </a>

                @if(auth()->user()->isAdmin() || (auth()->user()->isEtudiant() && $project->hasMember(auth()->user())))
                    <form method="POST" action="{{ route('projects.destroy', $project) }}" class="ml-auto">
                        @csrf
                        @method('DELETE')

                        <button class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow delete-confirm">
                            <i class="bi bi-trash mr-1"></i> Supprimer
                        </button>
                    </form>
                @endif

            </div>

        </form>

    </div>
</div>
@endsection
