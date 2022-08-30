<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SecteurStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:400'],
            'city' => ['required', 'string', 'max:400'],
            'description' => ['string'],
            'nb_localite' => ['required', 'integer'],
            'circonscription_id' => ['required', 'integer', 'exists:Circonscriptions,id'],
        ];
    }
}
