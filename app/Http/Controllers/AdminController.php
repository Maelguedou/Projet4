<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
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
    use AuthorizesRequests;
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

        
        return view("admin.dashboard", compact("users","salleneeds","freesalles","materielneeds","freemateriels","besoins"));
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
   
    // On récupère seulement la ligne envoyée
    $needId = $request->input('need_id');
    $salleId = $request->input('salle_id');

    // Vérifier que les deux champs existent
    if (!$needId || !$salleId) {
        return back()->with('error', 'Informations manquantes.');
    }

    $need = Demande::findOrFail($needId);
    $salle=Salle::findOrFail($salleId);
    // On affecte la salle
    $need->id_salle = $salleId;
    $need->statut = 'acceptee';
    $need->date_demande=now();
    $need->admin_id = Auth::id();
    $need->save();
    return back()->with('success', 'Salle attribuée avec succès.');
}


    //Fonction pour valider l'attribution d'un materiel
 public function assignMateriel(Request $request)
{
   
    // On récupère seulement la ligne envoyée
    $needId = $request->input('Mneed_id');
    $materielId = $request->input('materiel_id');
 
    // Vérifier que les deux champs existent
    if (!$needId || !$materielId ) {
        return back()->with('error', 'Informations manquantes.');
    }

    $need = Demande::findOrFail($needId);
    $materiel=Materiel::findOrFail($materielId);
  
    // On affecte la salle
    $need->id_materiel = $materielId ;
    $need->statut = 'acceptee';
    $need->date_demande=now();
    $need->admin_id = Auth::id();
    $need->save();

    return back()->with('success', 'Matériel attribué.');
}

    

    //Fonction pour supprimé un enseignant
    public function destroy($id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success','Enseignant supprimé');
    }

    //Fonction pour rejeter une demande
    public function rejectDemande(Request $request, $id)
    {
        $demande = Demande::findOrFail($id);
        $demande->statut = 'refusee';
        $demande->admin_id = Auth::id();
        $demande->save();

        return redirect()->back()->with('success', 'Demande rejetée.');
    }
}
