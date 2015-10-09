<?php

namespace App\Http\Controllers\Ubicacion;

use App\Ficoflora\Especies\EspecieDatosTrait;
use App\Ficoflora\Ubicacion\UbicacionSuperiorTrait;
use App\Modelos\Geografico\Localidad;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LocalidadesController extends Controller
{

    use UbicacionSuperiorTrait;
    use EspecieDatosTrait;

    public function especies($id)
    {
        $localidad = Localidad::find($id);

        $especies_ids = $localidad->especies()->conCatalogo(true)->get();
//        dd(count($especies_ids));

        $ubicacion = $this->ubicacionLocalidad($id);

        $especies = Array();
        $total = 0;

        foreach ($especies_ids as $especie) {

            if($especie->catalogo == true){

                $nombre = $this->especieDatos($especie, null, false);
                array_push($especies, $nombre);
                $total++;
            }
        }

//        dd($especies, $ubicacion);

        return view('ubicacion.localidad.index-especies', compact('especies', 'ubicacion', 'total'));
    }



    public function lugares($id)
    {
        $lugar = Localidad::find($id);

        $lugares = $lugar->lugares()->get();

        $ubicacion = $this->ubicacionLocalidad($id);

        $total = count($lugares);

        foreach ($lugares as $lugar) {
            $lugar['especies'] = count($lugar->especies()->conCatalogo(true)->get());
            $lugar['sitios'] = count($lugar->sitios()->get());
        }


        return view('ubicacion.localidad.index-lugares', compact('lugares', 'ubicacion', 'total'));
    }
}
