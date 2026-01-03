<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignation extends Model
{
    use HasFactory;
    protected $fillable = ['travail_id', 'etudiant_id', 'groupe_id', 'date_debut', 'date_fin'];

    public function travail(): BelongsTo
    {
        return $this->belongsTo(Travail::class);
    }

    public function livraison(): BelongsTo
    {
        return $this->belongsTo(Livraison::class);
    }

    public function etudiant(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class);
    }
}
