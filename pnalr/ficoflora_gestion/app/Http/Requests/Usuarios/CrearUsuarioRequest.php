<?php namespace App\Http\Requests\Usuarios;

use App\Http\Requests\Request;

class CrearUsuarioRequest extends Request {

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

            'usuario' => 'required|unique:usuarios,usuario',
            'email' => 'required|email|unique:usuarios,email',
            'nombre' => 'required',
            'apellido' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',

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
            'required' => 'Todos los campos son obligatorios',
            'usuario.unique' => 'El Usuario ya existe',
            'email.unique' => 'Existe un usuario con el correo suminstrado',
            'apellido.min' => 'Debe especificar el tipo de archivo que se importará',
            'password.min' => 'Longitud minima de la clave 6',
            'password_confirmation.same' => 'Las claves no son iguales',
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
