<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-bold text-sky-800">
                    Tableau de bord Enseignant
                </h2>
                <p class="text-slate-600 text-sm mt-1">Gérez vos demandes de réservation</p>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('demandes.create') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-medium rounded-lg shadow-md transition transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Nouvelle demande
                </a>
                
                <a href="{{ route('demandes.index') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-gray-50 text-sky-700 font-medium rounded-lg shadow-md border-2 border-sky-200 transition transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Mes demandes
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 via-sky-50 to-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Carte de bienvenue --}}
            <div class="bg-gradient-to-r from-sky-600 to-blue-600 rounded-2xl shadow-xl p-8 mb-8 text-white">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-6">
                        <div class="bg-white/20 backdrop-blur-sm p-4 rounded-2xl">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-1">Bienvenue, {{ Auth::user()->name }} !</h3>
                            <p class="text-sky-100">Vous êtes connecté en tant qu'enseignant</p>
                        </div>
                    </div>
                    
                    <div class="bg-white/10 backdrop-blur-sm px-6 py-3 rounded-xl border border-white/20">
                        <div class="text-sm text-sky-100">Date du jour</div>
                        <div class="text-xl font-bold">{{ date('d/m/Y') }}</div>
                    </div>
                </div>
            </div>

            {{-- Grille des cartes principales --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                
                {{-- Carte 1: Statistiques --}}
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b">
                        <div class="flex items-center gap-3">
                            <div class="bg-green-100 p-2 rounded-lg">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-800">Demandes Acceptées</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-4xl font-bold text-green-600 mb-2">12</div>
                        <p class="text-sm text-gray-600">Ce mois-ci</p>
                    </div>
                </div>

                {{-- Carte 2: En attente --}}
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition">
                    <div class="bg-gradient-to-r from-yellow-50 to-amber-50 px-6 py-4 border-b">
                        <div class="flex items-center gap-3">
                            <div class="bg-yellow-100 p-2 rounded-lg">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-800">En Attente</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-4xl font-bold text-yellow-600 mb-2">5</div>
                        <p class="text-sm text-gray-600">À traiter</p>
                    </div>
                </div>

                {{-- Carte 3: Rejetées --}}
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition">
                    <div class="bg-gradient-to-r from-red-50 to-rose-50 px-6 py-4 border-b">
                        <div class="flex items-center gap-3">
                            <div class="bg-red-100 p-2 rounded-lg">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-800">Demandes Rejetées</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-4xl font-bold text-red-600 mb-2">2</div>
                        <p class="text-sm text-gray-600">Ce mois-ci</p>
                    </div>
                </div>
            </div>

            {{-- Actions rapides --}}
            <div class="grid md:grid-cols-2 gap-6">
                
                {{-- Section: Créer une demande --}}
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-sky-50 to-blue-50 px-6 py-5 border-b">
                        <h3 class="text-xl font-bold text-sky-800 flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Nouvelle demande
                        </h3>
                        <p class="text-sm text-slate-600 mt-1">Réservez une salle ou du matériel</p>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center gap-2 text-slate-600">
                                <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Réservation de salles de cours
                            </li>
                            <li class="flex items-center gap-2 text-slate-600">
                                <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Emprunt de matériel pédagogique
                            </li>
                            <li class="flex items-center gap-2 text-slate-600">
                                <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Suivi en temps réel
                            </li>
                        </ul>
                        <a href="{{ route('demandes.create') }}" 
                           class="block w-full text-center px-6 py-3 bg-sky-600 hover:bg-sky-700 text-white font-medium rounded-lg shadow-md transition transform hover:scale-105">
                            Créer une demande
                        </a>
                    </div>
                </div>

                {{-- Section: Mes demandes --}}
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-5 border-b">
                        <h3 class="text-xl font-bold text-purple-800 flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Mes demandes
                        </h3>
                        <p class="text-sm text-slate-600 mt-1">Consultez l'historique de vos réservations</p>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center gap-2 text-slate-600">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Historique complet
                            </li>
                            <li class="flex items-center gap-2 text-slate-600">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Statuts des demandes
                            </li>
                            <li class="flex items-center gap-2 text-slate-600">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Modification possible
                            </li>
                        </ul>
                        <a href="{{ route('demandes.index') }}" 
                           class="block w-full text-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg shadow-md transition transform hover:scale-105">
                            Voir mes demandes
                        </a>
                    </div>
                </div>
            </div>

            {{-- Section aide --}}
            <div class="mt-8 bg-gradient-to-r from-amber-50 to-orange-50 border-l-4 border-amber-500 rounded-lg p-6">
                <div class="flex items-start gap-4">
                    <div class="bg-amber-100 p-3 rounded-lg flex-shrink-0">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-amber-900 mb-2">Besoin d'aide ?</h4>
                        <p class="text-amber-800 text-sm">
                            Si vous rencontrez des difficultés ou avez des questions, n'hésitez pas à contacter le service administratif ou à consulter le guide d'utilisation.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<style>
    /* Animations supplémentaires si besoin */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out;
    }
</style>