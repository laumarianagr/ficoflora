<?php

namespace App\Http\Requests\Bibliografia\Referencias;

use App\Http\Requests\Request;

class CrearRevistaRequest extends Request
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
            'titulo' => 'required',
            'nombre' => 'required',
            'volumen' => 'required|integer',
//            'numero' => 'integer',
            'intervalo_1' => 'required|integer',
            'intervalo_2' => 'required|integer',

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
            'integer' => 'El campo :attribute debe ser númerico',

            'intervalo_1.required' => 'El campo comienzó de intervalo de páginas es obligatorio',
            'intervalo_2.required' => 'El campo fin de intervalo de páginas es obligatorio',


        ];

    }
}
