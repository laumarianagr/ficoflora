<?php

namespace App\Http\Requests\Taxonomia;

use App\Http\Requests\Request;

class EspecieRequest extends Request
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
            'familia' => 'required',
            'genero' => 'required',
            'especie' => 'required',
            'autor' => 'required',
//            'cita_autor' => 'required',
//            'cita_fecha' => 'required'

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
            'especie.required' => 'El campo Epiteto especifico es obligatorio',
//            'cita_autor.required' => 'El campo autor de la cita es obligatorio',
//            'cita_fecha.required' => 'El campo fecha de la cita es obligatorio',
            'required' => 'El campo :attribute es obligatorio',

        ];

    }
}
