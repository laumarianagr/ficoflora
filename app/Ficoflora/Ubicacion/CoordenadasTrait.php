<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 09/09/2015
 * Time: 22:53
 */

namespace App\Ficoflora\Ubicacion;


use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;
use App\Modelos\Geografico\Ubicacion;

trait CoordenadasTrait {


    public function getCoordenadas($ubicaciones)
    {
        $coordenadas = array();

        foreach ($ubicaciones as $id) {

            $ubicacion = Ubicacion::find($id);

            $nombre = null;
            if($ubicacion['sitio_id'] != null){
                $nombre = Sitio::find($ubicacion['sitio_id'])->nombre;
                $tipo = 'Sitio';

            }else{

                if($ubicacion['lugar_id'] != null) {
                    $nombre = Lugar::find($ubicacion['lugar_id'])->nombre;
                    $tipo = 'Lugar';

                }else{
                    if($ubicacion['localidad_id'] != null) {
                        $nombre = Localidad::find($ubicacion['localidad_id'])->nombre;
                        $tipo = 'Localidad';
                    }else{
                        $nombre =  Entidad::find($ubicacion['entidad_id'])->nombre;
                        $tipo = 'Entidad';

                    }
                }
            }

            $coordenadas[$id] = ['latitud' =>$ubicacion['latitud'], 'longitud'=>$ubicacion['longitud'], 'nombre'=>$nombre, 'tipo'=>$tipo];
        }

        return $coordenadas;
    }
}