<x-app-layout>
    <style>
/*         @keyframes fade-in-slide {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in-up {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-slide {
            animation: fade-in-slide 0.5s ease-out forwards;
        }

        .animate-fade-in-up {
            opacity: 0;
            animation: fade-in-up 0.5s ease-out forwards;
        }

        .delay-0 { animation-delay: 0s; }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
 */        .delay-5 { animation-delay: 0.5s; }
        .delay-6 { animation-delay: 0.6s; }
        .delay-7 { animation-delay: 0.7s; }
        .delay-8 { animation-delay: 0.8s; }
        .delay-9 { animation-delay: 0.9s; }

/*         @media (prefers-reduced-motion: reduce) {
            .animate-fade-in-slide,
            .animate-fade-in-up {
                animation: none !important;
                opacity: 1 !important;
                transform: none !important;
            }
        }
 */
    </style>

    <x-slot name="header">
        <div class="modern-header">
            <div class="modern-header-pattern"></div>
            <div class="header-content">
                <div class="animate-fade-in">
                    <h2 class="header-title">
                        {{ __('Mes demandes de réservations') }}
                    </h2>
                    <p class="header-subtitle">
                        Consultez et gérez vos demandes de réservation en cours
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 p-4 bg-[#0E8345] hover:bg-[#15803D] border border-green-200 text-[#0E8345] rounded-lg shadow-sm animate-fade-in-slide">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('enseignant.dashboard') }}" class="text-sm text-gray-600 hover:underline">
                    ← Retour
                </a>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Mes demandes de réservations</h3>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('demandes.create') }}" class="inline-flex items-center gap-2 bg-[#0E8345] hover:bg-[#15803D] text-white px-4 py-2 rounded-md shadow-sm text-sm transition-all duration-200 ease-in-out transform hover:scale-105 hover:shadow-md active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200 group-hover:rotate-90" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                    Nouvelle demande
                </a>
            </div>
        </div>

        <!-- Desktop table -->
        <div class="hidden sm:block bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Besoin</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Classe</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                        @forelse ($demandes as $demande)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors duration-150 animate-fade-in-up delay-{{ $loop->index }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200">{{ ucfirst($demande->type) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200">
                                    @if ($demande->besoin)
                                        @php
                                            $besoins = is_string($demande->besoin)
                                                ? json_decode($demande->besoin, true)
                                                : (array) $demande->besoin;
                                        @endphp
                                        {{ !empty($besoins) ? implode(', ', $besoins) : 'Aucun' }}
                                    @else
                                        Aucun
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-200">{{ $demande->classe }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $demande->date_demande }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if ($demande->statut == 'en_attente')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-yellow-700 bg-yellow-100">🕐 En attente</span>
                                    @elseif ($demande->statut == 'acceptee')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-green-700 bg-green-100">✓ Acceptée</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-red-700 bg-red-100">✕ Refusée</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">Aucune demande enregistrée</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile cards -->
        <div class="sm:hidden space-y-4">
            @forelse ($demandes as $demande)
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 transition-all duration-200 hover:shadow-lg transform hover:-translate-y-1 animate-fade-in-up delay-{{ $loop->index }}">
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ ucfirst($demande->type) }} — {{ $demande->classe }}</div>
                            <div class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ $demande->formatted_date }}</div>
                        </div>
                        <div class="text-sm">
                            @if ($demande->statut == 'en_attente')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-yellow-700 bg-yellow-100">🕐 En attente</span>
                            @elseif ($demande->statut == 'acceptee')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-green-700 bg-green-100">✓ Acceptée</span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-red-700 bg-red-100">✕ Refusée</span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-3 text-sm text-gray-700 dark:text-gray-200">
                        @php
                            $besoinData = is_string($demande->besoin)
                                ? json_decode($demande->besoin, true)
                                : (array) $demande->besoin;
                        @endphp
                        <strong>Besoin :</strong> {{ !empty($besoinData) ? implode(', ', $besoinData) : 'Aucun' }}
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 text-center text-gray-500">Aucune demande enregistrée</div>
            @endforelse
        </div>
    </div>

</x-app-layout>
