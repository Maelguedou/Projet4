<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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
        $ref = now()->format('ymd') . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $request->validate([
            'time'=> 'required|integer',
            'type' => 'required|array|min:1',
            'type.*' => 'in:Salle,Materiel',
            'classe' => 'required|string|max:255',
            'autre_materiel' => 'nullable|string',
            'start'=>'required|date_format:Y-m-d\TH:i'
        ]
    );


        $columnMap = [
        'Projecteur'   => 'projecteur',
        'Ordinateur'   => 'ordinateur',
        'Haut-parleur' => 'haut_parleur',
         ];

        DB::beginTransaction();

        //Demande Salle (une seule ligne si demandée)
        if(in_array('Salle',$request->type)){
            $demande = Demande::create([
            'time'=>$request->input('time'), 
            'type' => 'Salle',
            'classe' => $request->classe,
            'user_id' => Auth::id(),
            'statut' => 'en_attente',
            'date_demande' => now(),
            'start' =>$request->input('start'),
            'ref'=>$ref
         ]);

        }
        // 2) Demandes Matériel : une demande par matériel sélectionné
        if(in_array('Materiel',$request->type)){
                $materiels = $request->input('materiels', []);

                 // remplacer 'Autre' par le texte si présent
                if (($key = array_search('Autre', $materiels)) !== false) {
                $autreText = trim($request->input('autre_materiel', ''));
               
                // si texte vide, garde 'Autre' sinon remplace par le texte
                $materiels[$key] = $autreText !== '' ? $autreText : 'Autre';    
                }
            foreach($materiels as $materiel){
                $demande=Demande::create([
                        'time'=>$request->input('time'), 
                        'type' =>'Materiel',
                        'classe' => $request->classe,
                        'user_id' => Auth::id(),
                        'statut' => 'en_attente',
                        'date_demande' => now(),
                        'start' =>$request->input('start'),
                        'ref'=>$ref,
                ]);
                // initialise toutes les colonnes booléennes à 0
                $besoinData = [
                    'demande_id' => $demande->id,
                    // initialise explicitement les colonnes existantes
                    'projecteur' => 0,
                    'ordinateur' => 0,
                    'haut_parleur' => 0,
                    'autre' => null,
                ];

                // Si le matérial correspond à une colonne connue, active-la
                $foundColumn = false;
                foreach ($columnMap as $label => $col) {
                    if (strcasecmp($materiel, $label) === 0) {
                        $besoinData[$col] = 1;
                        $foundColumn = true;
                        break;
                    }
                }

                // Si c'est un texte libre (autre), on remplit la colonne 'autre'
                if (!$foundColumn) {
                    // si tu as une colonne bool 'autre' + une colonne texte 'autre_text', adapte ici
                    $besoinData['autre'] = $materiel;
                }
                Besoin::create($besoinData);
            }    
        }

        DB::commit();
        return redirect()->route('demandes.index')->with('success', 'Demande(s) créée(s) avec succès.');
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
