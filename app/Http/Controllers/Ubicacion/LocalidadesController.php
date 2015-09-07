<?php

namespace App\Http\Controllers\Ubicacion;

use App\Ficoflora\Funcionalidades\EspecieNombreTrait;
use App\Ficoflora\Funcionalidades\UbicacionSuperiorTrait;
use App\Modelos\Geografico\Localidad;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LocalidadesController extends Controller
{

    use UbicacionSuperiorTrait;
    use EspecieNombreTrait;

    public function especies($id)
    {
        $localidad = Localidad::find($id);

        $especies_ids = $localidad->especies()->get();
//        dd(count($especies_ids));

        $ubicacion = $this->ubicacionLocalidad($id);

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

        return view('ubicacion.localidad.index-especies', compact('especies', 'ubicacion', 'total'));
    }



    public function lugares($id)
    {
        $lugar = Localidad::find($id);

        $lugares = $lugar->lugares()->get();

        $ubicacion = $this->ubicacionLocalidad($id);

        $total = count($lugares);


        return view('ubicacion.localidad.index-lugares', compact('lugares', 'ubicacion', 'total'));
    }
}
