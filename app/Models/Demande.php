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

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class, 'matricule_enseignant', 'matricule');
    }

        public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

        public function salle()
    {
        return $this->belongsTo(Salle::class, 'id_salle', 'id_salle');
    }

        public function materiel()
    {
        return $this->belongsTo(Materiel::class, 'id_materiel', 'id_materiel');
    }

}
