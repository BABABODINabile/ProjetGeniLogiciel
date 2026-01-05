<?php

namespace Database\Seeders;

use App\Models\Travail;
use App\Models\Espace;
use App\Models\Formateur;
use Illuminate\Database\Seeder;

class TravailSeeder extends Seeder
{
    public function run(): void
    {
        $espaces = Espace::all();

        foreach ($espaces as $index => $espace) {
            Travail::create([
                'titre' => "Devoir n°" . ($index + 1) . " - " . $espace->nom,
                'consigne' => "Veuillez réaliser le travail pratique concernant le chapitre " . ($index + 1),
                'type' => $index % 2 == 0 ? 'individuel' : 'collectif',
                'espace_id' => $espace->id,
                'formateur_id' => $espace->formateur->id,
                'statut' => 'en_cours',
            ]);
        }
    }
}