<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChildcare extends FormRequest
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
            'children'  => 'required',
            'begining'  => 'required',
            'end'       => 'required',
            'day'       => 'required',
            'location'  => 'required',
            'age_range' => 'required',
        ];
    }
}
