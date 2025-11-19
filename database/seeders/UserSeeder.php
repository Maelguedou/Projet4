<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'name' => 'Admin',
            'email' => 'admin@laravel.com',
            'password' => Hash::make('123456'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Enseignant',
            'email' => 'enseignant@laravel.com',
            'password' => Hash::make('123456'),
            'role' => 'enseignant',
            'matricule'=>'20256767',
            'phone' => '0601020304',
            'is_block'=>0
        ]);

        User::create([
            'name' => 'Alice Bernard',
            'email' => 'alice.bernard@campus.com',
            'password' => Hash::make('password'),
            'role' => 'etudiant',
            'matricule' => '001',
            'phone' => '0601020306',
        ]);
    }
    
}
