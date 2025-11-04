<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    protected $table = 'demandes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'type',
        'besoin',
        'matricule_enseignant',
        'admin_id',
        'id_salle',
        'id_materiel',
        'classe',
        'date_demande',
        'statut',
        'user_id',
    ];

    protected $dates = [
        'date_demande',
        'created_at',
        'updated_at'
    ];

    public function user()  {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function admin()  {
        return $this->belongsTo(User::class, 'admin_id');
    }
    
        public function salle()
    {
        return $this->belongsTo(Salle::class, 'id_salle', 'id_salle');
    }

        public function materiel()
    {
        return $this->belongsTo(Materiel::class, 'id_materiel', 'id_materiel');
    }

    public function besoin()
    {
        return $this->hasOne(Besoin::class, 'demande_id');
    }

    public function getFormattedDateAttributes() //format plus lisible de la date
    {
        return $this->date_demande ? $this->date_demande->format('d/m/Y H:i') : null;
    }
}
