<?php

namespace App\Http\Requests\Geografico;

use App\Http\Requests\Request;

class CrearLugarRequest extends Request
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
            'localidad' => 'required',
            'lugar' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
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
