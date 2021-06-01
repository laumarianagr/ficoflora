<?php

namespace App\Http\Controllers\Geograficos;

use App\Ficoflora\Funcionalidades\Geograficas\UbicacionSuperiorTrait;
use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Ficoflora\Registros\Geograficos\SitioRegistro;
use App\Http\Requests\Geografico\CrearSitioRequest;
use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;
use App\Modelos\Geografico\Ubicacion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SitiosController extends Controller
{
    use UbicacionSuperiorTrait;
    use EspecieDatosTrait;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.sitios', ['only'=>['editar', 'eliminar', 'actualizar']]);
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
        $entidades = Entidad::select('id', 'nombre')->get();
        $sitios = Sitio::select('id', 'nombre')->get();

        $lista_localidades = Localidad::orderby('nombre')->get();

        $lista_lugares = Array();
        //Arreglo con lugares asociadas por localidad
        foreach($lista_localidades as $localidad) {
            
            $lugares = $localidad->lugares;
            //si posee lugares la localidad los guardamos en el arreglo
            if(!$lugares->isEmpty() ){
                $lugares = $lugares->sortBy('nombre')->lists('nombre', 'id');
                $nombre_entidad = $entidades->where('id', $localidad->entidad_id)->first()->nombre;
                $lista_lugares[$localidad->nombre.' ('.$nombre_entidad.')'] = $lugares->toArray();
            }
            

        }

//        dd($lista_lugares);

        $geograficos = array('sitio' => $sitios);
        $geograficos = json_encode($geograficos);


        return view('geograficos.sitio.crear', compact('geograficos', 'lista_lugares', 'lugar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function guardar(CrearSitioRequest $request)
    {

        //posible error de localidad ID
        $lugar = Lugar::find($request->lugar);
        if($lugar == null){
            return redirect()->back()->withErrors("El Lugar no existe")->withInput();
        }

        //Obtengo el objeto Localidad ya sea de la BDD o una nueva instancia
        $registro = new SitioRegistro($request->sitio, $request->latitud, $request->longitud, $lugar->id, Auth::user()->id);
        $respuesta = $registro->nuevoSitio();

        //Manejo de errores
        if($respuesta['error'] == true){
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }
        //Ya existe
        if($respuesta['existe'] == true){
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }

        //No hubo errores, guardo el nuevo lugar
        $sitio = $respuesta['registro'];
        $sitio->save();

        if(!$respuesta['error']) {
            $lugar = Lugar::find($sitio->lugar_id);
            $localidad = Localidad::find($lugar->localidad_id);
            $ubicacion = Ubicacion::where('entidad_id', $localidad->entidad_id)->conLocalidad($localidad->id)->conLugar($lugar->id)->conSitio($sitio->id)->first();
            if ($ubicacion == null) {
                Ubicacion::create([
                    'entidad_id' => $localidad->entidad_id,
                    'localidad_id' => $localidad->id,
                    'lugar_id' => $lugar->id,
                    'sitio_id' => $sitio->id,
                    'latitud' => $lugar->latitud,
                    'longitud' => $lugar->longitud
                ]);
            }
        }

        return redirect()->route('sitio.mostrar',$sitio->id);
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

        $sitio = Sitio::find($id);

        $especies_ids = $sitio->especies()->conCatalogo(true)->get();

        $ubicacion = $this->ubicacionSitio($id);

        $especies = Array();
        $total_especies = 0;

        foreach ($especies_ids as $especie) {

            if($especie->catalogo == true){

                $nombre = $this->especieDatos($especie, null, false);
                array_push($especies, $nombre);
                $total_especies++;
            }
        }

        return view('geograficos.sitio.mostrar', compact('usuario', 'especies', 'ubicacion', 'total_especies'));

    }

    //EDITAR
    public function editar($id)
    {
        $sitio = Sitio::find($id);

        $lugares = Lugar::lists('nombre', 'id');

        $sitios = Sitio::select('id', 'nombre')->get();

        $geograficos = array('sitio' => $sitios);
        $geograficos = json_encode($geograficos);

        return view('geograficos.sitio.editar', compact('sitio', 'lugares','geograficos' ));
    }

    //ACTUALIZAR
    public function actualizar(CrearSitioRequest $request, $id)
    {
        $sitio = Sitio::find($id);

        //chequear si hay cambios en el nombre
        if($sitio->nombre != $request->sitio){
            $check = Sitio::where('nombre', $request->sitio)->first();//verficamos si no existe otro género con ese nombre
            if($check != null){
                return redirect()->back()->withErrors('Ya existe un sitio con este nombre')->withInput();
            }else{
                $sitio->nombre = $request->sitio;
            }
        }

        $sitio->latitud = $request->latitud;
        $sitio->longitud = $request->longitud;
        $sitio->lugar_id = $request->lugar;

        $sitio->save();

        return redirect()->route('sitio.mostrar', [$sitio->id]);
    }
    public function eliminar($id)
    {
        $sitio = Sitio::find($id);

        if ($sitio == null) {
            $errores = [
                'error' => ['El Sitio no existe'],
            ];
            return response()->json($errores, 422);

        } else {

//            $ubicaciones = Ubicacion::where('sitio_id', $id)->select('id')->get();

            if ($sitio->delete()) {

//                foreach ($ubicaciones as $ubicacion) {
//                    DB::table('registro_ubicacion_sinonimia')->where('ubicacion_id', $ubicacion->id)->delete();
//                }

                return;
            } else {
                $errores = [
                    'error' => ['Disculpe, no se pudo eliminar el sitio, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }
}
