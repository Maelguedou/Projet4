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
        $salles = Salle::orderBy("created_at","desc")->get();
        $materiels=Materiel::orderBy("created_at","desc")->get();
        return view("Module2/home", compact("salles","materiels"));
    }
}
