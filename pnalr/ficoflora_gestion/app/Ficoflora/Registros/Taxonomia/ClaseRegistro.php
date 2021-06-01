<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 04/07/2015
 * Time: 10:22
 */

namespace App\Ficoflora\Registros\Taxonomia;


use App\Modelos\Taxonomia\Clase;
use App\Modelos\Taxonomia\Phylum;

class ClaseRegistro {

    private $nombre;

    private $phylum_id;

    private $creador_id;

    private $error;
    private $log;
    private $existe=true;


    function __construct($datos, $phylum_id, $creador_id) {

        $this->nombre = $datos['clase'];
        $this->phylum_id = $phylum_id;
        $this->creador_id = $creador_id;
    }


    /**
     * Obtiene el objeto Clase y lo regresa al controllador.
     *
     */
    public function nuevaClase()
    {
        $registro = $this->getClase();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }

    /**
     * Obtiene el objeto clase, ya sea buscandolo en la BDD o creandolo en caso de que no exista.
     *
     */
    public function getClase()
    {
        $obj_clase = Clase::where('nombre', $this->nombre)->first();

        if($obj_clase == null){
            $this->existe = false;
            return new Clase(['nombre' => $this->nombre, 'creador_id' => $this->creador_id, 'phylum_id' => $this->phylum_id]);
        }

        //La clase ya existe
        $this->error = true;
        $this->log = "La Clase ya existe";

        //Verifico que si la clase existe pertenece al mismo phylum que el usuario indica.
        if($obj_clase->phylum_id != $this->phylum_id){
            $phylum = Phylum::find($obj_clase->phylum_id);
            $this->log = "La Clase ya existe, pertenece al phylum \"".$phylum->nombre."\"";
        }

        return $obj_clase;
    }


}