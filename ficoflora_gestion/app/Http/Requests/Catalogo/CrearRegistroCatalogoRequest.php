<?php

namespace App\Http\Requests\Catalogo;

use App\Http\Requests\Request;

class CrearRegistroCatalogoRequest extends Request
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
            'especie' => 'required',
            'referencia' => 'required',
            'tipo' => 'required',

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

            'especie.required' => 'Debe especificar una especie',
            'referencia.required' => 'Debe especificar una referencia',
            'tipo.required' => 'Debe especificar una referencia',


        ];

    }
}
