<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 18/07/2015
 * Time: 1:09
 */

namespace App\Ficoflora\Registros\Geograficos;


use App\Modelos\Geografico\Entidad;

class EntidadRegistro {


    private $nombre;

    private $latitud;
    private $longitud;

    private $creador_id;

    private $error;
    private $log;
    private $existe = true;


    function __construct($datos, $creador_id) {

        $this->nombre = $datos['entidad'];
        $this->latitud = $datos['latitud'];
        $this->longitud = $datos['longitud'];
        $this->creador_id = $creador_id;
    }



    /**
     *
     */
    public function nuevaEntidad()
    {

        $registro = $this->getEntidad();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }

    /**
     *
     */
    private function getEntidad()
    {
        $obj_entidad = Entidad::where('nombre', $this->nombre)->first();

        if($obj_entidad == null){
            $this->existe = false;
            return new Entidad(['nombre' => $this->nombre, 'latitud'=> $this->latitud, 'longitud' => $this->longitud,'creador_id' => $this->creador_id]);
        }

        return $obj_entidad;
    }
}