<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travail extends Model
{
    use HasFactory;
    protected $fillable = ['titre', 'consigne', 'type', 'espace_id','formateur_id','statut'];

    // Travail appartient à un Espace
    public function espace(): BelongsTo
    {
        return $this->belongsTo(Espace::class);
    }


    public function assignations(): HasOne
    {
        return $this->hasOne(Assignation::class);
    }

     public function formateur(): BelongsTo
    {
        return $this->belongsTo(Formateur::class);
    }
}
