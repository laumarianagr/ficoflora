<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 05/07/2015
 * Time: 3:34
 */

namespace App\Ficoflora\Registros\Taxonomia;


use App\Modelos\Taxonomia\Orden;

class OrdenRegistro {

    private $nombre;

    private $clase_id;
    private $subclase_id;

    private $creador_id;

    private $error;
    private $log;
    private $existe=true;


    function __construct($datos, $clase_id, $subclase_id, $creador_id) {

        $this->nombre = $datos['orden'];
        $this->clase_id = $clase_id;
        $this->subclase_id = $subclase_id;
        $this->creador_id = $creador_id;
    }


    /**
     * Obtiene el objeto orden y lo regresa al controllador.
     *
     */
    public function nuevoOrden()
    {
        $registro = $this->getOrden();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }

    /**
     * Obtiene el objeto orden, ya sea buscandolo en la BDD o creandolo en caso de que no exista.
     *
     */
    public function getOrden()
    {
        $obj_orden = Orden::where('nombre', $this->nombre)->first();

        if($obj_orden == null){
            $this->existe = false;
            return new Orden(['nombre' => $this->nombre, 'creador_id' => $this->creador_id, 'subclase_id'=> $this->subclase_id, 'clase_id'=> $this->clase_id]);
        }

        //El Orden ya existe
        $this->error = true;
        $this->log = "El Orden ya existe";


        return $obj_orden;
    }

}