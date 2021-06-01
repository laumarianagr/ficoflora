<?php

namespace App\Http\Controllers\Auth;

use App\Modelos\Cuentas\Usuario;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    protected $redirectTo = '/inicio';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'usuario' => 'required|max:255|unique:usuarios',
            'email' => 'required|email|max:255|unique:usuarios',
            'password' => 'required|confirmed|min:6',
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
//        $usuario = Usuario::create([
//            'usuario' => $data['usuario'],
//            'email' => $data['email'],
//            'password' => bcrypt($data['password']),
//            'nombre' => $data['nombre'],
//            'apellido' => $data['apellido'],
//
//        ]);

        $usuario = new Usuario([
            'usuario' => $data['usuario'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido']
        ]);

        $usuario->perfil_id = 4;//visitante
        $usuario->save();

        return $usuario;
    }

    protected function getFailedLoginMessage()
    {
        return 'Correo y/o clave incorrecto';
    }

}
