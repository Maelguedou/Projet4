<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EnseignantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliverableController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Demande;
use App\Models\Salle;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Route::get('home', function () {
    return view('home');
});

Route::get('home2', [SalleController::class,'index']
)->name('home2');

Route::middleware(['auth', 'verified'])->group(function()
{ 
    Route::get('home3', function () {
        return view('Module3/home');
    })->name('home3');

  Route::prefix('module3')->group(function () {
    // Dashboard
    Route::get('/dashboard3', [DashboardController::class, 'index'])->name('dashboard3');
    
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
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/demandes', [DemandeController::class, 'index'])->name('demandes.index');
Route::get('/demandes/create', [DemandeController::class, 'create'])->name('demandes.create');
Route::post('/demandes', [DemandeController::class, 'store'])->name('demandes.store');

Route::middleware(['auth','role:enseignant','block'])->group(function(){
    Route::get('/enseignant/dashboard', [EnseignantController::class, 'dashboard'])->name('enseignant.dashboard');
    Route::resource('demandes', DemandeController::class);});

Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');
    Route::get('/admin/create-teacher', [AdminController::class, 'Create'])->name('admin.create-teacher');
    Route::post('/admin/create-teacher', [AdminController::class, 'Store'])->name('admin.store-teacher');
    Route::post("/users/block",[AdminController::class,"block"])->name("block");
    Route::post("/users/unblock",[AdminController::class,"unblock"])->name("unblock");
    Route::delete('/enseignants/{id}', [AdminController::class, 'destroy'])->name('destroy');
    Route::post('/demandes/assign-salle', [AdminController::class, 'assignSalle'])->name('assignSalle');
    Route::post('/demandes/assign-materiel', [AdminController::class, 'assignMateriel'])->name('assignMateriel');
    Route::post('/admin/store-salle', [SalleController::class,'store'])->name('sallestore');
    Route::post('/admin/store-materiel', [MaterielController::class,'store'])->name('materielstore');
    Route::get('/admin/create-salle', [SalleController::class,'create'])->name('admin.create-salle');
    Route::get('/admin/create-materiel', [MaterielController::class,'create'])->name('admin.create-materiel');
    Route::post('/reject-demande/{id}', [AdminController::class, 'rejectDemande'])->name('rejet');
        

});





require __DIR__.'/auth.php';
