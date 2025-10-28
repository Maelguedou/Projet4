<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliverableController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Projects routes
    Route::resource('projects', ProjectController::class);

    // Deliverables routes
    Route::get('/projects/{project}/deliverables/create', [DeliverableController::class, 'create'])
        ->name('deliverables.create');
    Route::post('/deliverables', [DeliverableController::class, 'store'])
        ->name('deliverables.store');
    Route::get('/deliverables/{deliverable}/download', [DeliverableController::class, 'download'])
        ->name('deliverables.download');
    Route::patch('/deliverables/{deliverable}/status', [DeliverableController::class, 'updateStatus'])
        ->name('deliverables.updateStatus');
    Route::delete('/deliverables/{deliverable}', [DeliverableController::class, 'destroy'])
        ->name('deliverables.destroy');

    // Comments routes
    Route::post('/projects/{project}/comments', [CommentController::class, 'store'])
        ->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');

    // Evaluations routes
    Route::post('/projects/{project}/evaluation', [EvaluationController::class, 'store'])
        ->name('evaluations.store');
    Route::delete('/evaluations/{evaluation}', [EvaluationController::class, 'destroy'])
        ->name('evaluations.destroy');

    // Route de test pour vérifier l'authentification
    Route::get('/test-auth', function () {
        if (auth()->check()) {
            $user = auth()->user();
            return response()->json([
                'authenticated' => true,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ],
                'checks' => [
                    'isEtudiant' => $user->isEtudiant(),
                    'isEnseignant' => $user->isEnseignant(),
                    'isAdmin' => $user->isAdmin(),
                ],
                'can_create_project' => $user->isEtudiant(),
            ]);
        }

        return response()->json([
            'authenticated' => false,
            'message' => 'Non connecté',
        ]);
    });
});

require __DIR__.'/auth.php';
