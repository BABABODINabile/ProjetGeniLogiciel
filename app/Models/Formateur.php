<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'nom', 'prenom', 'specialite'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Matières que le formateur est habilité à enseigner
    public function matieres(): BelongsToMany
    {
        return $this->belongsToMany(Matiere::class, 'formateur_matiere');
    }

    // Espaces créés pour ce formateur
    public function espaces(): HasMany
    {
        return $this->hasMany(Espace::class);
    }

    public function travails(): HasMany
    {
        return $this->hasMany(Travail::class);
    }
}
