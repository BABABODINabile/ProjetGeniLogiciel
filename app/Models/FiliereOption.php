<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FiliereOption extends Model
{
    use HasFactory;

    public function etudiants(): HasMany
    {
        return $this->hasMany(Etudiant::class);
    }

}
