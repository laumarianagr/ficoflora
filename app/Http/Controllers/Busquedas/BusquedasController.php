<?php

namespace App\Http\Controllers\Busquedas;

use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Especie;
use App\Modelos\Taxonomia\Genero;
use App\Modelos\Bibliografia\Referencias\Revista;
use App\Modelos\Bibliografia\Referencias\Libro;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BusquedasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function especies()
    {

        $autores = Autor::select('id','nombre')->get();

        return view('buscar.especies.index-buscar-especies', compact('autores'));
    }

    public function taxonomia()
    {

        return view('buscar.taxonomia.index-buscar-taxonomia');
    }
    public function ubicacion()
    {

        return view('buscar.ubicacion.index-buscar-ubicacion');
    }

    public function referencias()
    {

        return view('buscar.referencias.index-buscar-referencias');
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
            ->orwhere('epitetos_subespecies.nombre', 'like', $query.'%')
            ->orwhere('epitetos_varietales.nombre', 'like', $query.'%')
            ->orwhere('epitetos_formas.nombre', 'like', $query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_subespecies.nombre,epitetos_varietales.nombre,epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"subsp.",epitetos_subespecies.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"f.",epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"var.",epitetos_varietales.nombre)'), 'like' , '%'.$query.'%')
            ->join('epitetos_especificos', 'sinonimias.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_subespecies', 'sinonimias.subespecie_id', '=', 'epitetos_subespecies.id')
            ->leftJoin('epitetos_varietales', 'sinonimias.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'sinonimias.forma_id', '=', 'epitetos_formas.id')
            ->join('autores', 'sinonimias.autor_id', '=', 'autores.id')
            ->join('generos', 'sinonimias.genero_id', '=', 'generos.id')
            ->select(DB::raw('sinonimias.id, 1 as catalogo,   generos.nombre as genero, epitetos_especificos.nombre as especifico, epitetos_subespecies.nombre as subespecie, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, autores.nombre as autor, "sinonimia" as tipo'));


        $especies = DB::table('especies')
            ->where(function ($q) use ($query){
                $q->orwhere('generos.nombre', 'like', $query.'%')
                ->orwhere('epitetos_especificos.nombre', 'like', $query.'%')
                ->orwhere('epitetos_subespecies.nombre', 'like', $query.'%')
                ->orwhere('epitetos_varietales.nombre', 'like', $query.'%')
                ->orwhere('epitetos_formas.nombre', 'like', $query.'%')
                ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_subespecies.nombre,epitetos_varietales.nombre,epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
                ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"subsp.",epitetos_subespecies.nombre)'), 'like' , '%'.$query.'%')
                ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"f.",epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
                ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"var.",epitetos_varietales.nombre)'), 'like' , '%'.$query.'%');//
            })
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

//        dd($especies);
        $total = count($especies);

        return view('buscar.especies.resultados-especies', compact('query', 'total', 'especies'));

    }

    public function getEspeciesYSinonimias($query)
    {

        $sinonimias = DB::table('sinonimias')
            ->where(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_subespecies.nombre,epitetos_varietales.nombre,epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"subsp.",epitetos_subespecies.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"f.",epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"var.",epitetos_varietales.nombre)'), 'like' , '%'.$query.'%')
            ->join('epitetos_especificos', 'sinonimias.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_subespecies', 'sinonimias.subespecie_id', '=', 'epitetos_subespecies.id')
            ->leftJoin('epitetos_varietales', 'sinonimias.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'sinonimias.forma_id', '=', 'epitetos_formas.id')
            ->leftJoin('autores', 'sinonimias.autor_id', '=', 'autores.id')
            ->join('generos', 'sinonimias.genero_id', '=', 'generos.id')
            ->select(DB::raw('sinonimias.id, autores.nombre as autor , epitetos_especificos.nombre as especifico, epitetos_subespecies.nombre as subespecie, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, generos.nombre as genero, CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_subespecies.nombre,epitetos_varietales.nombre,epitetos_formas.nombre)  as nombre, "s" as tipo'));

        $especies = DB::table('especies')

            ->where(function ($q) use ($query){
                $q->orwhere('generos.nombre', 'like', $query.'%')
                    ->orwhere('epitetos_especificos.nombre', 'like', $query.'%')
                    ->orwhere('epitetos_subespecies.nombre', 'like', $query.'%')
                    ->orwhere('epitetos_varietales.nombre', 'like', $query.'%')
                    ->orwhere('epitetos_formas.nombre', 'like', $query.'%')
                    ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_varietales.nombre,epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
                    ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"subsp.",epitetos_subespecies.nombre)'), 'like' , '%'.$query.'%')
                    ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"f.",epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
                    ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"var.",epitetos_varietales.nombre)'), 'like' , '%'.$query.'%');//
            })
//            ->where(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_varietales.nombre,epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
//            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"f.",epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
//            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"var.",epitetos_varietales.nombre)'), 'like' , '%'.$query.'%')
            ->where('especies.catalogo', 1)
            ->join('epitetos_especificos', 'especies.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_subespecies', 'especies.subespecie_id', '=', 'epitetos_subespecies.id')
            ->leftJoin('epitetos_varietales', 'especies.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'especies.forma_id', '=', 'epitetos_formas.id')
            ->join('generos', 'especies.genero_id', '=', 'generos.id')
            ->leftJoin('autores', 'especies.autor_id', '=', 'autores.id')
            ->select(DB::raw('especies.id, autores.nombre as autor, epitetos_especificos.nombre as especifico, epitetos_subespecies.nombre as subespecie, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, generos.nombre as genero, CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_subespecies.nombre,epitetos_varietales.nombre,epitetos_formas.nombre)  as nombre, "e" as tipo'))
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
            ->where('generos.familia_id', '<>', -1)
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


    //LISTA DE ENTIDADES
    public function getSitios($query)
    {
        $sitios = DB::table('sitios')
            ->where('sitios.nombre', 'like', '%'.$query.'%')
            ->select('id','nombre')
            ->orderBy('nombre')
            ->get();

        return $sitios;
    }


    //Busqueda de Ubicaciones
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


    //LISTA DE REFERENCIAS BIBLIOGRAFICAS, AUTOR (INVESTIGADOR) O TÍTULO

    public function getReferencias($query)
    {
        $revistas = DB::table('referencias_revistas')
            ->where('referencias_revistas.autores', 'like', '%'.$query.'%')
            ->orwhere('referencias_revistas.titulo', 'like', '%'.$query.'%')
            ->select(DB::raw('id, autores, fecha, letra, titulo, "r" as tipo'))
            ->orderBy('autores')->orderBy('fecha')->orderBy('letra');

        $libros = DB::table('referencias_libros')
            ->where('referencias_libros.autores', 'like', '%'.$query.'%')
            ->orwhere('referencias_libros.titulo', 'like', '%'.$query.'%')
            ->select(DB::raw('id, autores, fecha, letra, titulo, "l" as tipo'))
            ->orderBy('autores')->orderBy('fecha')->orderBy('letra');

        $catalogos = DB::table('referencias_catalogos')
            ->where('referencias_catalogos.autores', 'like', '%'.$query.'%')
            ->orwhere('referencias_catalogos.titulo', 'like', '%'.$query.'%')
            ->select(DB::raw('id, autores, fecha, letra, titulo, "c" as tipo'))
            ->orderBy('autores')->orderBy('fecha')->orderBy('letra');

        $enlaces = DB::table('referencias_enlaces')
            ->where('referencias_enlaces.autores', 'like', '%'.$query.'%')
            ->orwhere('referencias_enlaces.nombre', 'like', '%'.$query.'%')
            ->select(DB::raw('id, autores, fecha, letra, nombre, "e" as tipo'))
            ->orderBy('autores')->orderBy('fecha')->orderBy('letra');

        $trabajos = DB::table('referencias_trabajos')
            ->where('referencias_trabajos.autores', 'like', '%'.$query.'%')
            ->orwhere('referencias_trabajos.titulo', 'like', '%'.$query.'%')
            ->select(DB::raw('id, autores, fecha, letra, titulo, "t" as tipo'))
            ->union($revistas)
            ->union($libros)
            ->union($catalogos)
            ->union($enlaces)
            ->orderBy('autores')->orderBy('fecha')->orderBy('letra')
            ->get();

        return $trabajos;
    }


    public function getRevistas($query)
    {
        $revistas = DB::table('referencias_revistas')
            ->where('referencias_revistas.autores', 'like', '%'.$query.'%')
            ->orwhere('referencias_revistas.titulo', 'like', '%'.$query.'%')
            ->select('id','autores','titulo')
            ->orderBy('autores')
            ->get();

        return $revistas;
    }

    public function getLibros($query)
    {
        $libros = DB::table('referencias_libros')
            ->where('referencias_libros.autores', 'like', '%'.$query.'%')
            ->orwhere('referencias_libros.titulo', 'like', '%'.$query.'%')
            ->select('id','autores','titulo')
            ->orderBy('autores')
            ->get();

        return $libros;
    }

    public function getCatalogos($query)
    {
        $catalogos = DB::table('referencias_catalogos')
            ->where('referencias_catalogos.autores', 'like', '%'.$query.'%')
            ->orwhere('referencias_catalogos.titulo', 'like', '%'.$query.'%')
            ->select('id','autores','titulo')
            ->orderBy('autores')
            ->get();

        return $catalogos;
    }

    public function getTrabajos($query)
    {
        $trabajos = DB::table('referencias_trabajos')
            ->where('referencias_trabajos.autores', 'like', '%'.$query.'%')
            ->orwhere('referencias_trabajos.titulo', 'like', '%'.$query.'%')
            ->select('id','autores','titulo')
            ->orderBy('autores')
            ->get();

        return $trabajos;
    }

    public function getEnlaces($query)
    {
        $enlaces = DB::table('referencias_enlaces')
            ->where('referencias_enlaces.autores', 'like', '%'.$query.'%')
            ->orwhere('referencias_enlaces.nombre', 'like', '%'.$query.'%')
            ->select('id','autores','nombre')
            ->orderBy('autores')
            ->get();

        return $enlaces;
    }
}