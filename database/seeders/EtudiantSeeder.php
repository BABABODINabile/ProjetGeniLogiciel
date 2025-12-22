<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Etudiant;
use App\Models\Promotion;
use App\Models\FiliereOption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EtudiantSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            // Création du compte utilisateur
            $user = User::create([
                'email' => "etudiant$i@test.com",
                'password' => Hash::make('password'),
                'role' => 'etudiant',
                'is_active' => true,
            ]);

            // Création du profil étudiant associé
            Etudiant::create([
                'user_id' => $user->id,
                'matricule' => 'MAT-' . Str::upper(Str::random(5)),
                'nom' => "NomEtudiant$i",
                'prenom' => "Prenom$i",
                'date_naissance' => '2000-01-01',
                'sexe' => $i % 2 == 0 ? 'M' : 'F',
                'promotion_id' => Promotion::inRandomOrder()->first()->id,
                'filiere_option_id' => FiliereOption::inRandomOrder()->first()->id,
            ]);
        }
    }
}