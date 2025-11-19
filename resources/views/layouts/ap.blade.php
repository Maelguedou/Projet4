{{-- ========================================
     LAYOUT: resources/views/layouts/ap.blade.php
     ======================================== --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('ap.name', 'CampusConnect') }} - @yield('title', 'Gestion des Projets')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gradient-to-br from-slate-50 via-sky-50 to-slate-50 min-h-screen">
    
    {{-- NAVBAR MODERNE --}}
    <nav x-data="{ open: false, userMenu: false }" class="bg-white shadow-lg border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                {{-- Logo --}}
                <a href="{{ route('dashboard3') }}" class="flex items-center gap-3 hover:opacity-90 transition group">
                    <div class="bg-gradient-to-r from-sky-600 to-blue-600 p-2 rounded-xl shadow-md group-hover:shadow-lg transition">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-sky-800">CampusConnect</span>
                </a>

                

                {{-- Bouton Mobile --}}
                <button @click="open = !open" class="md:hidden text-gray-700 text-2xl focus:outline-none">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                {{-- Menu Desktop --}}
                <ul class="hidden md:flex items-center space-x-2">
                    <li>
                        <a href="{{ route('dashboard3') }}"
                           class="flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-sky-100 text-sky-700' : 'text-gray-700 hover:bg-sky-50 hover:text-sky-700' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Tableau de bord
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('projects.index') }}"
                           class="flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg transition {{ request()->routeIs('projects.*') ? 'bg-sky-100 text-sky-700' : 'text-gray-700 hover:bg-sky-50 hover:text-sky-700' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                            </svg>
                            Projets
                        </a>
                    </li>

                    @if(auth()->user()->isAdmin())
                    <li>
                        <a href="{{ route('dashboard3') }}"
                           class="flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg transition {{ request()->routeIs('admin.*') ? 'bg-sky-100 text-sky-700' : 'text-gray-700 hover:bg-sky-50 hover:text-sky-700' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Administration
                        </a>
                    </li>
                    @endif

                    @if(auth()->user()->isEtudiant())
                    <li>
                        <a href="{{ route('projects.create') }}"
                           class="flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-sky-600 to-blue-600 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transition transform hover:scale-105">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Nouveau Projet
                        </a>
                    </li>
                    @endif

                    {{-- User Menu Desktop --}}
                    <li class="relative ml-4">
                        <button @click="userMenu = !userMenu"
                            class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                            <div class="w-9 h-9 bg-gradient-to-r from-sky-600 to-blue-600 rounded-full flex items-center justify-center shadow-md">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        {{-- Dropdown --}}
                        <div x-show="userMenu" 
                             @click.away="userMenu=false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-72 bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden z-50">

                            <div class="p-4 bg-gradient-to-r from-sky-50 to-blue-50 border-b">
                                <small class="text-gray-600 font-medium">Connecté en tant que</small>
                                <div class="font-bold text-gray-800 mt-1">{{ auth()->user()->email }}</div>

                                <span class="mt-2 inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold rounded-full
                                    @if(auth()->user()->isAdmin()) bg-red-100 text-red-700
                                    @elseif(auth()->user()->isEnseignant()) bg-green-100 text-green-700
                                    @else bg-blue-100 text-blue-700 @endif">
                                    @if(auth()->user()->isAdmin())
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        Administrateur
                                    @elseif(auth()->user()->isEnseignant())
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                        </svg>
                                        Enseignant
                                    @else
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                        </svg>
                                        Étudiant
                                    @endif
                                </span>
                            </div>

                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-gray-700 font-medium">Paramètres</span>
                            </a>

                            <div class="border-t"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="flex items-center gap-3 w-full px-4 py-3 text-red-600 hover:bg-red-50 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    <span class="font-medium">Déconnexion</span>
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>

            {{-- Menu Mobile --}}
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="md:hidden py-4 border-t space-y-2">

                <a href="{{ route('dashboard3') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-sky-100 text-sky-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Tableau de bord
                </a>

                <a href="{{ route('projects.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('projects.*') ? 'bg-sky-100 text-sky-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                    Projets
                </a>

                @if(auth()->user()->isAdmin())
                <a href="{{ route('dashboard3') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Administration
                </a>
                @endif

                @if(auth()->user()->isEtudiant())
                <a href="{{ route('projects.create') }}"
                   class="flex items-center justify-center gap-2 mx-4 px-4 py-3 bg-gradient-to-r from-sky-600 to-blue-600 text-white rounded-lg font-semibold shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Nouveau Projet
                </a>
                @endif

                {{-- User Info Mobile --}}
                <div class="mt-4 pt-4 border-t px-4">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-sky-600 to-blue-600 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-800">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-gray-600">{{ auth()->user()->email }}</div>
                        </div>
                    </div>

                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 py-2 text-gray-700 hover:text-sky-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Paramètres
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button class="flex items-center gap-2 py-2 text-red-600 hover:text-red-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- Messages Flash --}}
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 p-4 rounded-lg shadow-md flex items-center gap-3 animate-fade-in">
            <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="text-green-800 font-medium">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 p-4 rounded-lg shadow-md flex items-center gap-3 animate-fade-in">
            <svg class="w-6 h-6 text-red-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <span class="text-red-800 font-medium">{{ session('error') }}</span>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 p-4 rounded-lg shadow-md animate-fade-in">
            <div class="flex gap-3">
                <svg class="w-6 h-6 text-red-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <strong class="text-red-800 font-semibold">Erreurs de validation :</strong>
                    <ul class="mt-2 space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-red-700 text-sm">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Page Content --}}
    <main class="py-8">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    {{-- Footer --}}
    <footer class="mt-auto bg-sky-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <h5 class="text-lg font-bold">CampusConnect</h5>
                    </div>
                    <p class="text-sky-200 text-sm">Plateforme de gestion des projets étudiants</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-sky-200">&copy; {{ date('Y') }} CampusConnect. Tous droits réservés.</p><br>
                    <a href="{{ route('welcome') }}" 
                        class="inline-flex items-center gap-2 bg-white hover:bg-sky-800 text-black text-sm font-medium px-5 py-2.5 rounded-lg shadow-md transition transform hover:scale-105">
                        Portail
                    </a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
