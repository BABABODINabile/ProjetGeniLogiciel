<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreEspaceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom'          => 'required|string|min:3|max:100',
            'description'  => 'nullable|string|max:1000',
            'matiere_id' => [
                                'required',
                                Rule::unique('espaces')->where(function ($query) {
                                    return $query->where('promotion_id', $this->promotion_id);
                                })
                            ],
            'promotion_id' => 'nullable|exists:promotions,id',
            'formateur_id' => 'nullable|exists:formateurs,id',
        ];
    }

    /**
     * Messages d'erreur personnalisés en français.
     */
    public function messages(): array
    {
        return [
            'nom.required'        => "Le nom de l'espace est obligatoire pour l'identifier.",
            'nom.min'             => "Le nom doit comporter au moins :min caractères.",
            'matiere_id.required' => "Vous devez impérativement lier cet espace à une matière.",
            'exists'              => "La sélection pour le champ :attribute est invalide ou n'existe plus.",
            'max'                 => "Le champ :attribute ne peut pas dépasser :max caractères.",
            'matiere_id.unique'   => "Un espace pédagogique pour cette matière et cette promotion existe déjà.",
        ];
    }

    /**
     * Traduction des noms des champs.
     */
    public function attributes(): array
    {
        return [
            'nom'          => "nom de l'espace",
            'description'  => "description",
            'matiere_id'   => "matière",
            'promotion_id' => "promotion",
            'formateur_id' => "formateur",
        ];
    }
}