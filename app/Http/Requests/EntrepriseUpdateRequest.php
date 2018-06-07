<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntrepriseUpdateRequest extends FormRequest
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
            'nom' => 'required|max:255',
            'rue' => 'max:255',
            'ville' => 'max:255',
            'cp' => 'max:255',
            'siteWeb' => 'max:255',
            'telephone' => 'max:255',
            'commentaire' => 'max:65000',
        ];
    }
}
