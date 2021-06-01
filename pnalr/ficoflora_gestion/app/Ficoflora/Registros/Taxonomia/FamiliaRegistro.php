<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 05/07/2015
 * Time: 8:38
 */

namespace App\Ficoflora\Registros\Taxonomia;


use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Orden;

class FamiliaRegistro {
    private $nombre;

    private $orden_id;

    private $creador_id;

    private $error;
    private $log;
    private $existe=true;


    function __construct($datos, $orden_id, $creador_id) {

        $this->nombre = $datos['familia'];
        $this->orden_id = $orden_id;
        $this->creador_id = $creador_id;
    }


    /**
     * Obtiene el objeto Familia y lo regresa al controllador.
     *
     */
    public function nuevaFamilia()
    {
        $registro = $this->getFamilia();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }

    /**
     * Obtiene el objeto familia, ya sea buscandolo en la BDD o creandolo en caso de que no exista.
     *
     */
    public function getFamilia()
    {
        $obj_familia = Familia::where('nombre', $this->nombre)->first();

        if($obj_familia == null){
            $this->existe = false;
            return new Familia(['nombre' => $this->nombre, 'creador_id' => $this->creador_id, 'orden_id' => $this->orden_id]);
        }

        //La familia ya existe
        $this->error = true;
        $this->log = "La Familia ya existe";

        //Verifico que si la familia existe pertenece al mismo phylum que el usuario indica.
        if($obj_familia->orden_id != $this->orden_id){
            $orden = Orden::find($obj_familia->orden_id);
            $this->log = "La Clase ya existe, pertenece al orden \"".$orden->nombre."\"";
        }

        return $obj_familia;
    }

}