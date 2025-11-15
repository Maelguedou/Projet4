<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Besoin;
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
        $demandes = Demande::with('besoin')->where('user_id', Auth::id())->orderByDesc('date_demande')->latest()->get();

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
            'time'=> 'required|integer',
            'type' => 'required|array|min:1',
            'type.*' => 'in:Salle,Materiel',
            'classe' => 'required|string|max:255',
            'autre_materiel' => 'nullable|string',
            'start'=>[
                'required',
                'date_format:H:i',
                function($attribute,$value,$fail){
                    $heure= \Carbon\Carbon::createFromFormat('H:i',$value);
                    $min   = \Carbon\Carbon::createFromTime(8, 0, 0);
                    $max   = \Carbon\Carbon::createFromTime(17, 0, 0);
                    if($heure->lt($min) || $heure->gt($max)){
                         $fail('L\'heure doit être comprise entre 08:00 et 17:00.');
                    }                                                                       
                }
            ]
        ],[
                'heure_debut.required' => 'Vous devez renseigner une heure de début.',
                'heure_debut.date_format' => 'Le format doit être HH:MM (ex : 14:30).',
    ]
    );


        $demande = Demande::create([
            'time'=>$request->input('time'), 
            'type' => implode(', ', $request->type),
            'classe' => $request->classe,
            'user_id' => Auth::id(),
            'statut' => 'en_attente',
            'date_demande' => now(),
            'start' =>$request->input('start')
        ]);


        //création du besoin associé(si marériel choisi)
        if (in_array('Materiel', $request->type)) {
            Besoin::create([
                'demande_id'   => $demande ->id,
                'projecteur'   => $request ->has('projecteur'),
                'ordinateur'   => $request ->has('ordinateur'),
                'haut_parleur' => $request ->has('haut_parleur'),
                'autre'        => $request ->input('autre_materiel'),

            ]);
        }


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
