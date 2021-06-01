<?php

namespace App\Http\Controllers\Estadisticas;

use App\Modelos\Taxonomia\Clase;
use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Genero;
use App\Modelos\Taxonomia\Orden;
use App\Modelos\Taxonomia\Phylum;
use App\Modelos\Taxonomia\Subclase;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EstadisticasTaxonomiasController extends Controller
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

        $elementos = [

            ['tipo' => 'Phyla', 'total' => count(Phylum::all()), 'ruta'=>'phylums'],
            ['tipo' => 'Clases', 'total' => count(Clase::all()), 'ruta'=>'clases'],
            ['tipo' => 'Subclases', 'total' => count(Subclase::all()), 'ruta'=>'subclases'],
            ['tipo' => 'Órdenes', 'total' => count(Orden::all()), 'ruta'=>'ordenes'],
            ['tipo' => 'Familias', 'total' => count(Familia::all()), 'ruta'=>'familias'],
            ['tipo' => 'Géneros', 'total' => count(Genero::all()), 'ruta'=>'generos'],
        ];

        $total= null;
        foreach ($elementos as $elemento) {
            $total +=$elemento['total'];
        }

        return view('estadisticas.taxonomias.taxonomias-estadisticas', compact('total', 'elementos'));
    }

    public function generos()
    {
        $obj_generos = Genero::all();
        $generos = [];

        $total = $obj_generos->count();
        foreach ($obj_generos as $genero) {

//            $generos[$genero->id]=['name' => $genero->nombre, 'especies'=>$genero->especies()->count()];
            array_push($generos, ['id' => $genero->id,'nombre' => $genero->nombre, 'especies'=>$genero->especies()->count()]);
        }

        $mas_usados = collect($generos)->sortByDesc('especies')->take(15);
//        dd($mas_usados);
//        dd(json_encode($generos));

        return view('estadisticas.taxonomias.generos-estadisticas', compact('total', 'generos', 'mas_usados'));
    }

    public function familias()
    {
        $obj_familias = Familia::all();
        $familias = [];

        $total = $obj_familias->count();
        foreach ($obj_familias as $familia) {

            array_push($familias, ['id' => $familia->id,'nombre' => $familia->nombre, 'generos'=>$familia->generos()->count()]);
        }

        $mas_usados = collect($familias)->sortByDesc('generos')->take(15);

        return view('estadisticas.taxonomias.familias-estadisticas', compact('total', 'familias', 'mas_usados'));
    }

    public function ordenes()
    {
        $obj_ordenes = Orden::all();
        $ordenes = [];

        $total = $obj_ordenes->count();
        foreach ($obj_ordenes as $orden) {

            array_push($ordenes, ['id' => $orden->id,'nombre' => $orden->nombre, 'familias'=>$orden->familias()->count()]);
        }

        $mas_usados = collect($ordenes)->sortByDesc('familias')->take(15);

        return view('estadisticas.taxonomias.ordenes-estadisticas', compact('total', 'ordenes', 'mas_usados'));
    }

    public function subclases()
    {
        $obj_subclases = Subclase::all();
        $subclases = [];

        $total = $obj_subclases->count();
        foreach ($obj_subclases as $subclase) {

            array_push($subclases, ['id' => $subclase->id,'nombre' => $subclase->nombre, 'ordenes'=>$subclase->ordenes()->count()]);
        }

        $mas_usados = collect($subclases)->sortByDesc('ordenes')->take(15);

        return view('estadisticas.taxonomias.subclases-estadisticas', compact('total', 'subclases', 'mas_usados'));
    }

    public function clases()
    {
        $obj_clases = Clase::all();
        $clases = [];

        $total = $obj_clases->count();
        foreach ($obj_clases as $clase) {

            array_push($clases, ['id' => $clase->id,'nombre' => $clase->nombre, 'subclases'=>$clase->subclases()->count()]);
        }

        $mas_usados = collect($clases)->sortByDesc('subclases')->take(15);

        return view('estadisticas.taxonomias.clases-estadisticas', compact('total', 'clases', 'mas_usados'));
    }


    public function phylums()
    {
        $obj_phylums = Phylum::all();
        $phylums = [];

        $total = $obj_phylums->count();
        foreach ($obj_phylums as $phylum) {

            array_push($phylums, ['id' => $phylum->id,'nombre' => $phylum->nombre, 'clases'=>$phylum->clases()->count()]);
        }

        $mas_usados = collect($phylums)->sortByDesc('clases')->take(15);

        return view('estadisticas.taxonomias.phylums-estadisticas', compact('total', 'phylums', 'mas_usados'));
    }


}
