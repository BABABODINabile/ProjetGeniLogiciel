<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    protected $fillable = [
        'livraison_id',
        'note',
        'points',
        'commentaire'
    ];

    /**
     * Accède à la livraison associée à cette évaluation.
     */
    public function livraison(): BelongsTo
    {
        return $this->belongsTo(Livraison::class);
    }
}
