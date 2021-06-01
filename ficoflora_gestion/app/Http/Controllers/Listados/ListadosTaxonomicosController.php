<?php

namespace App\Http\Controllers\Listados;

use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Epitetos\Especifico;
use App\Modelos\Taxonomia\Epitetos\Varietal;
use App\Modelos\Taxonomia\Epitetos\Forma;
use App\Modelos\Taxonomia\Epitetos\Subespecie;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListadosTaxonomicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('listados.index');
    }

    //ESPECIES
    public function especies()
    {
        $usuario = Auth::user();

        $especies = DB::table('especies')
            ->join('epitetos_especificos', 'especies.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'especies.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'especies.forma_id', '=', 'epitetos_formas.id')
            ->leftJoin('epitetos_subespecies', 'especies.subespecie_id', '=', 'epitetos_subespecies.id')
            ->join('generos', 'especies.genero_id', '=', 'generos.id')
            ->join('autores', 'especies.autor_id', '=', 'autores.id')
            ->select(DB::raw('especies.id, especies.catalogo, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, epitetos_subespecies.nombre as subespecie, generos.nombre as genero, autores.nombre as autor'))
            ->orderBy('genero')->orderBy('especifico')->orderBy('varietal')->orderBy('forma')->orderBy('subespecie')
            ->get();

        $total = count($especies);

       return view('listados.especies.especies-listados', compact( 'usuario','especies', 'total'));
    }

    //SINONIMIAS
    public function sinonimias()
    {
        $usuario = Auth::user();

        $especies = DB::table('sinonimias')
            ->join('epitetos_especificos', 'sinonimias.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'sinonimias.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'sinonimias.forma_id', '=', 'epitetos_formas.id')
            ->leftJoin('epitetos_subespecies', 'sinonimias.subespecie_id', '=', 'epitetos_subespecies.id')
            ->join('generos', 'sinonimias.genero_id', '=', 'generos.id')
            ->join('autores', 'sinonimias.autor_id', '=', 'autores.id')
            ->select(DB::raw('sinonimias.id, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, epitetos_subespecies.nombre as subespecie, generos.nombre as genero, autores.nombre as autor'))
            ->orderBy('genero')->orderBy('especifico')->orderBy('varietal')->orderBy('forma')->orderBy('subespecie')
            ->get();

        $total = count($especies);

        return view('listados.especies.sinonimias-listados', compact('especies', 'usuario', 'total'));
    }

    //ESPECIFICOS
    public function especificos()
    {
        $usuario = Auth::user();
        $especificos = Especifico::all()->sortBy('nombre');

        $total = count($especificos);

        return view('listados.especies.especificos-listados', compact('especificos', 'usuario','total'));
    }

    //VARIETALES
    public function varietales()
    {
        $usuario = Auth::user();
        $varietales = Varietal::all()->sortBy('nombre');

        $total = count($varietales);

        return view('listados.especies.varietales-listados', compact('varietales', 'usuario', 'total'));
    }

    //FORMAS
    public function formas()
    {
        $usuario = Auth::user();
        $formas = Forma::all()->sortBy('nombre');

        $total = count($formas);

        return view('listados.especies.formas-listados', compact('formas', 'usuario', 'total'));
    }

    //SUBESPECIES
    public function subespecies()
    {
        $usuario = Auth::user();
        $subespecies = Subespecie::all()->sortBy('nombre');

        $total = count($subespecies);

        return view('listados.especies.subespecies-listados', compact('subespecies', 'usuario', 'total'));
    }

    //AUTORIDADES
    public function autores()
    {
        $usuario = Auth::user();
        $autores = Autor::all()->sortBy('nombre');

        $total = count($autores);

        return view('listados.especies.autores-listados', compact('autores', 'usuario', 'total'));
    }


    //GENEROS
    public function generos()
    {
        $usuario = Auth::user();

        $generos = DB::table('generos')
            ->where('generos.creador_id', $usuario->id)
            ->orderBy('nombre')
            ->get();
        $total = count($generos);

        return view('listados.taxonomicos.generos-listados', compact('generos', 'usuario', 'total'));
    }

    //FAMILIAS
    public function familias()
    {
        $usuario = Auth::user();

        $familias = DB::table('familias')
            ->where('familias.creador_id', $usuario->id)
            ->orderBy('nombre')
            ->get();

        $total = count($familias);

        return view('listados.taxonomicos.familias-listados', compact('familias', 'usuario', 'total'));
    }


    //FAMILIAS
    public function ordenes()
    {
        $usuario = Auth::user();

        $ordenes = DB::table('ordenes')
            ->where('ordenes.creador_id', $usuario->id)
            ->orderBy('nombre')
            ->get();

        $total = count($ordenes);

        return view('listados.taxonomicos.ordenes-listados', compact('ordenes', 'usuario', 'total'));
    }


    //SUBCLASES
    public function subclases()
    {
        $usuario = Auth::user();

        $subclases = DB::table('subclases')
            ->where('subclases.creador_id', $usuario->id)
            ->orderBy('nombre')
            ->get();

        $total = count($subclases);

        return view('listados.taxonomicos.subclases-listados', compact('subclases', 'usuario', 'total'));
    }


    //CLASES
    public function clases()
    {
        $usuario = Auth::user();

        $clases = DB::table('clases')
            ->where('clases.creador_id', $usuario->id)
            ->orderBy('nombre')
            ->get();

        $total = count($clases);

        return view('listados.taxonomicos.clases-listados', compact('clases', 'usuario', 'total'));
    }


    //PHYLUMS
    public function phylums()
    {
        $usuario = Auth::user();

        $phylums = DB::table('phylums')
            ->where('phylums.creador_id', $usuario->id)
            ->orderBy('nombre')
            ->get();

        $total = count($phylums);

        return view('listados.taxonomicos.phylums-listados', compact('phylums', 'usuario', 'total'));
    }
}