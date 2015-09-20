<?php

namespace App\Http\Controllers\Taxonomia;

use App\Ficoflora\Especies\EspecieDatosTrait;
use App\Ficoflora\Funcionalidades\TaxonomiaSuperiorTrait;
use App\Modelos\Taxonomia\Familia;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FamiliasController extends Controller
{
    use TaxonomiaSuperiorTrait;
    use EspecieDatosTrait;

    public function especies($id)
    {
        $familia = Familia::find($id);

        $taxonomia = $this->taxoFamilia($id);
        
        $generos = $familia->generos()->get();

        $especies_nombres = Array();

        $total = 0;

        foreach ($generos as $genero) {

            $especies = $genero->especies()->get();

            foreach ($especies as $especie) {

                if($especie->catalogo==true) {

                    $nombre = $this->especieDatos($especie, null, false);
                    $total++;
                }

            array_push($especies_nombres, $nombre);
            }
        }

        return view('taxonomia.familia.index_especies', compact('taxonomia', 'total'))->with('especies', $especies_nombres);

    }


    public function generos($id)
    {
        $familia = Familia::find($id);

        $taxonomia = $this->taxoFamilia($id);

        $generos = $familia->generos()->get();

//        dd($taxonomia);


        $total = count($generos);


//        dd($generos);

        return view('taxonomia.familia.index_generos', compact('taxonomia', 'total', 'generos'));

    }
}
