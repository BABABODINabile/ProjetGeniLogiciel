<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call([
        FiliereOptionSeeder::class,
        PromotionSeeder::class,
        MatiereSeeder::class,
        EtudiantSeeder::class,
        FormateurSeeder::class,
        AdministrationSeeder::class,
        EspaceSeeder::class,
        
        // Seeders de liaison (Pivots)
        EspaceEtudiantSeeder::class,   // Inscription des élèves aux cours
        FormateurMatiereSeeder::class, // Compétences des formateurs
        
        TravailSeeder::class,
        AssignationSeeder::class,
        LivraisonSeeder::class,
        EvaluationSeeder::class,
    ]);
    }
}
