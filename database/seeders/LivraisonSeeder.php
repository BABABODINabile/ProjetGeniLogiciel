<?php

namespace Database\Seeders;

use App\Models\Livraison;
use App\Models\Assignation;
use Illuminate\Database\Seeder;

class LivraisonSeeder extends Seeder
{
    public function run(): void
    {
        $assignations = Assignation::all();

        foreach ($assignations as $assignation) {
            Livraison::create([
                'assignation_id' => $assignation->id,
                'contenu' => "Lien vers le dépôt Git ou contenu textuel du devoir pour l'assignation #" . $assignation->id,
            ]);
        }
    }
}
