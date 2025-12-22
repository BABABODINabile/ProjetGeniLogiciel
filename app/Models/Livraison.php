<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;
    protected $fillable = ['assignation_id', 'contenu'];

    public function evaluation() {
        return $this->hasOne(Evaluation::class);
    }
}
