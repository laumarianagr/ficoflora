<?php

namespace App\Http\Controllers\Buscar;

use App\Modelos\Taxonomia\Autor;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BusquedasController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
//        $this->middleware('creador.especie', ['only'=>['editar', 'eliminar', 'actualizar']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {


        return view('buscar.index');
    }

    public function especies()
    {
        $autores = Autor::select('id','nombre')->get();

        return view('buscar.especies.buscar-especies', compact('autores'));
    }

    public function taxonomia()
    {
        return view('buscar.taxonomia.index-buscar-taxonomia');
    }

    public function ubicacion()
    {
        return view('buscar.ubicacion.index-buscar-ubicacion');
    }

    public function referencia()
    {
        return view('buscar.referencia.index-buscar-referencia');
    }

    /**hnk
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function buscarEspeciesYSinonimias(Request $request)
    {
        $query = $request->especie;

        $sinonimias = DB::table('sinonimias')

            ->where('generos.nombre', 'like', $query.'%')
            ->orwhere('epitetos_especificos.nombre', 'like', $query.'%')
            ->orwhere('epitetos_varietales.nombre', 'like', $query.'%')
            ->orwhere('epitetos_formas.nombre', 'like', $query.'%')
            ->orwhere('epitetos_subespecies.nombre', 'like', $query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_varietales.nombre,epitetos_formas.nombre,epitetos_subespecies.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"var.",epitetos_varietales.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"f.",epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"subsp.",epitetos_subespecies.nombre)'), 'like' , '%'.$query.'%')
            ->join('epitetos_especificos', 'sinonimias.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'sinonimias.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'sinonimias.forma_id', '=', 'epitetos_formas.id')
            ->leftJoin('epitetos_subespecies', 'sinonimias.subespecie_id', '=', 'epitetos_subespecies.id')
            ->join('autores', 'sinonimias.autor_id', '=', 'autores.id')
            ->join('generos', 'sinonimias.genero_id', '=', 'generos.id')
            ->select(DB::raw('sinonimias.id, 1 as catalogo,   generos.nombre as genero, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, epitetos_subespecies.nombre as subespecie, autores.nombre as autor, "sinonimia" as tipo'));


        $especies = DB::table('especies')
            ->where(function ($q) use ($query){
                $q->orwhere('generos.nombre', 'like', $query.'%')
                    ->orwhere('epitetos_especificos.nombre', 'like', $query.'%')
                    ->orwhere('epitetos_varietales.nombre', 'like', $query.'%')
                    ->orwhere('epitetos_formas.nombre', 'like', $query.'%')
                    ->orwhere('epitetos_subespecies.nombre', 'like', $query.'%')
                    ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_varietales.nombre,epitetos_formas.nombre,epitetos_subespecies.nombre)'), 'like' , '%'.$query.'%')
                    ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"var.",epitetos_varietales.nombre)'), 'like' , '%'.$query.'%')
                    ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"f.",epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
                    ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"subsp.",epitetos_subespecies.nombre)'), 'like' , '%'.$query.'%');
            })
            ->where('especies.catalogo', 1)
            ->join('epitetos_especificos', 'especies.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'especies.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'especies.forma_id', '=', 'epitetos_formas.id')
            ->leftJoin('epitetos_subespecies', 'especies.subespecie_id', '=', 'epitetos_subespecies.id')
            ->join('autores', 'especies.autor_id', '=', 'autores.id')
            ->join('generos', 'especies.genero_id', '=', 'generos.id')
            ->select(DB::raw('especies.id, especies.catalogo,  generos.nombre as genero, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, epitetos_subespecies.nombre as subespecie, autores.nombre as autor, "especie" as tipo'))
            ->union($sinonimias)
            ->orderBy('genero')->orderBy('especifico')->orderBy('varietal')->orderBy('forma')->orderBy('subespecie')
            ->get();

//        dd($especies);
        $total = count($especies);

        return view('buscar.especies.resultados-especies', compact('query', 'total', 'especies'));

    }

    public function getEspeciesYSinonimias($query)
    {
        $sinonimias = DB::table('sinonimias')
            ->where(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_varietales.nombre,epitetos_formas.nombre, epitetos_subespecies.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"var.",epitetos_varietales.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"f.",epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"subsp.",epitetos_subespecies.nombre)'), 'like' , '%'.$query.'%')
            ->join('epitetos_especificos', 'sinonimias.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'sinonimias.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'sinonimias.forma_id', '=', 'epitetos_formas.id')
            ->leftJoin('epitetos_subespecies', 'sinonimias.subespecie_id', '=', 'epitetos_subespecies.id')
            ->join('generos', 'sinonimias.genero_id', '=', 'generos.id')
            ->select(DB::raw('sinonimias.id, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, epitetos_subespecies.nombre as subespecie, generos.nombre as genero, CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_varietales.nombre,epitetos_formas.nombre,epitetos_subespecies.nombre) as nombre, "s" as tipo'));

        $especies = DB::table('especies')
            ->where(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_varietales.nombre,epitetos_formas.nombre,epitetos_subespecies.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"var.",epitetos_varietales.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"f.",epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"subsp.",epitetos_subespecies.nombre)'), 'like' , '%'.$query.'%')
            ->join('epitetos_especificos', 'especies.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'especies.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'especies.forma_id', '=', 'epitetos_formas.id')
            ->leftJoin('epitetos_subespecies', 'especies.subespecie_id', '=', 'epitetos_subespecies.id')
            ->join('generos', 'especies.genero_id', '=', 'generos.id')
            ->select(DB::raw('especies.id, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, epitetos_subespecies.nombre as subespecie, generos.nombre as genero, CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_varietales.nombre,epitetos_formas.nombre,epitetos_subespecies.nombre) as nombre, "e" as tipo'))
            ->union($sinonimias)
            ->orderBy('nombre')
            ->get();

        return $especies;

        dd($especies);
    }


    //LISTA DE GENEROS
    public function getGeneros($query)
    {
        $generos = DB::table('generos')
            ->where('generos.nombre', 'like', '%'.$query.'%')
            ->orderBy('nombre')
            ->get();

        return $generos;
    }


    //LISTA DE FAMILIAS
    public function getFamilias($query)
    {
        $familias = DB::table('familias')
            ->where('familias.nombre', 'like', '%'.$query.'%')
            ->orderBy('nombre')
            ->get();

        return $familias;
    }

    //LISTA DE ORDENES
    public function getOrdenes($query)
    {
        $ordenes = DB::table('ordenes')
            ->where('ordenes.nombre', 'like', '%'.$query.'%')
            ->orderBy('nombre')
            ->get();

        return $ordenes;
    }

    //LISTA DE SUBCLASES
    public function getSubclases($query)
    {
        $subclases = DB::table('subclases')
            ->where('subclases.nombre', 'like', '%'.$query.'%')
            ->orderBy('nombre')
            ->get();

        return $subclases;
    }

    //LISTA DE CLASES
    public function getClases($query)
    {
        $clases = DB::table('clases')
            ->where('clases.nombre', 'like', '%'.$query.'%')
            ->orderBy('nombre')
            ->get();

        return $clases;
    }

    //LISTA DE PHYLUMS
    public function getPhylums($query)
    {
        $phylums = DB::table('phylums')
            ->where('phylums.nombre', 'like', '%'.$query.'%')
            ->orderBy('nombre')
            ->get();

        return $phylums;
    }


    //LISTA DE AUTORES
    public function getAutores($query)
    {
        $autores = DB::table('autores')
            ->where('autores.nombre', 'like', '%'.$query.'%')
            ->orderBy('nombre')
            ->get();

        return $autores;
    }



    //LISTA DE ENTIDADES
    public function getEntidades($query)
    {
        $entidades = DB::table('entidades')
            ->where('entidades.nombre', 'like', $query.'%')
            ->select('id','nombre')
            ->orderBy('nombre')
            ->get();

        return $entidades;
    }

    //LISTA DE ENTIDADES
    public function getLocalidades($query)
    {
        $localidades = DB::table('localidades')
            ->where('localidades.nombre', 'like', '%'.$query.'%')
            ->select('id','nombre')
            ->orderBy('nombre')
            ->get();

        return $localidades;
    }


    //LISTA DE ENTIDADES
    public function getLugares($query)
    {
        $lugares = DB::table('lugares')
            ->where('lugares.nombre', 'like', '%'.$query.'%')
            ->select('id','nombre')
            ->orderBy('nombre')
            ->get();

        return $lugares;
    }


    //LISTA DE SITIOS
    public function getSitios($query)
    {
        $sitios = DB::table('sitios')
            ->where('sitios.nombre', 'like', '%'.$query.'%')
            ->select('id','nombre')
            ->orderBy('nombre')
            ->get();

        return $sitios;
    }

    //LISTA DE EPÍTETOS ESPECÍFICOS
    public function getEspecificos($query)
    {
        $especificos = DB::table('epitetos_especificos')
            ->where('epitetos_especificos.nombre', 'like', '%'.$query.'%')
            ->select('id','nombre')
            ->orderBy('nombre')
            ->get();

        return $especificos;
    }

    //LISTA DE EPÍTETOS VARIETALES
    public function getVarietales($query)
    {
        $varietales = DB::table('epitetos_varietales')
            ->where('epitetos_varietales.nombre', 'like', '%'.$query.'%')
            ->select('id','nombre')
            ->orderBy('nombre')
            ->get();

        return $varietales;
    }

    //LISTA DE EPÍTETOS DE FORMA
    public function getFormas($query)
    {
        $formas = DB::table('epitetos_formas')
            ->where('epitetos_formas.nombre', 'like', '%'.$query.'%')
            ->select('id','nombre')
            ->orderBy('nombre')
            ->get();

        return $formas;
    }

    //LISTA DE SUBESPECIES
    public function getSubespecies($query)
    {
        $subespecies = DB::table('epitetos_subespecies')
            ->where('epitetos_subespecies.nombre', 'like', '%'.$query.'%')
            ->select('id','nombre')
            ->orderBy('nombre')
            ->get();

        return $subespecies;
    }



    //LISTA DE AUTORES DE REVISTAS
    public function getRevistasAutores($query)
    {
        $autores = DB::table('referencias_revistas')
            ->where('autores', 'like', '%'.$query.'%')
            ->select('id', 'autores', 'fecha', 'letra')
            ->orderBy('autores')->orderBy('fecha')->orderBy('letra')
            ->get();

        return $autores;
    }

    //LISTA DE TÍTULOS DE REVISTAS
    public function getRevistasTitulos($query)
    {
        $titulos = DB::table('referencias_revistas')
            ->where('titulo', 'like', '%'.$query.'%')
            ->select('id','titulo')
            ->orderBy('titulo')
            ->get();

        return $titulos;
    }


    //LISTA DE AUTORES DE LIBROS
    public function getLibrosAutores($query)
    {
        $autores = DB::table('referencias_libros')
            ->where('autores', 'like', '%'.$query.'%')
            ->select('id', 'autores', 'fecha', 'letra')
            ->orderBy('autores')->orderBy('fecha')->orderBy('letra')
            ->get();

        return $autores;
    }

    //LISTA DE TÍTULOS DE LIBROS
    public function getLibrosTitulos($query)
    {
        $titulos = DB::table('referencias_libros')
            ->where('titulo', 'like', '%'.$query.'%')
            ->select('id','titulo')
            ->orderBy('titulo')
            ->get();

        return $titulos;
    }


    //LISTA DE AUTORES DE TRABAJOS
    public function getTrabajosAutores($query)
    {
        $autores = DB::table('referencias_trabajos')
            ->where('autores', 'like', '%'.$query.'%')
            ->select('id', 'autores', 'fecha', 'letra')
            ->orderBy('autores')->orderBy('fecha')->orderBy('letra')
            ->get();

        return $autores;
    }

    //LISTA DE TÍTULOS DE TRABAJOS
    public function getTrabajosTitulos($query)
    {
        $titulos = DB::table('referencias_trabajos')
            ->where('titulo', 'like', '%'.$query.'%')
            ->select('id','titulo')
            ->orderBy('titulo')
            ->get();

        return $titulos;
    }




    //LISTA DE UBICACIONES

    public function getUbicaciones($query)
    {
        $entidades = DB::table('entidades')
            ->where('entidades.nombre', 'like', '%'.$query.'%')
            ->select(DB::raw('id, nombre, "e" as tipo'))
            ->orderBy('nombre');
//            ->get();

        $localidades = DB::table('localidades')
            ->where('localidades.nombre', 'like', '%'.$query.'%')
            ->select(DB::raw('id, nombre, "lo" as tipo'))
            ->orderBy('nombre');
//            ->get();

        $lugares = DB::table('lugares')
            ->where('lugares.nombre', 'like', '%'.$query.'%')
            ->select(DB::raw('id, nombre, "lu" as tipo'))
            ->orderBy('nombre');

        $sitios = DB::table('sitios')
            ->where('sitios.nombre', 'like', '%'.$query.'%')
            ->select(DB::raw('id, nombre, "s" as tipo'))
            ->union($localidades)
            ->union($entidades)
            ->union($lugares)
            ->orderBy('nombre')
            ->get();

        return $sitios;
    }


}
