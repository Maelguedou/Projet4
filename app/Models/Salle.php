<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    protected $table = 'salles';
    protected $primaryKey = 'id_salle';
    protected $fillable = ['nom', 'localisation', 'statut'];
}
