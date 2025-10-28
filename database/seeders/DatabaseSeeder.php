<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Deliverable;
use App\Models\Evaluation;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer un admin
        $admin = User::create([
            'name' => 'Admin CampusConnect',
            'email' => 'admin@campus.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Créer des enseignants
        $enseignant1 = User::create([
            'name' => 'Dr. Marie Dupont',
            'email' => 'marie.dupont@campus.com',
            'password' => Hash::make('password'),
            'role' => 'enseignant',
            'matricule' => 'ENS001',
            'phone' => '0601020304',
        ]);

        $enseignant2 = User::create([
            'name' => 'Prof. Jean Martin',
            'email' => 'jean.martin@campus.com',
            'password' => Hash::make('password'),
            'role' => 'enseignant',
            'matricule' => 'ENS002',
            'phone' => '0601020305',
        ]);

        // Créer des étudiants
        $etudiant1 = User::create([
            'name' => 'Alice Bernard',
            'email' => 'alice.bernard@campus.com',
            'password' => Hash::make('password'),
            'role' => 'etudiant',
            'matricule' => 'ETU001',
            'phone' => '0601020306',
        ]);

        $etudiant2 = User::create([
            'name' => 'Bob Durand',
            'email' => 'bob.durand@campus.com',
            'password' => Hash::make('password'),
            'role' => 'etudiant',
            'matricule' => 'ETU002',
            'phone' => '0601020307',
        ]);

        $etudiant3 = User::create([
            'name' => 'Claire Petit',
            'email' => 'claire.petit@campus.com',
            'password' => Hash::make('password'),
            'role' => 'etudiant',
            'matricule' => 'ETU003',
            'phone' => '0601020308',
        ]);

        $etudiant4 = User::create([
            'name' => 'David Moreau',
            'email' => 'david.moreau@campus.com',
            'password' => Hash::make('password'),
            'role' => 'etudiant',
            'matricule' => 'ETU004',
            'phone' => '0601020309',
        ]);

        // Créer des projets
        $project1 = Project::create([
            'title' => 'Système de Gestion de Bibliothèque',
            'description' => 'Développement d\'une application web pour gérer les emprunts et retours de livres dans une bibliothèque universitaire.',
            'start_date' => now()->subDays(30),
            'end_date' => now()->addDays(30),
            'supervisor_id' => $enseignant1->id,
            'status' => 'en_cours',
        ]);

        $project1->members()->attach($etudiant1->id, ['role' => 'chef']);
        $project1->members()->attach($etudiant2->id, ['role' => 'membre']);

        $project2 = Project::create([
            'title' => 'Application Mobile de Suivi Sportif',
            'description' => 'Création d\'une application mobile permettant aux utilisateurs de suivre leurs activités sportives et leurs performances.',
            'start_date' => now()->subDays(20),
            'end_date' => now()->addDays(40),
            'supervisor_id' => $enseignant2->id,
            'status' => 'en_cours',
        ]);

        $project2->members()->attach($etudiant3->id, ['role' => 'chef']);
        $project2->members()->attach($etudiant4->id, ['role' => 'membre']);

        $project3 = Project::create([
            'title' => 'Plateforme E-learning',
            'description' => 'Développement d\'une plateforme d\'apprentissage en ligne avec gestion de cours, quiz et suivi de progression.',
            'start_date' => now()->subDays(10),
            'end_date' => now()->addDays(50),
            'supervisor_id' => $enseignant1->id,
            'status' => 'en_attente',
        ]);

        $project3->members()->attach($etudiant1->id, ['role' => 'chef']);
        $project3->members()->attach($etudiant3->id, ['role' => 'membre']);

        // Créer des commentaires
        Comment::create([
            'project_id' => $project1->id,
            'user_id' => $enseignant1->id,
            'content' => 'Bon début ! N\'oubliez pas de documenter votre code.',
        ]);

        Comment::create([
            'project_id' => $project1->id,
            'user_id' => $etudiant1->id,
            'content' => 'Merci pour le retour ! Nous allons améliorer la documentation.',
        ]);

        Comment::create([
            'project_id' => $project2->id,
            'user_id' => $enseignant2->id,
            'content' => 'Pensez à intégrer les tests unitaires dès le début.',
        ]);

        // Créer une évaluation
        Evaluation::create([
            'project_id' => $project1->id,
            'evaluator_id' => $enseignant1->id,
            'note' => 15.5,
            'comment' => 'Bon travail dans l\'ensemble. L\'interface est intuitive et le code est bien structuré.',
        ]);

        $this->command->info('Base de données peuplée avec succès !');
        $this->command->info('Comptes créés :');
        $this->command->info('Admin: admin@campus.com / password');
        $this->command->info('Enseignant 1: marie.dupont@campus.com / password');
        $this->command->info('Enseignant 2: jean.martin@campus.com / password');
        $this->command->info('Étudiant 1: alice.bernard@campus.com / password');
        $this->command->info('Étudiant 2: bob.durand@campus.com / password');
        $this->command->info('Étudiant 3: claire.petit@campus.com / password');
        $this->command->info('Étudiant 4: david.moreau@campus.com / password');
    }
}
