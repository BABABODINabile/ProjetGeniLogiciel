<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espace extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'description', 'matiere_id', 'promotion_id', 'formateur_id'];

    // Promotion associée à cet espace
    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class);
    }
    // Matière associée à cet espace
    public function matiere(): BelongsTo
    {
        return $this->belongsTo(Matiere::class);
    }

    public function formateur(): BelongsTo
    {
        return $this->belongsTo(Formateur::class);
    }

    // Étudiants inscrits spécifiquement à cet espace
    public function etudiants(): BelongsToMany
    {
        return $this->belongsToMany(Etudiant::class, 'espace_etudiant')->withTimestamps();
    }

    // Travaux publiés dans cet espace
    public function travails(): HasMany
    {
        return $this->hasMany(Travail::class);
    }
}
