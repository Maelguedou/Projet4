<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    protected $table = 'demandes';
    protected $primaryKey = 'id_demande';
    protected $fillable = [
        'type',
        'besoin',
        'matricule_enseignant',
        'id_admin',
        'id_salle',
        'id_materiel',
        'classe',
        'date_demande',
        'statut'
    ];
}
