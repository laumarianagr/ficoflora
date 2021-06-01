<?php

namespace App\Http\Requests\Bibliografia\Referencias;

use App\Http\Requests\Request;

class CrearLibroRequest extends Request
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
            'lugar' => 'required',
            'paginas' => 'required|integer',



//            'capitulo' => 'required_with:editor,intervalo_1,intervalo_2',
            'editor' => 'required_with:capitulo',
            'intervalo_1' => 'required_with:capitulo|integer',
            'intervalo_2' => 'required_with:capitulo|integer',
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
            'interger' => 'El campo :attribute debe ser numerico',

            'intervalo_1.required_with' => 'Si el campo Título (Capitulo/Sección), Editor o Fin de intervalo de páginas esta presente, también debe estar el campo comienzó de Intervalo de páginas',
            'intervalo_2.required_with' => 'Si el campo Título (Capitulo/Sección), Editor o comienzó de intervalo de páginas esta presente, también debe estar el campo fin de Intervalo de páginas',
            'capitulo.required_with' => 'Si el campo Editor, o Intervalo de páginas está presente, también debe estar el campo Capítulo',
            'editor.required_with' => 'Si el campo Título (Capitulo/Sección) o intervalo de páginas está presente, también debe estar en la campo Editor.',

        ];

    }
}
