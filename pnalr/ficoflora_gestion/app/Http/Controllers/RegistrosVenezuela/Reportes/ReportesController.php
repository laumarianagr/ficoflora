<?php

namespace App\Http\Controllers\RegistrosVenezuela\Reportes;

use App\Modelos\Taxonomia\Epitetos\Especifico;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function crear()
    {

        $especies = DB::table('especies')
            ->join('epitetos_especificos', 'especies.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'especies.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'especies.forma_id', '=', 'epitetos_formas.id')
            ->join('generos', 'epitetos_especificos.genero_id', '=', 'generos.id')
            ->select(DB::raw('especies.id, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, generos.nombre as genero'))
            ->orderBy('genero')->orderBy('especifico')->orderBy('forma')->orderBy('varietal')
            ->get();


        $datos = array();
        foreach($especies as $especie){

            $elemento = $especie->genero.' '.$especie->especifico;

            if($especie->varietal != null){
                $elemento = $elemento.' '.$especie->varietal;
            }
            if($especie->forma != null){
                $elemento = $elemento.' '.$especie->forma;
            }

            $datos =array_merge($datos, [$especie->id => $elemento]);
        }

//        dd($array);

        return view('reporte.crear')->with('especies', $datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
