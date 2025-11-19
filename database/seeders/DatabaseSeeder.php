<?php

namespace Database\Seeders;

use App\Models\Enseignant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $etudiant1 = User::create([
            'name' => 'Alice Bernard',
            'email' => 'alice.bernard@campus.com',
            'password' => Hash::make('password'),
            'role' => 'etudiant',
            'matricule' => '00155565',
            'phone' => '0601020306',
        ]);

        
    }
}
