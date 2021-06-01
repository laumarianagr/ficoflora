<?php

namespace App\Http\Controllers\Geograficos;

use App\Ficoflora\Funcionalidades\Geograficas\UbicacionSuperiorTrait;
use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Ficoflora\Registros\Geograficos\EntidadRegistro;
use App\Http\Requests\Geografico\CrearEntidadRequest;
use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Ubicacion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EntidadesController extends Controller
{

    use UbicacionSuperiorTrait;

    use EspecieDatosTrait;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.entidades', ['only'=>['editar', 'eliminar', 'actualizar']]);
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

        $geograficos = array('entidad' =>$entidades);
        $geograficos = json_encode($geograficos);

        return view('geograficos.entidad.crear', compact('geograficos'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function guardar(CrearEntidadRequest $request)
    {
        $registro = new EntidadRegistro($request->all(), Auth::user()->id);
        $respuesta = $registro->nuevaEntidad();

        if($respuesta['error'] == true){
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }

        if($respuesta['existe'] == true){
            return redirect()->back()->withErrors("La Entidad ya esta registrada")->withInput();
        }

        //Guardamos la nueva entidad
        $entidad = $respuesta['registro'];
        $entidad->save();

        if(!$respuesta['error']) {
            $ubicacion = Ubicacion::where('entidad_id', $entidad->id)->conLocalidad(null)->conLugar(null)->conSitio(null)->first();
            if ($ubicacion == null) {
                Ubicacion::create([
                    'entidad_id' => $entidad->id,
                    'localidad_id' => null,
                    'lugar_id' => null,
                    'sitio_id' => null,
                    'latitud' => $entidad->latitud,
                    'longitud' => $entidad->longitud
                ]);
            }
        }

        return redirect()->route('entidad.mostrar',$entidad->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function mostrar($id)
    {
        $entidad = Entidad::find($id);

        $usuario = Auth::user();

        $localidades = $entidad->localidades()->get();

        $ubicacion = $this->ubicacionEntidad($id);


        $total_localidades = count($localidades);

        foreach ($localidades as $localidad) {
            $localidad['especies'] = count($localidad->especies()->conCatalogo(true)->get());
        }


        $especies_ids = $entidad->especies()->conCatalogo(true)->get();

        $especies = Array();
        $total_especies = 0;

        foreach ($especies_ids as $especie) {

            if($especie->catalogo==true){
                $nombre = $this->especieDatos($especie, null, false);
                array_push($especies, $nombre);
                $total_especies++;
            }
        }

        return view('geograficos.entidad.mostrar', compact('usuario','localidades', 'ubicacion', 'total_localidades', 'especies', 'total_especies'));

    }

    //EDITAR
    public function editar($id)
    {
        $entidad = Entidad::find($id);

        $entidades = Entidad::select('id', 'nombre')->get();

        $geograficos = array('entidad' => $entidades);
        $geograficos = json_encode($geograficos);

        return view('geograficos.entidad.editar', compact('entidad', 'geograficos'));
    }


    //ACTUALIZAR
    public function actualizar(CrearEntidadRequest $request, $id)
    {

        $entidad = Entidad::find($id);

        //chequear si hay cambios en el nombre
        if($entidad->nombre != $request->entidad){
            $check = Entidad::where('nombre', $request->entidad)->first();//verficamos si no existe otro género con ese nombre
            if($check != null){
                return redirect()->back()->withErrors('Ya existe un entidad con este nombre')->withInput();
            }else{
                $entidad->nombre = $request->entidad;
            }
        }

        $entidad->latitud = $request->latitud;
        $entidad->longitud = $request->longitud;
        $entidad->save();

        return redirect()->route('entidad.mostrar', [$entidad->id]);
    }


    public function eliminar($id)
    {
        $entidad = Entidad::find($id);

        if($entidad == null){
            $errores = [
                'error'    => ['La Entidad no existe'],
            ];
            return response()->json($errores, 422);

        }else{

//            $ubicaciones = Ubicacion::where('entidad_id', $id)->select('id')->get();

                if ($entidad->delete()){

//                foreach ($ubicaciones as $ubicacion) {
//                    DB::table('registro_ubicacion_sinonimia')->where('ubicacion_id', $ubicacion->id)->delete();
//                }

                return;
            }else{
                $errores = [
                    'error'    => ['Disculpe, no se pudo eliminar la entidad, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }
    
}
