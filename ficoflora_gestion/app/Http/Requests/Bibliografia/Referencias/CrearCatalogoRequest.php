<?php

namespace App\Http\Requests\Bibliografia\Referencias;

use App\Http\Requests\Request;

class CrearCatalogoRequest extends Request
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

//          'nombre' => 'required_with: intervalo_1,intervalo_2',
            'intervalo_1' => 'required_with:nombre|integer',
            'intervalo_2' => 'required_with:nombre|integer',

//          'edición' => 'required_with:lugar,paginas',
            'lugar' => 'required_with:edicion',
            'paginas' => 'required_with:edicion|integer',
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
            'interger' => 'El campo :attribute debe ser numérico',

            'intervalo_1.required_with' => 'Si el campo Nombre está presente, también debe estar el campo comienzo de Intervalo de páginas',
            'intervalo_2.required_with' => 'Si el campo Nombre está presente, también debe estar el campo fin de Intervalo de páginas',

            'lugar.required_with' => 'Si el campo Edición está presente, también debe estar el campo Lugar',
            'paginas.required_with' => 'Si el campo Edición está presente, también debe estar el campo Páginas',
        ];

    }
}