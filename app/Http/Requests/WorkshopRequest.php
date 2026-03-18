<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkshopRequest extends FormRequest
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
        $date = now()->format('Y-m-d');

        return [
            'title'        => 'required|string|max:40',
            'price'        => 'required|numeric',
            'org_type'     => 'required|string',
            'postal'       => 'required|integer',
            'age_mini'     => 'required|different:age_maxi',
            'age_maxi'     => 'required|different:age_mini',
            'effectif_max' => 'required|integer|min:1',
            'date'         => 'required|date|after:' . $date,
            'begining'     => 'required',
            'end'          => 'required',
            'description'  => 'required',
            'picture'      => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'date.after' => "Un atelier ne peut être prévu à une date antérieure à aujourd'hui.",
        ];
    }
}
