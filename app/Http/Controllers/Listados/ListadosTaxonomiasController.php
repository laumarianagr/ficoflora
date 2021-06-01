<?php

namespace App\Http\Controllers\Listados;

use App\Modelos\Taxonomia\Clase;
use App\Modelos\Taxonomia\Especie;
use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Genero;
use App\Modelos\Taxonomia\Orden;
use App\Modelos\Taxonomia\Phylum;
use App\Modelos\Taxonomia\Subclase;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ListadosTaxonomiasController extends Controller
{

    //Listado con todas los GENEROS registrados
    public function especies()
    {

        $sinonimias = DB::table('sinonimias')
             ->join('epitetos_especificos', 'sinonimias.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_subespecies', 'sinonimias.subespecie_id', '=', 'epitetos_subespecies.id')
            ->leftJoin('epitetos_varietales', 'sinonimias.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'sinonimias.forma_id', '=', 'epitetos_formas.id')
            ->join('autores', 'sinonimias.autor_id', '=', 'autores.id')
            ->join('generos', 'sinonimias.genero_id', '=', 'generos.id')
            ->select(DB::raw('sinonimias.id, 1 as catalogo,   generos.nombre as genero, epitetos_especificos.nombre as especifico, epitetos_subespecies.nombre as subespecie, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, autores.nombre as autor, "sinonimia" as tipo'));


        $especies = DB::table('especies')
            ->where('especies.catalogo', 1)
            ->join('epitetos_especificos', 'especies.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_subespecies', 'especies.subespecie_id', '=', 'epitetos_subespecies.id')
            ->leftJoin('epitetos_varietales', 'especies.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'especies.forma_id', '=', 'epitetos_formas.id')
            ->join('autores', 'especies.autor_id', '=', 'autores.id')
            ->join('generos', 'especies.genero_id', '=', 'generos.id')
            ->select(DB::raw('especies.id, especies.catalogo,  generos.nombre as genero, epitetos_especificos.nombre as especifico, epitetos_subespecies.nombre as subespecie, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, autores.nombre as autor, "especie" as tipo'))
            ->union($sinonimias)
            ->orderBy('genero')->orderBy('especifico')->orderBy('subespecie')->orderBy('forma')->orderBy('varietal')
            ->get();

        $taxonomia = 'Especies';
//        $total = count($especies);
        
        $total = Especie::where('especies.catalogo', 1)->get()->count();

        return view('listados.taxonomias.especies', compact('taxonomia', 'total', 'especies'));
    }

    //Listado con todas los GENEROS registrados
    public function generos()
    {
        $generos = Genero::select('id','nombre')->where('familia_id' , '<>' ,-1)->get();
        // estoy excluyendo del listado los géneros de las especies que son sinonimia, solo muestro los de nombres válidos
        $taxonomia = 'Géneros';
        $total = count($generos);

        return view('listados.taxonomias.generos', compact('taxonomia', 'total', 'generos'));
    }

    //Listado con todas las FAMILIAS registradas
    public function familias()
    {
        $familias = Familia::select('id','nombre')->get();
        $taxonomia = 'Familias';
        $total = count($familias);

        return view('listados.taxonomias.familias', compact('taxonomia', 'total', 'familias'));
    }


    //Listado con todas los ORDENES registrados
    public function ordenes()
    {
        $ordenes = Orden::select('id','nombre')->get();
        $taxonomia = 'Órdenes';
        $total = count($ordenes);

        return view('listados.taxonomias.ordenes', compact('taxonomia', 'total', 'ordenes'));
    }



    //Listado con todas las FAMILIAS registradas
    public function subclases()
    {
        $subclases = Subclase::select('id','nombre')->get();
        $taxonomia = 'Subclases';
        $total = count($subclases);

        return view('listados.taxonomias.subclases', compact('taxonomia', 'total', 'subclases'));
    }


    //Listado con todas las FAMILIAS registradas
    public function clases()
    {
        $clases = Clase::select('id','nombre')->get();
        $taxonomia = 'Clases';
        $total = count($clases);

        return view('listados.taxonomias.clases', compact('taxonomia', 'total', 'clases'));
    }




    //Listado con todas los PHYLUM registrados
    public function phylum()
    {
        $phylums = Phylum::select('id','nombre')->get();
        $taxonomia = 'Phylum';
        $total = count($phylums);

        return view('listados.taxonomias.phylum', compact('taxonomia', 'total', 'phylums'));
    }

}
