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

        foreach ($assignations as $index => $assignation) {
            Livraison::create([
                'assignation_id' => $assignation->id,
                'fichier_path'   => ($index % 3 != 0) ? "livraisons/demo_file.pdf" : null, // 2 fois sur 3 un fichier
                'message'        => "Ceci est un message de test pour l'assignation #" . $assignation->id,
            ]);
        }
    }
}
