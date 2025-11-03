<?php

namespace Database\Seeders;

use App\Models\Materiel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Materiel::create([
        'nom'=>"Projecteur",
        "numero"=> "1",
        "type"=> "projecteur",
        "statut"=> "libre",
       ]);
        Materiel::create([
        'nom'=>"Projecteur",
        "numero"=> "2",
        "type"=> "projecteur",
        "statut"=> "libre",
       ]);

        Materiel::create([
        'nom'=>"Ordinateur",
        "numero"=> "1",
        "type"=> "projecteur",
        "statut"=> "occupee",
       ]);
       
    }
}
       