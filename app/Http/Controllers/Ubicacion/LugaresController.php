<?php

namespace App\Http\Controllers\Ubicacion;

use App\Ficoflora\Especies\EspecieDatosTrait;
use App\Ficoflora\Ubicacion\UbicacionSuperiorTrait;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use Illuminate\Http\Request;
use App\Ficoflora\Especies\ReportesReferenciasTrait;
use App\Modelos\Taxonomia\Especie;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LugaresController extends Controller
{

    use UbicacionSuperiorTrait;
    use EspecieDatosTrait;
    use ReportesReferenciasTrait;


    public function especies($id)
    {
        $lugar = Lugar::find($id);
        $info_coordenadas = null;
        $info_coordenadas[0] = ['latitud' =>$lugar['latitud'], 'longitud'=>$lugar['longitud'], 'nombre'=>$lugar['nombre']];
        $coordenadas = collect($info_coordenadas);

        $localidad = Localidad::find($lugar['localidad_id']);
        $info_coordenadasUbicacion = null;
        $info_coordenadasUbicacion[0] = ['latitud' =>$localidad['latitud'], 'longitud'=>$localidad['longitud'], 'nombre'=>$localidad['nombre']];
        $coordenadasUbicacion = collect($info_coordenadasUbicacion);

        $especies_ids = $lugar->especies()->conCatalogo(true)->get();

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
        $obj_especie = Especie::find($id);
        $especie = $this->especieDatos($obj_especie, $id, true);
        list($citas_reportes, $referencias, $ubicaciones_ids) = $this->getReportesReferenciasEspecie($id);


        return view('ubicacion.lugar.index-especies', compact('especies', 'ubicacion', 'total', 'coordenadas', 'coordenadasUbicacion', 'citas_reportes'));
    }

    public function sitios($id)
    {
        $lugar = Lugar::find($id);
        $info_coordenadasUbicacion = null;
        $info_coordenadasUbicacion[0] = ['latitud' =>$lugar['latitud'], 'longitud'=>$lugar['longitud'], 'nombre'=>$lugar['nombre']];
        $coordenadasUbicacion = collect($info_coordenadasUbicacion);

        $sitios = $lugar->sitios()->get();
        $ubicacion = $this->ubicacionLugar($id);

        $total = count($sitios);
        $info_coordenadas = null;

        foreach ($sitios as $sitio) {
            $sitio['especies'] = count($sitio->especies()->conCatalogo(true)->get());
            $info_coordenadas[$sitio['id']] = ['latitud' =>$sitio['latitud'], 'longitud'=>$sitio['longitud'], 'nombre'=>$sitio['nombre']];

        }
        $coordenadas = collect($info_coordenadas);

        return view('ubicacion.lugar.index-sitios', compact('sitios', 'ubicacion', 'total', 'coordenadas', 'coordenadasUbicacion'));
    }

    public function sitiosyespecies($id)
    {
        $lugar = Lugar::find($id);
        $sitios = $lugar->sitios()->get();
        $total = count($sitios);

        if ($total>0){ // hay sitios para listar que posiblemente tengan especies

            $info_coordenadasUbicacion = null;
            $info_coordenadasUbicacion[0] = ['latitud' =>$lugar['latitud'], 'longitud'=>$lugar['longitud'], 'nombre'=>$lugar['nombre']];
            $coordenadasUbicacion = collect($info_coordenadasUbicacion);

            $ubicacion = $this->ubicacionLugar($id);
            $info_coordenadas = null;

            foreach ($sitios as $sitio) {
                $sitio['especies'] = count($sitio->especies()->conCatalogo(true)->get());
                $info_coordenadas[$sitio['id']] = ['latitud' =>$sitio['latitud'], 'longitud'=>$sitio['longitud'], 'nombre'=>$sitio['nombre']];

            }
            $coordenadas = collect($info_coordenadas);

            return view('ubicacion.lugar.index-sitios', compact('sitios', 'ubicacion', 'total', 'coordenadas', 'coordenadasUbicacion'));
        }
        else{ // no hay sitios para este lugar, pero si hay especies para listar

            $info_coordenadas = null;
            $info_coordenadas[0] = ['latitud' =>$lugar['latitud'], 'longitud'=>$lugar['longitud'], 'nombre'=>$lugar['nombre']];
            $coordenadas = collect($info_coordenadas);

            $localidad = Localidad::find($lugar['localidad_id']);
            $info_coordenadasUbicacion = null;
            $info_coordenadasUbicacion[0] = ['latitud' =>$localidad['latitud'], 'longitud'=>$localidad['longitud'], 'nombre'=>$localidad['nombre']];
            $coordenadasUbicacion = collect($info_coordenadasUbicacion);

            $especies_ids = $lugar->especies()->conCatalogo(true)->get();

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
            // $obj_especie = Especie::find($id);
            // $especie = $this->especieDatos($obj_especie, $id, true);
            // list($citas_reportes, $referencias, $ubicaciones_ids) = $this->getReportesReferenciasEspecie($id);

            return view('ubicacion.lugar.index-especies', compact('especies', 'ubicacion', 'total', 'coordenadas', 'coordenadasUbicacion'));
        }
    }
}