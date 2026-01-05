<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FiliereOption extends Model
{
    use HasFactory;

    protected $fillable = ['option'];  // Ajustez selon vos champs (ex. nom, description)

    public function etudiants(): HasMany
    {
        return $this->hasMany(Etudiant::class);  // Ajustez si nécessaire
    }
    public function promotions(): HasMany
    {
        return $this->hasMany(Promotion::class);
    }
    

    // Ajoutez d'autres relations si besoin, ex. promotions
    public function promotions(): HasMany
    {
        return $this->hasMany(Promotion::class);
    }
}