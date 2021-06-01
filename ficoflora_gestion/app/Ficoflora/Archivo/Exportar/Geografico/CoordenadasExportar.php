<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 27/09/2015
 * Time: 10:09
 */

namespace App\Ficoflora\Archivo\Exportar\Geografico;


use App\Modelos\Geografico\Ubicacion;
use Illuminate\Support\Facades\DB;

trait CoordenadasExportar {

    public function getCoordenadas()
    {

        $ubicacioness =  DB::table('ubicaciones')
            ->leftjoin('entidades','ubicaciones.entidad_id',  '=','entidades.id' )
            ->leftjoin('localidades','ubicaciones.localidad_id',  '=','localidades.id' )
            ->leftjoin('lugares','ubicaciones.lugar_id',  '=','lugares.id' )
            ->leftjoin('sitios','ubicaciones.sitio_id',  '=','sitios.id' )
            ->select(DB::raw('entidades.nombre as entidad, localidades.nombre as localidad, lugares.nombre as lugar, sitios.nombre as sitio, ubicaciones.latitud, ubicaciones.longitud'))
            ->get();
        
        $ubicaciones = collect($ubicacioness)->groupBy('entidad');

        $coordenadas = [];
        
        foreach ($ubicaciones as $entidad => $porEntidad) {
            
            $porLocalidad = $porEntidad->sortBy('localidad')->groupBy('localidad');

            foreach ($porLocalidad as $localidad =>$ubicacionesLo) {
                
                if($localidad == null) {
                    array_push($coordenadas, [$entidad, null, null, null, ' '.$ubicacionesLo[0]->latitud, ' '.$ubicacionesLo[0]->longitud]);

                }else{

                    $porLugar = $ubicacionesLo->sortBy('lugar')->groupBy('lugar');
//
                    foreach ($porLugar as $lugar => $ubicacionesLu) {
//                        
                        if($lugar == null){
                            array_push($coordenadas, [$entidad, $localidad, null, null, ' '.$ubicacionesLu[0]->latitud, ' '.$ubicacionesLu[0]->longitud]);
                        }else{
//
                            $porSitio  = $ubicacionesLu->sortBy('sitio')->groupBy('sitio');

                            foreach ($porSitio as $sitio => $ubicacionesS) {
//                                
                                if($sitio == null){
                                    array_push($coordenadas, [$entidad, $localidad, $lugar, null, ' '.$ubicacionesS[0]->latitud, ' '.$ubicacionesS[0]->longitud]);
                                }else{
                                    array_push($coordenadas, [$entidad, $localidad, $lugar, $sitio, ' '.$ubicacionesS[0]->latitud, ' '.$ubicacionesS[0]->longitud]);
                                }
                            }
//
                        }
                    }

                }
            }

        }

        return $coordenadas;


    }
}