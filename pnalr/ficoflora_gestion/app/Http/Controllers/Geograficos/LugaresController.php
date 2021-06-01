<?php

namespace App\Http\Controllers\Geograficos;

use App\Ficoflora\Funcionalidades\Geograficas\UbicacionSuperiorTrait;
use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Ficoflora\Registros\Geograficos\LugarRegistro;
use App\Http\Requests\Geografico\CrearLugarRequest;
use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Ubicacion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LugaresController extends Controller
{

    use UbicacionSuperiorTrait;
    use EspecieDatosTrait;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.lugares', ['only'=>['editar', 'eliminar', 'actualizar']]);
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
        $entidades = Entidad::orderby('nombre')->get();
        $lista_localidades = Array();

        //Arreglo con localidades asociadas por entidad
        foreach($entidades as $entidad) {
            $localidades = $entidad->localidades->sortBy('nombre')->lists('nombre', 'id');
            $lista_localidades[$entidad->nombre] = $localidades->toArray();
        }


        $lugares = Lugar::select('id', 'nombre')->get();

        $geograficos = array('lugar' => $lugares);
        $geograficos = json_encode($geograficos);

        return view('geograficos.lugar.crear', compact('geograficos', 'lista_localidades'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function guardar(CrearLugarRequest $request)
    {

        //posible error de localidad ID
        $localidad = Localidad::find($request->localidad);
        if($localidad == null){
            return redirect()->back()->withErrors("La Localidad no existe")->withInput();
        }

        //Obtengo el objeto Localidad ya sea de la BDD o una nueva instancia
        $registro = new LugarRegistro($request->lugar, $request->latitud, $request->longitud, $localidad->id, Auth::user()->id);
        $respuesta = $registro->nuevoLugar();

        //Manejo de errores
        if($respuesta['error'] == true){
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }
        //Ya existe
        if($respuesta['existe'] == true){
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }

        //No hubo errores, guardo el nuevo lugar
        $lugar = $respuesta['registro'];
        $lugar->save();

        if(!$respuesta['error']) {
            $localidad = Localidad::find($lugar->localidad_id);
            $ubicacion = Ubicacion::where('entidad_id', $localidad->entidad_id)->conLocalidad($localidad->id)->conLugar($lugar->id)->conSitio(null)->first();
            if ($ubicacion == null) {
                Ubicacion::create([
                    'entidad_id' => $localidad->entidad_id,
                    'localidad_id' => $localidad->id,
                    'lugar_id' => $lugar->id,
                    'sitio_id' => null,
                    'latitud' => $lugar->latitud,
                    'longitud' => $lugar->longitud
                ]);
            }
        }

        return redirect()->route('lugar.mostrar',$lugar->id);
    }


    //MOSTRAR
    public function mostrar($id)
    {
        $usuario = Auth::user();

        $lugar = Lugar::find($id);

        $sitios = $lugar->sitios()->get();

        $ubicacion = $this->ubicacionLugar($id);

        $total_sitios = count($sitios);

        foreach ($sitios as $sitio) {
            $sitio['especies'] = count($sitio->especies()->conCatalogo(true)->get());
        }



        $especies_ids = $lugar->especies()->conCatalogo(true)->get();

        $especies = Array();
        $total_especies = 0;

        foreach ($especies_ids as $especie) {

            if($especie->catalogo == true){

                $nombre = $this->especieDatos($especie, null, false);
                array_push($especies, $nombre);
                $total_especies++;
            }
        }

        return view('geograficos.lugar.mostrar', compact('usuario','sitios', 'ubicacion', 'total_sitios', 'especies', 'total_especies'));

    }
    //EDITAR
    public function editar($id)
    {
        $lugar = Lugar::find($id);

        $localidades = Localidad::lists('nombre', 'id');

        $lugares = Lugar::select('id', 'nombre')->get();

        $geograficos = array('lugar' => $lugares);
        $geograficos = json_encode($geograficos);

        return view('geograficos.lugar.editar', compact('lugar', 'localidades','geograficos' ));
    }


    //ACTUALIZAR
    public function actualizar(CrearLugarRequest $request, $id)
    {
        $lugar = Lugar::find($id);

        //chequear si hay cambios en el nombre
        if($lugar->nombre != $request->lugar){
            $check = Lugar::where('nombre', $request->lugar)->first();//verficamos si no existe otro género con ese nombre
            if($check != null){
                return redirect()->back()->withErrors('Ya existe un lugar con este nombre')->withInput();
            }else{
                $lugar->nombre = $request->lugar;
            }
        }

        $lugar->latitud = $request->latitud;
        $lugar->longitud = $request->longitud;
        $lugar->localidad_id = $request->localidad;

        $lugar->save();

        return redirect()->route('lugar.mostrar', [$lugar->id]);
    }

    public function eliminar($id)
    {
        $lugar = Lugar::find($id);

        if ($lugar == null) {
            $errores = [
                'error' => ['El Lugar no existe'],
            ];
            return response()->json($errores, 422);

        } else {

//            $ubicaciones = Ubicacion::where('lugar_id', $id)->select('id')->get();

            if ($lugar->delete()) {

//                foreach ($ubicaciones as $ubicacion) {
//                    DB::table('registro_ubicacion_sinonimia')->where('ubicacion_id', $ubicacion->id)->delete();
//                }

                return;
            } else {
                $errores = [
                    'error' => ['Disculpe, no se pudo eliminar el lugar, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }
}
