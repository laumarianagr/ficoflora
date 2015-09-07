<?php

namespace App\Http\Controllers\Busquedas;

use App\Modelos\Taxonomia\Especie;
use App\Modelos\Taxonomia\Genero;
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
    public function index()
    {


        return view('buscar.buscar', compact('generos'));
    }

    /**hnk
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function buscarEspeciesSinonimias(Request $request)
    {
        $query = $request->especie;
        
        $sinonimias = DB::table('sinonimias')
            
            ->where('generos.nombre', 'like', $query.'%')
            ->orwhere('epitetos_especificos.nombre', 'like', $query.'%')
            ->orwhere('epitetos_varietales.nombre', 'like', $query.'%')
            ->orwhere('epitetos_formas.nombre', 'like', $query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_varietales.nombre,epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"f.",epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"var.",epitetos_varietales.nombre)'), 'like' , '%'.$query.'%')
            ->join('epitetos_especificos', 'sinonimias.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'sinonimias.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'sinonimias.forma_id', '=', 'epitetos_formas.id')
            ->join('autores', 'sinonimias.autor_id', '=', 'autores.id')
            ->join('generos', 'sinonimias.genero_id', '=', 'generos.id')
            ->select(DB::raw('sinonimias.id, 1 as catalogo,   generos.nombre as genero, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, autores.nombre as autor, "sinonimia" as tipo'));


        $especies = DB::table('especies')
            ->where(function ($q) use ($query){
                $q->orwhere('generos.nombre', 'like', $query.'%')
                ->orwhere('epitetos_especificos.nombre', 'like', $query.'%')
                ->orwhere('epitetos_varietales.nombre', 'like', $query.'%')
                ->orwhere('epitetos_formas.nombre', 'like', $query.'%')
                ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_varietales.nombre,epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
                ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"f.",epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
                ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"var.",epitetos_varietales.nombre)'), 'like' , '%'.$query.'%');//
            })
            ->where('especies.catalogo', 1)
            ->join('epitetos_especificos', 'especies.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'especies.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'especies.forma_id', '=', 'epitetos_formas.id')
            ->join('autores', 'especies.autor_id', '=', 'autores.id')
            ->join('generos', 'especies.genero_id', '=', 'generos.id')
            ->select(DB::raw('especies.id, especies.catalogo,  generos.nombre as genero, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, autores.nombre as autor, "especie" as tipo'))
            ->union($sinonimias)
            ->orderBy('genero')->orderBy('especifico')->orderBy('forma')->orderBy('varietal')
            ->get();

//        dd($especies);
        $total = count($especies);

        return view('buscar.resultados', compact('query', 'total', 'especies'));

    }

    public function getEspeciesSinonimias($query)
    {


//
//        $especies = DB::table('especies')
//            ->where('generos.nombre', 'like', $query.'%')
//            ->orwhere('epitetos_especificos.nombre', 'like', $query.'%')
//            ->orwhere('epitetos_varietales.nombre', 'like', $query.'%')
//            ->orwhere('epitetos_formas.nombre', 'like', $query.'%')
//            ->join('epitetos_especificos', 'especies.especifico_id', '=', 'epitetos_especificos.id')
//            ->leftJoin('epitetos_varietales', 'especies.varietal_id', '=', 'epitetos_varietales.id')
//            ->leftJoin('epitetos_formas', 'especies.forma_id', '=', 'epitetos_formas.id')
//            ->join('generos', 'especies.genero_id', '=', 'generos.id')
//            ->select(DB::raw('especies.id, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, generos.nombre as genero, "e" as tipo'))
//            ->union($sinonimias)
//            ->orderBy('genero')->orderBy('especifico')->orderBy('forma')->orderBy('varietal')
//            ->get();
//
//
//        return $especies;


        $sinonimias = DB::table('sinonimias')
            ->where(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_varietales.nombre,epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"f.",epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"var.",epitetos_varietales.nombre)'), 'like' , '%'.$query.'%')
            ->join('epitetos_especificos', 'sinonimias.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'sinonimias.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'sinonimias.forma_id', '=', 'epitetos_formas.id')
            ->join('generos', 'sinonimias.genero_id', '=', 'generos.id')
            ->select(DB::raw('sinonimias.id, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, generos.nombre as genero, CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_varietales.nombre,epitetos_formas.nombre)  as nombre, "s" as tipo'));

        $especies = DB::table('especies')
            ->where(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_varietales.nombre,epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"f.",epitetos_formas.nombre)'), 'like' , '%'.$query.'%')
            ->orwhere(DB::raw('CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,"var.",epitetos_varietales.nombre)'), 'like' , '%'.$query.'%')
            ->join('epitetos_especificos', 'especies.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'especies.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'especies.forma_id', '=', 'epitetos_formas.id')
            ->join('generos', 'especies.genero_id', '=', 'generos.id')
            ->select(DB::raw('especies.id, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, generos.nombre as genero, CONCAT_WS(" ",generos.nombre,epitetos_especificos.nombre,epitetos_varietales.nombre,epitetos_formas.nombre)  as nombre, "e" as tipo'))
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
}
