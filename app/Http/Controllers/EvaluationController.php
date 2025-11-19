<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Project;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Store or update project evaluation.
     */
    public function store(Request $request, Project $project)
    {
        // Seul le superviseur peut évaluer
        if (!$project->isSupervisor(auth()->user())) {
            abort(403);
        }

        $request->validate([
            'note' => 'required|numeric|min:0|max:20',
            'comment' => 'nullable|string',
        ]);

        $project->evaluation()->updateOrCreate(
            ['project_id' => $project->id],
            [
                'evaluator_id' => auth()->id(),
                'note' => $request->note,
                'comment' => $request->comment,
            ]
        );

        return back()->with('success', 'Évaluation enregistrée avec succès.');
    }

    /**
     * Remove the evaluation.
     */
    public function destroy(Evaluation $evaluation)
    {
        // Seul l'évaluateur ou un admin peut supprimer
        if ($evaluation->evaluator_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $evaluation->delete();

        return back()->with('success', 'Évaluation supprimée avec succès.');
    }
}
