<?php

namespace Database\Seeders;

use App\Models\Matiere;
use Illuminate\Database\Seeder;

class MatiereSeeder extends Seeder
{
    public function run(): void
    {
        $matieres = [
            'Algorithmique Avancée',
            'Base de Données Relationnelles',
            'Architecture des Réseaux',
            'Développement Web Laravel',
            'Gestion de Projet Agile'
        ];

        foreach ($matieres as $libelle) {
            Matiere::create(['libelle' => $libelle]);
        }
    }
}