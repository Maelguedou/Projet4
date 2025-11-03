<x-app-layout>


    <div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-sky-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-sky-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-sky-800 mb-2">Nouvel Enseignant</h2>
            <p class="text-slate-600">Remplissez le formulaire pour créer un compte enseignant</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="p-8">
                <form method="POST" action="{{ route('admin.store-teacher') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Nom complet -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                            Nom complet
                        </label>
                        <input 
                            id="name" 
                            name="name" 
                            type="text" 
                            required 
                            autofocus
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-slate-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition duration-200"
                            placeholder="Ex: Dr. Jean Dupont"
                        />
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                            Adresse email
                        </label>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-slate-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition duration-200"
                            placeholder="exemple@uac.bj"
                        />
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Matricule -->
                    <div>
                        <label for="matricule" class="block text-sm font-medium text-slate-700 mb-2">
                            Matricule
                        </label>
                        <input 
                            id="matricule" 
                            name="matricule" 
                            type="text" 
                            required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-slate-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition duration-200"
                            placeholder="Ex: ENS2024001"
                        />
                        @error('matricule')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
                            Mot de passe
                        </label>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-slate-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition duration-200"
                            placeholder="••••••••"
                        />
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirmation mot de passe -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">
                            Confirmer le mot de passe
                        </label>
                        <input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-slate-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition duration-200"
                            placeholder="••••••••"
                        />
                    </div>

                    <!-- Boutons -->
                    <div class="flex items-center gap-4 pt-4">
                        <button 
                            type="submit"
                            class="flex-1 px-6 py-3 bg-sky-600 text-white font-medium rounded-lg hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transform hover:scale-105 transition duration-200 shadow-md hover:shadow-lg"
                        >
                            Créer Enseignant
                        </button>
                        <a 
                            href="{{ route('dashboard') }}"
                            class="px-6 py-3 bg-gray-200 text-slate-700 font-medium rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition duration-200"
                        >
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer Link -->
        <div class="text-center mt-6">
            <a href="{{ route('dashboard') }}" class="text-sky-600 hover:text-sky-700 text-sm font-medium">
                ← Retour au tableau de bord
            </a>
        </div>
    </div>
</div>

<style>
    /* Style global si nécessaire */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
</style>
    </div>
</x-app-layout>
