<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = ['libelle', 'filiere_option_id', 'year'];  // Utilisez les vrais champs

    public function filiereOption(): BelongsTo
    {
        return $this->belongsTo(FiliereOption::class, 'filiere_option_id');  // Relation avec FiliereOption (ajustez le modèle si nécessaire)
    }
}