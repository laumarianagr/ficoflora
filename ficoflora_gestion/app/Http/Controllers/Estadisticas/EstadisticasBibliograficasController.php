<?php

namespace App\Http\Controllers\Estadisticas;

use App\Modelos\Bibliografia\Referencias\Revista;
use App\Modelos\Bibliografia\Referencias\Libro;
use App\Modelos\Bibliografia\Referencias\Trabajo;
use App\Modelos\Bibliografia\Referencias\Catalogo;
use App\Modelos\Bibliografia\Referencias\Enlace;
use App\Modelos\Catalogo\Registro;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EstadisticasBibliograficasController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor');
//        $this->middleware('creador.especie', ['only'=>['editar', 'eliminar', 'actualizar']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $referencias = [

            ['tipo' => 'Libros', 'total' => count(Libro::all()), 'ruta'=>'libros'],

            ['tipo' => 'Artículos en Revistas', 'total' => count(Revista::all()), 'ruta'=>'revistas'],

            ['tipo' => 'Trabajos Académicos', 'total' => count(Trabajo::all()), 'ruta'=>'trabajos'],

            ['tipo' => 'Catálogos', 'total' => count(Catalogo::all()), 'ruta'=>'catalogos'],

            ['tipo' => 'Sitios Web', 'total' => count(Enlace::all()), 'ruta'=>'enlaces']
        ];

        $total= null;
        foreach ($referencias as $referencia) {
            $total +=$referencia['total'];
        }

        return view('estadisticas.bibliograficas.bibliograficas-estadisticas', compact('total', 'referencias'));
    }


    public function revistas()
    {
        $revistas_obj = Revista::select('id', 'cita', 'letra', 'autores', 'titulo', 'fecha','comentarios')->get();
        $revistas = [];
        $total = $revistas_obj->count();

        foreach ($revistas_obj as $revista) {

            $registros = Registro::where('referencia_id', $revista->id)->where('tipo_referencia', 'R')->get();
            $cita = $revista->cita.', '.$revista->fecha.$revista->letra;
            array_push($revistas, ['id' => $revista->id, 'cita'=> $cita, 'autores' => $revista->autores, 'titulo'=>$revista->titulo, 'fecha'=>$revista->fecha, 'registros' => $registros->count()]);
        }

        $mas_usados = collect($revistas)->sortByDesc('registros')->take(15);

        return view('estadisticas.bibliograficas.revistas-estadisticas', compact('total', 'revistas', 'mas_usados'));
    }

    public function libros()
    {
        $libros_obj = Libro::select('id', 'cita', 'letra', 'autores', 'titulo', 'fecha','comentarios')->get();
        $libros = [];
        $total = $libros_obj->count();

        foreach ($libros_obj as $libro) {

            $registros = Registro::where('referencia_id', $libro->id)->where('tipo_referencia', 'L')->get();
            $cita = $libro->cita.', '.$libro->fecha.$libro->letra;
            array_push($libros, ['id' => $libro->id, 'cita'=> $cita, 'autores' => $libro->autores, 'titulo'=>$libro->titulo, 'fecha'=>$libro->fecha, 'registros' => $registros->count()]);
        }

        $mas_usados = collect($libros)->sortByDesc('registros')->take(15);

        return view('estadisticas.bibliograficas.libros-estadisticas', compact('total', 'libros', 'mas_usados'));
    }


    public function catalogos()
    {

        $catalogos_obj = Catalogo::select('id', 'cita', 'letra', 'autores', 'titulo', 'fecha','comentarios')->get();
        $catalogos = [];
        $total = $catalogos_obj->count();

        foreach ($catalogos_obj as $catalogo) {

            $registros = Registro::where('referencia_id', $catalogo->id)->where('tipo_referencia', 'C')->get();
            $cita = $catalogo->cita.', '.$catalogo->fecha.$catalogo->letra;
            array_push($catalogo, ['id' => $catalogo->id, 'cita'=> $cita, 'autores' => $catalogo->autores, 'titulo'=>$catalogo->titulo, 'fecha'=>$catalogo->fecha, 'registros' => $registros->count()]);
        }

        $mas_usados = collect($catalogo)->sortByDesc('registros')->take(15);

        return view('estadisticas.bibliograficas.catalogos-estadisticas', compact('total', 'catalogos', 'mas_usados'));

    }


    public function trabajos()
    {
        $trabajos_obj = Trabajo::select('id', 'cita', 'letra', 'autores', 'titulo', 'fecha','comentarios')->get();
        $trabajos = [];
        $total = $trabajos_obj->count();

        foreach ($trabajos_obj as $trabajo) {

            $registros = Registro::where('referencia_id', $trabajo->id)->where('tipo_referencia', 'T')->get();
            $cita = $trabajo->cita.', '.$trabajo->fecha.$trabajo->letra;
            array_push($trabajos, ['id' => $trabajo->id, 'cita'=> $cita, 'autores' => $trabajo->autores, 'titulo'=>$trabajo->titulo, 'fecha'=>$trabajo->fecha, 'registros' => $registros->count()]);
        }

        $mas_usados = collect($trabajos)->sortByDesc('registros')->take(15);

        return view('estadisticas.bibliograficas.trabajos-estadisticas', compact('total', 'trabajos', 'mas_usados'));

    }

    public function enlaces()
    {
        $enlaces_obj = Enlace::select('id', 'cita', 'letra', 'autores', 'titulo', 'fecha')->get();
        $enlaces = [];
        $total = $enlaces_obj->count();

        foreach ($enlaces_obj as $enlace) {

            $registros = Registro::where('referencia_id', $enlace->id)->where('tipo_referencia', 'E')->get();
            $cita = $enlace->cita.', '.$enlace->fecha.$enlace->letra;
            array_push($enlaces, ['id' => $enlace->id, 'cita'=> $cita, 'autores' => $enlace->autores, 'nombre'=>$enlace->nombre, 'fecha'=>$enlace->fecha, 'registros' => $registros->count()]);
        }

        $mas_usados = collect($enlaces)->sortByDesc('registros')->take(15);

        return view('estadisticas.bibliograficas.enlaces-estadisticas', compact('total', 'enlaces', 'mas_usados'));

    }
}