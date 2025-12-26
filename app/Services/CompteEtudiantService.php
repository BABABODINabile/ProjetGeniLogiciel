<?php

namespace App\Services;

use App\Models\Espace;
use App\Models\Etudiant;
use App\Models\Promotion;
use Illuminate\Support\Facades\DB;
use Exception;

class CompteEtudiantService
{
    /**
     * Mes espaces en tant qu'étudiant
     */

    public function getMySpace($etudiantId)
    {
        $etudiant=Etudiant::with(['promotion'])->findOrFail($etudiantId);
        return $etudiant->espaces;
    }
}