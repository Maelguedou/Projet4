<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Demande;
use App\Models\Enseignant;
use App\Models\Materiel;
use App\Models\Salle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $demandes = Demande::with(['salle', 'materiel', 'user'])->get();

        return view('demandes.index', compact('demandes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $salles = Salle::all();
        $materiels = Materiel::all();

        return view('demandes.create', compact('salles', 'materiels')); //le dossier demandes dans resources/views
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valids = $request->validate([
            'type' => 'required',
            'besoin' => 'required',
            'classe' => 'required',
        ]);

        $valids['user_id'] = Auth::id();
        $valids['statut'] = 'en_attente';
        $valids['date_demande'] = now();
        Demande::create($valids);

        return redirect()->route('demandes.index')->with('success', 'Demande envoyée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
