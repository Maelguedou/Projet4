<!-- ========================================
     PAGE 1 : PORTAIL D'ACCUEIL
     ======================================== -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portail UAC - Université d'Abomey-Calavi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-slate-50 via-sky-50 to-slate-50 min-h-screen">

    <!-- Header élégant -->
    <header class="bg-white shadow-md border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <!-- Logo et titre -->
                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/Uac_logo2.png') }}" alt="Logo UAC" class="h-16 md:h-20 w-auto">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-sky-800">Portail UAC</h1>
                        <p class="text-sm text-slate-600">Université d'Abomey-Calavi</p>
                    </div>
                </div>
                
                <!-- Actions rapides -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('enseignant.dashboard') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2 bg-sky-700 hover:bg-sky-800 text-white text-sm font-medium rounded-lg shadow-md transition transform hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Espace Enseignant
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative py-20 overflow-hidden">
        <!-- Décoration de fond -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-72 h-72 bg-sky-300 rounded-full filter blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-300 rounded-full filter blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold text-sky-900 mb-4">
                Bienvenue sur votre espace académique
            </h2>
            <p class="text-lg md:text-xl text-slate-600 max-w-3xl mx-auto">
                Accédez à tous les services universitaires en quelques clics : réservation de salles, gestion de matériel et bien plus encore.
            </p>
        </div>
    </section>

    <!-- Cartes des modules -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="grid md:grid-cols-2 gap-8">
            
            <!-- Carte 1 : Réservation -->
            <a href="{{ route('home2') }}" class="group relative">
                <div class="bg-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <!-- Image avec overlay -->
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/aleyna-catak-iCyEPaLdPAs-unsplash.jpg') }}" 
                             alt="Réservation" 
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                        
                        <!-- Badge -->
               
                    </div>
                    
                    <!-- Contenu -->
                    <div class="p-8">
                        <div class="flex items-start gap-4">
                            <div class="bg-sky-100 p-3 rounded-xl">
                                <svg class="w-8 h-8 text-sky-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-sky-800 mb-2">
                                    Réservation de salles & matériels
                                </h3>
                                <p class="text-slate-600 leading-relaxed">
                                    Consultez les disponibilités en temps réel et réservez facilement salles de cours et équipements pédagogiques.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Call to action -->
                        <div class="mt-6 flex items-center text-sky-700 font-semibold group-hover:gap-3 gap-2 transition-all">
                            <span>Accéder au module</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Carte 2 : Projets étudiants -->
            <div class="group relative">
                <div class="bg-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <!-- Image avec overlay -->
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('images/vitaly-gariev-kp7qkHTgSKc-unsplash.jpg') }}" 
                             alt="Projets étudiants" 
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                        
                        <!-- Badge -->
                   
                    </div>
                    
                    <!-- Contenu -->
                    <div class="p-8">
                        <div class="flex items-start gap-4">
                            <div class="bg-amber-100 p-3 rounded-xl">
                                <svg class="w-8 h-8 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-amber-800 mb-2">
                                    Gestion de projets étudiants
                                </h3>
                                <p class="text-slate-600 leading-relaxed">
                                    Suivez vos projets académiques, collaborez avec vos enseignants et soumettez vos travaux en ligne.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Call to action désactivé -->
                        <div class="mt-6 flex items-center text-slate-400 font-semibold gap-2">
                            <span>Module en développement</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-sky-900 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-center md:text-left">
                    <p class="font-semibold">Université d'Abomey-Calavi</p>
                    <p class="text-sky-200 text-sm">Excellence académique depuis 1970</p>
                </div>
                <p class="text-sky-200 text-sm">
                    © {{ date('Y') }} UAC — Tous droits réservés
                </p>
            </div>
        </div>
    </footer>

</body>
</html>