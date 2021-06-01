<?php

namespace App\Http\Requests\Cuentas;

use App\Http\Requests\Request;

class ActualizarImagenRequest extends Request
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
            'imagen' => 'required|mimes:jpeg|max:2048'


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

            'imagen.mimes' => 'La imagen debe ser un archivo tipo JPEG',
            'imagen.required' => 'Debe especificar una imagen / Tamaño maximo del archivo 2MB o 2000KB',
            'imagen.max' => 'Tamaño maximo del archivo 2MB o 2000KB',


        ];

    }
}
