<x-app-layout>

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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                {{-- Carte 1: Demandes Acceptées --}}
                <div class="relative bg-white rounded-xl shadow-lg border border-gray-200 p-6 overflow-hidden group hover:shadow-xl transition-all duration-300">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Demandes Acceptées</span>
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <h2 class="text-4xl font-bold text-green-600">{{ $demande_acepte }}</h2>
                        <p class="text-sm text-gray-600 mt-1">Ce mois-ci</p>
                    </div>
                </div>

                {{-- Carte 2: En attente --}}
                <div class="relative bg-white rounded-xl shadow-lg border border-gray-200 p-6 overflow-hidden group hover:shadow-xl transition-all duration-300">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-50 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-semibold text-gray-600 uppercase tracking-wider">En Attente</span>
                            <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <h2 class="text-4xl font-bold text-yellow-600">{{ $demande_attent }}</h2>
                        <p class="text-sm text-gray-600 mt-1">À traiter</p>
                    </div>
                </div>

                {{-- Carte 3: Rejetées --}}
                <div class="relative bg-white rounded-xl shadow-lg border border-gray-200 p-6 overflow-hidden group hover:shadow-xl transition-all duration-300">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Demandes Rejetées</span>
                            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <h2 class="text-4xl font-bold text-red-600">{{ $demande_rejete }}</h2>
                        <p class="text-sm text-gray-600 mt-1">Ce mois-ci</p>
                    </div>
                </div>
            </div>

            {{-- Actions rapides --}}
            <div class="grid md:grid-cols-2 gap-6">
                
                {{-- Section: Créer une demande --}}
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-sky-50 to-blue-50 px-6 py-5 border-b border-gray-200">
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
                    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-5 border-b border-gray-200">
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