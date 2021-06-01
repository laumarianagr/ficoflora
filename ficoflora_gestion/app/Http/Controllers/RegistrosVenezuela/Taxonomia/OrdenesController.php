<?php

namespace App\Http\Controllers\RegistrosVenezuela\Taxonomia;

use App\Ficoflora\Funcionalidades\Logs\LogsTrait;
use App\Ficoflora\Funcionalidades\Nombres\TaxonomiaSuperiorTrait;
use App\Ficoflora\Registros\Taxonomia\OrdenRegistro;
use App\Ficoflora\Taxonomia;
use App\Http\Requests\Taxonomia\CrearOrdenRequest;
use App\Modelos\Taxonomia\Clase;
use App\Modelos\Taxonomia\Orden;
use App\Modelos\Taxonomia\Phylum;
use App\Modelos\Taxonomia\Subclase;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrdenesController extends Controller
{

    use TaxonomiaSuperiorTrait;
    use LogsTrait;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.ordenes', ['only'=>['editar', 'eliminar', 'actualizar']]);
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
        $subclases = Subclase::lists('nombre', 'id');

        $orden = Orden::select('id', 'nombre', 'subclase_id', 'clase_id')->get();

        $taxonomia = array('orden' => $orden);
        $taxonomia = json_encode($taxonomia);

        return view('taxonomia.ordenes.crear', compact('taxonomia', 'clases', 'subclases'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function guardar(CrearOrdenRequest $request)
    {
        $usuario = Auth::user();
//        dd($request->all());

        $clase_id = $subclase_id = null;

        //posible error  ID
        if($request->has('check')){
            $subclase = Subclase::find($request->subclase);
            if($subclase == null){
                return redirect()->back()->withErrors("La Subclase no existe")->withInput();
            }
            $subclase_id = $subclase->id;
            $clase_id = $subclase->clase_id;

        }else{
            $clase = Clase::find($request->clase);
            if($clase == null){
                return redirect()->back()->withErrors("La Clase no existe")->withInput();
            }
            $clase_id = $clase->id;

        }

        //Obtengo el objeto Subclase ya sea de la BDD o una nueva instancia
        $registro = new OrdenRegistro($request->all(), $clase_id, $subclase_id, $usuario->id);
        $respuesta = $registro->nuevoOrden();

        if($respuesta['error'] == true){
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }

        //No hubo errores, guardo la nueva Subclase
        $orden = $respuesta['registro'];
        $orden->save();

        $this->LogCrear($usuario->usuario,'Orden',$orden->nombre,$orden->id,'orden.mostrar');

        return redirect()->route('orden.mostrar',$orden->id);


    }


    //MOSTRAR
    public function mostrar($id)
    {
        $usuario = Auth::user();
        $orden_obj = Orden::find($id);

        $orden = $this->taxoOrden($id);

        $familias = $orden_obj->familias()->get();


        return view('taxonomia.ordenes.mostrar', compact('usuario', 'orden', 'familias'));
    }


    //EDITAR
    public function editar($id)
    {
        $orden = Orden::findOrFail($id);

        $subclases = Subclase::lists('nombre', 'id');
        $clases = Clase::lists('nombre', 'id');

        $ordenes = Orden::select('id', 'nombre', 'subclase_id', 'clase_id')->get();

        if($orden['subclase_id'] != null){
            $check = 1;
        }else{
            $check = 0;
        }

//        dd($check);
        $taxonomia = array('orden' => $ordenes);
        $taxonomia = json_encode($taxonomia);

        return view('taxonomia.ordenes.editar', compact('subclases','clases', 'orden', 'taxonomia', 'check' ));
    }

    //ACTUALIZAR orden
    public function actualizar(CrearOrdenRequest $request, $id)
    {
//        dd($request->all());
        $orden = Orden::find($id);
        $usuario = Auth::user();
        $log_o = $log_s= $log_c= false;

        //chequear si hay cambios en el nombre
        if($orden->nombre != $request->orden){
            $check = Orden::where('nombre', $request->orden)->first();//verficamos si no existe otro género con ese nombre
            if($check != null){
                return redirect()->back()->withErrors('Ya existe una orden con este nombre')->withInput();
            }else{
                $ant_o=$orden->nombre;
                $nuevo_o=$request->orden;
                $orden->nombre = $request->orden;
                $log_o=true;

            }
        }

        if($request->has('check')){
            if($orden->subclase_id !=  null){
                $ant_s=Subclase::find($orden->subclase_id)->nombre;
            }else{
                $ant_s=null;
            }
            if($request->subclase !=  null){
                $nuevo_s=Subclase::find($request->subclase)->nombre;
            }else{
                $nuevo_s=null;
            }
            $orden->subclase_id = $request->subclase;
            $orden->clase_id = Subclase::find($orden->subclase_id)->clase_id;;
            $log_s=true;

        }else{
            $ant_c=Clase::find($orden->clase_id )->nombre;
            $nuevo_c=Clase::find($request->clase)->nombre;
            $orden->subclase_id = null;
            $orden->clase_id = $request->clase;
            $log_c=true;

        }

        $orden->save();

        if($log_o) {
            $this->LogEditar($usuario->usuario,'Orden',$ant_o,$nuevo_o ,'Editar nombre',$orden->id,'orden.mostrar');
        }
        if($log_s) {
            $this->LogEditar($usuario->usuario,'Orden',$ant_s,$nuevo_s ,'Editar subclase',$orden->id,'orden.mostrar');
        }
        if($log_c) {
            $this->LogEditar($usuario->usuario,'Orden',$ant_c,$nuevo_c ,'Editar clase',$orden->id,'orden.mostrar');
        }

        return redirect()->route('orden.mostrar', [$orden->id]);
    }

    //ELIMINAR
    public function eliminar($id)
    {
        $orden = Orden::find($id);
        $usuario = Auth::user();

        if($orden == null){
            $errores = [
                'error'    => ['El Orden no existe'],
            ];
            return response()->json($errores, 422);

        }else{

            if ($orden->delete()){
                $this->LogEliminar($usuario->usuario,'Orden',$orden->nombre,$orden->id);

                return;
            }else{
                $errores = [
                    'error'    => ['Disculpe, no se pudo eliminar rl orden, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }

}
