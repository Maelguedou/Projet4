<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $user = auth()->user();

       if ($user->isEtudiant()) {
            $projects = $user->projects()->with('supervisor')->get();
            $totalProjects = $projects->count();
            $ongoingProjects = $projects->where('status', 'en_cours')->count();
            $completedProjects = $projects->where('status', 'termine')->count();
            
            $demandes = collect();
            $pendingDemandes = 0;

            return view('dashboard', compact('projects', 'totalProjects', 'ongoingProjects', 'completedProjects', 'demandes', 'pendingDemandes'));

        } elseif ($user->isEnseignant()) {
            $projects = $user->supervisedProjects()->with('members')->get();
            $totalProjects = $projects->count();
            $ongoingProjects = $projects->where('status', 'en_cours')->count();
            $completedProjects = $projects->where('status', 'termine')->count();

            return view('dashboard', compact(
                'projects',
                'totalProjects',
                'ongoingProjects',
                'completedProjects',
            ));
        }else{
            // Statistiques pour les admins
            $totalProjects = Project::count();
            $ongoingProjects = Project::where('status', 'en_cours')->count();
            $completedProjects = Project::where('status', 'termine')->count();
            $projects = Project::with(['supervisor', 'members'])->latest()->take(10)->get();

            return view('dashboard', compact('projects', 'totalProjects', 'ongoingProjects', 'completedProjects'));

        }
    }
}
