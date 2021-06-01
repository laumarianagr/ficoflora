<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 04/07/2015
 * Time: 10:20
 */

namespace App\Ficoflora\Registros\Taxonomia;


use App\Modelos\Taxonomia\Phylum;

class PhylumRegistro {

    private $nombre;

    private $creador_id;

    private $error;
    private $log;
    private $existe=true;


    function __construct($datos, $creador_id) {

        $this->nombre = $datos['phylum'];
        $this->creador_id = $creador_id;
    }


    /**
     * Constructor para la crear un nuevo AUTOR desde formulario con establcerAutor()
     *
     */
    public function nuevoPhylum()
    {

        $registro = $this->getPhylum();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }

    /**
     * Busca en la BDD si existe el PHYLUM, sino lo crea.
     *
     */
    public function getPhylum()
    {
        $obj_phylum = Phylum::where('nombre', $this->nombre)->first();

        if($obj_phylum == null){
            $this->existe = false;
            return new Phylum(['nombre' => $this->nombre, 'creador_id' => $this->creador_id]);
        }

        return $obj_phylum;
    }


}