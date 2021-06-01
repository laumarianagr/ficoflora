<?php

namespace App\Http\Controllers\Catalogo;

use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Ficoflora\Funcionalidades\Referencias\ReferenciasTextosTrait;
use App\Ficoflora\Funcionalidades\Referencias\SelectsFormularioReferenciasTrait;
use App\Ficoflora\Funcionalidades\ReferenciasTrait;
use App\Ficoflora\Registros\Catalogo\CatalogoRegistro;
use App\Http\Requests\Catalogo\CrearRegistroCatalogoRequest;

use App\Modelos\Bibliografia\Referencias\Revista;
use App\Modelos\Bibliografia\Referencias\Libro;
use App\Modelos\Bibliografia\Referencias\Catalogo;
use App\Modelos\Bibliografia\Referencias\Trabajo;
use App\Modelos\Bibliografia\Referencias\Enlace;

use App\Modelos\Catalogo\Registro;
use App\Modelos\Geografico\Ubicacion;
use App\Modelos\Sinonimias\Sinonimia;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Epitetos\Especifico;
use App\Modelos\Taxonomia\Epitetos\Forma;
use App\Modelos\Taxonomia\Epitetos\Subespecie;
use App\Modelos\Taxonomia\Epitetos\Varietal;
use App\Modelos\Taxonomia\Especie;
use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Genero;
use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegistrosController extends Controller
{

    use EspecieDatosTrait;

    use ReferenciasTrait;

    use ReferenciasTextosTrait;

    use SelectsFormularioReferenciasTrait;



    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.registros', ['only'=>['editar', 'eliminar', 'actualizar']]);

        //limitar agregar eliminar sinonimias al creador del registo
    }

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
        $familias = Familia::lists('nombre', 'id');

        //Quitando los genero que esta por sinonimia que no tienen arbol taxonómico superior
        $genero = Genero::where('familia_id', '!=', -1)->select('id', 'nombre', 'familia_id')->get();
        $especifico = Especifico::select('id', 'nombre')->get();
        $varietal = Varietal::select('id', 'nombre')->get();
        $forma = Forma::select('id', 'nombre')->get();
        $subespecie = Subespecie::select('id', 'nombre')->get();

        $autor = Autor::lists('nombre');


        $taxonomia = array('genero' => $genero, 'especifico' => $especifico, 'varietal' => $varietal, 'forma' => $forma, 'subespecie' => $subespecie, 'autor' => $autor);
        $taxonomia = json_encode($taxonomia);

        $cita_autores = $this->citaCantidadAutores();
        $tipo_trabajos = $this->tipoTrabajos();
        list($fecha, $fecha_ano, $fecha_mes, $fecha_dia) = $this->fechas();


        $lista_especies = $this->listaNombresEspecies();
        $lista_sinonimias = $this->listaNombreSinonimia();


        $entidades = Entidad::select('id', 'nombre')->get();
        $localidas = Localidad::select('id', 'nombre')->get();
        $lugares = Lugar::select('id', 'nombre')->get();
        $sitios = Sitio::select('id', 'nombre')->get();

        $geograficos = array('entidad' => $entidades, 'localidad' => $localidas, 'lugar' => $lugares, 'sitio' => $sitios);
        $geograficos = json_encode($geograficos);


//        dd($lista_sinonimias);
        return view('catalogo.crear', compact('taxonomia', 'familias', 'fecha', 'fecha_ano', 'fecha_dia', 'fecha_mes', 'cita_autores', 'tipo_trabajos', 'lista_especies', 'lista_sinonimias', 'geograficos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function guardar(CrearRegistroCatalogoRequest $request)
    {
//        dd($request->all());
        
//        return $request->all();

        $usuario = Auth::user();

        $registro = new CatalogoRegistro($request->all(), $usuario->id);
        $respuesta = $registro->newRegistro($request->all(), $usuario->id);


//        return $respuesta;
//        dd($respuesta);


        if($respuesta['error'] == true){
            if($request->ajax()) {
                $log = ['error' =>[$respuesta['log']]];

                return response()->json($log, 422);
            }
//            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }


        if($respuesta['existe'] == true){
            if($request->ajax()) {
                $log = ['error' =>["El registro ya existe"]];

                return response()->json($log, 422);
            }
//            return redirect()->route('reporte.crear')->withErrors('El registro ya existe');
        }

        $registro_obj = $respuesta['registro'];

        if($request->ajax()) {

            return $registro_obj;
        }

        return redirect()->route('registro.mostrar',$registro_obj->id);


    }

    //MOSTRAR
    public function mostrar($id)
    {

//        $especie = Especie::find(1);

//        dd($especie->entidades()->find(2));


        $registro = Registro::find($id);
//        dd($registro);

        $permisos = $registro->creador_id == Auth::user()->id ? true : false;



        $especie_obj = Especie::find($registro->especie_id);
        $especie = $this->especieDatos($especie_obj, null, true);

        switch ($registro->tipo_referencia) {

            case 'R':
                $referencia = Revista::find($registro->referencia_id);
                $texto = $this->getRevistaTexto($referencia);

                $tipo = 'R';
                break;

            case 'L':
                $referencia = Libro::find($registro->referencia_id);
                $texto = $this->getLibroTexto($referencia);

                $tipo = 'L';
                break;

            case 'C':
                $referencia = Catalogo::find($registro->referencia_id);
                $texto = $this->getCatalogoTexto($referencia);

                $tipo = 'C';
                break;

            case 'T':
                $referencia = Trabajo::find($registro->referencia_id);
                $texto = $this->getTrabajoTexto($referencia);

                $tipo = 'T';
                break;

            case 'E':
                $referencia = Enlace::find($registro->referencia_id);
                $texto = $this->getEnlaceTexto($referencia);

                $tipo = 'E';
                break;
        }

//        $re_ub_si = DB::table('registro_ubicacion_sinonimia')->where('registro_id', $registro->id)->get();

//        dd($re_ub_si);

        $reportes_datos = collect(DB::table('registro_ubicacion_sinonimia')
            ->where('registro_id', $registro->id)
            ->leftJoin('ubicaciones', 'registro_ubicacion_sinonimia.ubicacion_id', '=', 'ubicaciones.id')
            ->leftJoin('entidades', 'ubicaciones.entidad_id', '=', 'entidades.id')
            ->leftJoin('localidades', 'ubicaciones.localidad_id', '=', 'localidades.id')
            ->leftJoin('lugares', 'ubicaciones.lugar_id', '=', 'lugares.id')
            ->leftJoin('sitios', 'ubicaciones.sitio_id', '=', 'sitios.id')
            ->select(DB::raw('registro_ubicacion_sinonimia.id, entidades.nombre as entidad, localidades.nombre as localidad, lugares.nombre as lugar, sitios.nombre as sitio, registro_ubicacion_sinonimia.sinonimia_id'))
            ->orderBy('sinonimia_id')->orderBy('entidad')->orderBy('localidad')->orderBy('lugar')->orderBy('sitio')
            ->get());
//        dd($registros_datos);


        foreach ($reportes_datos as $repo) {

            if ($repo->sinonimia_id != null) {
                $info = $this->especieDatos(Sinonimia::find($repo->sinonimia_id), null, false);
                $repo->sinonimia = $info['nombre'] . ' ' . $info['autor'];

            } else {
                $repo->sinonimia = null;
            }

        }
//        dd($reportes_datos);


        $sinonimias = $this->listaNombreSinonimia();


        $entidades = Entidad::lists('nombre', 'id');
        $localidades = Localidad::select('id', 'nombre as text', 'entidad_id')->orderBy('text')->get()->groupBy('entidad_id');
//        $localidades = Localidad::select('id', 'nombre as text', 'entidad_id')->get()->groupBy('entidad_id');

//        dd($localidades->take(3));
        $lugares = Lugar::select('id', 'nombre as text', 'localidad_id')->orderBy('text')->get()->groupBy('localidad_id');
        $sitios = Sitio::select('id', 'nombre as text', 'lugar_id')->orderBy('text')->get()->groupBy('lugar_id');
//        dd($sitios);
        return view('catalogo.mostrar', compact('texto','permisos', 'registro', 'especie', 'referencia', 'tipo', 'reportes_datos', 'entidades', 'localidades', 'lugares', 'sitios', 'sinonimias'));

    }


    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function eliminar($id)
    {
        $regsitro = Registro::find($id);

//        return $regsitro;
        if ($regsitro == null) {
            $errores = [
                'error' => ['El Registro no existe'],
            ];
            return response()->json($errores, 422);

        } else {

            $especie = Especie::find($regsitro->especie_id);

            if ($regsitro->delete()) {

                $this->checkEspeciesRegistros($especie);

                return;
            } else {
                $errores = [
                    'error' => ['Disculpe, no se pudo eliminar el registro, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }

    public function checkEspeciesRegistros($especie)
    {
        $cant_reg = Registro::where('especie_id', $especie->id)->get();

        if(count($cant_reg) == 0){// es el último registro de la especie hay que sacarla del catalogo
            $especie->catalogo = 0;
            $especie->save();
        }
    }

    //ELIMINAR
    public function eliminarReporteUbicacionSinonimia($id)
    {

        $reporte = DB::table('registro_ubicacion_sinonimia')->where('id', $id)->first();


        if ($reporte == null) {
            $errores = [
                'error' => ['El Reporte de Sinonimia y/o Ubicación no existe'],
            ];
            return response()->json($errores, 422);

        } else {

            //Obtengo el registro y busco las especie que le corresponde
            $registro = Registro::find($reporte->registro_id);
            $especie = Especie::find($registro->especie_id);

            $sinonimia = $reporte->sinonimia_id;
            $ubicacion = $reporte->ubicacion_id;


            if($ubicacion != null){

                $datos =  collect(DB::table('registros')
                    ->where('especie_id', $especie->id)
                    ->leftJoin('registro_ubicacion_sinonimia', 'registros.id', '=', 'registro_ubicacion_sinonimia.registro_id')
                    ->leftJoin('ubicaciones', 'registro_ubicacion_sinonimia.ubicacion_id', '=', 'ubicaciones.id')
                    ->get());

            }else{//no hacemos join con la tabla ubicacion

                $datos =  collect(DB::table('registros')
                    ->leftJoin('registro_ubicacion_sinonimia', 'registros.id', '=', 'registro_ubicacion_sinonimia.registro_id')
                    ->where('especie_id', $especie->id)
                    ->get());
            }

            if($sinonimia != null){//buscamos cuantas relaciones tiene la especie con ella
                $relacion_sinonimia = $datos->where('sinonimia_id', $sinonimia);

                if($relacion_sinonimia->count() == 1){//se puede eliminar la relacion especie-sinonimia
                    $especie->sinonimias()->detach($sinonimia);
                }
            }



            if($ubicacion != null){
                $ubicacion = Ubicacion::find($reporte->ubicacion_id);

                $relacion_e = $datos->where('entidad_id', $ubicacion->entidad_id);
                if($relacion_e->count() == 1){//se puede eliminar la relacion especie-entidad
                    $especie->entidades()->detach($ubicacion->entidad_id);
                }

                if($ubicacion->localidad_id != null){
                    $relacion_l = $datos->where('localidad_id', $ubicacion->localidad_id);

                    if($relacion_l->count() == 1){//se puede eliminar la relacion especie-localidad
                        $especie->localidades()->detach($ubicacion->localidad_id);
                    }

                    if($ubicacion->lugar_id != null){
                        $relacion_lu = $datos->where('lugar_id', $ubicacion->lugar_id);

                        if($relacion_lu->count() == 1){//se puede eliminar la relacion especie-lugar
                            $especie->lugares()->detach($ubicacion->lugar_id);
                        }

                        if($ubicacion->sitio_id != null){
                            $relacion_s = $datos->where('sitio_id', $ubicacion->sitio_id);

                            if($relacion_s->count() == 1){//se puede eliminar la relacion especie-sitio
                                $especie->sitios()->detach($ubicacion->sitio_id);
                            }
                        }
                    }
                }
            }

            $del = DB::table('registro_ubicacion_sinonimia')->where('id', $id)->delete();
        }
    }

    public function agregarReporteUbicacionSinonimia($id, Request $request)
    {
//        return $request->all();

        if ($request->entidad != null) {

            $localidad = $lugar = $sitio = null;
            if ($request->has('localidad')) $localidad = $request->localidad;
            if ($request->has('lugar')) $lugar = $request->lugar;
            if ($request->has('sitio')) $sitio = $request->sitio;

            $ubicacion = Ubicacion::where('entidad_id', $request->entidad)->conLocalidad($localidad)->conLugar($lugar)->conSitio($sitio)->first();


            if ($ubicacion == null) {
                $errores = [
                    'error' => ['La ubicación no está registrada.'],//por si acaso
                ];
                return response()->json($errores, 422);
            }
            $ubicacion = $ubicacion->id;
        } else {
            $ubicacion = null;
        }


        $reporte = DB::table('registro_ubicacion_sinonimia')
            ->where('registro_id', $id)
            ->where('ubicacion_id', $ubicacion)
            ->where('sinonimia_id', $request->sinonimia)
            ->get();

//        return $this->setRelacionesConEspecie($ubicacion, $request->sinonimia, $id);

        if (!empty($reporte)) {
            $errores = [
                'error' => ['El reporte ya existe.'],
            ];
            return response()->json($errores, 422);
        } else {

             $this->setRelacionesConEspecie($ubicacion, $request->sinonimia, $id);

            DB::table('registro_ubicacion_sinonimia')->insert(
                ['registro_id' => $id, 'ubicacion_id' => $ubicacion, 'sinonimia_id' => $request->sinonimia]
            );

            return;
        }

    }


    public function getSinonimiaUbicacionRUStabla($id)
    {
        $reporte = DB::table('registro_ubicacion_sinonimia')
            ->where('id', $id)
            ->first();

        if ($reporte->ubicacion_id != null) {
            $ubicacion = Ubicacion::find($reporte->ubicacion_id);
        } else {
            $ubicacion = null;
        }

        if ($reporte->sinonimia_id != null) {
            $sinonimia = $reporte->sinonimia_id;
        } else {
            $sinonimia = null;
        }


        return [$ubicacion, $sinonimia];
    }

    public function actualizarReporteUbicacionSinonimia($id, $id_tabla, Request $request)
    {
        return $id_tabla;

    }


    public function setRelacionesConEspecie($ubicacion, $sinonimia, $registro)
    {

        $registro_obj = Registro::find($registro);

        $especie = Especie::find($registro_obj->especie_id);

        if ($ubicacion != null) {
            $ubicacion_obj = Ubicacion::find($ubicacion);

            if ($especie->entidades()->find($ubicacion_obj->entidad_id) == null) {//relacion especie-entidad
                $especie->entidades()->attach($ubicacion_obj->entidad_id);
            }

            if ($ubicacion_obj->localidad_id != null) {// relaciono la especie-localidad
                if ($especie->localidades()->find($ubicacion_obj->localidad_id) == null) {
                    $especie->localidades()->attach($ubicacion_obj->localidad_id);
                }
            }

            if ($ubicacion_obj->lugar_id != null) {// relaciono la especie-lugar
                if ($especie->lugares()->find($ubicacion_obj->lugar_id) == null) {
                    $especie->lugares()->attach($ubicacion_obj->lugar_id);
                }
            }
            if ($ubicacion_obj->sitio_id != null) {// relaciono la especie-sitio
                if ($especie->sitios()->find($ubicacion_obj->sitio_id) == null) {
                    $especie->sitios()->attach($ubicacion_obj->sitio_id);
                }
            }
        }


        if($sinonimia != null){
            if($especie->sinonimias()->find($sinonimia) == null){
                $especie->sinonimias()->attach($sinonimia);
            }
        }

    }
}
