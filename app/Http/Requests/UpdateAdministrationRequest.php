<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdministrationRequest extends FormRequest
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
        $administration = $this->route('administration');
        $userId = $administration->user->id ?? null;

        return [
            'email' => ['required','email', \Illuminate\Validation\Rule::unique('users','email')->ignore($userId)],
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'fonction' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
            'password' => 'nullable|string|min:8',
        ];
    }
}
