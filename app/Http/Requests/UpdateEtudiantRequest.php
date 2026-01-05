<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEtudiantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Autorisation gérée par middleware/policy ailleurs ; autoriser ici pour permettre la validation
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $etudiant = $this->route('etudiant');
        $etudiantId = $etudiant->id ?? null;
        $userId = $etudiant->user->id ?? null;

        return [
            'email'             => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'nom'               => 'required|string|max:255',
            'prenom'            => 'required|string|max:255',
            'matricule'         => [
                'required',
                'string',
                Rule::unique('etudiants', 'matricule')->ignore($etudiantId),
            ],
            'promotion_id'      => 'required|exists:promotions,id',
            'filiere_option_id' => 'required|exists:filiere_options,id',
            'date_naissance'    => 'required|date',
            'sexe'              => 'required|in:M,F',
            // Mot de passe optionnel lors de la mise à jour
            'password'          => 'nullable|string|min:8',
        ];
    }
}
