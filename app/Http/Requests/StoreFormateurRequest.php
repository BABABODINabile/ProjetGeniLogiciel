<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormateurRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        // On laisse à true si la gestion des permissions est faite ailleurs (ex: Middleware)
        return true;
    }

    /**
     * Règles de validation.
     */
    public function rules(): array
    {
        return [
            'email'      => 'required|email|unique:users,email',
            'nom'        => 'required|string|max:255',
            'prenom'     => 'required|string|max:255',
            'specialite' => 'nullable|string|max:255',
            'is_active'  => 'nullable|boolean',
        ];
    }

    /**
     * Messages d'erreur personnalisés en français.
     */
    public function messages(): array
    {
        return [
            'email.required'   => "L'adresse email est obligatoire pour créer le compte du formateur.",
            'email.email'      => "Le format de l'adresse email n'est pas valide.",
            'email.unique'     => "Cette adresse email est déjà utilisée par un autre utilisateur (étudiant ou formateur).",
            'nom.required'     => "Le nom de famille est obligatoire.",
            'prenom.required'  => "Le prénom est obligatoire.",
            'max'              => "Le champ :attribute est trop long (maximum :max caractères).",
            'boolean'          => "La valeur du champ :attribute est incorrecte.",
        ];
    }

    /**
     * Traduction des noms des champs pour les messages d'erreur.
     */
    public function attributes(): array
    {
        return [
            'email'      => 'adresse email',
            'nom'        => 'nom',
            'prenom'     => 'prénom',
            'specialite' => 'spécialité',
            'is_active'  => 'statut d\'activé',
        ];
    }
}
