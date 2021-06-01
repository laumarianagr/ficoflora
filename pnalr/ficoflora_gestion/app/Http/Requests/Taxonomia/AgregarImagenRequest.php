<?php

namespace App\Http\Requests\Taxonomia;

use App\Http\Requests\Request;

class AgregarImagenRequest extends Request
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
            'pequena' => 'required|mimes:jpeg|max:2048',
            'completa' => 'required|mimes:jpeg|max:2048',
            'tipo' => 'required',
            'leyenda' => 'required',


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

            'pequena.mimes' => 'La imagen debe ser un archivo tipo JPEG',
            'pequena.required' => 'Debe especificar una imagen / Tamaño maximo del archivo 2MB o 2000KB',
            'pequena.max' => 'Tamaño maximo del archivo 2MB o 2000KB',

            'completa.mimes' => 'La imagen debe ser un archivo tipo JPEG',
            'completa.required' => 'Debe especificar una imagen / Tamaño maximo del archivo 2MB o 2000KB',
            'completa.max' => 'Tamaño maximo del archivo 2MB o 2000KB',

            'tipo.required' => 'Debe especificar un tipo',
            'leyenda.required' => 'Debe especificar la leyenda',

        ];

    }
}
