<?php

namespace App\Http\Controllers\Geograficos;

use App\Ficoflora\Registros\Geograficos\UbicacionRegistro;
use App\Http\Requests\Geografico\CrearUbicacionRequest;
use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;
use App\Modelos\Geografico\Ubicacion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UbicacionController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
//        $this->middleware('creador.especie', ['only'=>['editar', 'eliminar', 'actualizar']]);
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
        $localidas = Localidad::select('id', 'nombre')->get();
        $lugares = Lugar::select('id', 'nombre')->get();
        $sitios = Sitio::select('id', 'nombre')->get();

        $geograficos = array('entidad' =>$entidades, 'localidad' =>$localidas, 'lugar' => $lugares, 'sitio' => $sitios);
        $geograficos = json_encode($geograficos);

        return view('geograficos.ubicacion.crear', compact('geograficos'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function guardar(CrearUbicacionRequest $request)
    {

//        dd($request->all());
        $especie = null;

//        if($request->ajax()) {
//            if($request->has('especie')){
//                $especie = $request->especie;
//            }else{
//                $log = ['error' =>["Disculpe, hubo un error con el registro de la especie, regrese al paso 1"]];
//                return response()->json($log, 422);
//            }
//        }


        $registro = new UbicacionRegistro($request->all(),$especie);
        $respuesta = $registro->newUbicacion();

//      ERROR
        if($respuesta['error'] == true){

            if($request->ajax()) {
                $log = ['error' =>[$respuesta['log']]];
                return response()->json($log, 422);
            }
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }

        //Para desplegar en la lista de ubicaciones agregadas
        $nombres = $this->getNombreUbicacion($request);

        $ubicacion = $respuesta['registro'];

//      EXISTE
        if($respuesta['existe'] == true){
            if($request->ajax()) {
                $nuevo = false;
                return compact('ubicacion', 'nuevo', 'nombres');
            }
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }

//      GUARDAR
        $ubicacion->save();

        if($request->ajax()) {
            $nuevo =true;
            return compact('ubicacion', 'nuevo', 'nombres');
        }


        dd($ubicacion);
        return redirect()->route('entidad.mostrar');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function mostrar($id)
    {
        $ubicacion = Ubicacion::find($id);

        $ubicacion->entidad= Entidad::find($ubicacion->entidad_id)->nombre;
        $ubicacion->localidad = $ubicacion->lugar = $ubicacion->sitio = null;

        if($ubicacion->localidad_id != null){
            $ubicacion->localidad= Localidad::find($ubicacion->localidad_id)->nombre;

            if($ubicacion->lugar_id != null){
                $ubicacion->lugar= Lugar::find($ubicacion->lugar_id)->nombre;

                if($ubicacion->sitio_id != null){
                    $ubicacion->sitio= Sitio::find($ubicacion->sitio_id)->nombre;
                }
            }
        }

//        dd($ubicacion);

        return view('geograficos.ubicacion.mostrar', compact('ubicacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function eliminar($id)
    {
        $ubicacion = Ubicacion::find($id);

        if ($ubicacion == null) {
            $errores = [
                'error' => ['La ubicacion no existe'],
            ];
            return response()->json($errores, 422);

        } else {

            if ($ubicacion->delete()) {
                return;
            } else {
                $errores = [
                    'error' => ['Disculpe, no se pudo eliminar la ubicacion, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }

    private function getNombreUbicacion(CrearUbicacionRequest $request)
    {
        $ubicacion = $request->entidad;

        if ($request->has('localidad')) {
            $ubicacion = $ubicacion . ' <b> > </b>' . $request->localidad;
        }
        if ($request->has('lugar')) {
            $ubicacion = $ubicacion . ' <b> > </b> ' . $request->lugar;
        }
        if ($request->has('sitio')) {
            $ubicacion = $ubicacion . ' <b> > </b> ' . $request->sitio;
        }

        return $ubicacion;
    }


}
