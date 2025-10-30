<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $table = 'enseignants';
    protected $primaryKey = 'matricule';
    protected $fillable = ['nom', 'email', 'mot_de_passe'];
}
