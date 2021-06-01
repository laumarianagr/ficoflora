<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 06/07/2015
 * Time: 5:52
 */

namespace App\Ficoflora\Registros\Taxonomia;


use App\Modelos\Taxonomia\Epitetos\Especifico;
use App\Modelos\Taxonomia\Genero;

class EspecificoRegistro {
    private $nombre;

    private $creador_id;

    private $error;
    private $log;
    private $existe=true;


    function __construct($especifico, $creador_id) {

        $this->nombre = $especifico;
        $this->creador_id = $creador_id;
    }


    /**
     * Obtiene el objeto Especifico y lo regresa al controllador.
     *
     */
    public function nuevoEspecifico()
    {
        $registro = $this->getEspecifico();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }

    /**
     * Obtiene el objeto clase, ya sea buscandolo en la BDD o creandolo en caso de que no exista.
     *
     */
    public function getEspecifico()
    {
        $obj_especifico = Especifico::where('nombre', $this->nombre)->first();

        if($obj_especifico == null){
            $this->existe = false;
            return new Especifico(['nombre' => $this->nombre, 'creador_id' => $this->creador_id]);
        }

        //El espíteto específico ya existe
        $this->log = "El epiteto específico ya existe";


        return $obj_especifico;
    }
}