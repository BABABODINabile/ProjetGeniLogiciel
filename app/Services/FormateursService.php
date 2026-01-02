<?php

namespace App\Services;

use App\Models\User;
use App\Models\Formateur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

class FormateursService
{
    /**
     * Récupérer tous les formateurs avec leurs relations
     */
    public function getAllFormateurs()
    {
        return Formateur::with(['user'])->latest()->get();
    }

    /**
     * Créer un nouveau formateur
     *
     * @param array $data
     * @return Formateur
     * @throws \Exception
     */
    public function createFormateur(array $data): Formateur
    {
        return DB::transaction(function () use ($data) {
            // Création de l'utilisateur
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'formateur',
                'is_active' => true
            ]);

            // Création du profil formateur
            $formateur = $user->formateur()->create([
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
                'specialite' => $data['specialite']
            ]);

            return $formateur->load('user');
        });
    }
}