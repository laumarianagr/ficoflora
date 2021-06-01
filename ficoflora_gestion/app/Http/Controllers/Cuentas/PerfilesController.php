<?php

namespace App\Http\Controllers\Cuentas;

use App\Modelos\Cuentas\Perfil;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class PerfilesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Lista todos los perfiles que existen.
     *
     * @return Response
     */
    public function index()
    {
        $perfiles = Perfil::select('id','tipo')->get();

        $total = count($perfiles);

        return view('perfiles.index', compact('total'))->with('perfiles', $perfiles);

    }



    /**
     * Guarda un nuevo Perfil en la BDD.
     *
     * @return Response
     */
    public function guardar(Request $request)
    {
        
        
//        return $request->all();
        $messages = [
            'required' => 'Debe especificar el tipo de Perfil a crear',
            'unique' => 'El perfil con el nombre "'.$request->tipo.'" ya existe',

        ];
        $this->validate($request, ['tipo' => 'required|unique:perfiles'], $messages);

        $perfil = Perfil::create(['tipo' => $request->tipo]);

        if($perfil != null){

            $respuesta = array(
                'success' => true,
                'data'   => 'ok',
            );

        }else{
            $errores = [
                'usuario'    => ['Disculpe, no se pudo crear el perfil, intente de nuevo'],
            ];
            return response()->json($errores, 422);

        }

        return response()->json($respuesta);

    }

    /**
     * Despliega la lista de los usuarios que poseen un determinado perfil.
     *
     * @param $nombre
     * @return Response
     */
    public function usuarios($nombre)
    {
        $perfil = Perfil::where('tipo',$nombre)->first();

        if($perfil == null){
            return redirect()->route('perfiles.index')->withErrors("Error - El Perfil no existe");
        }

        //lista de perfiles para el select, quitando el administrador
        $perfiles = Perfil::lists('tipo','id');
        $perfiles = array_except($perfiles, [1]);

        //obtenemos todos los usuarios con el perfil que piden
        $usuarios = $perfil->usuarios()->get();

        return view('perfiles.mostrar', compact('perfil', 'usuarios', 'perfiles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @return Response
     */
    public function editar(Request $request)
    {
        $messages = [
            'required' => 'No se recibieron los datos necesarios, intente de nuevo',
            'unique' => 'El perfil con el nombre "'.$request->tipo.'" ya existe',
        ];

        $this->validate($request, [
            'tipo' => 'required|unique:perfiles',
        ], $messages);

        if(($request->pk == 1)|| ($request->pk == 2)|| ($request->pk == 4)){

            switch ($request->pk ) {
                case 1:
                    $nombre = 'Administrador';
                    break;
                case 2:
                    $nombre = 'Coordinador';
                    break;
                case 4:
                    $nombre = 'Investigador Invitado';
                    break;
            }

            $errores = [
                'usuario'    => ['No puede modificar el usuario '.$nombre],
            ];
            return response()->json($errores, 422);
        }

        $perfil = Perfil::find($request->pk);

        if($perfil != null) {
            $perfil->tipo = $request->tipo;

            if($perfil->save()){
                $respuesta = array(
                    'success' => true,
                    'data'   => $request->all(),
                );
            }else{
                $errores = [
                    'perfil'    => ['Disculpe, no se pudo modificar el perfil, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }else{
            $errores = [
                'perfil'    => ['El perfil no existe'],
            ];
            return response()->json($errores, 422);
        }

        return response()->json($respuesta);


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function eliminar(Request $request)
    {

        $messages = [
            'required' => 'No se especifico el perfil a eliminar',
        ];

        $this->validate($request, [
            'tipo' => 'required',
        ], $messages);


        $perfil = Perfil::where('tipo', $request->tipo)->first();

        if($perfil != null){

            if(($perfil->id != 1) && ($perfil->id != 2) && ($perfil->id !=4)){
                if ($perfil->delete()){
                    $respuesta = array(
                        'success' => true,
                        'data'   => $request->all(),
                    );
                }else{
                    $errores = [
                        'perfil'    => ['Disculpe, no se pudo eliminar el perfil, intente de nuevo'],
                    ];
                    return response()->json($errores, 422);
                }
            }else{

                switch ($perfil->id ) {
                    case 1:
                        $nombre = 'Administrador';
                        break;
                    case 2:
                        $nombre = 'Coordinador';
                        break;
                    case 4:
                        $nombre = 'Investigador Invitado';
                        break;
                }

                $errores = [
                    'perfil'    => ['No puede eliminar el perfil '.$nombre],
                ];
                return response()->json($errores, 422);
            }
        }else{
            $errores = [
                'perfil'    => ['El Perfil no existe'],
            ];
            return response()->json($errores, 422);
        }

        return response()->json($respuesta);

    }
}
