<?php

namespace App\Http\Controllers\RegistrosVenezuela\Taxonomia;

use App\Ficoflora\Funcionalidades\Logs\LogsTrait;
use App\Ficoflora\Funcionalidades\Nombres\TaxonomiaSuperiorTrait;
use App\Ficoflora\Registros\Taxonomia\ClaseRegistro;
use App\Ficoflora\Taxonomia;
use App\Http\Requests\Taxonomia\CrearClaseRequest;
use App\Modelos\Taxonomia\Clase;
use App\Modelos\Taxonomia\Phylum;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClasesController extends Controller
{

    use TaxonomiaSuperiorTrait;
    use LogsTrait;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.clases', ['only'=>['editar', 'eliminar', 'actualizar']]);
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
        $phylums = Phylum::lists('nombre', 'id');
        $clase = Clase::select('id', 'nombre', 'phylum_id')->get();

        $taxonomia = array('clase' => $clase);
        $taxonomia = json_encode($taxonomia);
        
        return view('taxonomia.clases.crear', compact('taxonomia', 'phylums'));

    }

    /**
     * GUARDA un NUEVO Registro de una CLASE.
     *
     * @return Response
     */
    public function guardar(CrearClaseRequest $request)
    {
        $usuario = Auth::user();

        //posible error de phylum ID
        $phylum = Phylum::find($request->phylum);
        if($phylum == null){
            return redirect()->back()->withErrors("El Phylum no existe")->withInput();
        }

        //Obtengo el objeto Clase ya sea de la BDD o una nueva instancia
        $registro = new ClaseRegistro($request->all(), $phylum->id, $usuario->id);
        $respuesta = $registro->nuevaClase();

        //Manejo de errores
        if($respuesta['error'] == true){
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }

        //No hubo errores, guardo la nueva clase
        $clase = $respuesta['registro'];
        $clase->save();
        $this->LogCrear($usuario->usuario,'Clase',$clase->nombre,$clase->id,'clase.mostrar');

        return redirect()->route('clase.mostrar',$clase->id);
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
        $clase_obj = Clase::find($id);

        $clase = $this->taxoClase($id);

        $subclases = $clase_obj->subclases()->get();
        $ordenes = $clase_obj->ordenes()->get();


        return view('taxonomia.clases.mostrar', compact('usuario', 'clase', 'ordenes','subclases'));
    }

    //EDITAR clases
    public function editar($id)
    {
        $clase = Clase::findOrFail($id);

        $phylums = Phylum::lists('nombre', 'id');

        $clases = Clase::select('id', 'nombre', 'phylum_id')->get();

        $taxonomia = array('clase' => $clases);
        $taxonomia = json_encode($taxonomia);

        return view('taxonomia.clases.editar', compact('phylums', 'clase', 'taxonomia' ));
    }

    //ACTUALIZAR subclases
    public function actualizar(CrearClaseRequest $request, $id)
    {

        $clase = Clase::find($id);
        $usuario = Auth::user();
        $log_c = $log_p= false;

        //chequear si hay cambios en el nombre
        if($clase->nombre != $request->clase){
            $check = Clase::where('nombre', $request->clase)->first();//verficamos si no existe otro género con ese nombre
            if($check != null){
                return redirect()->back()->withErrors('Ya existe una clase con este nombre')->withInput();
            }else{
                $ant_c=$clase->nombre;
                $nuevo_c=$request->clase;
                $clase->nombre = $request->clase;
                $log_c=true;
            }
        }

        if($clase->phylum_id != $request->phylum){
            $ant_p=Phylum::find($clase->phylum_id)->nombre;
            $nuevo_p=Phylum::find($request->phylum)->nombre;
            $log_p=true;
            $clase->phylum_id = $request->phylum;
        }

        $clase->save();

        if($log_c) {
            $this->LogEditar($usuario->usuario,'Clase',$ant_c,$nuevo_c ,'Editar nombre',$clase->id,'clase.mostrar');
        }
        if($log_p) {
            $this->LogEditar($usuario->usuario,'Clase',$ant_p,$nuevo_p ,'Editar phylum',$clase->id,'clase.mostrar');
        }
//        dd($clase);

        return redirect()->route('clase.mostrar', [$clase->id]);
    }

    //ELIMINAR
    public function eliminar($id)
    {
        $clase = Clase::find($id);
        $usuario = Auth::user();

        if($clase == null){
            $errores = [
                'error'    => ['La Clase no existe'],
            ];
            return response()->json($errores, 422);

        }else{

            if ($clase->delete()){
                $this->LogEliminar($usuario->usuario,'Clase',$clase->nombre,$clase->id);

                return;
            }else{
                $errores = [
                    'error'    => ['Disculpe, no se pudo eliminar la clase, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }
}
