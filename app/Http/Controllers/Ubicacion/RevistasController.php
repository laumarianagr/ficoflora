<?php

namespace App\Http\Controllers\Ubicacion;

use App\Ficoflora\Especies\EspecieDatosTrait;
use App\Ficoflora\Ubicacion\UbicacionSuperiorTrait;
use App\Modelos\Geografico\Entidad;
use Illuminate\Http\Request;
use App\Modelos\Taxonomia\Especie;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EntidadesController extends Controller
{

    use UbicacionSuperiorTrait;
    use EspecieDatosTrait;
    use ReportesReferenciasTrait;

    public function especies($id)
    {
        $entidad = Entidad::find($id);

        $especies_ids = $entidad->especies()->conCatalogo(true)->get();
//        dd(count($especies_ids));

        $ubicacion = $this->ubicacionEntidad($id);

        $especies = Array();
        $total = 0;

        foreach ($especies_ids as $especie) {

            if($especie->catalogo == true){

                $nombre = $this->especieDatos($especie, null, false);
                array_push($especies, $nombre);
                $total++;
            }
        }
        $obj_especie = Especie::find($id);
        $especie = $this->especieDatos($obj_especie, $id, true);
        list($citas_reportes, $referencias, $ubicaciones_ids) = $this->getReportesReferenciasEspecie($id);

//        dd($especies, $ubicacion);

        return view('ubicacion.entidad.index-especies', compact('especies', 'ubicacion', 'total', 'citas_reportes'));
    }



    public function localidades($id)
    {
        $entidad = Entidad::find($id);
        $info_coordenadasUbicacion = null;
        $info_coordenadasUbicacion[0] = ['latitud' =>$entidad['latitud'], 'longitud'=>$entidad['longitud'], 'nombre'=>$entidad['nombre']];
        $coordenadasUbicacion = collect($info_coordenadasUbicacion);

        $localidades = $entidad->localidades()->get();

        $ubicacion = $this->ubicacionEntidad($id);

        $total = count($localidades);
        $info_coordenadas = null;

        foreach ($localidades as $localidad) {
            $localidad['especies'] = count($localidad->especies()->conCatalogo(true)->get());
            $localidad['lugares'] = count($localidad->lugares()->get());
            $info_coordenadas[$localidad['id']] = ['latitud' =>$localidad['latitud'], 'longitud'=>$localidad['longitud'], 'nombre'=>$localidad['nombre']];


        }
        $coordenadas = collect($info_coordenadas);

        return view('ubicacion.entidad.index-localidades', compact('localidades', 'ubicacion', 'total','coordenadas', 'coordenadasUbicacion'));
    }
}
