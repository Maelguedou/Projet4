<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mes demandes de réservations') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div>
            <a href="{{ route('enseignant.dashboard') }}">Retour</a>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Type</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Besoin</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Classe</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Date</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gary-200 dark:divide-gray-700">
                    @forelse ($demandes as $demande)
                        <tr>
                            {{-- implode est utilisé pour afficher convenablement type qui est un tableau --}}
                            <td>{{ implode(', ', $demande->type ?? []) }}</td>
                            <td class="px-6 py-4">{{ $demande->besoin }}</td>
                            <td class="px-6 py-4">{{ $demande->classe }}</td>
                            <td class="px-6 py-4">{{ $demande->formatted_date }}</td>
                            <td class="px-6 py-4">
                                @if ($demande-> statut == 'en_attente')
                                    <span class="text-yellow-600 font-semibold"> 🕐 En attente</span>
                                @elseif ($demande->statut == 'acceptee')
                                    <span class="text-green-600 font-semibold"> ✓ Acceptée</span>
                                @else
                                    <span class="text-red-600 font-semibold"> ❌ Refusée</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Aucune demande enregistrée
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mb-4 text-right">
        <a href="{{ route('demandes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Nouvelle demande
        </a>
    </div>

</x-app-layout>
