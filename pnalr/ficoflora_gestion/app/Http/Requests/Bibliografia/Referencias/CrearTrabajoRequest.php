<?php

namespace App\Http\Requests\Bibliografia\Referencias;

use App\Http\Requests\Request;

class CrearTrabajoRequest extends Request
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
            'tipo' => 'required',
            'autores' => 'required',
            'fecha' => 'required|integer',
            'cita' => 'required',
            'titulo' => 'required',
            'institucion' => 'required',
            'lugar' => 'required',
            'paginas' => 'integer',

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
            'integer' => 'El campo :attribute debe ser numerico',
        ];

    }
}
