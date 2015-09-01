<?php

namespace App\Http\Controllers\Taxonomia;

use App\Ficoflora\Funcionalidades\NombresTrait;
use App\Modelos\Taxonomia\Genero;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GenerosController extends Controller
{
    use NombresTrait;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function especies($id)
    {
        $genero = Genero::find($id);
//        dd($genero);
        $especies_ids = $genero->especies()->get();

        $total = count($especies_ids);
        $taxonomia = $this->nombreGenero($id);

        $especies = Array();
        foreach ($especies_ids as $especie_ids) {

            $especie = $this->especieIdsToNombre($especie_ids, null, false);

            array_push($especies, $especie);
        }


//        dd($especies, $taxonomia);

        return view('taxonomia.genero.index_especies', compact('especies', 'taxonomia', 'total'));
    }
}
