<?php

namespace App\Http\Controllers\Cuentas;

use App\Http\Requests\Usuarios\CrearUsuarioRequest;
use App\Modelos\Cuentas\Perfil;
use App\Modelos\Cuentas\Usuario;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['except'=>['mostrar']]);
    }

    public function index()
    {
        $usuarios = DB::table('usuarios')
            ->leftJoin('perfiles', 'usuarios.perfil_id', '=', 'perfiles.id')
            ->select(DB::raw('usuarios.id, usuarios.usuario, usuarios.nombre, usuarios.apellido, usuarios.email, usuarios.perfil_id, perfiles.tipo'))
            ->orderBy('perfil_id')->orderBy('nombre')
            ->get();

        $perfiles = Perfil::lists('tipo','id');
        $perfiles = array_except($perfiles, [1]);


//        $usuarios = DB::table('usuarios')->orderBy('perfil_id')->paginate(5);


//        $usuarios->setPath('usuarios');
//        dd($usuarios);
//        return view('usuarios.index')->with('usuarios',($usuarios));
        $total = count($usuarios);

        return view('usuarios.index', compact('perfiles', 'usuarios', 'total'));

    }

    public function crear(CrearUsuarioRequest $request)
    {
        $usuario = new Usuario([
            'usuario' => $request->usuario,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
        ]);

        $usuario->perfil_id = 4;//inv invitado
        $usuario->save();

        return $usuario;
    }


    public function mostrar($username)
    {
        $usuario = Usuario::where('usuario', $username)->first();
        $perfil = Perfil::find($usuario->perfil_id);

        if(File::exists('perfiles/'.$usuario->usuario.'.jpg')){
               $foto =  'perfiles/'.$usuario->usuario.'.jpg';
        }else{
            $foto = 'img/!logged-user.jpg';
        }
        return view('usuarios.perfil', compact('usuario', 'perfil', 'foto'));
    }


    public function autenticado()
    {
        if(Auth::check()){
            $user = Auth::user();
            echo $user->nombre." Autenticado </br>";
        }else{
            echo " No Autenticado</br>";
        }
    }

    public function home()
    {
        $user = Auth::user();

        dd($user->admin());

    }

    public function eliminar(Request $request)
    {

        $messages = [
            'required' => 'No se especifico el usuario a eliminar',
        ];

        $this->validate($request, [
            'usuario' => 'required',
        ], $messages);

        $usuario = Usuario::where('usuario', $request->usuario)->first();

        if($usuario != null){

            if($usuario->perfil_id != 1){
                if ($usuario->delete()){
                    $respuesta = array(
                        'success' => true,
                        'data'   => $request->all(),
                    );
                }else{
                    $errores = [
                        'usuario'    => ['Disculpe, no se pudo eliminar el usuario, intente de nuevo'],
                    ];
                    return response()->json($errores, 422);
                }
            }else{
                $errores = [
                    'usuario'    => ['No puede eliminar el usuario Administrador'],
                ];
                return response()->json($errores, 422);
            }

        }else{
            $errores = [
                'usuario'    => ['El usuario no existe'],
            ];
            return response()->json($errores, 422);
        }

        return response()->json($respuesta);
    }


    public function editarPerfil(Request $request)
    {

        $messages = [
            'required' => 'No se recibieron los datos necesarios, intente de nuevo',
        ];

        $this->validate($request, [
            'perfil_id' => 'required',
            'pk' => 'required',
        ], $messages);

        //No se puede modificar el usuario admin
        if($request->pk == 1){

            $errores = [
                'usuario'    => ['No puede modificar el usuario Administrador'],
            ];
            return response()->json($errores, 422);
        }

        $usuario = Usuario::find($request->pk);

        if($usuario != null) {

            $usuario->perfil_id = $request->perfil_id;

            if($usuario->save()){
                $respuesta = array(
                    'success' => true,
                    'data'   => $request->all(),
                );
            }else{
                $errores = [
                    'usuario'    => ['Disculpe, no se pudo modificar el usuario, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }

        }else{
            $errores = [
                'usuario'    => ['El usuario no existe'],
            ];
            return response()->json($errores, 422);
        }

        return response()->json($respuesta);
    }
}