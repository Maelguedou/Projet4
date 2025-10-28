<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CampusConnect') }} - Authentification</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="auth-page">
        <div class="min-vh-100 d-flex align-items-center justify-content-center py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-5 col-lg-4">
                        <!-- Logo -->
                        <div class="text-center mb-4">
                            <a href="/" class="text-decoration-none">
                                <div class="auth-logo mb-3">
                                    <i class="bi bi-mortarboard-fill text-white"></i>
                                </div>
                                <h2 class="text-white fw-bold mb-1">CampusConnect</h2>
                                <p class="text-white-50">Gestion des Projets Étudiants</p>
                            </a>
                        </div>

                        <!-- Carte de formulaire -->
                        <div class="glass-card p-4">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .auth-page {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                background-attachment: fixed;
            }

            .auth-logo {
                width: 80px;
                height: 80px;
                background: rgba(255, 255, 255, 0.2);
                backdrop-filter: blur(10px);
                border-radius: 50%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-size: 2.5rem;
                border: 3px solid rgba(255, 255, 255, 0.3);
            }
        </style>
    </body>
</html>
