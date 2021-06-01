<?php

namespace App\Http\Controllers\Estadisticas;

use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Modelos\Catalogo\Registro;
use App\Modelos\Sinonimias\Sinonimia;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Epitetos\Especifico;
use App\Modelos\Taxonomia\Epitetos\Varietal;
use App\Modelos\Taxonomia\Epitetos\Forma;
use App\Modelos\Taxonomia\Epitetos\Subespecie;
use App\Modelos\Taxonomia\Especie;
use App\Modelos\Taxonomia\Genero;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EstadisticasEspeciesController extends Controller
{

    use EspecieDatosTrait;
    
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor');
//        $this->middleware('creador.especie', ['only'=>['editar', 'eliminar', 'actualizar']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function especies()
    {
        $obj_especies = Especie::all();
        $total_especies = count($obj_especies);
        $catalogo = count($obj_especies->where('catalogo', 1));
        $especies =  ['total' => $total_especies, 'catalogo'=> $catalogo, 'no_catalogo'=> ($total_especies-$catalogo)];

        $totales_catalogo = [
            'tipo' => 'Registros del Catálogo', 'total' => count(Registro::all()), 'ruta'=>'registros'
        ];

        $totales = [
            ['tipo' => 'Autoridades', 'total' => count(Autor::all()), 'ruta'=>'autoridades'],
            ['tipo' => 'Géneros', 'total' => count(Genero::all()), 'ruta'=>'generos'],
            ['tipo' => 'Sinonimias', 'total' => count(Sinonimia::all()), 'ruta'=>'sinonimias']
        ];

        $totales_epitetos = [
            ['tipo' => 'Epítetos específicos', 'total' => count(Especifico::all()), 'ruta'=>'especificos'],
            ['tipo' => 'Epítetos varietales', 'total' => count(Varietal::all()), 'ruta'=>'varietales'],
            ['tipo' => 'Epítetos de forma', 'total' => count(Forma::all()), 'ruta'=>'formas'],
            ['tipo' => 'Subespecies', 'total' => count(Subespecie::all()), 'ruta'=>'subespecies'],
        ];
        return view('estadisticas.especies.especies-estadisticas', compact('totales_catalogo','totales', 'totales_epitetos', 'especies'));
    }


    public function sinonimias()
    {
        $obj_sinonimias = $this->listaSinonimia();
//        dd($obj_sinonimias);
        $sinonimias = [];

        $total = $obj_sinonimias->count();
        foreach ($obj_sinonimias as $sinonimia) {
            
            array_push($sinonimias, ['id' => $sinonimia->id,'nombre' => $sinonimia->nombre,'autor' => $sinonimia->autor, 'especies'=>Sinonimia::find($sinonimia->id)->especies()->count()]);
        }

        $mas_usados = collect($sinonimias)->sortByDesc('especies')->take(15);
        return view('estadisticas.especies.sinonimias-estadisticas', compact('total', 'sinonimias', 'mas_usados'));
    }


    public function autoridades()
    {
        $obj_autoridades = Autor::all();
        $autoridades = [];

        $total = $obj_autoridades->count();
        foreach ($obj_autoridades as $autoridad) {

//            $autoridades[$autoridad->id]=['name' => $autoridad->nombre, 'especies'=>$autoridad->especies()->count()];
            array_push($autoridades, ['id' => $autoridad->id,'nombre' => $autoridad->nombre, 'especies'=>$autoridad->especies()->count()]);
        }

        $mas_usados = collect($autoridades)->sortByDesc('especies')->take(15);
//        dd($mas_usados);
//        dd(json_encode($autoridades));

        return view('estadisticas.especies.autoridades-estadisticas', compact('total', 'autoridades', 'mas_usados'));
    }


    public function especificos()
    {
        $obj_especificos = Especifico::all();
        $especificos = [];

        $total = $obj_especificos->count();
        foreach ($obj_especificos as $especifico) {

           array_push($especificos, ['id' => $especifico->id, 'nombre' => $especifico->nombre, 'especies'=>$especifico->especies()->count()]);
        }

        $mas_usados = collect($especificos)->sortByDesc('especies')->take(15);
//        dd($mas_usados);
//        dd(json_encode($especificos));

        return view('estadisticas.especies.especificos-estadisticas', compact('total', 'especificos', 'mas_usados'));
    }

    public function varietales()
    {
        $obj_varietales = Varietal::all();
        $varietales = [];

        $total = $obj_varietales->count();
        foreach ($obj_varietales as $varietal) {

           array_push($varietales, ['id' => $varietal->id,'nombre' => $varietal->nombre, 'especies'=>$varietal->especies()->count()]);
        }

        $mas_usados = collect($varietales)->sortByDesc('especies')->take(10);
//        dd($mas_usados);
//        dd(json_encode($varietales));

        return view('estadisticas.especies.varietales-estadisticas', compact('total', 'varietales', 'mas_usados'));
    }

    public function formas()
    {
        $obj_formas = Forma::all();
        $formas = [];

        $total = $obj_formas->count();
        foreach ($obj_formas as $forma) {

            array_push($formas, ['id' => $forma->id,'nombre' => $forma->nombre, 'especies'=>$forma->especies()->count()]);
        }

        $mas_usados = collect($formas)->sortByDesc('especies')->take(10);
//        dd($mas_usados);
//        dd(json_encode($formas));

        return view('estadisticas.especies.formas-estadisticas', compact('total', 'formas', 'mas_usados'));
    }

    public function subespecies()
    {
        $obj_subespecies = Subespecie::all();
        $subespecies = [];

        $total = $obj_subespecies->count();
        foreach ($obj_subespecies as $subespecie) {

            array_push($subespecies, ['id' => $subespecie->id,'nombre' => $subespecie->nombre, 'especies'=>$subespecie->especies()->count()]);
        }

        $mas_usados = collect($subespecies)->sortByDesc('especies')->take(10);

        return view('estadisticas.especies.subespecies-estadisticas', compact('total', 'subespecies', 'mas_usados'));
    }


    public function registros()
    {
        $total = Registro::all()->count();

        $especies_reg = DB::table('registros')
            ->groupBy('registros.especie_id')
            ->leftJoin('especies', 'registros.especie_id', '=', 'especies.id')
            ->join('epitetos_especificos', 'especies.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'especies.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'especies.forma_id', '=', 'epitetos_formas.id')
            ->leftJoin('epitetos_subespecies', 'especies.subespecie_id', '=', 'epitetos_subespecies.id')
            ->join('generos', 'especies.genero_id', '=', 'generos.id')
            ->join('autores', 'especies.autor_id', '=', 'autores.id')
            ->select(DB::raw('count(*) as total, especies.id, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, epitetos_subespecies.nombre as subespecie, generos.nombre as genero, autores.nombre as autor'))
            ->get();

        $especies = collect();

        foreach ($especies_reg as $especie) {

            $especies->push( ['id' => $especie->id, 'nombre' => $this->especieNombre($especie),'autor'=>$especie->autor, 'registros' => $especie->total]);
        }

        $especies = $especies->sortByDesc('registros');
        $mas_usados = $especies->take(15);

        return view('estadisticas.especies.registros-estadisticas', compact('total', 'especies', 'mas_usados'));
    }

}