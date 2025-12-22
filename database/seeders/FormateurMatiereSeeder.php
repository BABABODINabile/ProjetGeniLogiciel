<?php
namespace Database\Seeders;

use App\Models\Formateur;
use App\Models\Matiere;
use Illuminate\Database\Seeder;

class FormateurMatiereSeeder extends Seeder
{
    public function run(): void
    {
        $formateurs = Formateur::all();
        $matieres = Matiere::all();

        foreach ($formateurs as $formateur) {
            // On attribue 2 matières aléatoires à chaque formateur
            // sync() est utilisé ici pour éviter les doublons avec l'index unique
            $formateur->matieres()->sync(
                $matieres->random(2)->pluck('id')->toArray()
            );
        }
    }
}