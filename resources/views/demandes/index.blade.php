<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-bold text-sky-800">
                    {{ __('Mes demandes de réservations') }}
                </h2>
                <p class="text-slate-600 text-sm mt-1">Consultez et gérez vos demandes de réservation en cours</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 via-sky-50 to-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Message de succès --}}
            @if (session('success'))
                <div class="mb-6 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 border-l-4 border-emerald-500 text-emerald-800 rounded-lg shadow-md animate-fade-in flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            {{-- En-tête avec boutons --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
                <div class="flex items-center gap-4">
                    <a href="{{ route('enseignant.dashboard') }}" 
                       class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-sky-700 transition-colors font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Retour au tableau de bord
                    </a>
                </div>

                <a href="{{ route('demandes.create') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold rounded-xl shadow-lg transform hover:scale-105 hover:shadow-xl active:scale-95 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Nouvelle demande
                </a>
            </div>

            {{-- Tableau Desktop --}}
            <div class="hidden sm:block bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-sky-50 to-blue-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-sky-800 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-sky-800 uppercase tracking-wider">Besoin</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-sky-800 uppercase tracking-wider">Classe</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-sky-800 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-sky-800 uppercase tracking-wider">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($demandes as $demande)
                                <tr class="hover:bg-sky-50 transition-all duration-200 animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            @if ($demande->type === 'Salle')
                                                <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                    </svg>
                                                </div>
                                            @else
                                                <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                            <span class="text-sm font-semibold text-gray-800">{{ ucfirst($demande->type) }}</span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <div class="max-w-xs truncate">
                                            {{ $demande->besoin?->liste_besoins ?? 'Aucun' }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-700">
                                            {{ $demande->classe }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $demande->date_demande }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($demande->statut == 'en_attente')
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700 border border-yellow-200">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                </svg>
                                                En attente
                                            </span>
                                        @elseif ($demande->statut == 'acceptee')
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-200">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                Acceptée
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold bg-red-100 text-red-700 border border-red-200">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                </svg>
                                                Refusée
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <p class="text-gray-600 text-lg font-medium">Aucune demande enregistrée</p>
                                            <p class="text-gray-500 text-sm mt-1">Créez votre première demande pour commencer</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Cartes Mobile --}}
            <div class="sm:hidden space-y-4">
                @forelse ($demandes as $demande)
                    <div class="bg-white rounded-xl shadow-lg p-5 border border-gray-200 transition-all duration-200 hover:shadow-xl transform hover:-translate-y-1 animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center gap-3">
                                @if ($demande->type === 'Salle')
                                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                @else
                                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">
                                        {{ ucfirst($demande->type) }}
                                    </div>
                                    <div class="text-xs text-gray-500 mt-0.5">
                                        {{ $demande->date_demande }}
                                    </div>
                                </div>
                            </div>

                            @if ($demande->statut === 'en_attente')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    En attente
                                </span>
                            @elseif ($demande->statut === 'acceptee')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Acceptée
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    Refusée
                                </span>
                            @endif
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-medium text-gray-500">Classe:</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-purple-100 text-purple-700">
                                    {{ $demande->classe }}
                                </span>
                            </div>
                            <div>
                                <span class="text-xs font-medium text-gray-500">Besoin:</span>
                                <span class="text-sm text-gray-700 ml-2">{{ $demande->besoin?->liste_besoins ?? 'Aucun' }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl shadow-lg p-8 text-center border border-gray-200">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-gray-600 font-medium">Aucune demande enregistrée</p>
                        <p class="text-gray-500 text-sm mt-1">Créez votre première demande</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

</x-app-layout>