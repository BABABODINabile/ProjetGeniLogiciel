<?php

namespace App\Services;

use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Support\Str;
use App\Notifications\WelcomeUserNotification;
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
            // 1. Générer un mot de passe provisoire aléatoire et sécurisé
            $temporaryPassword = Str::random(10);

            // 2. Création de l'utilisateur
            $user = User::create([
                'email' => $data['email'],
                // On utilise le mot de passe généré
                'password' => Hash::make($temporaryPassword),
                'role' => 'etudiant',
                'is_active' => $data['is_active'] ?? true,
            ]);

            // 3. Création du profil étudiant
            $etudiant = $user->etudiant()->create([
                'promotion_id'      => $data['promotion_id'],
                'filiere_option_id' => $data['filiere_option_id'],
                'matricule'         => $data['matricule'],
                'nom'               => $data['nom'],
                'prenom'            => $data['prenom'],
                'date_naissance'    => $data['date_naissance'],
                'sexe'              => $data['sexe'],
            ]);

            // 4. ENVOI DU MAIL : On envoie le mot de passe EN CLAIR à l'étudiant
            $user->notify(new WelcomeUserNotification($temporaryPassword));

            return $etudiant;
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

    /**
     * Envoyer manuellement les accès (mot de passe temporaire) à l'étudiant
     */
    public function sendCredentials($id)
    {
        return DB::transaction(function () use ($id) {
            $etudiant = Etudiant::findOrFail($id);
            $user = $etudiant->user;

            // Générer un mot de passe temporaire
            $temporaryPassword = Str::random(10);

            // Mettre à jour le mot de passe de l'utilisateur
            $user->update(['password' => Hash::make($temporaryPassword)]);

            // Envoyer la notification avec le mot de passe temporaire
            $user->notify(new WelcomeUserNotification($temporaryPassword));

            return true;
        });
    }
}