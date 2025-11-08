<nav x-data="{ open: false }" class="bg-gradient-to-r from-[#0E8345] via-[#16A34A] to-[#15803D] text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center gap-6">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/Uac_log-remove.png') }}" alt="Université - UAC" class="h-14 w-auto object-contain group-hover:scale-105 transition-transform drop-shadow-md">
                    <span class="hidden sm:inline-block font-semibold text-white tracking-wide">
                        UAC — Réservations
                    </span>
                </a>

                <!-- Liens desktop -->
                <div class="hidden md:flex md:items-center md:space-x-2">
                    <x-nav-link :href="route('home2')" :active="request()->routeIs('home')" class="px-3 py-2 text-sm text-white/90 hover:text-white">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('demandes.index')" :active="request()->routeIs('demandes.*')" class="px-3 py-2 text-sm text-white/90 hover:text-white">
                        {{ __('Mes demandes') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Droite : bouton + profil -->
            <div class="flex items-center gap-4">
                <a href="{{ route('demandes.create') }}"
                   class="hidden sm:inline-flex items-center gap-2 px-3 py-2 bg-white/20 hover:bg-white/30 rounded-md text-sm font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Nouvelle demande
                </a>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-white/20 hover:bg-white/30 focus:outline-none">
                            <span class="text-sm">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.353a.75.75 0 111.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Profil</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                Déconnexion
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

                <!-- Bouton mobile -->
                <div class="-mr-2 flex md:hidden">
                    <button @click="open = !open" aria-label="Toggle navigation" class="p-2 rounded-md bg-white/20 hover:bg-white/30 focus:outline-none">
                        <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="open" x-cloak class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu mobile -->
    <div x-show="open" x-cloak x-transition class="md:hidden bg-gradient-to-r from-[#006B3C] to-[#00A86B]/90">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('demandes.index')" :active="request()->routeIs('demandes.*')">Mes demandes</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('demandes.create')" :active="request()->routeIs('demandes.create')">Nouvelle demande</x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-3 border-t border-white/10">
            <div class="px-4">
                <div class="font-medium text-white">{{ Auth::user()->name }}</div>
                <div class="text-sm text-white/80">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 px-2 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">Profil</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Déconnexion</x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
