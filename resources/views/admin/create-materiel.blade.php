<x-app-layout>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-sky-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-sky-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m2 4h.01M12 8h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-sky-800 mb-2">Nouveau Matériel</h2>
                <p class="text-slate-600">Ajoutez un nouveau matériel disponible pour réservation</p>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="{{ route('materielstore') }}" class="space-y-6">
                        @csrf

                        <!-- Nom -->
                        <div>
                            <label for="nom" class="block text-sm font-medium text-slate-700 mb-2">Nom du matériel</label>
                            <input id="nom" name="nom" type="text" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-slate-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition duration-200"
                                placeholder="Ex: Vidéoprojecteur" />
                            @error('nom')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Numéro -->
                        <div>
                            <label for="numero" class="block text-sm font-medium text-slate-700 mb-2">Numéro du matériel</label>
                            <input id="numero" name="numero" type="text" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-slate-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition duration-200"
                                placeholder="Ex: MAT-2025-001" />
                            @error('numero')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-slate-700 mb-2">Type</label>
                            <input id="type" name="type" type="text" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-slate-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition duration-200"
                                placeholder="Ex: Informatique, Audio, etc." />
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="hidden" name="statut" value="libre">

                        <!-- Boutons -->
                        <div class="flex items-center gap-4 pt-4">
                            <button type="submit"
                                class="flex-1 px-6 py-3 bg-sky-600 text-white font-medium rounded-lg hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transform hover:scale-105 transition duration-200 shadow-md hover:shadow-lg">
                                Créer Matériel
                            </button>
                            <a href="{{ route('dashboard') }}"
                                class="px-6 py-3 bg-gray-200 text-slate-700 font-medium rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition duration-200">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-6">
                <a href="{{ route('dashboard') }}" class="text-sky-600 hover:text-sky-700 text-sm font-medium">
                    ← Retour au tableau de bord
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
