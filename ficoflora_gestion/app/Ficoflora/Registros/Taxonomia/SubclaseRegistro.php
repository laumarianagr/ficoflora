<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 05/07/2015
 * Time: 9:25
 */

namespace App\Ficoflora\Registros\Taxonomia;


use App\Modelos\Taxonomia\Clase;
use App\Modelos\Taxonomia\Subclase;

class SubclaseRegistro {
    private $nombre;

    private $clase_id;

    private $creador_id;

    private $error;
    private $log;
    private $existe=true;


    function __construct($datos, $clase_id, $creador_id) {

        $this->nombre = $datos['subclase'];
        $this->clase_id = $clase_id;
        $this->creador_id = $creador_id;
    }


    /**
     * Obtiene el objeto Sublase y lo regresa al controllador.
     *
     */
    public function nuevaSubclase()
    {
        $registro = $this->getSubclase();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }

    /**
     * Obtiene el objeto subclase, ya sea buscandolo en la BDD o creandolo en caso de que no exista.
     *
     */
    public function getSubclase()
    {
        $obj_subclase = Subclase::where('nombre', $this->nombre)->first();

        if($obj_subclase == null){
            $this->existe = false;
            return new Subclase(['nombre' => $this->nombre, 'creador_id' => $this->creador_id, 'clase_id' => $this->clase_id]);
        }
        //La clase ya existe
        $this->error = true;
        $this->log = "La Clase ya existe";

        //Verifico que si la clase existe pertenece al mismo phylum que el usuario indica.
        if($obj_subclase->clase_id != $this->clase_id){
            $clase = Clase::find($obj_subclase->clase_id);
            $this->log = "La Clase ya existe, pertenece a la clase  \"".$clase->nombre."\"";

        }
        return $obj_subclase;
    }

}