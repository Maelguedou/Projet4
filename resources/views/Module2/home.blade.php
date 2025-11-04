<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Espace public — Disponibilités UAC</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-slate-50 via-sky-50 to-slate-50 min-h-screen">

  {{-- HEADER MODERNE --}}
  <header class="page-header sticky top-0 z-50">
    <div class="page-header-content">
      {{-- Barre principale --}}
      <div class="py-5 flex flex-col sm:flex-row items-center justify-between gap-4">
        
        {{-- Logo & Titre --}}
        <a href="{{ route('home2') }}" class="flex items-center gap-4 hover:opacity-90 transition group">
          <div class="relative">
            <img src="{{ asset('images/Uac_logo1.png') }}" alt="Université - UAC" class="h-14 w-auto object-contain group-hover:scale-105 transition-transform">
          </div>
          <div>
            <h1 class="text-2xl font-bold text-sky-800">Espace Public</h1>
            <p class="text-sm text-slate-600">Disponibilités en temps réel</p>
          </div>
        </a>

        {{-- Navigation --}}
        <div class="flex items-center gap-4">
          <a href="{{ route('enseignant.dashboard') }}" 
             class="inline-flex items-center gap-2 bg-sky-700 hover:bg-sky-800 text-white text-sm font-medium px-5 py-2.5 rounded-lg shadow-md transition transform hover:scale-105">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Espace Enseignant
          </a>
        </div>
      </div>

      {{-- Bande de logos partenaires --}}
      <div class="bg-gradient-to-r from-sky-50 via-white to-sky-50 border-t py-4">
        <div class="flex justify-center items-center gap-16 flex-wrap">
          <img src="{{ asset('images/IFRI_logo2.png') }}" alt="IFRI" class="h-12 object-contain grayscale hover:grayscale-0 transition-all duration-300 hover:scale-110">
          <img src="{{ asset('images/Uac_logo1.png') }}" alt="UAC" class="h-14 object-contain opacity-90 hover:opacity-100 transition-all duration-300 hover:scale-110">
          <img src="{{ asset('images/IFRI_logo2.png') }}" alt="IFRI" class="h-12 object-contain grayscale hover:grayscale-0 transition-all duration-300 hover:scale-110">
        </div>
      </div>
    </div>
  </header>

  {{-- MAIN CONTENT --}}
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    {{-- Hero Section avec stats --}}
    <section class="mb-16 text-center">
      <div class="inline-flex items-center gap-2 bg-sky-100 text-sky-800 px-4 py-2 rounded-full text-sm font-semibold mb-4">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
        </svg>
        Mise à jour en temps réel
      </div>
      
      <h2 class="text-4xl md:text-5xl font-extrabold text-sky-900 mb-4">
        Disponibilités des ressources
      </h2>
      <p class="text-lg text-slate-600 max-w-2xl mx-auto">
        Consultez en temps réel la disponibilité des salles de cours et équipements pédagogiques de l'université
      </p>

      {{-- Stats rapides --}}
      <div class="mt-10 grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
          <div class="text-3xl font-bold text-sky-700">{{ $salles->count() }}</div>
          <div class="text-sm text-slate-600 mt-1">Salles</div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
          <div class="text-3xl font-bold text-green-600">{{ $salles->where('statut', 'libre')->count() }}</div>
          <div class="text-sm text-slate-600 mt-1">Disponibles</div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
          <div class="text-3xl font-bold text-sky-700">{{ $materiels->count() }}</div>
          <div class="text-sm text-slate-600 mt-1">Matériels</div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
          <div class="text-3xl font-bold text-green-600">{{ $materiels->where('statut', 'libre')->count() }}</div>
          <div class="text-sm text-slate-600 mt-1">Disponibles</div>
        </div>
      </div>
    </section>

    {{-- SECTION SALLES --}}
    <section class="mb-20">
      <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-3">
          <div class="bg-sky-100 p-3 rounded-xl">
            <svg class="w-8 h-8 text-sky-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
          </div>
          <h3 class="text-3xl font-extrabold text-sky-900">Salles de cours</h3>
        </div>
        
        <div class="flex items-center gap-2 text-sm text-slate-600">
          <span class="w-3 h-3 bg-green-500 rounded-full"></span>
          <span>Libre</span>
          <span class="w-3 h-3 bg-red-500 rounded-full ml-3"></span>
          <span>Occupé</span>
        </div>
      </div>

      @if($salles->isEmpty())
        <div class="text-center py-16 bg-white rounded-2xl border-2 border-dashed border-gray-300">
          <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
          </svg>
          <p class="text-slate-600 text-lg">Aucune salle n'est enregistrée pour le moment</p>
        </div>
      @else
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
          @foreach ($salles as $salle)
            <article class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-sky-200">
              
              {{-- Header avec statut --}}
              <div class="relative bg-gradient-to-br from-sky-50 to-blue-50 p-6 border-b border-gray-100">
                <div class="flex items-start justify-between">
                  <div class="bg-white p-3 rounded-xl shadow-sm group-hover:scale-110 transition-transform">
                    <img src="{{ asset('icons/salle-de-classe.png') }}" alt="Icône salle" class="h-10 w-10 object-contain">
                  </div>
                  
                  <span @class([
                    'px-4 py-1.5 text-sm font-semibold rounded-full shadow-sm',
                    'text-green-700 bg-green-100 border border-green-200' => trim(Str::lower($salle->statut ?? '')) === 'libre',
                    'text-red-700 bg-red-100 border border-red-200' => trim(Str::lower($salle->statut ?? '')) !== 'libre'
                  ])>
                    {{ ucfirst($salle->statut) }}
                  </span>
                </div>
              </div>

              {{-- Informations --}}
              <div class="p-6">
                <h4 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-sky-700 transition-colors">
                  {{ $salle->nom }}
                </h4>
                <div class="flex items-center gap-2 text-slate-600">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                  <span class="text-sm">{{ $salle->localisation }}</span>
                </div>
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </section>

    {{-- SECTION MATÉRIELS --}}
    <section>
      <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-3">
          <div class="bg-amber-100 p-3 rounded-xl">
            <svg class="w-8 h-8 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
          </div>
          <h3 class="text-3xl font-extrabold text-sky-900">Matériels pédagogiques</h3>
        </div>

        <div class="flex items-center gap-2 text-sm text-slate-600">
          <span class="w-3 h-3 bg-green-500 rounded-full"></span>
          <span>Disponible</span>
          <span class="w-3 h-3 bg-red-500 rounded-full ml-3"></span>
          <span>Emprunté</span>
        </div>
      </div>

      @if($materiels->isEmpty())
        <div class="text-center py-16 bg-white rounded-2xl border-2 border-dashed border-gray-300">
          <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
          </svg>
          <p class="text-slate-600 text-lg">Aucun matériel n'est répertorié pour le moment</p>
        </div>
      @else
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
          @foreach ($materiels as $materiel)
            <article class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-amber-200">
              
              {{-- Header avec statut --}}
              <div class="relative bg-gradient-to-br from-amber-50 to-orange-50 p-6 border-b border-gray-100">
                <div class="flex items-start justify-between">
                  @php
                    $icon = match($materiel->type ?? '') {
                      'projecteur' => 'icons/projector-device_10003349.png',
                      'ordinateur' => 'icons/ecran-dordinateur.png',
                      'rallonge'   => 'icons/papeterie.png',
                      default      => 'icons/default.png',
                    };
                  @endphp
                  
                  <div class="bg-white p-3 rounded-xl shadow-sm group-hover:scale-110 transition-transform">
                    <img src="{{ asset($icon) }}" alt="{{ $materiel->type ?? 'Matériel' }}" class="h-10 w-10 object-contain">
                  </div>

                  <span @class([
                    'px-4 py-1.5 text-sm font-semibold rounded-full shadow-sm',
                    'text-green-700 bg-green-100 border border-green-200' => trim(Str::lower($materiel->statut ?? '')) === 'libre',
                    'text-red-700 bg-red-100 border border-red-200' => trim(Str::lower($materiel->statut ?? '')) !== 'libre'
                  ])>
                    {{ ucfirst($materiel->statut ?? 'Inconnu') }}
                  </span>
                </div>
              </div>

              {{-- Informations --}}
              <div class="p-6">
                <h4 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-amber-700 transition-colors">
                  {{ $materiel->nom }} {{ $materiel->numero }}
                </h4>
                <div class="flex items-center gap-2 text-slate-600">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                  </svg>
                  <span class="text-sm">{{ ucfirst($materiel->type ?? 'Non spécifié') }}</span>
                </div>
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </section>

  </main>

  {{-- FOOTER ÉLÉGANT --}}
  <footer class="mt-20 bg-sky-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
      <div class="grid md:grid-cols-3 gap-8 mb-8">
        {{-- Colonne 1 --}}
        <div>
          <h4 class="font-bold text-lg mb-3">Université d'Abomey-Calavi</h4>
          <p class="text-sky-200 text-sm leading-relaxed">
            Excellence académique et innovation depuis 1970
          </p>
        </div>

        {{-- Colonne 2 --}}
        <div>
          <h4 class="font-bold text-lg mb-3">Liens rapides</h4>
          <ul class="space-y-2 text-sm text-sky-200">
            <li><a href="#" class="hover:text-white transition">Accueil</a></li>
            <li><a href="#" class="hover:text-white transition">À propos</a></li>
            <li><a href="#" class="hover:text-white transition">Contact</a></li>
          </ul>
        </div>

        {{-- Colonne 3 --}}
        <div>
          <h4 class="font-bold text-lg mb-3">Contact</h4>
          <p class="text-sky-200 text-sm">
            01 BP 526 Cotonou, Bénin<br>
            Tél: +229 XX XX XX XX
          </p>
        </div>
      </div>

      <div class="border-t border-sky-800 pt-6 text-center text-sm text-sky-200">
        © {{ date('Y') }} Université d'Abomey-Calavi — Tous droits réservés
      </div>
    </div>
  </footer>

</body>
</html>