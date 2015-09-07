<?php

namespace App\Http\Controllers\Ubicacion;

use App\Ficoflora\Funcionalidades\EspecieNombreTrait;
use App\Ficoflora\Funcionalidades\UbicacionSuperiorTrait;
use App\Modelos\Geografico\Entidad;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EntidadesController extends Controller
{

    use UbicacionSuperiorTrait;
    use EspecieNombreTrait;

    public function especies($id)
    {
        $entidad = Entidad::find($id);

        $especies_ids = $entidad->especies()->get();

//        dd(count($especies_ids));
        
        $ubicacion = $this->ubicacionEntidad($id);

        $especies = Array();
        $total = 0;

        foreach ($especies_ids as $especie) {

            if($especie->catalogo==true){

                $nombre = $this->especieNombre($especie, null, false);
                array_push($especies, $nombre);
                $total++;
            }
        }

        return view('ubicacion.entidad.index-especies', compact('especies', 'ubicacion', 'total'));
    }



    public function localidades($id)
    {
        $entidad = Entidad::find($id);

        $localidades = $entidad->localidades()->get();

        $ubicacion = $this->ubicacionEntidad($id);

        $total = count($localidades);


        return view('ubicacion.entidad.index-localidades', compact('localidades', 'ubicacion', 'total'));
    }

}