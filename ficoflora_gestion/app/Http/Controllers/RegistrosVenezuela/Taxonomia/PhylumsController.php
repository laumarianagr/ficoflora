<?php

namespace App\Http\Controllers\RegistrosVenezuela\Taxonomia;

use App\Ficoflora\Funcionalidades\Logs\LogsTrait;
use App\Ficoflora\Funcionalidades\Nombres\TaxonomiaSuperiorTrait;
use App\Ficoflora\Registros\Taxonomia\PhylumRegistro;
use App\Http\Requests\Taxonomia\CrearPhylumRequest;
use App\Modelos\Taxonomia\Phylum;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PhylumsController extends Controller
{

    use TaxonomiaSuperiorTrait;
    use LogsTrait;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.phylum', ['only'=>['editar', 'eliminar', 'actualizar']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function crear()
    {
        $phylum = Phylum::select('id', 'nombre')->get();

        $taxonomia = array('phylum' =>$phylum);
        $taxonomia = json_encode($taxonomia);

        return view('taxonomia.phylums.crear', compact('taxonomia'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function guardar(CrearPhylumRequest $request)
    {
        $usuario = Auth::user();

        $registro = new PhylumRegistro($request->all(), $usuario->id);
        $respuesta = $registro->nuevoPhylum();

        if($respuesta['error'] == true){
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }

        if($respuesta['existe'] == true){
            return redirect()->back()->withErrors("El phylum ya esta registrado")->withInput();
        }

        //Guardamos el nuevo phylum
        $phylum = $respuesta['registro'];
        $phylum->save();
        $this->LogCrear($usuario->usuario,'Phylum',$phylum->nombre,$phylum->id,'phylum.mostrar');


        return redirect()->route('phylum.mostrar',$phylum->id);
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

        $phylum_obj = Phylum::find($id);

        $phylum = ['phylum_id'=> $phylum_obj->id, 'phylum' => $phylum_obj->nombre, 'creador_id' => $phylum_obj->creador_id];

        $clases = $phylum_obj->clases()->get();

        return view('taxonomia.phylums.mostrar', compact('usuario','phylum', 'clases'));
    }


    //EDITAR phylum
    public function editar($id)
    {
        $phylum = Phylum::findOrFail($id);

        $phylums = Phylum::select('id', 'nombre')->get();

        $taxonomia = array('phylum' => $phylums);
        $taxonomia = json_encode($taxonomia);

        return view('taxonomia.phylums.editar', compact( 'phylum', 'taxonomia' ));
    }


    //ACTUALIZAR phylum
    public function actualizar(CrearPhylumRequest $request, $id)
    {
        $usuario = Auth::user();

        $phylum = Phylum::find($id);
        $log_p = false;

        //chequear si hay cambios en el nombre
        if($phylum->nombre != $request->phylum){
            $check = Phylum::where('nombre', $request->phylum)->first();//verficamos si no existe otro género con ese nombre
            if($check != null){
                return redirect()->back()->withErrors('Ya existe un phylum con este nombre')->withInput();
            }else{
                $ant_p=$phylum->nombre;
                $nuevo_p=$request->phylum;
                $log_p=true;
                $phylum->nombre = $request->phylum;

            }
        }

        $phylum->save();
        if($log_p) {
            $this->LogEditar($usuario->usuario,'Phylum',$ant_p,$nuevo_p ,'Editar nombre',$phylum->id,'genero.mostrar');
        }
        return redirect()->route('phylum.mostrar', [$phylum->id]);
    }

    //ELIMINAR
    public function eliminar($id)
    {
        $phylum = Phylum::find($id);
        $usuario = Auth::user();

        if($phylum == null){
            $errores = [
                'error'    => ['El Phylum no existe'],
            ];
            return response()->json($errores, 422);

        }else{

            if ($phylum->delete()){
                $this->LogEliminar($usuario->usuario,'Phylum',$phylum->nombre,$phylum->id);

                return;
            }else{
                $errores = [
                    'error'    => ['Disculpe, no se pudo eliminar el phylum, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }
}
