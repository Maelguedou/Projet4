<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Attribution;
use App\Models\Demande;
use DB;
use Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Salle;
use App\Models\Materiel;
use App\Models\Besoin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;




class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::where("role","=","enseignant")->get();
        // toutes les demandes contenant 'Salle'
        $salleneeds=Demande::with('user')->whereJsonContains("type","Salle")->where('statut','en_attente')->get();
        $materielneeds=Demande::with('user')->whereJsonContains("type","Materiel")->where('statut','en_attente')->get();
        $besoins=Besoin::all();
        // toutes les demandes contenant 'Materiel'
        $materiels=Demande::whereJsonContains("type","Materiel")->get();
        $freesalles=Salle::where("statut" ,"=","libre")->get();
        $freemateriels=Materiel::where('statut','=','libre')->get();

        
        return view("admin/dashboard", compact("users","salleneeds","freesalles","materielneeds","freemateriels","besoins"));
    }

    public function Create(){
        return view("admin.create-teacher");
    }

    public function Store(Request $request){
        
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'matricule'=>'required|integer|min:10000|unique:users'
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'enseignant', // le rôle "enseignant" est fixé automatiquement
        'matricule'=>$request->matricule,
    ]);
     
    return redirect()->route('dashboard')->with('success', 'Enseignant créé avec succès.');
    
    }
    //Fonction pour bloquer un utilisateur
    public function block(Request $request)
    {
        $request->validate(['id' => 'required|exists:users,id']);

        $user = User::find($request->id);
        $user->is_block = true;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'User has been blocked.'
        ]);
    }
    //Fonction pour débloquer un utilisateur
    public function unblock(Request $request)
    {
        $request->validate(['id'=> 'required|exists:users,id']);

        $user = User::find($request->id);
        $user->is_block = false;
        $user->save();
        return response()->json([
            'status'=> 'success',
            'message'=> 'User has been unblocked.'
        ]);
    }

    //Fonction pour valider l'attribution de salles
    public function assignSalle(Request $request)
    {
        //les salles choisies
        $Salles=$request->input('salles');

        //Verifier que les salles voulant être attribuer sont distinctes

        $salleIds = array_values($Salles);// on récupère uniquement les valeurs
        if(count($salleIds) !== count(array_unique($salleIds))) {
            return back()->withErrors(['message'=>'Une même salle a été sélectionnée plusieurs fois.']);
        }

        foreach($Salles as $demandeId => $salleId) {
            $demande=Demande::find($demandeId);
            $salle=Salle::find($salleId);
            if ($demande && $salle && $salle->statut=='libre') {
                //Attribuer la salle
                $demande->id_salle=$salle->id_salle;
                $demande->admin_id= Auth::id();
                $demande->statut= 'acceptee';
                $demande->date_demande = now(); // moment de l’approbation
                $demande->save();
                //Marquer la salle comme occupée
                $salle->statut= 'occupee';
                $salle->save();
            }
        }
        return redirect()->back()->with('success', 'Salles attribuées avec succès !');
    }

    //Fonction pour valider l'attribution d'un materiel
    public function assignMateriel(Request $request)
    {
    
        //les salles choisies
        $materiels=$request->input('materiel');
        
        //Verifier que les salles voulant être attribuer sont distinctes
       
        $materielIds = array_values($materiels);// on récupère uniquement les valeurs
        if(count($materielIds) !== count(array_unique($materielIds))) {
            return back()->withErrors(['message'=>'Un même matériel a été sélectionné plusieurs fois.']);
           
        }

        foreach($materiels as $demandeId => $materielId) {
            $demande=Demande::find($demandeId);
            $materiel=Materiel::find($materielId);
           
            if ($demande && $materiel && $materiel->statut=='libre') {
                //Attribuer la salle
                $demande->id_materiel=$materiel->id_materiel;
                $demande->admin_id= Auth::id();
                $demande->statut= 'acceptee';
                
                $demande->date_demande = now(); // moment de l’approbation
                $demande->save();
                //Marquer la salle comme occupée
                $materiel->statut= 'occupee';
                $materiel->save();
            }
        }
        return redirect()->back()->with('success', 'Matériaux attribués avec succès !');
    }
    

    //Fonction pour supprimé un enseignant
    public function destroy($id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success','Enseignant supprimé');
    }
}
