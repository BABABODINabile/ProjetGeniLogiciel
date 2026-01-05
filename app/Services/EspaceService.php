<?php

namespace App\Services;

use App\Models\Espace;
use App\Models\Promotion;
use Illuminate\Support\Facades\DB;
use Exception;

class EspaceService
{
    /**
     * Récupérer tous les espaces avec leurs relations
     */
    public function getAllEspaces()
    {
        // On récupère les relations nécessaires pour l'affichage
        return Espace::with(['matiere', 'promotion', 'formateur'])->latest()->get();
    }

    /**
     * Récupérer un espace spécifique par son ID
     */
    public function getEspaceById($id)
    {
        return Espace::with(['matiere', 'promotion', 'formateur', 'etudiants'])->findOrFail($id);
    }

    /**
     * Créer un espace (Promotion,Formateur optionnels)
     */
    public function createEspace(array $data)
    {
        return DB::transaction(function () use ($data) {
            // 1. Création de l'espace (les champs peuvent être nuls)
            $espace = Espace::create([
                'nom'          => $data['nom'],
                'description'  => $data['description'] ?? null,
                'matiere_id'   => $data['matiere_id'] ?? null,
                'promotion_id' => $data['promotion_id'] ?? null,
                'formateur_id' => $data['formateur_id'] ?? null,
            ]);

            // 2. Si une promotion est fournie à la création, on inscrit ses étudiants
            if (!empty($data['promotion_id'])) {
                $studentIds = Promotion::find($data['promotion_id'])
                    ->etudiants()
                    ->pluck('id');

                if ($studentIds->isNotEmpty()) {
                    $espace->etudiants()->attach($studentIds);
                }
            }

            return $espace;
        });
    }

    /**
     * Mettre à jour un espace pédagogique
     */
    public function updateEspace($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $espace = Espace::findOrFail($id);
            $oldPromotionId = $espace->promotion_id;

            // 1. Mise à jour des infos de base
            $espace->update($data);

            // 2. Si la promotion change
            if (array_key_exists('promotion_id', $data) && $data['promotion_id'] != $oldPromotionId) {
                
                // a. Supprimer les étudiants de l'ancienne promotion de cet espace
                if ($oldPromotionId) {
                    $oldStudentIds = Promotion::find($oldPromotionId)->etudiants()->pluck('id');
                    $espace->etudiants()->detach($oldStudentIds);
                }

                // b. Ajouter les étudiants de la nouvelle promotion
                if (!empty($data['promotion_id'])) {
                    $newStudentIds = Promotion::find($data['promotion_id'])->etudiants()->pluck('id');
                    // syncWithoutDetaching pour ne pas recréer de doublons si certains y sont déjà
                    $espace->etudiants()->syncWithoutDetaching($newStudentIds);
                }
            }

            return $espace;
        });
    }

    /**
     * Supprimer un espace pédagogique
     */
    public function deleteEspace($id)
    {
        $espace = Espace::findOrFail($id);
        return $espace->delete();
    }


    public function attachStudentsToEspace($espaceId, array $studentIds)
    {
        $espace = Espace::findOrFail($espaceId);
        // syncWithoutDetaching permet d'ajouter sans supprimer les anciens
        return $espace->etudiants()->syncWithoutDetaching($studentIds);
    }


    /**
     * Inscription d'un SEUL étudiant spécifique
     */
    public function ajoutEtudiant($espaceId, $etudiantId)
    {
        $espace = Espace::findOrFail($espaceId);
        
        // On utilise toggle ou attach. 
        // Attach avec un check est plus sûr pour éviter les erreurs SQL
        if (!$espace->etudiants()->where('etudiant_id', $etudiantId)->exists()) {
            $espace->etudiants()->attach($etudiantId);
            return true;
        }
        
        return false; // Déjà inscrit
    }


    /**
     * Retirer un étudiant spécifique d'un espace
     */
    public function retireEtudiant($espaceId, $etudiantId)
    {
        $espace = Espace::findOrFail($espaceId);
        // detach() supprime uniquement la ligne dans la table pivot (espace_etudiant)
        return $espace->etudiants()->detach($etudiantId);
    }
}