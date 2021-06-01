<?php

namespace App\Http\Requests\Bibliografia\Referencias;

use App\Http\Requests\Request;

class CrearEnlaceRequest extends Request
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
            'autores' => 'required',
            'fecha' => 'required|integer',
            'cita' => 'required',
            'enlace' => 'required',
            'dia' => 'required|integer',
            'mes' => 'required',
            'ano' => 'required|integer',

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
            'integer' => 'El campo :attribute debe ser numérico',
        ];

    }
}
