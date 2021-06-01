<?php

namespace App\Http\Controllers\Cuentas;

use App\Http\Requests\Cuentas\ActualizarClaveRequest;
use App\Http\Requests\Cuentas\ActualizarImagenRequest;
use App\Http\Requests\Cuentas\ActualizarInfoRequest;
use App\Modelos\Cuentas\Usuario;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CuentaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('admin', ['except'=>['mostrar']]);

    }

    public function editar()
    {
        $usuario = Auth::user();


        if(File::exists('perfiles/'.$usuario->usuario.'.jpg')){
            $foto =  'perfiles/'.$usuario->usuario.'.jpg';
        }else{
            $foto = 'img/!logged-user.jpg';
        }

        return view('usuarios.editar', compact('usuario', 'foto'));
    }


    public function actualizarClave(ActualizarClaveRequest $request)
    {
        $usuario = Auth::user();
        if (Hash::check($request->clave_actual, $usuario->password)) {
//            dd($request->clave_actual);
            $usuario->password = bcrypt($request->clave_nueva);
            $usuario->save();
            Auth::login($usuario);

            return redirect()->back()->with('exito', "Clave actualizada correctamente");

        } else {
            return redirect()->back()->withErrors("Clave actual incorrecta");
        }
    }

    public function actualizarInfo(ActualizarInfoRequest $request)
    {
        $usuario = Auth::user();
        
        $usuario->descripcion = $request->descripcion;
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;

        if($usuario->email != $request->email){

            if(Usuario::where('email',$request->email)->exists()){
                return redirect()->back()->withErrors("Ya existe un usuario con el correo-e indicado");
            }
            $usuario->email = $request->email;
        }


        $usuario->save();

        return redirect()->back()->with('exito', "Información actualizada correctamente");

    }


    public function actualizarImagen(ActualizarImagenRequest $request)
    {
        $archivo = $request->file('imagen');

        $extension = $archivo->getClientOriginalExtension();
        $usuario = Auth::user();
        $nombreArchivo = $usuario->usuario. '.' . $extension;

        Input::file('imagen')->move('perfiles', $nombreArchivo);

        return redirect()->back()->with('exito', "Imagen actualizada correctamente");

    }
}
