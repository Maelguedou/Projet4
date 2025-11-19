<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'matricule'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function demandes()
    {
        return $this->hasMany(Demande::class, 'user_id');
    }



     public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Vérifie si l'utilisateur est un enseignant
     */
    public function isEnseignant(): bool
    {
        return $this->role === 'enseignant';
    }

    /**
     * Vérifie si l'utilisateur est un étudiant
     */
    public function isEtudiant(): bool
    {
        return $this->role === 'etudiant';
    }

    /**
     * Projets supervisés par l'enseignant
     */
    public function supervisedProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'supervisor_id');
    }

    /**
     * Projets auxquels l'utilisateur participe en tant que membre
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_members')
            ->withPivot('role')
            ->withTimestamps();
    }

    /**
     * Livrables déposés par l'utilisateur
     */
    public function deliverables(): HasMany
    {
        return $this->hasMany(Deliverable::class);
    }

    /**
     * Commentaires postés par l'utilisateur
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Évaluations faites par l'enseignant
     */
    public function evaluations(): HasMany
    {
        return $this->hasMany(Evaluation::class, 'evaluator_id');
    }

    /**
     * Demandes de réservation faites par l'utilisateur (Module 2)
     */
  

    



}
