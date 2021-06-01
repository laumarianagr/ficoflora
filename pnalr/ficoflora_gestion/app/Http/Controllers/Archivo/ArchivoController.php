<?php namespace App\Http\Controllers\Archivo;

use App\Ficoflora\Archivo\Archivo;
use App\Ficoflora\Archivo\Datos\Geografico\UbicacionDatos;
use App\Ficoflora\Archivo\Datos\Referencias\EnlacesDatos;
use App\Ficoflora\Archivo\Datos\Referencias\LibrosDatos;
use App\Ficoflora\Archivo\Datos\Referencias\RevistasDatos;
use App\Ficoflora\Archivo\Datos\Referencias\TrabajosDatos;
use App\Ficoflora\Archivo\Datos\Catalogo\CatalogoRegistroDatos;

use App\Ficoflora\Archivo\Exportar\Exportar;
use App\Http\Requests;

use App\Http\Requests\Archivos\ArchivoExportarRequest;
use App\Http\Requests\Archivos\ArchivoRequest;
use App\Modelos\Catalogo\Registro;
use App\Modelos\Imagenes\Imagen;
use App\Modelos\Taxonomia\Epitetos\Especifico;
use App\Modelos\Taxonomia\Epitetos\Varietal;
use App\Modelos\Taxonomia\Especie;
use App\Modelos\Taxonomia\Genero;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;


class ArchivoController extends Controller {

    private  $archivo;
    private  $nombreArchivo;
    private  $tipo_archivo;
//    private  $log = array();


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('equipo.coordinador');
    }

    /**
     * Se llama la vista con el formulario de importación de archivo
     *
     * @return \Illuminate\View\View
     */
    public function importar()
    {


        $tipo = Array(

            null=> 'seleccione una opción',


            'Registros' => array(
                'registros' => 'Registros de Especies',
            ),


            'Bibliográficos' => array(
                'enlaces' => 'Sitios Web',
                'libros' => 'Libros',
                'revistas' => 'Revistas',
                'trabajos' => 'Trabajos Académicos',
            ),

            'Geográficos' => array(
                'coordenadas' => 'Coordenadas geográficas',
            ),


        );


        return view("archivos.importar", compact('tipo'));
    }

  public function exportar_index()
    {
        $tipo = Array(

            null=> 'seleccione una opción',

            'Registros' => array(
                'registros' => 'Registros de Especies',
            ),

            'Bibliográficos' => array(
                'enlaces' => 'Sitios Web',
                'libros' => 'Libros',
                'revistas' => 'Revistas',
                'trabajos' => 'Trabajos Académicos',
            ),

            'Geográficos' => array(
                'coordenadas' => 'Coordenadas geográficas',
            ),


        );

        return view("archivos.exportar", compact('tipo'));
    }

    public function exportar(ArchivoExportarRequest $request)
    {
        $archivo = new Exportar();

        switch($request->tipo)
        {
            case "registros":
              $archivo->catalogo(false);
                break;

            case "libros":
                $archivo->libros(false);
                break;

            case "revistas":
                $archivo->revistas(false);
                break;


            case "trabajos":
                $archivo->trabajos(false);
                break;

            case "enlaces":
                $archivo->enlaces(false);
                break;

            case "coordenadas":
                $archivo->coordenadas(false);
                break;
        }

    }

    public function modelo($tipo)
    {
        $archivo = new Exportar();

        switch($tipo)
        {
            case "registros":
                $archivo->catalogo(true);
                break;

            case "libros":
                $archivo->libros(true);
                break;

            case "revistas":
                $archivo->revistas(true);
                break;

            case "trabajos":
                $archivo->trabajos(true);
                break;

            case "enlaces":
                $archivo->enlaces(true);
                break;

            case "coordenadas":
                $archivo->coordenadas(true);
                break;
        }

    }


    /**
     * Validamos la extension del archivo y los guardamos temporalmente.
     *
     */
    public function guardar(ArchivoRequest $request)
    {
//        dd($request->all());
        $this->archivo = $request->file('archivo');
        $this->nombreArchivo = Archivo::guardar($this->archivo);

        $this->tipo_archivo = $request->tipo;

        return $this->revisarEstructura();

    }

    /**
     * Se revisa la estructura del archivo (cantidad de columnas y el nombre de ellas)
     *
     */
    private function revisarEstructura()
    {
        if (Storage::exists($this->nombreArchivo))//revisamos que se guardo el archivo
        {
            $archivo = new Archivo();//Verificamos la estructura del archivo
            $respuesta = $archivo->revisarFormato($this->archivo, $this->tipo_archivo);//Verificamos la estructura del archivo de acuero al tipo

            if($respuesta['error']){ //si hubo errores
                Storage::delete($this->nombreArchivo);
                return redirect()->back()->withErrors($respuesta['log'])->withInput();
            }

            return $this->extraerDatos();

        }else{
            return redirect()->back()->withErrors("Importe nuevamente el archivo"); //No se guardo el archivo
        }
    }

    /**
     * Se extraen los datos del archivo y se pasan a un arreglo.
     *
     */
    private function extraerDatos()
    {
        $datos = Archivo::extraerDatos($this->archivo);  // Se extraen todos los datos del archivo.
        Storage::delete($this->nombreArchivo);

        if($datos == null){ // no se extrajo nada del archivo
            return redirect()->back()->withErrors("No se pudo leer el archivo");
        }
        return $this->procesarDatos($datos);
    }



    private function procesarDatos($datos)
    {
        Session::put('archivo',$this->tipo_archivo);

        switch($this->tipo_archivo)
        {
            case "registros":
                $archivo = new CatalogoRegistroDatos();
                $log = $archivo->procesar($datos);
                break;

            case "libros":
                $archivo = new LibrosDatos();
                $log = $archivo->procesar($datos);
                break;


            case "revistas":
                $archivo = new RevistasDatos();
                $log = $archivo->procesar($datos);
                break;

            case "trabajos":
                $archivo = new TrabajosDatos();
                $log = $archivo->procesar($datos);
                break;

            case "enlaces":
                $archivo = new EnlacesDatos();
                $log = $archivo->procesar($datos);
                break;

            case "coordenadas":
                $archivo = new UbicacionDatos();
                $log = $archivo->procesar($datos);
                break;
        }


        if($log != null) {
            $total= count($log);

            $ruta = $this->crearArchivoLog($log);
            Session::put('ruta',$ruta);
//            dd(Session::all());

//            return redirect()->back()->withErrors("Se detectaron errores en algunos registros, revise la tabla de resultados.")->withInput()->with(['log' => $log, 'total' => $total]);
            return redirect()->route('archivo.index')->with(['log' => $log, 'total' => $total, 'warning'=> "Se detectaron errores en algunos registros, revise la tabla de resultados."]);
        }else{
            return redirect()->route('archivo.index')->with('exito', "Archivo importado correctamente");
        }

    }


    public function crearArchivoLog($log){
        $errores="";
        $nombre_fichero_tmp = tempnam("/tmp", "FOO");
        foreach($log as $error){
            $errores.="Fila ".$error['fila']." - ".$error['error']."\r\n";
//            $errores.="Fila ".$error['fila'].": ".$error['error']." (ERROR: ".$error['tipo'].")\r\n";
        }
        File::put($nombre_fichero_tmp, $errores);
        return $nombre_fichero_tmp;
    }


    public function descargarArchivoLog()
    {
//        dd(Session::all());
        $archivo_tipo = Session::get('archivo');
        $ruta = Session::get('ruta');
        $fecha = Carbon::now();
//        dd($fecha->format('d-m-y_h.').$fecha->minute.'.'.$fecha->second);
        
        $headers = array(
            'Content-Type: application/pdf',
        );
        return Response::download($ruta, 'log_'.$archivo_tipo.'_'.$fecha->format('d-m-y_h.').$fecha->minute.'.'.$fecha->second.'.txt', $headers);
        
    }


    public function setImagenes()
    {


        $imagenes = Imagen::all();

//        dd($imagenes);

//        $imagenes = ($imagenes->take(2));
        ini_set('max_execution_time', 10000);

        foreach ($imagenes as $imagen) {

            $datos = explode('_', $imagen->imagen);
            
            $cant = count($datos);
//            dd($datos);

            $genero = Genero::where('nombre', $datos[0])->first();
            $especifico = Especifico::where('nombre', $datos[1])->first();

//            dd($genero, $especifico);
            if($cant <= 3){
                $especie = Especie::where('genero_id', $genero['id'])->conEspecifico($especifico['id'])->conVarietal(null)->conForma(null)->first();
                if($especie != null){
                    $imagen->especie_id= $especie->id;
//                    $imagen->imagen = ucfirst($imagen->imagen);
                    $imagen->save();
                }
            }
//else{
//
//                $varital = Varietal::where('nombre', $datos[2])->first();
//                if($varital != null){
//                    $especie = Especie::where('genero_id', $genero['id'])->conEspecifico($especifico['id'])->conVarietal($varital['id'])->conForma(null)->first();
////                    dd($especie);
//
//                }
//            }


        }

        dd('ok');
    }


    public function uperName()
    {
        $imagenes = Imagen::all();

        ini_set('max_execution_time', 10000);

        foreach ($imagenes as $imagen) {
            $imagen->imagen = ucfirst($imagen->imagen);
            $imagen->save();
//            return;
        }

    }


}
