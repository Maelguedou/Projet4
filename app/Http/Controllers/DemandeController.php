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
        $demandes = Demande::with('besoin')->where('user_id', Auth::id())->orderByDesc('date_demande')->get();

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
        $request->validate([
            'type' => 'required|array|min:1',
            'type.*' => 'in:Salle,Matériel',
            'classe' => 'required|string|max:255',
            'autre_materiel' => 'nullable|string',
        ]);

        $besoins = [];

        //création du besoin associé(si marériel choisi)
        if (in_array('Matériel', $request->type)) {
            if ($request->has('projecteur')) {
                $besoins[] = 'Projecteur';
            }
            if ($request->has('ordinateur')) {
                $besoins[] = 'Ordinateur';
            }
            if ($request->has('haut_parleur')) {
                $besoins[] = 'Haut_parleur';
            }
            if ($request->filled('autre_materiel')) {
                $besoins[] = $request->input('autre_materiel');
            }
        }

        //dd($besoins);

        $demande = Demande::create([
            'type' => implode(', ', $request->type),
            'classe' => $request->classe,
            'user_id' => Auth::id(),
            'statut' => 'en_attente',
            'date_demande' => now(),
            'besoin' => json_encode($besoins),
        ]);

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
