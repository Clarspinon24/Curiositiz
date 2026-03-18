<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfil extends FormRequest
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
        $userId = Auth::user()->id;

        return [
            'email'  => 'nullable|email|unique:users,email,' . $userId,
            'phone'  => 'nullable|numeric|digits:10|unique:users,phone,' . $userId,
            'postal' => 'nullable|numeric|digits:5',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ];
    }
}
