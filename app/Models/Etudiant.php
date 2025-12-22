<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'promotion_id', 'filiere_option_id', 'matricule', 'nom', 'prenom', 'date_naissance', 'sexe'];

    // Relation inverse vers le compte utilisateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Inscription manuelle aux espaces pédagogiques (Table Pivot)
    public function espaces(): BelongsToMany
    {
        return $this->belongsToMany(Espace::class, 'espace_etudiant')->withTimestamps();
    }

    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class);
    }

    public function filiere_option():BelongsTo
    {
        return $this->belongsTo(FiliereOption::class);
    }

}
