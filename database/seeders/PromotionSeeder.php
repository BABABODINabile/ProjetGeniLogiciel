<?php
namespace Database\Seeders;

use App\Models\Promotion;
use App\Models\FiliereOption;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer les IDs des filières existantes
        $filiereIds = FiliereOption::pluck('id')->toArray();

        for ($i = 1; $i <= 5; $i++) {
            Promotion::create([
                'libelle' => "Promotion " . (2020 + $i),
                'filiere_option_id' => $filiereIds[array_rand($filiereIds)],
                'year' => 2020 + $i,
            ]);
        }
    }
}