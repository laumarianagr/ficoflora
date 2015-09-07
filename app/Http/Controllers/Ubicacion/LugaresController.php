<?php

namespace App\Http\Controllers\Ubicacion;

use App\Ficoflora\Funcionalidades\EspecieNombreTrait;
use App\Ficoflora\Funcionalidades\UbicacionSuperiorTrait;
use App\Modelos\Geografico\Lugar;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LugaresController extends Controller
{

    use UbicacionSuperiorTrait;
    use EspecieNombreTrait;

    public function especies($id)
    {
        $lugar = Lugar::find($id);

        $especies_ids = $lugar->especies()->get();
//        dd(count($especies_ids));

        $ubicacion = $this->ubicacionLugar($id);

        $especies = Array();
        $total = 0;

        foreach ($especies_ids as $especie) {

            if($especie->catalogo == true){

                $nombre = $this->especieNombre($especie, null, false);
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

        return view('ubicacion.lugar.index-sitios', compact('sitios', 'ubicacion', 'total'));
    }
}
