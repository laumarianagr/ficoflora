<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 06/07/2015
 * Time: 6:34
 */

namespace App\Ficoflora\Registros\Taxonomia;


use App\Modelos\Taxonomia\Epitetos\Subespecie;

class SubespecieRegistro {
    private $nombre;


    private $creador_id;

    private $error;
    private $log;
    private $existe=true;


    function __construct($subespecie, $creador_id) {

        $this->nombre = $subespecie;
        $this->creador_id = $creador_id;
    }


    /**
     * Obtiene el objeto Específico y lo regresa al controllador.
     *
     */
    public function nuevaSubespecie()
    {
        $registro = $this->getSubespecie();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }

    /**
     * Obtiene el objeto clase, ya sea buscandolo en la BDD o creandolo en caso de que no exista.
     *
     */
    public function getSubespecie()
    {
        $obj_subespecie = Subespecie::where('nombre', $this->nombre)->first();

        if($obj_subespecie == null){
            $this->existe = false;
            return new Subespecie(['nombre' => $this->nombre, 'creador_id' => $this->creador_id]);
        }

        //La subespecie ya existe
        $this->log = "La subespecie ya existe";


        return $obj_subespecie;
    }
}