<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 18/07/2015
 * Time: 7:22
 */

namespace App\Ficoflora\Registros\Geograficos;


use App\Modelos\Geografico\Sitio;

class SitioRegistro {

    private $nombre;
    private $lugar_id;
    private $latitud;
    private $longitud;

    private $creador_id;

    private $error;
    private $log;
    private $existe = true;


    function __construct($nombre, $latitud, $longitud, $lugar_id, $creador_id) {

        $this->nombre = $nombre;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->lugar_id = $lugar_id;

        $this->creador_id = $creador_id;
    }


    public function nuevoSitio()
    {
        $registro = $this->getSitio();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }

    /**
     * Obtiene el objeto clase, ya sea buscandolo en la BDD o creandolo en caso de que no exista.
     *
     */
    public function getSitio()
    {
        $obj_sitio = Sitio::where('nombre', $this->nombre)->first();

        //Si no existe o si el sitio existe pero pertenece a otro lugar, es nuevo.
        if(($obj_sitio == null) || ($obj_sitio->lugar_id != $this->lugar_id)){
            $this->existe = false;
            return new Sitio(['nombre' => $this->nombre, 'latitud' => $this->latitud, 'longitud' => $this->longitud, 'lugar_id' => $this->lugar_id,'creador_id' => $this->creador_id]);
        }

        //El Sitio ya existe
        $this->log = "El Sitio ya existe";

        return $obj_sitio;
    }
}