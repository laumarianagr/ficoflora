<?php namespace App\Http\Requests\Archivos;

use App\Http\Requests\Request;

class ArchivoRequest extends Request {

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
            'archivo' => 'required|mimes:xls,xlsx'

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
                'archivo.required' => 'No ha seleccionado ningun archivo',
                'tipo.required' => 'Debe especificar el tipo de archivo que se importará',
                'mimes' => 'Tipo de archivo invalido, formatos permitidos .xls o .xlsx',
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
