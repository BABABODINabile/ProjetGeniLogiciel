<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEtudiantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'             => 'required|email|unique:users,email',
            'nom'        => ['required', 'string', 'max:255', 'not_regex:/^[0-9]+$/'],
            'prenom'     => ['required', 'string', 'max:255', 'not_regex:/^[0-9]+$/'],
            'matricule'         => 'required|string|unique:etudiants,matricule',
            'promotion_id'      => 'required|exists:promotions,id',
            'filiere_option_id' => 'required|exists:filiere_options,id',
            'date_naissance'    => 'required|date',
            'sexe'              => 'required|in:M,F',
        ];
    }

    /**
     * Messages d'erreur personnalisés.
     */
    public function messages(): array
    {
        return [
            'nom.not_regex' => 'Le nom ne peut pas être composé uniquement de chiffres.',
            'prenom.not_regex' => 'Le prénom ne peut pas être composé uniquement de chiffres.',
            'email.required'    => "L'adresse email est indispensable pour l'envoi des accès.",
            'email.email'       => "Le format de l'adresse email n'est pas valide.",
            'email.unique'      => "Cette adresse email est déjà associée à un compte utilisateur.",
            'matricule.unique'  => "Ce numéro de matricule est déjà attribué à un autre étudiant.",
            'sexe.in'           => "Le sexe doit être 'Masculin' ou 'Féminin'.",
            'date_naissance.date' => "La date de naissance doit être une date valide.",
            'exists'            => "La sélection pour le champ :attribute est invalide.",
            'required'          => "Le champ :attribute est obligatoire.",
        ];
    }

    /**
     * Noms des attributs pour les messages d'erreur.
     */
    public function attributes(): array
    {
        return [
            'email'             => 'email professionnel',
            'nom'               => 'nom',
            'prenom'            => 'prénom',
            'matricule'         => 'N° matricule',
            'promotion_id'      => 'promotion',
            'filiere_option_id' => 'filière/option',
            'date_naissance'    => 'date de naissance',
            'sexe'              => 'genre',
        ];
    }
}
