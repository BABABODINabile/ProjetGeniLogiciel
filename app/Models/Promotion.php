<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = ['libelle', 'filiere_option_id', 'year'];  // Utilisez les vrais champs


    public function filiere_option(): BelongsTo
    {
        return $this->belongsTo(FiliereOption::class);
    }
    
}
