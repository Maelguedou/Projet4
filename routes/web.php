<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EnseignantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\SalleController;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Demande;
use App\Models\Salle;
Route::get('/', function () {
    return view('welcome');
});



Route::get('home', function () {
    return view('home');
});

Route::get('home2', [SalleController::class,'index']
)->name('home2');

Route::get('home3', function () {
    return view('Module3/home');
})->name('home3');

/* Route::get('home2', function() {
    return view('Module2/home');
})->name('home2');
 */

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

});



require __DIR__.'/auth.php';
