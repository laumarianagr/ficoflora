<?php

namespace App\Http\Controllers\Ubicacion;

use App\Ficoflora\Especies\EspecieDatosTrait;
use App\Ficoflora\Ubicacion\UbicacionSuperiorTrait;
use App\Modelos\Geografico\Lugar;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LugaresController extends Controller
{

    use UbicacionSuperiorTrait;
    use EspecieDatosTrait;

    public function especies($id)
    {
        $lugar = Lugar::find($id);

        $especies_ids = $lugar->especies()->conCatalogo(true)->get();
//        dd(count($especies_ids));

        $ubicacion = $this->ubicacionLugar($id);

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

        return view('ubicacion.lugar.index-especies', compact('especies', 'ubicacion', 'total'));
    }

    public function sitios($id)
    {
        $lugar = Lugar::find($id);

        $sitios = $lugar->sitios()->get();

        $ubicacion = $this->ubicacionLugar($id);

        $total = count($sitios);

        foreach ($sitios as $sitio) {
            $sitio['especies'] = count($sitio->especies()->conCatalogo(true)->get());
        }

        return view('ubicacion.lugar.index-sitios', compact('sitios', 'ubicacion', 'total'));
    }
}
