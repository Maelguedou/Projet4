
@extends('layouts.ap')

@section('title', 'Créer un Nouveau Projet')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Header --}}
    <div class="mb-10 animate-fade-in">
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-sky-600">
            <h1 class="text-3xl font-bold text-sky-800 mb-2 flex items-center gap-3">
                <i class="bi bi-plus-circle"></i>
                Créer un Nouveau Projet
            </h1>
            <p class="text-slate-600">Remplissez ce formulaire pour créer un nouveau projet.</p>
        </div>
    </div>

    {{-- Form --}}
    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-200">

        <form method="POST" action="{{ route('projects.store') }}" class="space-y-6">
            @csrf

            {{-- TITRE --}}
            <div>
                <label for="title" class="block mb-2 font-semibold text-gray-800">
                    <i class="bi bi-pencil text-sky-600"></i> Titre du Projet *
                </label>
                <input 
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    required
                    placeholder="Ex: Système de Gestion de Bibliothèque"
                    class="w-full p-3 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-sky-400 @error('title') border-red-500 @enderror"
                >
                @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- DESCRIPTION --}}
            <div>
                <label for="description" class="block mb-2 font-semibold text-gray-800">
                    <i class="bi bi-file-text text-sky-600"></i> Description *
                </label>

                <textarea 
                    id="description"
                    name="description"
                    rows="5"
                    required
                    placeholder="Décrivez votre projet..."
                    class="w-full p-3 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-sky-400 @error('description') border-red-500 @enderror"
                >{{ old('description') }}</textarea>

                {{-- compteur caractères --}}
                <div id="desc-count" class="text-sm text-gray-500 mt-1"></div>

                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

                <small class="text-gray-500">Minimum 50 caractères</small>
            </div>

            {{-- DATES --}}
            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <label for="start_date" class="block mb-2 font-semibold text-gray-800">
                        <i class="bi bi-calendar-event text-green-600"></i> Date de Début *
                    </label>
                    <input 
                        type="date"
                        id="start_date"
                        name="start_date"
                        value="{{ old('start_date') }}"
                        required
                        class="w-full p-3 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-sky-400 @error('start_date') border-red-500 @enderror"
                    >
                    @error('start_date')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="end_date" class="block mb-2 font-semibold text-gray-800">
                        <i class="bi bi-calendar-check text-red-600"></i> Date de Fin *
                    </label>
                    <input 
                        type="date"
                        id="end_date"
                        name="end_date"
                        value="{{ old('end_date') }}"
                        required
                        class="w-full p-3 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-sky-400 @error('end_date') border-red-500 @enderror"
                    >
                    @error('end_date')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- ENCADRANT --}}
            <div>
                <label for="supervisor_id" class="block mb-2 font-semibold text-gray-800">
                    <i class="bi bi-person-badge text-sky-600"></i> Encadrant *
                </label>
                <select 
                    id="supervisor_id"
                    name="supervisor_id"
                    required
                    class="w-full p-3 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-sky-400 @error('supervisor_id') border-red-500 @enderror"
                >
                    <option value="">-- Sélectionnez un encadrant --</option>
                    @foreach($enseignants as $enseignant)
                        <option value="{{ $enseignant->id }}" {{ old('supervisor_id') == $enseignant->id ? 'selected' : '' }}>
                            {{ $enseignant->name }} ({{ $enseignant->email }})
                        </option>
                    @endforeach
                </select>

                @error('supervisor_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- MEMBRES --}}
            <div>
                <label class="block mb-2 font-semibold text-gray-800">
                    <i class="bi bi-people-fill text-green-600"></i> Membres du Projet *
                </label>

                <div class="bg-gray-50 border border-gray-300 rounded-xl p-4 max-h-72 overflow-y-auto">
                    @foreach($etudiants as $etudiant)
                        <label class="flex items-center gap-2 mb-2">
                            <input 
                                type="checkbox"
                                name="members[]"
                                value="{{ $etudiant->id }}"
                                id="member_{{ $etudiant->id }}"
                                class="h-4 w-4 rounded border-gray-300"
                                {{ in_array($etudiant->id, old('members', [])) ? 'checked' : '' }}
                                {{ $etudiant->id === auth()->id() ? 'checked disabled' : '' }}
                            >
                            <span class="text-gray-700">
                                <strong>{{ $etudiant->name }}</strong>
                                <small class="text-gray-500">({{ $etudiant->email }})</small>

                                @if($etudiant->id === auth()->id())
                                    <span class="ml-2 px-2 py-0.5 rounded-full bg-sky-100 text-sky-700 text-xs">
                                        Vous (Chef de projet)
                                    </span>
                                @endif
                            </span>
                        </label>
                    @endforeach

                    <input type="hidden" name="members[]" value="{{ auth()->id() }}">
                </div>

                @error('members')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- STATUT --}}
            <div>
                <label for="status" class="block mb-2 font-semibold text-gray-800">
                    <i class="bi bi-flag text-yellow-600"></i> Statut Initial
                </label>
                <select 
                    id="status"
                    name="status"
                    class="w-full p-3 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-sky-400"
                >
                    <option value="en_attente" {{ old('status') === 'en_attente' ? 'selected' : '' }}>En Attente</option>
                    <option value="en_cours" {{ old('status', 'en_cours') === 'en_cours' ? 'selected' : '' }}>En Cours</option>
                </select>
            </div>

            {{-- BOUTONS --}}
            <div class="flex gap-4 pt-6 border-t">
                <button 
                    type="submit"
                    class="px-6 py-3 bg-sky-600 hover:bg-sky-700 text-white font-medium rounded-xl shadow-md transition"
                >
                    <i class="bi bi-check-circle mr-1"></i> Créer le Projet
                </button>

                <a 
                    href="{{ route('projects.index') }}"
                    class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl shadow-sm hover:bg-gray-200 transition"
                >
                    <i class="bi bi-x-circle mr-1"></i> Annuler
                </a>
            </div>

        </form>
    </div>

    {{-- AIDE --}}
    <div class="mt-8 bg-sky-50 border-l-4 border-sky-600 rounded-xl p-6 shadow-sm">
        <h3 class="font-bold text-sky-800 flex items-center gap-2">
            <i class="bi bi-info-circle"></i> Conseils
        </h3>
        <ul class="list-disc ml-6 text-gray-700 mt-2 space-y-1 text-sm">
            <li>Choisissez un titre clair et descriptif</li>
            <li>La description doit contenir au moins 50 caractères</li>
            <li>La date de fin doit être postérieure à la date de début</li>
            <li>Vous êtes automatiquement chef de projet</li>
            <li>Ajoutez d'autres étudiants si vous le souhaitez</li>
        </ul>
    </div>

</div>

@push('scripts')
<script>
    // MIN DATE
    document.getElementById('start_date').addEventListener('change', function() {
        const start = this.value;
        const endInput = document.getElementById('end_date');
        endInput.min = start;
        if (endInput.value && endInput.value < start) endInput.value = '';
    });

    // COMPTEUR DE CARACTÈRES
    const desc = document.getElementById('description');
    const countDiv = document.getElementById('desc-count');

    function updateCount() {
        const count = desc.value.length;
        countDiv.textContent = `${count} caractères (minimum 50)`;
        countDiv.className = count >= 50 
            ? "text-sm text-green-600"
            : "text-sm text-red-600";
    }

    desc.addEventListener('input', updateCount);
    updateCount();
</script>
@endpush
@endsection
