<?php

namespace App\Http\Controllers\RegistrosVenezuela;

use App\Ficoflora\Funcionalidades\Logs\LogsTrait;
use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Ficoflora\Registros\Formulario;
use App\Ficoflora\Registros\Taxonomia\AutorRegistro;
use App\Http\Requests\Taxonomia\CrearAutorRequest;
use App\Modelos\Taxonomia\Autor;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AutoresController extends Controller
{

    use EspecieDatosTrait;
    use LogsTrait;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
//        $this->middleware('creador.especie', ['only'=>['editar', 'eliminar', 'actualizar']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function crear()
    {
        $autor = Autor::lists('nombre');
        $autores = json_encode($autor);

        return view('taxonomia.autores.crear', compact('autores'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function guardar(CrearAutorRequest $request)
    {


        $usuario = Auth::user();

        $registro = new AutorRegistro($request->autor, $usuario->id);
        $respuesta = $registro->nuevoAutor();


        if($respuesta['error'] == true){
            if($request->ajax()) {
                $errores = [
                    'error' => [$respuesta['log']]
                ];
                return response()->json($errores, 422);
            }
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }

        if($respuesta['existe'] == true){
            if($request->ajax()) {
                $errores = [
                    'error' => ['La autoridad ya existe'],
                ];
                return response()->json($errores, 422);
            }
            return redirect()->back()->withErrors("La autoridad ya existe")->withInput();
        }

        $autor = $respuesta['registro'];
        $autor->save();
        $this->LogCrear($usuario->usuario,'Autoridad',$autor->nombre,$autor->id,'autor.mostrar');


        if($request->ajax()) {
            return $autor;
        }

        return redirect()->route('autor.mostrar',$autor->id);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function mostrar($id)
    {
        $usuario = Auth::user();

        $autor = Autor::find($id);

        $especies_obj = $autor->especies()->get();

        $total = $especies_obj->count();
        $especies = [];
        foreach ($especies_obj as $especie) {

            array_push($especies, ['id' => $especie->id, 'nombre'=> $this->especieDatos($especie, null, false)['nombre']]);
        }


        return view('taxonomia.autores.mostrar', compact('usuario', 'autor', 'especies', 'total'));
    }

    public function editar($id)
    {
        $autor = Autor::findOrFail($id);

        $autores = Autor::select('id', 'nombre')->get();

        $taxonomia = array('autor' => $autores);
        $taxonomia = json_encode($taxonomia);

        return view('taxonomia.autores.editar', compact( 'autor', 'taxonomia' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CrearAutorRequest $request
     * @param  int $id
     * @return Response
     */
    public function actualizar(CrearAutorRequest $request, $id)
    {
        $usuario = Auth::user();

        $autor = Autor::find($id);

        //chequear si hay cambios en el nombre
        if($autor->nombre != $request->autor){

            $check = Autor::where('nombre', $request->autor)->first();//verficamos si no existe otro género con ese nombre

            if($check != null){
                return redirect()->back()->withErrors('Ya existe un epíteto autor con este nombre')->withInput();
            }else{
                $anterior = $autor->nombre;
                $autor->nombre = $request->autor;
                $autor->save();
                $this->LogEditar($usuario->usuario,'Autoridad',$anterior,$autor->nombre ,'Editar nombre',$autor->id,'autor.mostrar');

            }
        }


        return redirect()->route('autor.mostrar', [$autor->id]);
    }

    public function eliminar($id)
    {
        $usuario = Auth::user();

        $autor = Autor::find($id);

        if($autor == null){
            $errores = [
                'error'    => ['El Autor no existe'],
            ];
            return response()->json($errores, 422);

        }else{

            if ($autor->delete()){
                $this->LogEliminar($usuario->usuario,'Autoridad',$autor->nombre,$autor->id);

                return;
            }else{
                $errores = [
                    'error'    => ['Disculpe, no se pudo eliminar el autor, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }
}
