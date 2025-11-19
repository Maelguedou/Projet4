<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created comment.
     */
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        // Vérifier les permissions
        $user = auth()->user();
        if ($user->isEtudiant() && !$project->hasMember($user)) {
            abort(403);
        } elseif ($user->isEnseignant() && !$project->isSupervisor($user)) {
            abort(403);
        }

        Comment::create([
            'project_id' => $project->id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Commentaire ajouté avec succès.');
    }

    /**
     * Remove the specified comment.
     */
    public function destroy(Comment $comment)
    {
        // Seul l'auteur ou un admin peut supprimer
        if ($comment->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Commentaire supprimé avec succès.');
    }
}
