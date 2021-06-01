<?php

namespace App\Http\Controllers\RegistrosVenezuela\Taxonomia;

use App\Ficoflora\Funcionalidades\Logs\LogsTrait;
use App\Ficoflora\Funcionalidades\Nombres\TaxonomiaSuperiorTrait;
use App\Ficoflora\Registros\Taxonomia\SubclaseRegistro;
use App\Ficoflora\Taxonomia;
use App\Http\Requests\Taxonomia\CrearSubclaseRequest;
use App\Modelos\Taxonomia\Clase;
use App\Modelos\Taxonomia\Phylum;
use App\Modelos\Taxonomia\Subclase;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubclasesController extends Controller
{

    use TaxonomiaSuperiorTrait;
    use LogsTrait;
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.subclases', ['only'=>['editar', 'eliminar', 'actualizar']]);
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
        $clases = Clase::lists('nombre', 'id');
        $subclase = Subclase::select('id', 'nombre', 'clase_id')->get();

        $taxonomia = array('subclase' => $subclase);
        $taxonomia = json_encode($taxonomia);


        return view('taxonomia.subclases.crear', compact('taxonomia', 'clases'));

    }
    /**
     * GUARDA un NUEVO Registro de una SUBCLASE.
     *
     * @return Response
     */
    public function guardar(CrearSubclaseRequest $request)
    {
        $usuario = Auth::user();

        //posible error de clase ID
        $clase = Clase::find($request->clase);
        if($clase == null){
            return redirect()->back()->withErrors("La Clase no existe")->withInput();
        }

        //Obtengo el objeto Subclase ya sea de la BDD o una nueva instancia
        $registro = new SubclaseRegistro($request->all(), $clase->id, $usuario->id);
        $respuesta = $registro->nuevaSubclase();

        //Manejo de errores
        if($respuesta['error'] == true){
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }

        //No hubo errores, guardo la nueva Subclase
        $subclase = $respuesta['registro'];
        $subclase->save();
        $this->LogCrear($usuario->usuario,'Subclase',$subclase->nombre,$subclase->id,'subclase.mostrar');


        return redirect()->route('subclase.mostrar',$subclase->id);
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
        $subclase_obj = Subclase::find($id);

        $subclase = $this->taxoSubclase($id);

        $ordenes = $subclase_obj->ordenes()->get();


        return view('taxonomia.subclases.mostrar', compact('usuario', 'subclase', 'ordenes'));
    }


    //EDITAR subclase
    public function editar($id)
    {
        $subclase = Subclase::findOrFail($id);

        $clases = Clase::lists('nombre', 'id');

        $subclases = Subclase::select('id', 'nombre', 'clase_id')->get();

        $taxonomia = array('subclase' => $subclases);
        $taxonomia = json_encode($taxonomia);

        return view('taxonomia.subclases.editar', compact('clases', 'subclase', 'taxonomia' ));
    }

    //ACTUALIZAR familia
    public function actualizar(CrearSubclaseRequest $request, $id)
    {
        $usuario = Auth::user();

        $subclase = Subclase::find($id);
        $log_s = $log_c= false;

        //chequear si hay cambios en el nombre
        if($subclase->nombre != $request->subclase){
            $check = Subclase::where('nombre', $request->subclase)->first();//verficamos si no existe otro género con ese nombre
            if($check != null){
                return redirect()->back()->withErrors('Ya existe una subclase con este nombre')->withInput();
            }else{
                $ant_s=$subclase->nombre;
                $nuevo_s=$request->subclase;
                $log_s=true;
                $subclase->nombre = $request->subclase;
            }
        }

        if($subclase->clase_id != $request->clase){
            $ant_c=Clase::find($subclase->clase_id)->nombre;
            $nuevo_c=Clase::find($request->clase)->nombre;
            $log_c=true;
            $subclase->clase_id = $request->clase;
        }
        if($log_s) {
            $this->LogEditar($usuario->usuario,'Subclase',$ant_s,$nuevo_s ,'Editar nombre',$subclase->id,'subclase.mostrar');
        }
        if($log_c) {
            $this->LogEditar($usuario->usuario,'Subclase',$ant_c,$nuevo_c,'Editar clase',$subclase->id,'subclase.mostrar');
        }


        $subclase->save();

//        dd($subclase);

        return redirect()->route('subclase.mostrar', [$subclase->id]);
    }


    //ELIMINAR subclase
    public function eliminar($id)
    {        $usuario = Auth::user();

        $subclase = Subclase::find($id);

        if($subclase == null){
            $errores = [
                'error'    => ['La Subclase no existe'],
            ];
            return response()->json($errores, 422);

        }else{

            if ($subclase->delete()){
                $this->LogEliminar($usuario->usuario,'Subclase',$subclase->nombre,$subclase->id);

                return;
            }else{
                $errores = [
                    'error'    => ['Disculpe, no se pudo eliminar la subclase, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }
}
