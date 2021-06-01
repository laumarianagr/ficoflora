<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 06/07/2015
 * Time: 10:03
 */

namespace App\Ficoflora\Registros\Taxonomia;


use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Genero;

class GeneroRegistro {

    private $nombre;

    private $familia_id;

    private $creador_id;

    private $error;
    private $log;
    private $existe=true;


    function __construct($nombre, $familia_id, $creador_id) {

        $this->nombre = $nombre;
        $this->familia_id = $familia_id;
        $this->creador_id = $creador_id;
    }


    /**
     * Obtiene el objeto Genero y lo regresa al controllador.
     *
     */
    public function nuevoGenero()
    {
        $registro = $this->getGenero();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }

    /**
     * Obtiene el objeto clase, ya sea buscandolo en la BDD o creandolo en caso de que no exista.
     *
     */
    public function getGenero()
    {
        $obj_genero = Genero::where('nombre', $this->nombre)->first();

        if($obj_genero == null){
            $this->existe = false;
            return new Genero(['nombre' => $this->nombre, 'creador_id' => $this->creador_id, 'familia_id' => $this->familia_id]);
        }

        //El genero ya existe

        if($obj_genero->familia_id == -1){
            $obj_genero->familia_id = $this->familia_id;
            $this->existe = false;

        }else {
            $this->log = "El Genero ya existe";

            //Verifico que si el genero existe, pertenece a la misma familia que el usuario indica.
            if ($obj_genero->familia_id != $this->familia_id) {

                $this->error = true;

                $familia = Familia::find($obj_genero->familia_id);
                $this->log = "El Genero " . $this->nombre . " pertenece a la Familia \"" . $familia->nombre . "\"";
//            $this->log = "EL Genero ya existe, pertenece a la familia \"".$familia->nombre."\"";
            }
        }

        return $obj_genero;
    }

}