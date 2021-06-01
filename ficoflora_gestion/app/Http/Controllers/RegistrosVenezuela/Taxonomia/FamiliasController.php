<?php

namespace App\Http\Controllers\RegistrosVenezuela\Taxonomia;

use App\Ficoflora\Funcionalidades\Logs\LogsTrait;
use App\Ficoflora\Funcionalidades\Nombres\TaxonomiaSuperiorTrait;
use App\Ficoflora\Registros\Taxonomia\FamiliaRegistro;
use App\Ficoflora\Taxonomia;
use App\Http\Requests\Taxonomia\CrearFamiliaRequest;
use App\Modelos\Taxonomia\Clase;
use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Orden;
use App\Modelos\Taxonomia\Phylum;
use App\Modelos\Taxonomia\Subclase;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FamiliasController extends Controller
{

    use TaxonomiaSuperiorTrait;
    use LogsTrait;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.familias', ['only'=>['editar', 'eliminar', 'actualizar']]);
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
        $ordenes = Orden::lists('nombre', 'id');
        $familia = Familia::select('id', 'nombre', 'orden_id')->get();

        $taxonomia = array('familia' => $familia);
        $taxonomia = json_encode($taxonomia);


        return view('taxonomia.familias.crear', compact('taxonomia', 'ordenes'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function guardar(CrearFamiliaRequest $request)
    {
        $usuario = Auth::user();

        //posible error de phylum ID
        $orden = Orden::find($request->orden);
        if($orden == null){
            return redirect()->back()->withErrors("El Orden no existe")->withInput();
        }

        //Obtengo el objeto Clase ya sea de la BDD o una nueva instancia
        $registro = new FamiliaRegistro($request->all(), $orden->id, $usuario->id);
        $respuesta = $registro->nuevaFamilia();

        //Manejo de errores
        if($respuesta['error'] == true){
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }

        //No hubo errores, guardo la nueva familia
        $familia = $respuesta['registro'];
        $familia->save();

        $this->LogCrear($usuario->usuario,'Familia',$familia->nombre,$familia->id,'familia.mostrar');


        return redirect()->route('familia.mostrar',$familia->id);


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
        $familia_obj = Familia::find($id);

        $familia = $this->taxoFamilia($id);

        $generos = $familia_obj->generos()->get();


        return view('taxonomia.familias.mostrar', compact('usuario', 'familia', 'generos'));
    }

    //EDITAR FAMILIA
    public function editar($id)
    {
        $familia = Familia::findOrFail($id);

        $ordenes = Orden::lists('nombre', 'id');

        $familias = Familia::select('id', 'nombre', 'orden_id')->get();

        $taxonomia = array('familia' => $familias);
        $taxonomia = json_encode($taxonomia);

        return view('taxonomia.familias.editar', compact('ordenes', 'familia', 'taxonomia' ));
    }

    //ACTUALIZAR FAMILIA
    public function actualizar(CrearFamiliaRequest $request, $id)
    {
        $usuario = Auth::user();

        $familia = Familia::find($id);
        $log_f = $log_o= false;

        //chequear si hay cambios en el nombre
        if($familia->nombre != $request->familia){
            $check = Familia::where('nombre', $request->familia)->first();//verficamos si no existe otro género con ese nombre
            if($check != null){
                return redirect()->back()->withErrors('Ya existe una familia con este nombre')->withInput();
            }else{
                $ant_f=$familia->nombre;
                $nuevo_f=$request->familia;
                $familia->nombre = $request->familia;
                $log_f=true;

            }
        }

        if($familia->orden_id != $request->orden){
            $ant_o=Orden::find($familia->orden_id)->nombre;
            $nuevo_o=Orden::find($request->orden)->nombre;
            $familia->orden_id = $request->orden;
            $log_o=true;

        }

        $familia->save();

        if($log_f) {
            $this->LogEditar($usuario->usuario,'Familia',$ant_f,$nuevo_f ,'Editar nombre',$familia->id,'familia.mostrar');
        }
        if($log_o) {
            $this->LogEditar($usuario->usuario,'Familia',$ant_o,$nuevo_o ,'Editar orden',$familia->id,'familia.mostrar');
        }

//        dd($familia);

        return redirect()->route('familia.mostrar', [$familia->id]);
    }


    //ELIMINAR
    public function eliminar($id)
    {
        $familia = Familia::find($id);
        $usuario = Auth::user();

        if($familia == null){
            $errores = [
                'error'    => ['La Familia no existe'],
            ];
            return response()->json($errores, 422);

        }else{

            if ($familia->delete()){
                $this->LogEliminar($usuario->usuario,'Familia',$familia->nombre,$familia->id);

                return;
            }else{
                $errores = [
                    'error'    => ['Disculpe, no se pudo eliminar la familia, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }


    public function taxonomia($id)
    {

        $familia = Familia::find($id);

        $orden = Orden::find($familia->orden_id);
        if($orden->subclase_id != null){
            $subclase = Subclase::find($orden->subclase_id);
            $subclase = $subclase->nombre;
        }else{
            $subclase=null;
        }
        $clase = Clase::find($orden->clase_id);
        $phylum = Phylum::find($clase->phylum_id);

        $registro = ['phylum' => $phylum->nombre, 'clase' => $clase->nombre, 'subclase' => $subclase, 'orden' => $orden->nombre, 'familia' => $familia->nombre];


        return $registro;
    }
}
