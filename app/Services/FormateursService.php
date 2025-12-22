<?php

namespace App\Services;

use App\Models\User;
use App\Models\Formateur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

class FormateursService
{

     /**
     * Récupérer tous les formateurs avec leurs relations
     */
    public function getAllFormateurs()
    {
        return Formateur::with(['user'])->latest()->get();
    }

}