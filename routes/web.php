<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EnseignantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function () {
    return view('home');
});

Route::get('home2', function () {
    return view('Module2/home');
})->name('home2');

Route::get('home3', function () {
    return view('Module3/home');
})->name('home3');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/admin/create-teacher', [AdminController::class, 'Create'])->name('admin.create-teacher');
    Route::post('/admin/create-teacher', [AdminController::class, 'Store'])->name('admin.store-teacher');
});

Route::middleware(['auth','role:enseignant'])->group(function(){
    Route::get('/enseignant/dashboard', [EnseignantController::class,'dashboard'])->name('enseignant.dashboard');
});

require __DIR__.'/auth.php';
