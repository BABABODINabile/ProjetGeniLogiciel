<?php

namespace Database\Seeders;

use App\Models\Assignation;
use App\Models\Travail;
use App\Models\Etudiant;
use App\Models\Promotion;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AssignationSeeder extends Seeder
{
    public function run(): void
    {
        $travails = Travail::all();
        $etudiants = Etudiant::all();
        $promotions = Promotion::all();

        foreach ($travails as $index => $travail) {
            Assignation::create([
                'travail_id' => $travail->id,
                // Si individuel, on lie à un étudiant, sinon à une promotion
                'etudiant_id' => $travail->type === 'individuel' ? $etudiants->random()->id : null,
                'promotion_id' => $travail->type !== 'individuel' ? $promotions->random()->id : null,
                'groupe_id' => null, // À remplir si tu as déjà créé le GroupeSeeder
                'date_debut' => Carbon::now(),
                'date_fin' => Carbon::now()->addDays(7),
            ]);
        }
    }
}
