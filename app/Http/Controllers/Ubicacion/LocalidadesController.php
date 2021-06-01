<?php

namespace App\Http\Controllers\Ubicacion;

use App\Ficoflora\Especies\EspecieDatosTrait;
use App\Ficoflora\Ubicacion\UbicacionSuperiorTrait;
use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use Illuminate\Http\Request;
use App\Modelos\Taxonomia\Especie;
use App\Ficoflora\Especies\ReportesReferenciasTrait;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modelos\Taxonomia\Prueba;


class LocalidadesController extends Controller
{

    use UbicacionSuperiorTrait;
    use EspecieDatosTrait;
    use ReportesReferenciasTrait;

    public function especies($id)
    {
        $localidad = Localidad::find($id);
        $info_coordenadasUbicacion = null;
        $info_coordenadasUbicacion[0] = ['latitud' =>$localidad['latitud'], 'longitud'=>$localidad['longitud'], 'nombre'=>$localidad['nombre']];
        $coordenadas = collect($info_coordenadasUbicacion);

        $entidad = Entidad::find($localidad['entidad_id']);
        $info_coordenadasUbicacion = null;
        $info_coordenadasUbicacion[0] = ['latitud' =>$entidad['latitud'], 'longitud'=>$entidad['longitud'], 'nombre'=>$entidad['nombre']];
        $coordenadasUbicacion = collect($info_coordenadasUbicacion);


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
        
        $obj_especie = Especie::find($id);
        $especie = $this->especieDatos($obj_especie, $id, true);
        list($citas_reportes, $referencias, $ubicaciones_ids) = $this->getReportesReferenciasEspecie($id);
//        dd($especies, $ubicacion);

        return view('ubicacion.localidad.index-especies', compact('especies', 'ubicacion', 'total', 'coordenadas', 'coordenadasUbicacion', 'citas_reportes'));
        //return view('ubicacion.entidad.index-localidades', compact('especies', 'ubicacion', 'total', 'coordenadas', 'coordenadasUbicacion', 'citas_reportes'));
    }



    public function lugares($id)
    {
        $localidad = Localidad::find($id);
        $info_coordenadasUbicacion = null;
        $info_coordenadasUbicacion[0] = ['latitud' =>$localidad['latitud'], 'longitud'=>$localidad['longitud'], 'nombre'=>$localidad['nombre']];
        $coordenadasUbicacion = collect($info_coordenadasUbicacion);

        $lugares = $localidad->lugares()->get();

        $ubicacion = $this->ubicacionLocalidad($id);

        $total = count($lugares);
        $info_coordenadas = null;

        foreach ($lugares as $lugar) {
            $lugar['especies'] = count($lugar->especies()->conCatalogo(true)->get());
            $lugar['sitios'] = count($lugar->sitios()->get());
            $info_coordenadas[$lugar['id']] = ['latitud' =>$lugar['latitud'], 'longitud'=>$lugar['longitud'], 'nombre'=>$lugar['nombre']];
        }
        $coordenadas = collect($info_coordenadas);

        return view('ubicacion.localidad.index-lugares', compact('lugares', 'ubicacion', 'total','coordenadas', 'coordenadasUbicacion'));
    }


    public function lugaresyespecies($id)
    {
        $localidad = Localidad::find($id);
        $lugares = $localidad->lugares()->get();
        $total = count($lugares);

        if ($total>0){ // hay lugares para listar que posiblemente tengan especies

            $info_coordenadasUbicacion = null;
            $info_coordenadasUbicacion[0] = ['latitud' =>$localidad['latitud'], 'longitud'=>$localidad['longitud'], 'nombre'=>$localidad['nombre']];
            $coordenadasUbicacion = collect($info_coordenadasUbicacion);

            $ubicacion = $this->ubicacionLocalidad($id);

            $info_coordenadas = null;

            foreach ($lugares as $lugar) {
                $lugar['especies'] = count($lugar->especies()->conCatalogo(true)->get());
                $lugar['sitios'] = count($lugar->sitios()->get());
                $info_coordenadas[$lugar['id']] = ['latitud' =>$lugar['latitud'], 'longitud'=>$lugar['longitud'], 'nombre'=>$lugar['nombre']];
            }
            $coordenadas = collect($info_coordenadas);

            return view('ubicacion.localidad.index-lugares', compact('lugares', 'ubicacion', 'total','coordenadas', 'coordenadasUbicacion'));

        }
        else{ // no hay lugares para esta localidad, pero si hay especies para listar

            $info_coordenadas = null;
            $info_coordenadas[0] = ['latitud' =>$localidad['latitud'], 'longitud'=>$localidad['longitud'], 'nombre'=>$localidad['nombre']];
            $coordenadas = collect($info_coordenadas);

            $entidad = Entidad::find($localidad['entidad_id']);
            $info_coordenadasUbicacion = null;
            $info_coordenadasUbicacion[0] = ['latitud' =>$entidad['latitud'], 'longitud'=>$entidad['longitud'], 'nombre'=>$entidad['nombre']];
            $coordenadasUbicacion = collect($info_coordenadasUbicacion);

            $especies_ids = $localidad->especies()->conCatalogo(true)->get();
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
            $obj_especie = Especie::find($id);
            $especie = $this->especieDatos($obj_especie, $id, true);
            list($citas_reportes, $referencias, $ubicaciones_ids) = $this->getReportesReferenciasEspecie($id);

            return view('ubicacion.localidad.index-especies', compact('especies', 'ubicacion', 'total', 'coordenadas', 'coordenadasUbicacion', 'citas_reportes'));

        }

    }
}
