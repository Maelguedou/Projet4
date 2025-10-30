<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';
    protected $primaryKey = 'id_admin';
    protected $fillable = ['nom', 'email', 'mot_de_passe'];

    public function demandes()
    {
        return $this->hasMany(Demande::class, 'id_admin', 'id_admin');
    }
}
