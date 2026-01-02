<?php

namespace App\Policies;

use App\Models\Formateur;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FormateurPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Tous les utilisateurs authentifiés peuvent voir la liste
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Formateur $formateur): bool
    {
        return true; // Tous les utilisateurs authentifiés peuvent voir un formateur
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Tous les utilisateurs authentifiés peuvent créer un formateur
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Formateur $formateur): bool
    {
        return true; // Tous les utilisateurs authentifiés peuvent mettre à jour un formateur
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Formateur $formateur): bool
    {
        return true; // Tous les utilisateurs authentifiés peuvent supprimer un formateur
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Formateur $formateur): bool
    {
        return false; // Désactivé pour l'instant
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Formateur $formateur): bool
    {
        return false; // Désactivé pour l'instant
    }
}
