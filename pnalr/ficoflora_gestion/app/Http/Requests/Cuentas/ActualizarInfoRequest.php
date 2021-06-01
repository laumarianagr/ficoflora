<?php

namespace App\Http\Requests\Cuentas;

use App\Http\Requests\Request;

class ActualizarInfoRequest extends Request
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
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'descripcion' => 'required',

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

            'required' => 'Todos los campos son obligatorio',
            'email.email' => 'Indique un correo-e válido',
            'email.unique' => 'Ya existe un usuario con el correo-e indicado',


        ];

    }
}
