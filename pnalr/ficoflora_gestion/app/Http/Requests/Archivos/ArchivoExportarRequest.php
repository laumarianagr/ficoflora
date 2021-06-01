<?php namespace App\Http\Requests\Archivos;

use App\Http\Requests\Request;

class ArchivoExportarRequest extends Request {

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
            'tipo.required' => 'Debe especificar el tipo de archivo que se importará',
        ];

    }

}

/*
 *     $messages = [
            'required' => 'No ha seleccionado ningun archivo',
            'mimes' => 'Tipo de archivo invalido, formatos permitidos .xls o .xlsx',
        ];
        $this->validate($request, ['archivo' => 'required|mimes:xls,xlsx'], $messages);

 *
 */
