<?php

namespace Database\Seeders;

use App\Models\Espace;
use App\Models\Etudiant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspaceEtudiantSeeder extends Seeder
{
    public function run(): void
    {
        $espaces = Espace::all();
        $etudiants = Etudiant::all();

        foreach ($espaces as $espace) {
            // On attache 3 étudiants aléatoires à chaque espace
            $espace->etudiants()->attach(
                $etudiants->random(3)->pluck('id')->toArray()
            );
        }
    }
}
