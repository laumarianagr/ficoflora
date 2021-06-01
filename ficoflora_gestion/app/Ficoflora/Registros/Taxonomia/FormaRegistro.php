<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 06/07/2015
 * Time: 6:48
 */

namespace App\Ficoflora\Registros\Taxonomia;


use App\Modelos\Taxonomia\Epitetos\Forma;

class FormaRegistro {

    private $nombre;
    private $creador_id;

    private $error;
    private $log;
    private $existe=true;


    function __construct($forma, $creador_id) {

        $this->nombre = $forma;
        $this->creador_id = $creador_id;
    }


    /**
     * Obtiene el objeto Epíteto Forma y lo regresa al controllador.
     *
     */
    public function nuevaForma()
    {
        $registro = $this->getForma();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }

    /**
     * Obtiene el objeto clase, ya sea buscandolo en la BDD o creandolo en caso de que no exista.
     *
     */
    public function getForma()
    {
        $obj_forma = Forma::where('nombre', $this->nombre)->first();

        if($obj_forma == null){
            $this->existe = false;
            return new Forma(['nombre' => $this->nombre, 'creador_id' => $this->creador_id]);
        }

        //el epíteto forma ya existe
        $this->log = "El epíteto forma ya existe";


        return $obj_forma;
    }
}