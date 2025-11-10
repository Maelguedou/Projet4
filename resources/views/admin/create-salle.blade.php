<x-app-layout>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-sky-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-sky-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7h18M5 10h14M8 14h8M10 18h4" />
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-sky-800 mb-2">Nouvelle Salle</h2>
                <p class="text-slate-600">Remplissez le formulaire pour ajouter une nouvelle salle</p>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="{{ route('sallestore') }}" class="space-y-6">
                        @csrf

                        <!-- Nom -->
                        <div>
                            <label for="nom" class="block text-sm font-medium text-slate-700 mb-2">Nom de la salle</label>
                            <input id="nom" name="nom" type="text" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-slate-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition duration-200"
                                placeholder="Ex: Salle 203" />
                            @error('nom')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Localisation -->
                        <div>
                            <label for="localisation" class="block text-sm font-medium text-slate-700 mb-2">Localisation</label>
                            <input id="localisation" name="localisation" type="text" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-slate-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition duration-200"
                                placeholder="Ex: Bloc B - Étage 2" />
                            @error('localisation')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <input type="hidden" name="statut" value="libre">

                        <!-- Boutons -->
                        <div class="flex items-center gap-4 pt-4">
                            <button type="submit"
                                class="flex-1 px-6 py-3 bg-sky-600 text-white font-medium rounded-lg hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transform hover:scale-105 transition duration-200 shadow-md hover:shadow-lg">
                                Créer Salle
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
