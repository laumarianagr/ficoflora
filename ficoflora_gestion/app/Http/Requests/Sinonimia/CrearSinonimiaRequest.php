<?php

namespace App\Http\Requests\Sinonimia;

use App\Http\Requests\Request;

class CrearSinonimiaRequest extends Request
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

            'genero' => 'required',
            'especie' => 'required',
            'autor' => 'required',
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
            'especie.required' => 'El campo Epíteto específico es obligatorio',
            'genero.required' => 'El campo Género es obligatorio',
            'required' => 'El campo :attribute es obligatorio',
        ];
    }
}