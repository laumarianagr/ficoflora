<?php

namespace App\Http\Requests\Taxonomia;

use App\Http\Requests\Request;

class CrearAutorRequest extends Request
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

//            'phylum' => 'required',
//            'clase' => 'required',
//            'orden' => 'required',
//            'familia' => 'required',
            'autor' => 'required'

        ];
    }

    /**
     * Personalizción de mensajes.
     *
     * @return array
     */
    public function messages()
    {
        return[
            'required' => 'El campo :attribute es obligatorio',

        ];

    }
}
