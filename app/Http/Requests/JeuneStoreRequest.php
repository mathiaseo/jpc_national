<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JeuneStoreRequest extends FormRequest
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
            'firstname' => ['required', 'string', 'max:400'],
            'lastname' => ['required', 'string', 'max:400'],
            'city' => ['required', 'string', 'max:400'],
            'fonction' => ['required', 'in:Jeune,President,Secretaire,Vice-president,Tresorier,Animateur,Conseiller'],
            'is_married' => ['required'],
            'is_water_baptism' => ['required'],
            'is_spirit_baptism' => ['required'],
            'birthday' => ['required', 'date'],
            'date_water_baptism' => ['required', 'date'],
            'date_spirit_baptism' => ['required', 'date'],
            'sexe' => ['required', 'in:Masculin,Feminin'],
            'localite_id' => ['required', 'integer', 'exists:Localites,id'],
        ];
    }
}
