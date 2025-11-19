<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-bold text-sky-800">
                    Tableau de bord Administrateur
                </h2>
                <p class="text-slate-600 text-sm mt-1">Gestion des enseignants et attribution des salles</p>
            </div>
            
            <!-- Bouton retour page principale -->
            <a href="{{ route('home2') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-gray-50 text-sky-700 font-medium rounded-lg shadow-md border-2 border-sky-200 transition transform hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Accueil
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 via-sky-50 to-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            {{-- Section: Actions rapides --}}
            <div class="grid md:grid-cols-3 gap-6">
                
                {{-- Ajouter un enseignant --}}
                <section class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-sky-50 to-blue-50 px-6 py-5 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-sky-800 flex items-center gap-3">
                            <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            Enseignant
                        </h2>
                        <p class="text-sm text-slate-600 mt-1">Créez un nouveau compte</p>
                    </div>
                    <div class="p-6">
                        <a href="{{ route('admin.create-teacher') }}"
                           class="inline-flex items-center gap-2 w-full justify-center bg-sky-600 hover:bg-sky-700 text-white font-medium px-6 py-3 rounded-lg shadow-md transition-all duration-200 transform hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Nouvel enseignant
                        </a>
                    </div>
                </section>

                {{-- Créer une salle --}}
                <section class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-50 to-teal-50 px-6 py-5 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-emerald-800 flex items-center gap-3">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            Salle
                        </h2>
                        <p class="text-sm text-slate-600 mt-1">Ajoutez une salle de cours</p>
                    </div>
                    <div class="p-6">
                        <a href="{{ route('admin.create-salle') }}"
                           class="inline-flex items-center gap-2 w-full justify-center bg-emerald-600 hover:bg-emerald-700 text-white font-medium px-6 py-3 rounded-lg shadow-md transition-all duration-200 transform hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Nouvelle salle
                        </a>
                    </div>
                </section>

                {{-- Créer un matériel --}}
                <section class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-50 to-orange-50 px-6 py-5 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-amber-800 flex items-center gap-3">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Matériel
                        </h2>
                        <p class="text-sm text-slate-600 mt-1">Ajoutez du matériel pédagogique</p>
                    </div>
                    <div class="p-6">
                        <a href="{{ route('admin.create-materiel') }}"
                           class="inline-flex items-center gap-2 w-full justify-center bg-amber-600 hover:bg-amber-700 text-white font-medium px-6 py-3 rounded-lg shadow-md transition-all duration-200 transform hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Nouveau matériel
                        </a>
                    </div>
                </section>

            </div>

            {{-- Section: Liste des enseignants --}}
            <section class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-5 border-b border-gray-200">
                    <h2 class="text-2xl font-semibold text-purple-800 flex items-center gap-3">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Liste des enseignants
                    </h2>
                    <p class="text-sm text-slate-600 mt-1 ml-10">{{ count($users) }} enseignant(s) enregistré(s)</p>
                </div>

                <div class="overflow-x-auto">
                    @if (count($users) == 0)
                        <div class="text-center py-16">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p class="text-slate-600 text-lg">Aucun enseignant enregistré</p>
                        </div>
                    @else
                        <table class="w-full">
                            <thead class="bg-slate-50 border-b-2 border-slate-200">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Nom</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Email</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Statut</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-slate-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @foreach ($users as $user)
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-sky-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-sky-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                </div>
                                                <span class="font-medium text-slate-800">{{ $user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-slate-600 text-sm">{{ $user->email ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">
                                            @if ($user->is_block)
                                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Bloqué
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Actif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                                @if ($user->is_block)
                                                    <button type="button" 
                                                            onclick="unBlockUser('{{ $user->id }}');"
                                                            class="inline-flex items-center gap-1 px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition transform hover:scale-105">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                                                        </svg>
                                                        Débloquer
                                                    </button>
                                                @else
                                                    <button type="button" 
                                                            onclick="blockUser('{{ $user->id }}');"
                                                            class="inline-flex items-center gap-1 px-3 py-2 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg transition transform hover:scale-105">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                        </svg>
                                                        Bloquer
                                                    </button>
                                                @endif
                                                
                                                <form action="{{ route('destroy', $user->id) }}" method="POST" 
                                                      onsubmit="return confirm('Voulez-vous vraiment supprimer cet enseignant ?');"
                                                      class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="inline-flex items-center gap-1 px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition transform hover:scale-105">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </section>

            {{-- Section: Attribution des salles --}}
            <section class="bg-white rounded-xl border border-gray-200 shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-50 to-teal-50 px-6 py-5 border-b border-gray-200">
                    <h2 class="text-2xl font-semibold text-emerald-800 flex items-center gap-3">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Attribution des salles
                    </h2>
                    <p class="text-sm text-slate-600 mt-1 ml-10">{{ count($salleneeds) }} besoin(s) de salle en attente</p>
                </div>
 
                    
                    {{-- <div class="overflow-x-auto">
                        @if (count($salleneeds) == 0)
                            <div class="text-center py-16">
                                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-slate-600 text-lg">Aucun besoin de salle pour le moment</p>
                            </div>
                        @else
                            <table class="w-full">
                                <thead class="bg-slate-50 border-b-2 border-slate-200">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Enseignant</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Matricule</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Classe</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Attribuer une salle</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Rejeter</th>
                                         <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">Valider une demande</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200">
                                    @foreach ($salleneeds as $salleneed)
                                        <tr class="hover:bg-slate-50 transition">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                                        <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                        </svg>
                                                    </div>
                                                    <span class="font-medium text-slate-800">{{ $salleneed->user->name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-slate-600 text-sm font-mono">{{ $salleneed->user->matricule }}</td>
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                                    {{ $salleneed->classe }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <select name="salles[{{ $salleneed->id }}]" 
                                                        required
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition">
                                                    <option value="">-- Sélectionner une salle --</option>
                                                    @foreach ($freesalles as $freesalle)
                                                        <option value="{{ $freesalle->id_salle }}">{{ $freesalle->nom }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="px-6 py-4">
                                                    <form action="{{ route('rejet', $salleneed->id) }}" method="POST" class="d-inline"
                                                        onsubmit="return confirm('Êtes-vous sûr de vouloir rejeter cette demande ?')">
                                                        @csrf
                                                        <button class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-rose-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl hover:from-red-700 hover:to-rose-700 transform hover:scale-105 active:scale-95 transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-red-300">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                            Supprimer
                                                        </button>
                                                    </form>
                                            </td>
                                            <td>
                                                <form action="">
                                                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                                                        <button type="submit" 
                                                                onclick="return confirm('Voulez-vous vraiment attribuer ces salles ?')"
                                                                class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg shadow-md transition transform hover:scale-105">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                            </svg>
                                                            Valider
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                          
                            
                        @endif
                    </div> --}}


            <div class="overflow-x-auto">
                @if ($salleneeds->isEmpty())
                    <div class="text-center py-16">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-slate-600 text-lg">Aucun besoin de salle pour le moment</p>
                    </div>
                @else
                    <table class="w-full">
                        <thead class="bg-slate-50 border-b-2 border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left">Enseignant</th>
                            <th class="px-6 py-4 text-left">Matricule</th>
                            <th class="px-6 py-4 text-left">Classe</th>
                            <th class="px-6 py-4 text-left">Date</th>
                            <th class="px-6 py-4 text-left">Attribuer une salle</th>
                            <th class="px-6 py-4 text-left">Rejeter</th>
                            <th class="px-6 py-4 text-left">Valider</th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-200">
                        @foreach ($salleneeds as $salleneed)
                            <form action="{{ route('assignSalle') }}" method="POST">
                                @csrf
                                <input type="hidden" name="need_id" value="{{ $salleneed->id }}">

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-emerald-700" ...></svg>
                                        </div>
                                        <span class="font-medium text-slate-800">{{ $salleneed->user->name }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-slate-600 text-sm font-mono">
                                    {{ $salleneed->user->matricule }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                        {{ $salleneed->classe }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-slate-600 text-sm font-mono">
                                    {{ $salleneed->date_demande}}
                                </td>
                                <td class="px-6 py-4">
                                    <select name="salle_id" required
                                            class="w-full px-4 py-2 border rounded-lg">
                                        <option value="">-- Sélectionner une salle --</option>
                                        @foreach ($freesalles as $freesalle)
                                            <option value="{{ $freesalle->id_salle }}">
                                                {{ $freesalle->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td class="px-6 py-4">
                                    <button type="submit"
                                            onclick="return confirm('Valider cette attribution ?')"
                                            class="px-6 py-3 bg-emerald-600 text-white rounded-lg">
                                        Valider
                                    </button>
                                </td>

                            </form>
                            <!-- Rejeter -->
                            <td class="px-6 py-4">
                                    <form action="{{ route('rejet', $salleneed->id) }}" method="POST"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir rejeter cette demande ?')">
                                        @csrf
                                        <button class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                                            Supprimer
                                        </button>
                                    </form>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

                
            <div class="overflow-x-auto">
                @if ($materielneeds->isEmpty())
                    <div class="text-center py-16">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-slate-600 text-lg">Aucun besoin en materiel pour le moment</p>
                    </div>
                @else
                    <table class="w-full">
                        <thead class="bg-slate-50 border-b-2 border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left">Enseignant</th>
                            <th class="px-6 py-4 text-left">Matricule</th>
                            <th class="px-6 py-4 text-left">Classe</th>
                            <th class="px-6 py-4 text-left">Nom</th>
                            <th class="px-6 py-4 text-left">Date de demande</th>
                            <th class="px-6 py-4 text-left">Attribuer un materiel</th>
                            <th class="px-6 py-4 text-left">Valider</th>
                            <th class="px-6 py-4 text-left">Rejeter</th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-200">
                        @foreach ($materielneeds as $materielneed)
                            <form action="{{ route('assignMateriel') }}" method="POST">
                                @csrf
                                <input type="hidden" name="Mneed_id" value="{{ $materielneed->id }}">

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-emerald-700" ...></svg>
                                        </div>
                                        <span class="font-medium text-slate-800">{{ $materielneed->user->name }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-slate-600 text-sm font-mono">
                                    {{ $materielneed->user->matricule }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                        {{ $materielneed->classe }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-600 text-sm font-mono">
                                                @php
                                                    $besoin = $besoins->Where('demande_id','=',$materielneed->id)->first();
                                                    if ($besoin) {
                                                        foreach ($besoin->getAttributes() as $key => $value) {
                                                            if (!in_array($key, ['id','demande_id','created_at','updated_at'])) {
                                                                if ($value == 1 || ($key == 'autre' && $value != null)) {
                                                                    $materielsDemandes = $key === 'autre' ? $value : ucfirst($key);
                                                                }
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                        {{ $materielsDemandes }}
                                </td>
                                <td class="px-6 py-4 text-slate-600 text-sm font-mono">
                                    {{ $materielneed->date_demande}}
                                </td>
                                <td class="px-6 py-4">
                                    <select name="materiel_id" required
                                            class="w-full px-4 py-2 border rounded-lg">
                                        <option value="">-- Sélectionner une salle --</option>
                                        @foreach ($freemateriels as $freemateriel)
                                            <option value="{{ $freemateriel->id_materiel }}">
                                                {{ $freemateriel->nom }}{{ $freemateriel->numero }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>

                                <td class="px-6 py-4">
                                    <button type="submit"
                                            onclick="return confirm('Valider cette attribution ?')"
                                            class="px-6 py-3 bg-emerald-600 text-white rounded-lg">
                                        Valider
                                    </button>
                                </td>

                            </form>
                            <!-- Rejeter -->
                            <td class="px-6 py-4">
                                    <form action="{{ route('rejet', $materielneed->id) }}" method="POST"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir rejeter cette demande ?')">
                                        @csrf
                                        <button class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                                            Supprimer
                                        </button>
                                    </form>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            </section>
        </div>
    </div>
</x-app-layout>

<script>
    async function blockUser(id) {
        if (!confirm("Êtes-vous sûr de vouloir bloquer cet enseignant ?")) return;

        try {
            const response = await axios.post('/users/block', { id });

            if (response.data.status === 'success') {
                window.location.reload();
            } else {
                alert(response.data.message || 'Une erreur est survenue');
            }
        } catch (error) {
            alert('Erreur lors du blocage de l\'utilisateur');
            console.error(error);
        }
    }

    async function unBlockUser(id) {
        if (!confirm("Confirmer le déblocage de cet enseignant ?")) return;

        try {
            const response = await axios.post('/users/unblock', { id });
            
            if (response.data.status === 'success') {
                window.location.reload();
            } else {
                alert(response.data.message || 'Une erreur est survenue');
            }
        } catch (error) {
            alert('Erreur lors du déblocage de l\'utilisateur');
            console.error(error);
        }
    }
</script>