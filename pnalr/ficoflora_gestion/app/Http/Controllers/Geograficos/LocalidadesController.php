<?php

namespace App\Http\Controllers\Geograficos;

use App\Ficoflora\Funcionalidades\Geograficas\UbicacionSuperiorTrait;
use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Ficoflora\Registros\Geograficos\LocalidadRegistro;
use App\Http\Requests\Geografico\CrearLocalidadRequest;
use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Ubicacion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LocalidadesController extends Controller
{

    use UbicacionSuperiorTrait;
    use EspecieDatosTrait;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.localidades', ['only'=>['editar', 'eliminar', 'actualizar']]);
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
        $entidades = Entidad::lists('nombre', 'id');
        $localidas = Localidad::select('id', 'nombre')->get();

        $geograficos = array('localidad' =>$localidas);
        $geograficos = json_encode($geograficos);

        return view('geograficos.localidad.crear', compact('geograficos', 'entidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function guardar(CrearLocalidadRequest $request)
    {

        //posible error de entidad ID
        $entidad = Entidad::find($request->entidad);
        if($entidad == null){
            return redirect()->back()->withErrors("La Entidad no existe")->withInput();
        }

        //Obtengo el objeto Localidad ya sea de la BDD o una nueva instancia
        $registro = new LocalidadRegistro($request->localidad, $request->latitud, $request->longitud, $entidad->id, Auth::user()->id);
        $respuesta = $registro->nuevaLocalidad();

        //Manejo de errores
        if($respuesta['error'] == true){
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }
        //Ya existe
        if($respuesta['existe'] == true){
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }

        //No hubo errores, guardo la nueva clase
        $localidad = $respuesta['registro'];
        $localidad->save();

        if(!$respuesta['error']) {
            $ubicacion = Ubicacion::where('entidad_id', $localidad->entidad_id)->conLocalidad($localidad->id)->conLugar(null)->conSitio(null)->first();
            if ($ubicacion == null) {
                Ubicacion::create([
                    'entidad_id' => $localidad->entidad_id,
                    'localidad_id' => $localidad->id,
                    'lugar_id' => null,
                    'sitio_id' => null,
                    'latitud' => $localidad->latitud,
                    'longitud' => $localidad->longitud
                ]);
            }
        }

        return redirect()->route('localidad.mostrar',$localidad->id);
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
        $localidad = Localidad::find($id);

        $lugares = $localidad->lugares()->get();

        $ubicacion = $this->ubicacionLocalidad($id);

        $total_lugares = count($lugares);

        foreach ($lugares as $lugar) {
            $lugar['especies'] = count($lugar->especies()->conCatalogo(true)->get());
        }


        $especies_ids = $localidad->especies()->conCatalogo(true)->get();

        $especies = Array();
        $total_especies = 0;

        foreach ($especies_ids as $especie) {

            if($especie->catalogo == true){

                $nombre = $this->especieDatos($especie, null, false);
                array_push($especies, $nombre);
                $total_especies++;
            }
        }



        return view('geograficos.localidad.mostrar', compact('usuario', 'lugares', 'ubicacion', 'total_lugares', 'especies', 'total_especies'));

    }

    //EDITAR
    public function editar($id)
    {
        $localidad = Localidad::findOrFail($id);

        $entidades = Entidad::lists('nombre', 'id');

        $localidades = Localidad::select('id', 'nombre')->get();

        $geograficos = array('localidad' => $localidades);
        $geograficos = json_encode($geograficos);

        return view('geograficos.localidad.editar', compact('localidad', 'entidades','geograficos' ));
    }

    //ACTUALIZAR
    public function actualizar(CrearLocalidadRequest $request, $id)
    {
        $localidad = Localidad::find($id);

        //chequear si hay cambios en el nombre
        if($localidad->nombre != $request->localidad){
            $check = Localidad::where('nombre', $request->localidad)->first();//verficamos si no existe otro género con ese nombre
            if($check != null){
                return redirect()->back()->withErrors('Ya existe una localidad con este nombre')->withInput();
            }else{
                $localidad->nombre = $request->localidad;
            }
        }

        $localidad->latitud = $request->latitud;
        $localidad->longitud = $request->longitud;
        $localidad->entidad_id = $request->entidad;

        $localidad->save();

        return redirect()->route('localidad.mostrar', [$localidad->id]);
    }

    //ELIMINAR
    public function eliminar($id)
    {
        $localidad = Localidad::find($id);

        if ($localidad == null) {
            $errores = [
                'error' => ['La Localidad no existe'],
            ];
            return response()->json($errores, 422);

        } else {

//            $ubicaciones = Ubicacion::where('localidad_id', $id)->select('id')->get();

            if ($localidad->delete()) {

//                foreach ($ubicaciones as $ubicacion) {
//                    DB::table('registro_ubicacion_sinonimia')->where('ubicacion_id', $ubicacion->id)->delete();
//                }

                return;
            } else {
                $errores = [
                    'error' => ['Disculpe, no se pudo eliminar la localidad, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }
}
