<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiel;
class MaterielController extends Controller
{
    public function create()
    {
        return view("admin/create-materiel");
    }

    public function store(Request $request)
    {
        $request->validate([
            "nom"=>'required|string|max:255',
            "numero"=>'required|integer',
            "type"=>'required|string|max:255',
            "statut"=>'required|string|max:255',
        ]);
        Materiel::create([
            "nom"=>$request->nom,
            "numero"=> $request->numero,
            "type"=> $request->type,
            "statut"=> $request->statut,
        ]);
        return redirect()->route('dashboard')->with('success', 'Materiel créé avec succès.');
    }
}
