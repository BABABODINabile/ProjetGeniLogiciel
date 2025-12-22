<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Administration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministrationSeeder extends Seeder
{
    public function run(): void
    {
        $fonctions = ['Directeur', 'Secrétaire', 'Comptable', 'Scolarité', 'Ressources Humaines'];

        for ($i = 0; $i < 5; $i++) {
            $user = User::create([
                'email' => "admin" . ($i+1) . "@test.com",
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
            ]);

            Administration::create([
                'user_id' => $user->id,
                'nom' => "NomAdmin" . ($i+1),
                'prenom' => "Prenom",
                'fonction' => $fonctions[$i],
            ]);
        }
    }
}