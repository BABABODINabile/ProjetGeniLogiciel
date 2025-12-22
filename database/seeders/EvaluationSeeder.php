<?php

namespace Database\Seeders;

use App\Models\Evaluation;
use App\Models\Livraison;
use Illuminate\Database\Seeder;

class EvaluationSeeder extends Seeder
{
    public function run(): void
    {
        $livraisons = Livraison::all();

        foreach ($livraisons as $livraison) {
            Evaluation::create([
                'livraison_id' => $livraison->id,
                'note' => rand(10, 20), // Note entre 10 et 20
                'points' => rand(50, 100), // Points sur une base de 100
                'commentaire' => "Bon travail, les objectifs sont atteints.",
            ]);
        }
    }
}
