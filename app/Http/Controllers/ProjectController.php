<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Project::with(['supervisor', 'members']);

        // Filtrage par statut
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Recherche par titre
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filtrage selon le rôle de l'utilisateur
        $user = auth()->user();
        if ($user->isEtudiant()) {
            // Les étudiants voient uniquement leurs projets
            $query->whereHas('members', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        } elseif ($user->isEnseignant()) {
            // Les enseignants voient les projets qu'ils supervisent
            $query->where('supervisor_id', $user->id);
        }
        // Les admins voient tous les projets

        $projects = $query->latest()->paginate(10);

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupérer tous les enseignants pour le formulaire
        $enseignants = User::where('role', 'enseignant')->get();

        // Récupérer tous les étudiants pour sélectionner les membres
        $etudiants = User::where('role', 'etudiant')->get();

        return view('projects.create', compact('enseignants', 'etudiants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->validated());

        // Ajouter les membres du projet
        if ($request->has('members')) {
            foreach ($request->members as $memberId) {
                $project->members()->attach($memberId, ['role' => 'membre']);
            }
        }

        // Ajouter le créateur comme chef de projet
        $project->members()->attach(auth()->id(), ['role' => 'chef']);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Projet créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load(['supervisor', 'members', 'deliverables.user', 'comments.user', 'evaluation']);

        // Vérifier les permissions
        $user = auth()->user();
        if ($user->isEtudiant() && !$project->hasMember($user)) {
            abort(403, 'Vous n\'avez pas accès à ce projet.');
        } elseif ($user->isEnseignant() && !$project->isSupervisor($user)) {
            abort(403, 'Vous n\'avez pas accès à ce projet.');
        }

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        // Vérifier les permissions
        $user = auth()->user();
        if ($user->isEtudiant() && !$project->hasMember($user)) {
            abort(403);
        } elseif ($user->isEnseignant() && !$project->isSupervisor($user)) {
            abort(403);
        }

        $enseignants = User::where('role', 'enseignant')->get();
        $etudiants = User::where('role', 'etudiant')->get();

        return view('projects.edit', compact('project', 'enseignants', 'etudiants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        return redirect()->route('projects.show', $project)
            ->with('success', 'Projet mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Seul un admin ou le superviseur peut supprimer un projet
        $user = auth()->user();
        if (!$user->isAdmin() && !$project->isSupervisor($user)) {
            abort(403);
        }

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Projet supprimé avec succès.');
    }
}
