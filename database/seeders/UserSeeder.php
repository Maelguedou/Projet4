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
            'is_block'=>0
        ]);
    }
    
}
