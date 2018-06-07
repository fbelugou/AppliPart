<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InterlocuteurCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'prenom' => 'max:255',
            'nom' => 'required|max:255',
            'civilite' => 'max:255',
            'fonction' => 'max:255',
            'telFixe' => 'max:255',
            'telMobile' => 'max:255',
            'commentaire' => 'max:255',
            'mail' => 'nullable|email|max:255',
            'type' => Rule::notIn([0]),
        ];
    }
}
