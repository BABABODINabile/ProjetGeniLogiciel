<?php

namespace App\Services;

use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

class EtudiantService
{
    /**
     * Récupérer tous les étudiants avec leurs relations
     */
    public function getAllStudents()
    {
        return Etudiant::with(['user', 'promotion','filiere_option'])->latest()->get();
    }

    /**
     * Récupérer un étudiant spécifique par son ID
     */
    public function getStudentById($id)
    {
        return Etudiant::with(['user', 'promotion', 'espaces'])->findOrFail($id);
    }

    /**
     * Créer un étudiant et son compte utilisateur (Transactionnel)
     */
    public function createStudent(array $data)
    {
        return DB::transaction(function () use ($data) {
            // 1. Création de l'utilisateur
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password'] ?? 'password123'),
                'role' => 'etudiant',
                'is_active' => $data['is_active'] ?? true,
            ]);

            // 2. Création du profil étudiant
            return $user->etudiant()->create([
                'promotion_id'      => $data['promotion_id'],
                'filiere_option_id' => $data['filiere_option_id'],
                'matricule'         => $data['matricule'],
                'nom'               => $data['nom'],
                'prenom'            => $data['prenom'],
                'date_naissance'    => $data['date_naissance'],
                'sexe'              => $data['sexe'],
            ]);
        });
    }

    /**
     * Mettre à jour un étudiant et son email (Transactionnel)
     */
    public function updateStudent($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $etudiant = Etudiant::findOrFail($id);
            $user = $etudiant->user;

            // Mise à jour de l'utilisateur si l'email change
            if (isset($data['email'])) {
                $user->update(['email' => $data['email']]);
            }

            // Mise à jour du mot de passe si fourni
            if (!empty($data['password'])) {
                $user->update(['password' => Hash::make($data['password'])]);
            }

            // Mise à jour du profil
            $etudiant->update($data);

            return $etudiant->fresh();
        });
    }

    /**
     * Supprimer un étudiant et son compte utilisateur
     */
    public function deleteStudent($id)
    {
        return DB::transaction(function () use ($id) {
            $etudiant = Etudiant::findOrFail($id);
            $user = $etudiant->user;

            $etudiant->delete(); // Supprime le profil
            $user->delete();     // Supprime le compte

            return true;
        });
    }
}