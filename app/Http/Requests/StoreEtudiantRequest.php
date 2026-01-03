<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEtudiantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'             => 'required|email|unique:users,email',
            'nom'               => 'required|string|max:255',
            'prenom'            => 'required|string|max:255',
            'matricule'         => 'required|string|unique:etudiants,matricule',
            'promotion_id'      => 'required|exists:promotions,id',
            'filiere_option_id' => 'required|exists:filiere_options,id',
            'date_naissance'    => 'required|date',
            'sexe'              => 'required|in:M,F',
        ];
    }
}
