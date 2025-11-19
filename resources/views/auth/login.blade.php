{{-- ========================================
     PAGE LOGIN (Connexion)
     resources/views/auth/login.blade.php
     ======================================== --}}
<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-sky-50 to-slate-50 flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            
            {{-- En-tête --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-sky-600 to-blue-600 rounded-2xl shadow-lg mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-sky-800 mb-2">Connexion</h2>
                <p class="text-slate-600">Connectez-vous à votre compte CampusConnect</p>
            </div>

            {{-- Carte principale --}}
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <div class="p-8">
                    
                    {{-- Session Status --}}
                    @if (session('status'))
                        <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-lg flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-green-800 text-sm font-medium">{{ session('status') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                <svg class="w-4 h-4 inline-block mr-1 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Adresse email
                            </label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email') }}"
                                   class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition duration-200 @error('email') border-red-500 bg-red-50 @enderror"
                                   placeholder="votre.email@campus.com" 
                                   required 
                                   autofocus>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                <svg class="w-4 h-4 inline-block mr-1 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Mot de passe
                            </label>
                            <input type="password" 
                                   name="password" 
                                   id="password"
                                   class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent transition duration-200 @error('password') border-red-500 bg-red-50 @enderror"
                                   placeholder="••••••••" 
                                   required>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Remember Me & Forgot Password --}}
                        <div class="flex items-center justify-between">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" 
                                       id="remember_me" 
                                       name="remember"
                                       class="w-4 h-4 text-sky-600 border-gray-300 rounded focus:ring-sky-500 transition">
                                <span class="ml-2 text-sm text-gray-700">Se souvenir de moi</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" 
                                   class="text-sm text-sky-600 hover:text-sky-700 font-medium transition">
                                    Mot de passe oublié ?
                                </a>
                            @endif
                        </div>

                        {{-- Bouton Connexion --}}
                        <button type="submit" 
                                class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-sky-600 to-blue-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl hover:from-sky-700 hover:to-blue-700 transform hover:scale-105 active:scale-95 transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-sky-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Se connecter
                        </button>

                        {{-- Lien inscription (visible uniquement si non connecté) --}}
                        @guest
                            @if (Route::has('register'))
                                <div class="relative my-6">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-gray-300"></div>
                                    </div>
                                    <div class="relative flex justify-center text-sm">
                                        <span class="px-4 bg-white text-gray-500">Vous n'avez pas de compte ?</span>
                                    </div>
                                </div>

                                <a href="{{ route('register') }}" 
                                   class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-white text-sky-700 font-semibold rounded-lg border-2 border-sky-200 hover:bg-sky-50 hover:border-sky-400 transform hover:scale-105 active:scale-95 transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-sky-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                    </svg>
                                    Créer un compte
                                </a>
                            @endif
                        @endguest 
                    </form>
                </div>

                {{-- Comptes de test --}}
                <div class="bg-gradient-to-r from-sky-50 to-blue-50 px-8 py-6 border-t border-gray-200">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-5 h-5 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-sm font-semibold text-gray-800">Comptes de démonstration</p>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center justify-between p-2 bg-white rounded-lg">
                            <span class="font-medium text-gray-700">Étudiant:</span>
                            <span class="text-gray-600 text-xs">alice.bernard@campus.com</span>
                        </div>
                        <div class="flex items-center justify-between p-2 bg-white rounded-lg">
                            <span class="font-medium text-gray-700">Enseignant:</span>
                            <span class="text-gray-600 text-xs">marie.dupont@campus.com</span>
                        </div>
                        <div class="flex items-center justify-between p-2 bg-white rounded-lg">
                            <span class="font-medium text-gray-700">Admin:</span>
                            <span class="text-gray-600 text-xs">admin@campus.com</span>
                        </div>
                        <div class="flex items-center justify-between p-2 bg-sky-100 rounded-lg border border-sky-200">
                            <span class="font-bold text-sky-800">Mot de passe:</span>
                            <span class="font-mono text-sky-700 font-semibold">password</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <p class="text-center text-sm text-gray-600 mt-6">
                © {{ date('Y') }} CampusConnect. Tous droits réservés.
            </p>
        </div>
    </div>
</x-guest-layout>