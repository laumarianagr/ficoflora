<?php

namespace App\Http\Controllers\Ubicacion;

use App\Ficoflora\Funcionalidades\EspecieNombreTrait;
use App\Ficoflora\Funcionalidades\UbicacionSuperiorTrait;
use App\Modelos\Geografico\Sitio;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SitiosController extends Controller
{
    use UbicacionSuperiorTrait;
    use EspecieNombreTrait;

    public function especies($id)
    {
        $sitio = Sitio::find($id);

        $especies_ids = $sitio->especies()->get();
//        dd(count($especies_ids));

        $ubicacion = $this->ubicacionSitio($id);

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

        return view('ubicacion.sitio.index-especies', compact('especies', 'ubicacion', 'total'));
    }
}
