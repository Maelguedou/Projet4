<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CampusConnect') }} - @yield('title', 'Gestion des Projets')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand text-white fw-bold d-flex align-items-center" href="{{ route('dashboard') }}">
                <i class="bi bi-mortarboard-fill me-2 fs-4"></i>
                <span class="fs-5">CampusConnect</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2 me-1"></i> Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" href="{{ route('projects.index') }}">
                            <i class="bi bi-folder-fill me-1"></i> Projets
                        </a>
                    </li>



                    {{-- @if(auth()->user()->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-shield-check me-1"></i> Administration
                        </a>
                    </li>
                    @endif --}}

                    @if(auth()->user()->isEtudiant())
                    <li class="nav-item ms-2">
                        <a href="{{ route('projects.create') }}" class="btn btn-light btn-sm rounded-pill px-3">
                            <i class="bi bi-plus-circle me-1"></i> Nouveau Projet
                        </a>
                    </li>
                    @endif

                    <li class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <div class="bg-white rounded-circle p-2 me-2">
                                <i class="bi bi-person-fill text-primary"></i>
                            </div>
                            <span>{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2" style="border-radius: 15px;">
                            <li>
                                <div class="px-3 py-2 border-bottom">
                                    <small class="text-muted">Connecté en tant que</small>
                                    <div class="fw-bold">{{ auth()->user()->email }}</div>
                                    <span class="badge bg-primary mt-1">
                                        @if(auth()->user()->isAdmin())
                                            <i class="bi bi-shield-fill"></i> Administrateur
                                        @elseif(auth()->user()->isEnseignant())
                                            <i class="bi bi-person-badge"></i> Enseignant
                                        @else
                                            <i class="bi bi-mortarboard"></i> Étudiant
                                        @endif
                                    </span>
                                </div>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-gear me-2"></i> Paramètres
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Messages Flash -->
    @if(session('success'))
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Erreurs de validation :</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    <!-- Page Content -->
    <main class="py-4">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <!-- Footer -->
    <footer class="mt-5 py-4" style="background: rgba(255, 255, 255, 0.1);">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-white">
                    <h5><i class="bi bi-mortarboard-fill me-2"></i>CampusConnect</h5>
                    <p class="mb-0">Plateforme de gestion des projets étudiants</p>
                </div>
                <div class="col-md-6 text-md-end text-white">
                    <p class="mb-0">&copy; {{ date('Y') }} CampusConnect. Tous droits réservés.</p>
                    <small>Développé avec <i class="bi bi-heart-fill text-danger"></i> par Laravel</small>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
