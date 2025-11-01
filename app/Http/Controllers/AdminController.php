<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view("admin.dashboard");
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
     
    return redirect()->route('admin.dashboard')->with('success', 'Enseignant créé avec succès.');
    
    }
}
