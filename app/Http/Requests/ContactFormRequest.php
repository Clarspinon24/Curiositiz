<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'firstname' => 'required|max:255',
            'lastname'  => 'required|max:255',
            'subject'   => 'required|max:255',
            'email'     => 'required|email|max:255',
            'message'   => 'required',
        ];
    }
}
