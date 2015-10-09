<?php

namespace App\Http\Controllers\Ubicacion;

use App\Ficoflora\Especies\EspecieDatosTrait;
use App\Ficoflora\Ubicacion\UbicacionSuperiorTrait;
use App\Modelos\Geografico\Sitio;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SitiosController extends Controller
{
    use UbicacionSuperiorTrait;
    use EspecieDatosTrait;

    public function especies($id)
    {
        $sitio = Sitio::find($id);

        $especies_ids = $sitio->especies()->conCatalogo(true)->get();

        $ubicacion = $this->ubicacionSitio($id);

        $especies = Array();
        $total = 0;

        foreach ($especies_ids as $especie) {

            if($especie->catalogo == true){

                $nombre = $this->especieDatos($especie, null, false);
                array_push($especies, $nombre);
                $total++;
            }
        }


        return view('ubicacion.sitio.index-especies', compact('especies', 'ubicacion', 'total'));
    }
}
