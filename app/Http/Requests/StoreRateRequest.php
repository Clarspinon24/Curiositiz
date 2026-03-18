<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'user_id'     => 'required|exists:users,id',
            'workshop_id' => 'required|exists:workshop,id',
            'rate'        => 'required|integer',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'user_id.required'     => "L'id de l'utilisateur est obligatoire.",
            'workshop_id.required' => "L'id de l'atelier est obligatoire.",
            'user_id.exists'       => "L'utilisateur est introuvable.",
            'workshop_id.exists'   => "L'atelier est introuvable.",
        ];
    }
}
