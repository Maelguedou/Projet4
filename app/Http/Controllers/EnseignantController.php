<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Demande;
class EnseignantController extends Controller
{
    public function dashboard() {
        $demande_acepte=Demande::where('statut','=','acceptee')->whereMonth('created_at',now()->month)->whereYear('created_at', now()->year)->count();
        $demande_attent=Demande::where('statut','=','en_attente')->count();
        $demande_rejete=Demande::where('statut','=','refusee')->whereMonth('created_at',now()->month)->whereYear('created_at', now()->year)->count();

        return view ('enseignant.dashboard', compact('demande_acepte','demande_attent','demande_rejete'));
    }
}
