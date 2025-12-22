<?php

namespace Database\Seeders;

use App\Models\FiliereOption;
use Illuminate\Database\Seeder;

class FiliereOptionSeeder extends Seeder
{
    public function run(): void
    {
        $options = [
            'Génie Logiciel',
            'Systèmes et Réseaux',
            'Cybersécurité',
            'Data Science',
            'Management Digital'
        ];

        foreach ($options as $option) {
            FiliereOption::create([
                'option' => $option
            ]);
        }
    }
}