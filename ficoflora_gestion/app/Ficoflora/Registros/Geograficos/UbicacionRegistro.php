<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 18/07/2015
 * Time: 9:31
 */

namespace App\Ficoflora\Registros\Geograficos;


use App\Ficoflora\Funcionalidades\Respuesta;
use App\Modelos\Geografico\Ubicacion;
use App\Modelos\Taxonomia\Especie;
use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;

class UbicacionRegistro extends Respuesta {



    function __construct($datos, $especie)
    {
        $this->entidad = $datos['entidad'];
        $this->localidad = $datos['localidad'];
        $this->lugar = $datos['lugar'];
        $this->sitio = $datos['sitio'];
        $this->especie = $especie;

    }

    public function newUbicacion()
    {
        if($this->especie !=null){
            $this->especie = Especie::find($this->especie);
        }

        $registro = $this->getUbicacion();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }


    private function getUbicacion()
    {

        list($entidad, $localidad, $lugar, $sitio) = $this->procesarUbicacion();

        $obj_ubicacion = Ubicacion::where('entidad_id', $entidad)->conLocalidad($localidad)->conLugar($lugar)->conSitio($sitio)->first();

        if($obj_ubicacion == null){

            $obj_ubicacion = new Ubicacion([
                'entidad_id' => $entidad,
                'localidad_id' => $localidad,
                'lugar_id' => $lugar,
                'sitio_id' => $sitio,
            ]);

            $this->existe = false;

        }else{
            $this->log="La Ubicación ya existe";
        }

        return $obj_ubicacion;
    }

    /**
     * Busca en la BDD si existe la entidad, sino la crea.
     *
     */
    private function getEntidad()
    {
        $obj_entidad = Entidad::where('nombre', $this->entidad)->first(); //verifico si ya existe en la BD

        if($obj_entidad == null){ //Creo la entidad si no existe
            $this->existe=false;
            return Entidad::Create(['nombre' => $this->entidad]);
        }

        return $obj_entidad;
    }




    /**
     * Revisa si existe la localidad en la BDD, sino la crea.
     *
     */
    private function getLocalidad($entidad)
    {

        $obj_localidad = Localidad::where('nombre', $this->localidad)->ConEntidadId($entidad->id)->first(); //verifico si ya existe en la BD

        if($obj_localidad == null){
            $this->existe=false;
            return $entidad->localidades()->save(new Localidad(['nombre' => $this->localidad])); //Guardo la localidad asociandola a la entidad
        }
        return $obj_localidad;
    }



    /**
     * Revisa si existe el LUGAR en la BDD, sino lo crea.
     *
     */
    private function getLugar($localidad)
    {
        $obj_lugar = Lugar::where('nombre', $this->lugar)->conLocalidadId($localidad->id)->first(); //verifico si ya existe en la BD

        if($obj_lugar == null){
            $this->existe=false;
            return $localidad->lugares()->save(new Lugar(['nombre' => $this->lugar])); //Guardo el lugar asociandola a la localidad
        }

        return $obj_lugar;
    }



    /**
     * Revisa si existe el LUGAR en la BDD, sino lo crea.
     *
     */
    private function getSitio($lugar)
    {
        $obj_sitio = Sitio::where('nombre', $this->sitio)->conLugarId($lugar->id)->first(); //verifico si ya existe en la BD

        if($obj_sitio == null){
            $this->existe=false;
            return $lugar->sitios()->save(new Sitio(['nombre' => $this->sitio])); //Guardo el sitio asociandola a un lugar
        }

        return $obj_sitio;
    }




    /**
     * @return array
     */
    private function procesarUbicacion()
    {

        $entidad = $localidad = $lugar = $sitio = null;

        $obj_entidad = $this->getEntidad();
        $entidad = $obj_entidad->id;

        if ($this->especie != null) {
            $this->tablaEspecieEntidad($obj_entidad);
        }

        if ($this->localidad != null) {
            $obj_localidad = $this->getLocalidad($obj_entidad);
            $localidad = $obj_localidad->id;
            if ($this->especie != null) {
                $this->tablaEspecieLocalidad($obj_localidad);
            }

            if ($this->lugar != null) {
                $obj_lugar = $this->getLugar($obj_localidad);
                $lugar = $obj_lugar->id;
                if ($this->especie != null) {
                    $this->tablaEspecieLugar($obj_lugar);
                }

                if ($this->sitio != null) {
                    $obj_sitio = $this->getSitio($obj_lugar);
                    $sitio = $obj_sitio->id;
                    if ($this->especie != null) {
                        $this->tablaEspecieSitio($obj_sitio);
                    }

                }
            }
        }
        return array($entidad, $localidad, $lugar, $sitio);
    }
}