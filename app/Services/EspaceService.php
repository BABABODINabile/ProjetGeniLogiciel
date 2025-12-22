<?php

namespace App\Services;

use App\Models\Espace;
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
     * Créer un nouvel espace pédagogique
     */
    public function createEspace(array $data)
    {
        return Espace::create([
            'nom'          => $data['nom'],
            'description'  => $data['description'] ?? null,
            'matiere_id'   => $data['matiere_id'] ?? null,
            'promotion_id' => $data['promotion_id']?? null,
            'formateur_id' => $data['formateur_id']?? null,
        ]);
    }

    /**
     * Mettre à jour un espace pédagogique
     */
    public function updateEspace($id, array $data)
    {
        $espace = Espace::findOrFail($id);
        $espace->update($data);
        return $espace; //retour de l'objet modifié
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
}