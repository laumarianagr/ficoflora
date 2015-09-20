<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 05/09/2015
 * Time: 0:03
 */

namespace App\Ficoflora\Ubicacion;



use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;

trait UbicacionSuperiorTrait {



    public function ubicacionSitio($id)
    {
        $sitio = Sitio::find($id);

        $ubicacion = $this->ubicacionLugar($sitio->lugar_id);

        $ubicacion['sitio'] = $sitio->nombre;
        $ubicacion['sitio_id'] = $sitio->id;

        return $ubicacion;
    }

    public function ubicacionLugar($id)
    {
        $lugar = Lugar::find($id);

        $ubicacion = $this->ubicacionLocalidad($lugar->localidad_id);

        $ubicacion['lugar'] = $lugar->nombre;
        $ubicacion['lugar_id'] = $lugar->id;

        return $ubicacion;
    }

    public function ubicacionLocalidad($id)
    {
        $localidad = Localidad::find($id);

        $ubicacion = $this->ubicacionEntidad($localidad->entidad_id);

        $ubicacion['localidad'] = $localidad->nombre;
        $ubicacion['localidad_id'] = $localidad->id;

        return $ubicacion;
    }

    public function ubicacionEntidad($id)
    {
        $entidad = Entidad::find($id);

        $ubicacion = $this->ubicacionPais();

        $ubicacion['entidad'] = $entidad->nombre;
        $ubicacion['entidad_id'] = $entidad->id;

        return $ubicacion;
    }


    public function ubicacionPais()
    {
        $ubicacion['pais'] = 'Venezuela';
        return $ubicacion;
    }






}

