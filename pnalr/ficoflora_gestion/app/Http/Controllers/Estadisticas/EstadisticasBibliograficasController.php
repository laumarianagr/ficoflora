<?php

namespace App\Http\Controllers\Estadisticas;

use App\Modelos\Bibliografia\Referencias\Libro;
use App\Modelos\Bibliografia\Referencias\Revista;
use App\Modelos\Bibliografia\Referencias\Trabajo;
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
            ['tipo' => 'Revistas', 'total' => count(Revista::all()), 'ruta'=>'revistas'],
            ['tipo' => 'Trabajos Académicos', 'total' => count(Trabajo::all()), 'ruta'=>'trabajos'],
        ];

        $total= null;
        foreach ($referencias as $referencia) {
            $total +=$referencia['total'];
        }



        return view('estadisticas.bibliograficas.bibliograficas-estadisticas', compact('total', 'referencias'));
    }


    public function libros()
    {
        
        $libros_obj = Libro::all();

        $libros = [];

        $total = $libros_obj->count();

        foreach ($libros_obj as $libro) {

            $registros = Registro::where('referencia_id', $libro->id)->where('tipo_referencia', 'L')->get();
            $cita = $libro->cita.', '.$libro->fecha.$libro->letra;
            array_push($libros, ['id' => $libro->id, 'cita'=> $cita, 'autores' => $libro->autores, 'titulo'=>$libro->titulo, 'fecha'=>$libro->fecha, 'registros' => $registros->count()]);
        }

        $mas_usados = collect($libros)->sortByDesc('registros')->take(15);

//        dd($libros);

        return view('estadisticas.bibliograficas.libros-estadisticas', compact('total', 'libros', 'mas_usados'));
//
    }



    public function revistas()
    {

        $revistas_obj = Revista::all();

        $revistas = [];

        $total = $revistas_obj->count();

        foreach ($revistas_obj as $revista) {

            $registros = Registro::where('referencia_id', $revista->id)->where('tipo_referencia', 'R')->get();
            $cita = $revista->cita.', '.$revista->fecha.$revista->letra;
            array_push($revistas, ['id' => $revista->id, 'cita'=> $cita, 'autores' => $revista->autores, 'titulo'=>$revista->titulo, 'fecha'=>$revista->fecha, 'registros' => $registros->count()]);
        }

        $mas_usados = collect($revistas)->sortByDesc('registros')->take(15);

//        dd($revistas);

        return view('estadisticas.bibliograficas.revistas-estadisticas', compact('total', 'revistas', 'mas_usados'));
//

    }

    public function trabajos()
    {

        $trabajos_obj = Trabajo::all();

        $trabajos = [];

        $total = $trabajos_obj->count();

        foreach ($trabajos_obj as $trabajo) {

            $registros = Registro::where('referencia_id', $trabajo->id)->where('tipo_referencia', 'T')->get();
            $cita = $trabajo->cita.', '.$trabajo->fecha.$trabajo->letra;
            array_push($trabajos, ['id' => $trabajo->id, 'cita'=> $cita, 'autores' => $trabajo->autores, 'titulo'=>$trabajo->titulo, 'fecha'=>$trabajo->fecha, 'registros' => $registros->count()]);
        }

        $mas_usados = collect($trabajos)->sortByDesc('registros')->take(15);

//        dd($trabajos);

        return view('estadisticas.bibliograficas.trabajos-estadisticas', compact('total', 'trabajos', 'mas_usados'));
//

    }
}
