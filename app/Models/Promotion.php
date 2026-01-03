<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Promotion extends Model
{
    use HasFactory;


    public function etudiants() : HasMany
    {
        return $this->hasMany(Etudiant::class);
    }

    public function filiere_option(): BelongsTo
    {
        return $this->belongsTo(FiliereOption::class);
    }
    
}
