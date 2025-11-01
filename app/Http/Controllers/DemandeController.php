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
        $demandes = Demande::with(['salle', 'materiel', 'user'])->orderByDesc('date_demande')->get();

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
            'type' => 'required|array|min:1',
            'type.*' => 'in:Salle,Matériel',
            'besoin' => 'nullable|string',
            'classe' => 'required|string|max:255',
        ]);

        $type = implode(', ', $request->input('type')); //peut contenir salle ou matétiel

        if (in_array('Salle', $request->input('type')) && !in_array('Matériel', $request->input('type'))) {
            $besoin = "Rien à préciser";
        } else {
            $besoin = $request->input('besoin') ?: 'Non précisé';
        }

        $valids['type'] = $type;
        $valids['besoin'] = $besoin;
        //$valids['classe'] = $request->claase;
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
