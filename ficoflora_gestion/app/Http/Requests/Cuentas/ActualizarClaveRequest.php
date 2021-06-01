<?php

namespace App\Http\Requests\Cuentas;

use App\Http\Requests\Request;

class ActualizarClaveRequest extends Request
{
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
            'clave_actual' => 'required',
            'clave_nueva' => 'required|min:6',

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

            'clave_actual.required' => 'El campo clave actual es obligatorio',
            'clave_nueva.required' => 'El campo clave nueva es obligatorio',
            'clave_nueva.min' => 'El campo clave nueva debe tener al menos 6 elementos',


        ];

    }
}
