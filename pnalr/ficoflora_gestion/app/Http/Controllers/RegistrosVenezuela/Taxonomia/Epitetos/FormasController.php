<?php

namespace App\Http\Controllers\RegistrosVenezuela\Taxonomia\Epitetos;

use App\Ficoflora\Funcionalidades\Logs\LogsTrait;
use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Http\Requests\Taxonomia\CrearFormaRequest;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Epitetos\Forma;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FormasController extends Controller
{
    use EspecieDatosTrait;
    use LogsTrait;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.formas', ['only'=>['editar', 'eliminar', 'actualizar']]);
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

    public function crear()
    {
        $forma = Forma::select('id', 'nombre')->get();

        $taxonomia = array('forma' => $forma);
        $taxonomia = json_encode($taxonomia);


        return view('taxonomia.formas.crear', compact('taxonomia'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function guardar(CrearFormaRequest $request)
    {
        //
        $usuario = Auth::user();

        $forma = Forma::where('nombre', $request->forma)->exists();

        if($forma == true){
            if($request->ajax()) {

                $errores = [
                    'error' => ['El epíteto forma ya existe'],
                ];
                return response()->json($errores, 422);
            }
            return redirect()->back()->withErrors('El epíteto ya existe')->withInput();

        }
            $forma = Forma::create(['nombre' => $request->forma, 'creador_id' => $usuario->id]);
        $this->LogCrear($usuario->usuario,'Epíteto de forma',$forma->nombre,$forma->id,'forma.mostrar');


        if($request->ajax()) {
            return $forma;
        }

        return redirect()->route('forma.mostrar', [$forma->id]);

    }

    public function mostrar($id)
    {
        $usuario = Auth::user();
        $forma = Forma::find($id);

        $especies_obj = $forma->especies()->get();

        $total = $especies_obj->count();
        $especies = [];
        foreach ($especies_obj as $especie) {

            array_push($especies, ['id' => $especie->id, 'nombre'=> $this->especieDatos($especie, null, false)['nombre'],'autor'=>Autor::find($especie->autor_id)->nombre]);
        }

        return view('taxonomia.formas.mostrar', compact( 'usuario', 'forma', 'total', 'especies' ));

    }


    public function editar($id)
    {
        $forma = Forma::findOrFail($id);

        $formas = Forma::select('id', 'nombre')->get();

        $taxonomia = array('forma' => $formas);
        $taxonomia = json_encode($taxonomia);

        return view('taxonomia.formas.editar', compact( 'forma', 'taxonomia' ));
    }


    public function actualizar(CrearFormaRequest $request, $id)
    {

        $forma = Forma::find($id);
        $usuario = Auth::user();


        //chequear si hay cambios en el nombre
        if($forma->nombre != $request->forma){

            $check = Forma::where('nombre', $request->forma)->first();//verficamos si no existe otro género con ese nombre

            if($check != null){
                return redirect()->back()->withErrors('Ya existe un epíteto forma con este nombre')->withInput();
            }else{
                $ant =$forma->nombre;

                $forma->nombre = $request->forma;
                $forma->save();

                $this->LogEditar($usuario->usuario,'Epíteto de forma',$ant,$forma->nombre ,'Editar nombre',$forma->id,'forma.mostrar');

            }
        }


        return redirect()->route('forma.mostrar', [$forma->id]);
    }

    public function eliminar($id)
    {
        $forma = Forma::find($id);
        $usuario = Auth::user();

        if($forma == null){
            $errores = [
                'error'    => ['El Genero no existe'],
            ];
            return response()->json($errores, 422);

        }else{

            if ($forma->delete()){
                $this->LogEliminar($usuario->usuario,'Epíteto de forma',$forma->nombre,$forma->id);
                return;
            }else{
                $errores = [
                    'error'    => ['Disculpe, no se pudo eliminar el epíteto, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }
}
