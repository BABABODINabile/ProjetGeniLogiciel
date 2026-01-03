<?php

namespace App\Services;

use App\Models\User;
use App\Models\Formateur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Notifications\WelcomeFormateurNotification;
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
     * Récupérer un formateur par son ID
     */
    public function getFormateurById($id)
    {
        return Formateur::with(['user'])->findOrFail($id);
    }

    /**
     * Créer un formateur et le compte utilisateur (transactionnel)
     */
    public function createFormateur(array $data)
    {
        return DB::transaction(function () use ($data) {
            $temporaryPassword = Str::random(10);

            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($temporaryPassword),
                'role' => 'formateur',
                'is_active' => $data['is_active'] ?? true,
            ]);

            $formateur = $user->formateur()->create([
                'nom' => $data['nom'] ?? null,
                'prenom' => $data['prenom'] ?? null,
                'specialite' => $data['specialite'] ?? null,
            ]);

            // Envoi notification
            try {
                $user->notify(new WelcomeFormateurNotification($temporaryPassword));
            } catch (Exception $e) {
                // Ne pas rollback l'opération si l'envoi d'email échoue ; on peut logger si besoin
            }

            return $formateur;
        });
    }

    /**
     * Mettre à jour un formateur et son email/mot de passe utilisateur
     */
    public function updateFormateur($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $formateur = Formateur::findOrFail($id);
            $user = $formateur->user;

            if (!empty($data['email'])) {
                $user->update(['email' => $data['email']]);
            }

            if (!empty($data['password'])) {
                $user->update(['password' => Hash::make($data['password'])]);
            }

            $formateur->update($data);

            return $formateur->fresh();
        });
    }

    /**
     * Supprimer un formateur et son compte utilisateur
     */
    public function deleteFormateur($id)
    {
        return DB::transaction(function () use ($id) {
            $formateur = Formateur::findOrFail($id);
            $user = $formateur->user;

            $formateur->delete();
            $user->delete();

            return true;
        });
    }

}