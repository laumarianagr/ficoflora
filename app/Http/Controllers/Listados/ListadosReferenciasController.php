<?php

namespace App\Http\Controllers\Listados;

use App\Modelos\Bibliografia\Referencias\Revista;
use App\Modelos\Bibliografia\Referencias\Libro;
use App\Modelos\Bibliografia\Referencias\Catalogo;
use App\Modelos\Bibliografia\Referencias\Trabajo;
use App\Modelos\Bibliografia\Referencias\Enlace;
use App\Modelos\Catalogo\Registro;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ListadosReferenciasController extends Controller

{

    public function query_revistas()
    {
        $referencias = DB::table('referencias_revistas')
            ->select(DB::raw('autores as c1, fecha as c2, letra as c3,
                titulo as c4, nombre as c5, volumen as c6,
                numero as c7, intervalo as c8, isbn as c9,
                archivo as c10, comentarios as c11, "" as c13, "" as c14, "" as c15, "Artículo en Revista" as c12'));
        return $referencias;
    }

    public function query_libros()
    {
        $libros = DB::table('referencias_libros')
            ->select(DB::raw('autores as c1, fecha as c2, letra as c3,
                titulo as c4, editor as c5, editorial as c6,
                edicion as c7, lugar as c8, paginas as c9,
                isbn as c10, comentarios as c11, archivo as c13, "" as c14, "" as c15, "Libro" as c12'));
        return $libros;
    }

    public function query_catalogos()
    {
        $catalogos = DB::table('referencias_catalogos')
            ->select(DB::raw('autores as c1, fecha as c2, letra as c3,
                titulo as c4, nombre as c5, editor_editorial as c6,
                edicion as c7, lugar as c8, paginas as c9,
                isbn as c10, comentarios as c11, archivo as c13, volumen as c14, numero as c15, "Catálogo" as c12'));
        return $catalogos;
    }

    public function query_trabajos()
    {
        $trabajos = DB::table('referencias_trabajos')
            ->select(DB::raw('autores as c1, fecha as c2, letra as c3,
                titulo as c4, tipo as c5, institucion as c6,
                lugar as c7, paginas as c8, "" as c9,
                "" as c10, comentarios as c11, "" as c13, "" as c14, "" as c15, "Trabajo Académico" as c12'))
            ->where('comentarios', 'not LIKE', '%NSM%')
            ->orwhereNull('comentarios');
        return $trabajos;
    }

    public function query_enlaces()
    {
        $enlaces = DB::table('referencias_enlaces')
            ->select(DB::raw('autores as c1, fecha as c2, letra as c3,
                nombre as c4, titulo as c5, institucion as c6,
                lugar as c7, enlace as c8, dia as c9,
                mes as c10, ano as c11, "" as c13, "" as c14, "" as c15, "Sitio Web" as c12'));
        return $enlaces;
    }

    // consulta una referencia según su id
    public function referencia()
    {
        $revistas = $this->query_revistas();
        $libros = $this->query_libros();
        $trabajos = $this->query_trabajos();
        $catalogos = $this->query_catalogos();
        $enlaces = $this->query_enlaces()
            ->union($revistas)
            ->union($libros)
            ->union($catalogos)
            ->union($trabajos)
            ->orderBy('c1')->orderBy('c2')->orderBy('c3')
            ->get();
        $referencias = $enlaces;
    }

//---------->>>>>>>>>>
// CONSULTAS PARA LAS LISTAS DE REFERENCIAS
//---------->>>>>>>>>>
    // consulta de TODAS las referencias bibliográficas, se utiliza en la vista del listado de todas las referencias
    public function referencias()
    {
        $revistas = $this->query_revistas();
        $totalR = DB::table('referencias_revistas')->count();

        $libros = $this->query_libros();
        $totalL = DB::table('referencias_libros')->count();

        $catalogos = $this->query_catalogos();
        $totalC = DB::table('referencias_catalogos')->count();

        $trabajos = $this->query_trabajos();
        $totalT = DB::table('referencias_trabajos')
            ->where('comentarios', 'not LIKE', '%NSM%')
            ->orwhereNull('comentarios')
            ->count();

        $totalE = DB::table('referencias_enlaces')->count();
        $enlaces = $this->query_enlaces()
            ->union($revistas)
            ->union($libros)
            ->union($catalogos)
            ->union($trabajos)
            ->orderBy('c1')->orderBy('c2')->orderBy('c3')
            ->get();
        $referencias = $enlaces;

        $total = $totalR + $totalL + $totalC + $totalT + $totalE;

        return view('listados.referencias.referencias',
            compact('referencias', 'total', 'totalR', 'totalL', 'totalC', 'totalT', 'totalE'));
    }

    //consulta utilizada en la vista del listados de las referencias bibliográficas tipo Revista
    public function revistas()
    {
        $referencias = $this->query_revistas()
            ->orderBy('c1')->orderBy('c2')->orderBy('c3')
            ->get();
        $total = DB::table('referencias_revistas')->count();
        $tipo = 'Revistas';

        return view('listados.referencias.revistas', compact('tipo', 'total', 'referencias'));
    }

    //consulta utilizada en la vista del listado de las referencias bibliográficas tipo Libro
    public function libros()
    {
        $referencias = $this->query_libros()
            ->orderBy('c1')->orderBy('c2')->orderBy('c3')
            ->get();
        $total = DB::table('referencias_libros')->count();
        $tipo = 'Libros';

        return view('listados.referencias.libros', compact('tipo', 'total', 'referencias'));
    }

    //consulta utilizada en la vista del listado de las referencias bibliográficas tipo Catálogo
    public function catalogos()
    {
        $referencias = $this->query_catalogos()
            ->orderBy('c1')->orderBy('c2')->orderBy('c3')
            ->get();
        $total = DB::table('referencias_catalogos')->count();
        $tipo = 'Catálogos';

        return view('listados.referencias.catalogos', compact('tipo', 'total', 'referencias'));
    }

    //consulta utilizada en la vista del listado de las referencias bibliográficas tipo Enlace o sitio web
    public function enlaces()
    {
        $referencias = $this->query_enlaces()
            ->orderBy('c1')->orderBy('c2')->orderBy('c3')
            ->get();
        $total = DB::table('referencias_enlaces')->count();
        $tipo = 'Sitios Web';

        return view('listados.referencias.enlaces', compact('tipo', 'total', 'referencias'));
    }

    //consulta utilizada en la vista del listado de las referencias bibliográficas tipo Trabajos Académicos
    public function trabajos()
    {
        $referencias = $this->query_trabajos()
            ->orderBy('c1')->orderBy('c2')->orderBy('c3')
            ->get();
        $total = DB::table('referencias_trabajos')
            ->where('comentarios', 'not LIKE', '%NSM%')
            ->orwhereNull('comentarios')
            ->count();
        $tipo = 'Trabajos Académicos';

        return view('listados.referencias.trabajos', compact('tipo', 'total', 'referencias'));
    }

//---------->>>>>>>>>>
// CONSULTAS PARA UNA REFERENCIA ESPECÍFICA
//---------->>>>>>>>>>

    public function tipoTrabajoAcademico($tipo)
    {
        switch ($tipo){
            case 'Tesis (Doctorado)': $ta = 'Tesis de Doctorado'; break;
            case 'Tesis (Maestría)': $ta = 'Tesis de Maestría'; break;
            case 'Trabajo Especial de Grado (Licenciatura)': $ta = 'Trabajo Especial de Grado'; break;
            default: $ta = ''; break;
        }
        return $ta;
    }

    public function referenciaInfo($id, $tipo)
    {  // la referencia se arma para mostrar en la pagina en view > listados > referencias > _parciales > _referencias.blade.php

        // $registrosdb = DB::table('registros')->where('referencia_id', '=', $id)->get();
        // $registros = collect($registrosdb);


        //-------------------------------------------------------------------------------//

       
        $registrosdb = DB::table('registros')
            ->join('registro_ubicacion_sinonimia', 'registros.id', '=', 'registro_ubicacion_sinonimia.registro_id')
            ->join('ubicaciones', 'registro_ubicacion_sinonimia.ubicacion_id', '=', 'ubicaciones.id')
            ->select('ubicaciones.*')
            ->where('referencia_id', $id)
            ->get();
        $registros = collect($registrosdb);    

    
        //$entidad = array();
        foreach ($registros as $registrosUb) {
            if($registrosUb->entidad_id != null && $registrosUb->localidad_id != null  && $registrosUb->lugar_id != null && $registrosUb->sitio_id != null ) {

                // $entidades = DB::table('entidades')
                //     ->select('entidades.nombre')
                //     ->where('id', '=', $registrosUb->entidad_id)  
                //     ->get();

                $entidades = DB::table('entidades') 
                    ->join('localidades', 'entidades.id', '=', 'localidades.entidad_id') 
                    ->join('lugares', 'localidades.id', '=', 'lugares.localidad_id') 
                    ->join('sitios', 'lugares.id', '=', 'sitios.lugar_id')
                    ->select('entidades.nombre as nombre_entidad', 'entidades.id as entidad_id', 'localidades.nombre as nombre_localidad', 'localidades.id as localidad_id', 'lugares.nombre as nombre_lugar', 'lugares.id as entidad_id', 'sitios.nombre as nombre_sitio') 
                    ->where('entidades.id', $registrosUb->entidad_id)                                 
                    ->get();
                
                
                //array_push($entidad, $entidadDB);
                //$entidad = collect($entidadArr);


            }
            elseif($registrosUb->entidad_id != null && $registrosUb->localidad_id != null  && $registrosUb->lugar_id != null ) {

                // $entidades = DB::table('entidades')
                //     ->select('entidades.nombre')
                //     ->where('id', '=', $registrosUb->entidad_id)  
                //     ->get();

                $entidades = DB::table('entidades') 
                    ->join('localidades', 'entidades.id', '=', 'localidades.entidad_id') 
                    ->join('lugares', 'localidades.id', '=', 'lugares.localidad_id') 
                    ->select('entidades.nombre as nombre_entidad', 'entidades.id as entidad_id', 'localidades.nombre as nombre_localidad', 'localidades.id as localidad_id', 'lugares.nombre as nombre_lugar', 'lugares.id as entidad_id') 
                    ->where('entidades.id', $registrosUb->entidad_id)                                 
                    ->get();
                
                // array_push($entidadArr, $entidadDB);
                // $entidad = collect($entidadArr);


            }
            
            elseif($registrosUb->entidad_id != null && $registrosUb->localidad_id != null && $registrosUb->lugar_id == null) {

          

                $entidades = DB::table('entidades') 
                    ->join('localidades', 'entidades.id', '=', 'localidades.entidad_id') 
                    ->select('entidades.nombre as nombre_entidad', 'entidades.id as entidad_id', 'localidades.nombre as nombre_localidad', 'localidades.id as localidad_id') 
                    ->where('entidades.id', $registrosUb->entidad_id)                                 
                    ->get();
                //$entidadDB = collect($entidades);
                // array_push($entidadArr, $entidadDB);
                // $entidad = collect($entidadArr);


            }

          
            else {

                $entidades = DB::table('entidades')
                    ->select('entidades.nombre as nombre_entidad')
                    ->where('id', '=', $registrosUb->entidad_id)  
                    ->get();
            //     $entidadDB = collect($entidades);
            //     array_push($entidadArr, $entidadDB);
            //     $entidad = collect($entidadArr);   
            }
            
            $entidad = collect($entidades);
            //array_push($entidad, $entidadDB);
            $totalReg = count($entidad);

        } 

        
        if ($tipo == 'r') {//consulta para un artículo específico en Revista
            $referencia = Revista::find($id);
            $tipo = "Artículo en Revista";
            return view('listados.referencias.referencia', compact('tipo', 'referencia', 'registros', 'entidad','totalReg'));

        }elseif ($tipo == 'l') {//consulta para una referencia en un Libro
            $referencia = Libro::find($id);
            $tipo = "Libro";
            return view('listados.referencias.referencia', compact('tipo', 'referencia', 'registros', 'entidad','totalReg'));

        }elseif ($tipo == 'c') {//consulta para una referencia en un Catálogo
            $referencia = Catalogo::find($id);
            $tipo = "Catálogo";
            return view('listados.referencias.referencia', compact('tipo', 'referencia', 'registros', 'entidad','totalReg'));

        }elseif ($tipo == 'e') {//consulta para una referencia en un Sitio Web
            $referencia = Enlace::find($id);
            $tipo = "Sitio Web";
            return view('listados.referencias.referencia', compact('tipo', 'referencia', 'registros', 'entidad','totalReg'));

        }elseif ($tipo == 't') {//consulta para una referencia en un Trabajo Académico
            $referencia = Trabajo::find($id);
            $tipo = "Trabajo Académico";
            $ta = $this->tipoTrabajoAcademico($referencia->$tipo);            
            return view('listados.referencias.referencia', compact('ta', 'tipo', 'referencia', 'registros', 'entidad','totalReg'));

        }
    }
}
