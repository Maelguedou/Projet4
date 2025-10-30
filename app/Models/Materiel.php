<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    protected $table = 'materiels';
    protected $primaryKey = 'id_materiel';
    protected $fillable = ['nom', 'numero', 'type', 'statut'];

    public function demandes()
    {
        return $this->hasMany(Demande::class, 'id_materiel', 'id_materiel');
    }
}
