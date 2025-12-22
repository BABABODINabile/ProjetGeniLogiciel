<?php
namespace Database\Seeders;

use App\Models\Espace;
use App\Models\Matiere;
use App\Models\Promotion;
use App\Models\Formateur;
use Illuminate\Database\Seeder;

class EspaceSeeder extends Seeder
{
    public function run(): void
    {
        $matieres = Matiere::all();
        $promotions = Promotion::all();
        $formateurs = Formateur::all();

        for ($i = 0; $i < 5; $i++) {
            $matiere = $matieres[$i];
            $promotion = $promotions[$i];
            $formateur = $formateurs[$i];

            Espace::create([
                'nom' => "Cours de " . $matiere->libelle,
                'description' => "Espace dédié au module " . $matiere->libelle . " pour la " . $promotion->libelle,
                'matiere_id' => $matiere->id,
                'promotion_id' => $promotion->id,
                'formateur_id' => $formateur->id,
            ]);
        }
    }
}