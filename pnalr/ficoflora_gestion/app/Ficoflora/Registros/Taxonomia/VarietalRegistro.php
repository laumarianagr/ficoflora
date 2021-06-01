<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 06/07/2015
 * Time: 6:34
 */

namespace App\Ficoflora\Registros\Taxonomia;


use App\Modelos\Taxonomia\Epitetos\Varietal;

class VarietalRegistro {
    private $nombre;


    private $creador_id;

    private $error;
    private $log;
    private $existe=true;


    function __construct($varietal, $creador_id) {

        $this->nombre = $varietal;
        $this->creador_id = $creador_id;
    }


    /**
     * Obtiene el objeto Especifico y lo regresa al controllador.
     *
     */
    public function nuevoVarietal()
    {
        $registro = $this->getVarietal();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }

    /**
     * Obtiene el objeto clase, ya sea buscandolo en la BDD o creandolo en caso de que no exista.
     *
     */
    public function getVarietal()
    {
        $obj_varietal = Varietal::where('nombre', $this->nombre)->first();

        if($obj_varietal == null){
            $this->existe = false;
            return new Varietal(['nombre' => $this->nombre, 'creador_id' => $this->creador_id]);
        }

        //La genero ya existe
        $this->log = "El epíteto varietal ya existe";


        return $obj_varietal;
    }
}