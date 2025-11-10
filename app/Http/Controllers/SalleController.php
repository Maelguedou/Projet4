<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use App\Models\Salle;
use Illuminate\Http\Request;

class SalleController extends Controller
{
    public function index()
    {
        // return view("Module2/home");
        $salles = Salle::with('demandes')->orderBy("created_at","desc")->get();
        $materiels=Materiel::orderBy("created_at","desc")->get();
        return view("Module2/home", compact("salles","materiels"));
    }
    public function create()
    {
        return view("admin/create-salle");
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'localisation'=>'required|string|max:255',
            'statut'=>'required|string|max:255',
        ]);
        Salle::create([
            'nom'=>$request->nom,
            'localisation'=>$request->localisation,
            'statut'=>$request->statut
        ]);
        return redirect()->route('dashboard')->with('success', 'Salle créé avec succès.');
    }
}
