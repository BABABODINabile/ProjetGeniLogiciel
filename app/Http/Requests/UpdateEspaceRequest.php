<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEspaceRequest extends FormRequest
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
            'nom' => 'sometimes|required|string|max:100|min:3',
            'description' => 'nullable|string|max:500',
            
            // On vérifie que les ID existent bien dans leurs tables respectives
            'matiere_id' => 'sometimes|required|exists:matieres,id',
            'promotion_id' => 'sometimes|nullable|exists:promotions,id',
            'formateur_id' => 'sometimes|nullable|exists:formateurs,id',
        ];
    }

    /**
     * Personnalisation des messages d'erreur (Optionnel mais recommandé pour le groupe)
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de l\'espace est obligatoire.',
            'matiere_id.exists' => 'La matière sélectionnée n\'existe pas.',
            'promotion_id.exists' => 'La promotion sélectionnée n\'existe pas.',
            'formateur_id.exists' => 'Le formateur sélectionné n\'existe pas.',
        ];
    }
}
