<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Besoin extends Model
{
    use HasFactory;

    protected $fillable = [
        'demande_id',
        'projecteur',
        'ordinateur',
        'haut_parleur',
        'autre',
    ];

    protected $casts = [
        'projecteur' => 'boolean',
        'ordinateur' => 'boolean',
        'haut_parleur' => 'boolean',
    ];

    public function demande()
    {
        return $this->belongsTo(Demande::class, 'demande_id');
    }
}
