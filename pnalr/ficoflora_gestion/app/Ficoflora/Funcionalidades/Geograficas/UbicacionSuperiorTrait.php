<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 05/09/2015
 * Time: 0:03
 */

namespace App\Ficoflora\Funcionalidades\Geograficas;



use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;

trait UbicacionSuperiorTrait {



    public function ubicacionSitio($id)
    {
        $sitio = Sitio::find($id);

        $ubicacion = $this->ubicacionLugar($sitio->lugar_id);

        $ubicacion['latitud'] = $sitio->latitud;
        $ubicacion['longitud'] = $sitio->longitud;
        $ubicacion['sitio'] = $sitio->nombre;
        $ubicacion['sitio_id'] = $sitio->id;
        $ubicacion['creador_id'] = $sitio->creador_id;


        return $ubicacion;
    }

    public function ubicacionLugar($id)
    {
        $lugar = Lugar::find($id);

        $ubicacion = $this->ubicacionLocalidad($lugar->localidad_id);

        $ubicacion['latitud'] = $lugar->latitud;
        $ubicacion['longitud'] = $lugar->longitud;
        $ubicacion['lugar'] = $lugar->nombre;
        $ubicacion['lugar_id'] = $lugar->id;
        $ubicacion['creador_id'] = $lugar->creador_id;


        return $ubicacion;
    }

    public function ubicacionLocalidad($id)
    {
        $localidad = Localidad::find($id);

        $ubicacion = $this->ubicacionEntidad($localidad->entidad_id);

        $ubicacion['latitud'] = $localidad->latitud;
        $ubicacion['longitud'] = $localidad->longitud;
        $ubicacion['localidad'] = $localidad->nombre;
        $ubicacion['localidad_id'] = $localidad->id;
        $ubicacion['creador_id'] = $localidad->creador_id;


        return $ubicacion;
    }

    public function ubicacionEntidad($id)
    {
        $entidad = Entidad::find($id);

        $ubicacion = $this->ubicacionPais();

        $ubicacion['latitud'] = $entidad->latitud;
        $ubicacion['longitud'] = $entidad->longitud;
        $ubicacion['entidad'] = $entidad->nombre;
        $ubicacion['entidad_id'] = $entidad->id;
        $ubicacion['creador_id'] = $entidad->creador_id;

        return $ubicacion;
    }


    public function ubicacionPais()
    {
        $ubicacion['pais'] = 'Venezuela';
        $ubicacion['pais_id'] = 1;
        return $ubicacion;
    }






}

