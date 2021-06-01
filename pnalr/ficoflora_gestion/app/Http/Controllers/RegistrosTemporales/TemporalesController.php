<?php

namespace App\Http\Controllers\RegistrosTemporales;

use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Ficoflora\Funcionalidades\Referencias\ReferenciasTextosTrait;
use App\Ficoflora\Funcionalidades\Referencias\SelectsFormularioReferenciasTrait;
use App\Modelos\Bibliografia\Referencias\Libro;
use App\Modelos\Cuentas\Usuario;
use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;
use App\Modelos\RegistrosTemporales\Temporal;
use App\Modelos\Sinonimias\Sinonimia;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Clase;
use App\Modelos\Taxonomia\Epitetos\Especifico;
use App\Modelos\Taxonomia\Epitetos\Forma;
use App\Modelos\Taxonomia\Epitetos\Varietal;
use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Genero;
use App\Modelos\Taxonomia\Orden;
use App\Modelos\Taxonomia\Phylum;
use App\Modelos\Taxonomia\Subclase;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TemporalesController extends Controller
{

    use EspecieDatosTrait;
    use SelectsFormularioReferenciasTrait;
    use ReferenciasTextosTrait;


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $temporales =  DB::table('temporales')
            ->select(DB::raw('id, genero, especifico, varietal, forma, autor, referencia, referencia_tipo'))
            ->get();

//        dd($temporales);

        $reportes = collect();

        foreach ($temporales as $temporal) {

            $reporte = [];
            $referencia = json_decode($temporal->referencia);
            $reporte['autores'] =$referencia->autores;
            $reporte['fecha'] =$referencia->fecha;
            $reporte['titulo'] =$referencia->titulo;

            switch($temporal->referencia_tipo){

                case 'L':
                    $reporte['tipo'] = 'Libro';
                    break;
                case 'R':
                    $reporte['tipo'] = 'Revista';
                    break;
                case 'T':
                    $reporte['tipo'] = 'Trabajo';
                    break;
            }

            $reporte['id'] = $temporal->id;

            $reporte['especie'] = $this->especieObjNombre($temporal);


            $reportes->push($reporte);

        }


//        dd($reportes);

        return view('temporales.index', compact('reportes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function crear()
    {

        $phylum = Phylum::select('id', 'nombre')->get();
        $clase = Clase::select('id', 'nombre', 'phylum_id')->get();
        $subclase = Subclase::select('id', 'nombre', 'clase_id')->get();
        $orden = Orden::select('id', 'nombre', 'subclase_id', 'clase_id')->get();
        $familia = Familia::select('id', 'nombre', 'orden_id')->get();
        $genero = Genero::where('familia_id', '!=', -1)->select('id', 'nombre', 'familia_id')->get();
        $especifico = Especifico::select('id', 'nombre')->get();
        $varietal = Varietal::select('id', 'nombre')->get();
        $forma = Forma::select('id','nombre')->get();
        $autor = Autor::lists('nombre');


        $taxonomia = array( 'phylum' => $phylum, 'clase' => $clase, 'subclase' => $subclase, 'orden' => $orden, 'familia' => $familia, 'genero' => $genero, 'especifico' => $especifico, 'varietal' => $varietal, 'forma' => $forma, 'autor' => $autor);
        $taxonomia = json_encode($taxonomia);


        $entidades = Entidad::select('id', 'nombre')->get();
        $localidas = Localidad::select('id', 'nombre')->get();
        $lugares = Lugar::select('id', 'nombre')->get();
        $sitios = Sitio::select('id', 'nombre')->get();

        $geograficos = array('entidad' => $entidades, 'localidad' => $localidas, 'lugar' => $lugares, 'sitio' => $sitios);
        $geograficos = json_encode($geograficos);

        $cita_autores = $this->citaCantidadAutores();
        $tipo_trabajos = $this->tipoTrabajos();
        list($fecha, $fecha_ano, $fecha_mes, $fecha_dia) = $this->fechas();

        $lista_especies = $this->listaNombresEspecies();
        $lista_sinonimias = $this->listaNombreSinonimia();

        return view('temporales.crear', compact('geograficos','lista_especies', 'taxonomia', 'fecha','fecha_ano', 'fecha_dia', 'fecha_mes', 'cita_autores', 'tipo_trabajos', 'lista_sinonimias'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function guardar(Request $request)
    {
//        dd($request->all());

        $usuario = Auth::user();

        switch($request->referencia){

            case 'L':
                $referencia = $this->getObjetoLibro($request);
                break;
            case 'R':
                $referencia = $this->getObjetoRevista($request);
                break;
            case 'T':
                $referencia = $this->getObjetoTrabajo($request);
                break;
        }


        if($request->especie_id != null){

            $especie = $this->especieDatos(null, $request->especie_id, true);

            $phylum  = $especie['phylum'];  $clase = $especie['clase']; $subclase = $especie['subclase'];
            $orden = $especie['orden']; $familia  = $especie['familia']; $genero = $especie['genero'];
            $especifico = $especie['especifico']; $varietal  = $especie['varietal']; $forma = $especie['forma']; $autor  = $especie['autor'];

        }else{

            $phylum  = $request->phylum; $clase = $request->clase; $subclase =$request->subclase;$orden = $request->orden;
            $familia  = $request->familia; $genero = $request->genero; $especifico =$request->especie;
            $varietal  = $request->variedad; $forma =$request->forma; $autor  = $request->autor;

        }
        $sinonimias = collect();
        
        if($request->sinonimias_ids != null){
            $sinonimias_ids = explode(',', $request->sinonimias_ids);

            foreach ($sinonimias_ids as $id) {
                $obj_s = Sinonimia::find($id);
                $datos = $this->especieDatos($obj_s, null, false);
                $sinonimias->push($datos['nombre'].' '.$datos['autor']);
            }
        }
        
        if($request->sinonimias_nombres != null){
            $sinonimias_nombres = explode(',', $request->sinonimias_nombres);
            foreach ($sinonimias_nombres as $nombre) {
                $sinonimias->push($nombre);
            }
        }


        $temporal = new Temporal([
            'phylum' => $phylum, 'clase'=> $clase, 'subclase'=>$subclase,'orden'=> $orden, 'familia' => $familia,
            'genero' => $genero, 'especifico'=>$especifico,'varietal' => $varietal, 'forma'=>$forma, 'autor' => $autor,
            'referencia' => $referencia, 'referencia_tipo' => $request->referencia, 'sinonimias' => $sinonimias, 'ubicacion'=> $request->ubicaciones, 'creador_id' =>$usuario->id
        ]);


        $temporal->save();



        return redirect()->route('temporal.mostrar', $temporal->id);

        return redirect()->route('temporal.crear')->with('exito', "Reporte enviando correctamente");


    }



    //MOSTRAR
    public function mostrar($id)
    {
        $temporal =  DB::table('temporales')
            ->where('id', $id)
            ->first();
        
        
        $usuario = Usuario::find($temporal->creador_id);


        $referencia = json_decode($temporal->referencia);

        switch($temporal->referencia_tipo){

            case 'L':
                $texto = $this->getLibroTexto($referencia);
                break;
            case 'R':
                $texto = $this->getRevistaTexto($referencia);
                break;
            case 'T':
                $texto = $this->getTrabajoTexto($referencia);
                break;
        }

        $sinonimias = json_decode($temporal->sinonimias);

        $ubicaciones = $this->procesarUbicacion($temporal->ubicacion);


        $especie = $this->especieNombre($temporal);
        

        return view('temporales.mostrar', compact('temporal', 'especie', 'referencia', 'sinonimias', 'texto', 'ubicaciones', 'usuario'));

    }


    //ELIMINAR
    public function eliminar($id)
    {
        $temporal = Temporal::find($id);

//        return $temporal;
        if ($temporal == null) {
            $errores = [
                'error' => ['El Registro no existe'],
            ];
            return response()->json($errores, 422);

        } else {


            if ($temporal->delete()) {

                return;
            } else {
                $errores = [
                    'error' => ['Disculpe, no se pudo eliminar el registro, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }


    public function temporales()
    {

        $usuario = Auth::user();


        $temporales =  DB::table('temporales')
            ->where('temporales.creador_id', $usuario->id)
            ->select(DB::raw('id, genero, especifico, varietal, forma, autor, referencia, referencia_tipo'))
            ->get();

//        dd($temporales);

        $reportes = collect();

        foreach ($temporales as $temporal) {

            $reporte = [];
            $referencia = json_decode($temporal->referencia);
            $reporte['autores'] =$referencia->autores;
            $reporte['fecha'] =$referencia->fecha;
            $reporte['titulo'] =$referencia->titulo;

            switch($temporal->referencia_tipo){

                case 'L':
                    $reporte['tipo'] = 'Libro';
                    break;
                case 'R':
                    $reporte['tipo'] = 'Revista';
                    break;
                case 'T':
                    $reporte['tipo'] = 'Tipo';
                    break;
            }

            $reporte['id'] = $temporal->id;

            $reporte['especie'] = $this->especieObjNombre($temporal);


            $reportes->push($reporte);

        }


//        dd($reportes);

        return view('temporales.temporales-usuario', compact('reportes'));

    }

    


   //"entidad_23_234,entidad_24_24|localida_345_345|lugar_345_435|sitio_234_234"

    public function procesarUbicacion($temporal_ubicacion)
    {
        if ($temporal_ubicacion != null) {

            $ubicaciones_datos = explode(',', $temporal_ubicacion);

            $ubicaciones = collect();
            foreach ($ubicaciones_datos as $ubicacion) {

                $datos = explode('|', $ubicacion);                
                $u=count($datos);
                $reporte = [];

                $reporte['entidad']=explode('_',$datos[0]);
                $reporte['localidad']= $reporte['lugar']= $reporte['sitio']= null;
                if($u>1) {
                    $reporte['localidad'] = explode('_', $datos[1]);
                    if($u >2){
                        $reporte['lugar'] = explode('_', $datos[2]);
                        if($u >3) {
                            $reporte['sitio'] = explode('_', $datos[3]);
                        }
                    }
                }

                $ubicaciones->push($reporte);
            }
        }else{
            return collect();
        }

        return $ubicaciones;

//        dd($ubicaciones);
    }
   
}
