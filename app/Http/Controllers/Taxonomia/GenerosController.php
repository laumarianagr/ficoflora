<?php

namespace App\Http\Controllers\Taxonomia;

use App\Ficoflora\Especies\EspecieDatosTrait;
use App\Ficoflora\Especies\NombresTrait;
use App\Ficoflora\Funcionalidades\TaxonomiaSuperiorTrait;
use App\Modelos\Taxonomia\Genero;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GenerosController extends Controller
{
    use TaxonomiaSuperiorTrait;
    use EspecieDatosTrait;

    public function especies($id)
    {
        $genero = Genero::find($id);
//        dd($genero);
        $especies_ids = $genero->especies()->get();

        $taxonomia = $this->taxoGenero($id);

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


//        dd($especies, $taxonomia);

        return view('taxonomia.genero.index_especies', compact('especies', 'taxonomia', 'total'));
    }



    public function getGeneros()
    {

        $generos = Genero::lists('nombre','id');

        return $generos;

    }
}
