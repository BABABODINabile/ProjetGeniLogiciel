<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Livraison extends Model
{
    use HasFactory;
    protected $fillable = ['assignation_id', 'message','fichier_path'];

    public function evaluation() {
        return $this->hasOne(Evaluation::class);
    }

    public function assignations(): HasMany{
        return $this->hasMany(Assignation::class);
    }
}
