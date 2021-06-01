<?php

namespace App\Http\Controllers\Ubicacion;

use App\Ficoflora\Especies\EspecieDatosTrait;
use App\Ficoflora\Ubicacion\UbicacionSuperiorTrait;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;
use Illuminate\Http\Request;

use App\Modelos\Taxonomia\Especie;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SitiosController extends Controller
{
    use UbicacionSuperiorTrait;
    use EspecieDatosTrait;
    use ReportesReferenciasTrait;

    public function especies($id)
    {
        $sitio = Sitio::find($id);
        $info_coordenadas = null;
        $info_coordenadas[0] = ['latitud' =>$sitio['latitud'], 'longitud'=>$sitio['longitud'], 'nombre'=>$sitio['nombre']];
        $coordenadas = collect($info_coordenadas);

        $lugar = Lugar::find($sitio['lugar_id']);
        $info_coordenadasUbicacion = null;
        $info_coordenadasUbicacion[0] = ['latitud' =>$lugar['latitud'], 'longitud'=>$lugar['longitud'], 'nombre'=>$lugar['nombre']];
        $coordenadasUbicacion = collect($info_coordenadasUbicacion);

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
        $obj_especie = Especie::find($id);
        $especie = $this->especieDatos($obj_especie, $id, true);
        list($citas_reportes, $referencias, $ubicaciones_ids) = $this->getReportesReferenciasEspecie($id);
//        dd($especies, $ubicacion);

        return view('ubicacion.sitio.index-especies', compact('especies', 'ubicacion', 'total', 'coordenadas', 'coordenadasUbicacion', 'citas_reportes'));
    }
}
