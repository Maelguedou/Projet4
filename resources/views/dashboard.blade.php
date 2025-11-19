@extends('layouts.ap')

@section('title', 'Tableau de bord')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header --}}
    <div class="mb-8 animate-fade-in">
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-sky-600">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-sky-800 mb-2 flex items-center gap-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Tableau de bord
                    </h1>
                    <p class="text-slate-600">
                        Bienvenue, <strong class="text-sky-700">{{ auth()->user()->name }}</strong>
                        @if(auth()->user()->isEtudiant())
                            <span class="inline-flex items-center gap-1 ml-2 px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                </svg>
                                Étudiant
                            </span>
                        @elseif(auth()->user()->isEnseignant())
                            <span class="inline-flex items-center gap-1 ml-2 px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                </svg>
                                Enseignant
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 ml-2 px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Administrateur
                            </span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistiques --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        {{-- Total Projets --}}
        <div class="relative bg-white rounded-xl shadow-lg border border-gray-200 p-6 overflow-hidden group hover:shadow-xl transition-all duration-300">
            <div class="absolute top-0 right-0 w-32 h-32 bg-sky-50 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Total Projets</span>
                    <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-sky-700">{{ $totalProjects }}</h2>
            </div>
        </div>

        {{-- En Cours --}}
        <div class="relative bg-white rounded-xl shadow-lg border border-gray-200 p-6 overflow-hidden group hover:shadow-xl transition-all duration-300">
            <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm font-semibold text-gray-600 uppercase tracking-wider">En Cours</span>
                    <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-amber-600">{{ $ongoingProjects }}</h2>
            </div>
        </div>

        {{-- Terminés --}}
        <div class="relative bg-white rounded-xl shadow-lg border border-gray-200 p-6 overflow-hidden group hover:shadow-xl transition-all duration-300">
            <div class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Terminés</span>
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-green-600">{{ $completedProjects }}</h2>
            </div>
        </div>
    </div>

    {{-- Liste des projets --}}
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
        
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
            <h3 class="text-2xl font-bold text-sky-800 flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                @if(auth()->user()->isEtudiant())
                    Mes Projets
                @elseif(auth()->user()->isEnseignant())
                    Projets Supervisés
                @else
                    Projets Récents
                @endif
            </h3>

            <a href="{{ route('projects.index') }}" 
               class="inline-flex items-center gap-2 px-4 py-2 bg-sky-100 hover:bg-sky-200 text-sky-700 font-medium rounded-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                Voir tout
            </a>
        </div>

        @if($projects->count() > 0)
            <div class="grid md:grid-cols-2 gap-6">
                @foreach($projects as $project)
                <div class="group bg-gradient-to-br from-white to-gray-50 rounded-xl border border-gray-200 shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
                    
                    <div class="p-6">
                        {{-- Titre + Statut --}}
                        <div class="flex items-start justify-between gap-3 mb-4">
                            <a href="{{ route('projects.show', $project) }}" 
                               class="text-lg font-bold text-gray-800 hover:text-sky-700 transition line-clamp-2">
                                {{ $project->title }}
                            </a>

                            @if($project->status === 'en_attente')
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700 border border-yellow-200 whitespace-nowrap">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    En Attente
                                </span>
                            @elseif($project->status === 'en_cours')
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 border border-blue-200 whitespace-nowrap">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    En Cours
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-200 whitespace-nowrap">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Terminé
                                </span>
                            @endif
                        </div>

                        {{-- Description --}}
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                            {{ Str::limit($project->description, 100) }}
                        </p>

                        {{-- Informations --}}
                        <div class="space-y-2 text-sm mb-4">
                            <div class="flex items-center gap-2 text-gray-700">
                                <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="font-medium">Encadrant:</span>
                                <span>{{ $project->supervisor->name }}</span>
                            </div>

                            <div class="flex items-center gap-2 text-gray-700">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ $project->start_date->format('d/m/Y') }} - {{ $project->end_date->format('d/m/Y') }}</span>
                            </div>
                        </div>

                        {{-- Retard --}}
                        @if($project->isOverdue())
                            <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 rounded">
                                <div class="flex items-center gap-2 text-red-700 text-sm font-medium">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <strong>En retard !</strong>
                                </div>
                            </div>
                        @endif

                        {{-- Footer --}}
                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <div class="flex items-center gap-1 text-gray-600 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                {{ $project->members->count() }} membre(s)
                            </div>

                            <a href="{{ route('projects.show', $project) }}" 
                               class="inline-flex items-center gap-1 px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white text-sm font-medium rounded-lg transition transform hover:scale-105">
                                Voir détails
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <p class="text-gray-500 text-lg font-medium mb-4">Aucun projet pour le moment</p>

                @if(auth()->user()->isEtudiant())
                    <a href="{{ route('projects.create') }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-sky-600 to-blue-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition transform hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Créer votre premier projet
                    </a>
                @endif
            </div>
        @endif

    </div>

</div>
@endsection