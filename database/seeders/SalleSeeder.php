<?php

namespace Database\Seeders;

use App\Models\Salle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Salle::create([
            'nom' => 'Iran2',
            'localisation'=>'adresse',
            'statut'=>'libre',
        ]);
        Salle::create([
            'nom' => 'Iran1',
            'localisation'=>'adresse1',
            'statut'=>'libre',
        ]);
        Salle::create([
            'nom' => 'Padtice',
            'localisation'=>'adresse2',
            'statut'=>'libre',
        ]);
        Salle::create([
            'nom' => 'Fakambi',
            'localisation'=>'adresse3',
            'statut'=>'occupee',
        ]);
        Salle::create([
            'nom' => 'Nage',
            'localisation'=>'adresse4',
            'statut'=>'occupee',
        ]);

    }
}
// 'libre', 'occupee'