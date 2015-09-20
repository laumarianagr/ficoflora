<?php

namespace App\Http\Controllers\Taxonomia;

use App\Ficoflora\Especies\EspecieDatosTrait;
use App\Modelos\Sinonimias\Sinonimia;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SinonimiasController extends Controller
{
    use EspecieDatosTrait;

    public function especies($id)
    {
        $sinonimia = Sinonimia::find($id);
        $especies_ids = $sinonimia->especies()->get();

        $sinonimia = $this->especieDatos($sinonimia, null, false);

        $especies = Array();
        $total = 0;

        foreach ($especies_ids as $especie) {

//            dd($especie);
            if($especie->catalogo==true){

                $nombre = $this->especieDatos($especie, null, false);
                array_push($especies, $nombre);
                $total++;
            }
        }


//        dd($especies, $sinonimia);

        return view('taxonomia.sinonimia.index-especies', compact('especies', 'sinonimia', 'total'));



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
    public function destroy($id)
    {
        //
    }
}
