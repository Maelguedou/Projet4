<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeliverableRequest;
use App\Models\Deliverable;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeliverableController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        // Vérifier que l'utilisateur est membre du projet
        if (!$project->hasMember(auth()->user())) {
            abort(403);
        }

        return view('deliverables.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeliverableRequest $request)
    {
        $data = $request->validated();

        // Gérer l'upload du fichier
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('deliverables', 'public');
            $data['file_path'] = $path;
        }

        $data['user_id'] = auth()->id();

        $deliverable = Deliverable::create($data);

        return redirect()->route('projects.show', $deliverable->project_id)
            ->with('success', 'Livrable déposé avec succès.');
    }

    /**
     * Download the deliverable file.
     */
    public function download(Deliverable $deliverable)
    {
        // Vérifier les permissions
        $user = auth()->user();
        $project = $deliverable->project;

        if ($user->isEtudiant() && !$project->hasMember($user)) {
            abort(403);
        } elseif ($user->isEnseignant() && !$project->isSupervisor($user)) {
            abort(403);
        }

        return Storage::disk('public')->download($deliverable->file_path);
    }

    /**
     * Update deliverable status (for supervisors).
     */
    public function updateStatus(Request $request, Deliverable $deliverable)
    {
        // Seul le superviseur peut changer le statut
        if (!$deliverable->project->isSupervisor(auth()->user())) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:en_attente,valide,refuse',
            'feedback' => 'nullable|string',
        ]);

        $deliverable->update([
            'status' => $request->status,
            'feedback' => $request->feedback,
        ]);

        return back()->with('success', 'Statut du livrable mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deliverable $deliverable)
    {
        // Seul l'auteur ou un admin peut supprimer
        if ($deliverable->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        // Supprimer le fichier
        if (Storage::disk('public')->exists($deliverable->file_path)) {
            Storage::disk('public')->delete($deliverable->file_path);
        }

        $deliverable->delete();

        return back()->with('success', 'Livrable supprimé avec succès.');
    }
}
