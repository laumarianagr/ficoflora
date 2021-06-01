<?php

namespace App\Http\Requests\Geografico;

use App\Http\Requests\Request;

class CrearUbicacionRequest extends Request
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
            'entidad' => 'required',
//            'latitud_entidad' => 'required',
//            'longitud_entidad' => 'required',

            'localidad' => 'required_with:lugar',
//            'latitud_localidad' => 'required_with:localidad',
//            'longitud_localidad' => 'required_with:localidad',

            'lugar' => 'required_with:sitio',
//            'latitud_lugar' => 'required_with:lugar',
//            'longitud_lugar' => 'required_with:lugar',

//            'sitio' => '',
//            'latitud_sitio' => 'required_with:sitio',
//            'longitud_sitio' => 'required_with:sitio',
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

            'localidad.required_with' => "Debe especificar la Localidad del Lugar",
            'latitud_localidad.required_with' => "Debe especificar la Latidud de la Localidad",
            'longitud_localidad.required_with' => "Debe especificar la Longitud de la Localidad",

            'lugar.required_with' => "Debe especificar el Lugar del Sitio",
            'latitud_lugar.required_with' => "Debe especificar la Latidud del Lugar",
            'longitud_lugar.required_with' => "Debe especificar la Longitud del Lugar",

            'latitud_sitio.required_with' => "Debe especificar la Latidud del Sitio",
            'longitud_sitio.required_with' => "Debe especificar la Longitud del Sitio",


        ];

    }
}
