<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Formateur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FormateurSeeder extends Seeder
{
    public function run(): void
    {
        $specialites = ['Informatique', 'Mathématiques', 'Gestion', 'Droit', 'Anglais'];

        for ($i = 0; $i < 5; $i++) {
            $user = User::create([
                'email' => "formateur" . ($i+1) . "@test.com",
                'password' => Hash::make('password'),
                'role' => 'formateur',
                'is_active' => true,
            ]);

            Formateur::create([
                'user_id' => $user->id,
                'nom' => "NomFormateur" . ($i+1),
                'prenom' => "Prenom",
                'specialite' => $specialites[$i],
            ]);
        }
    }
}
