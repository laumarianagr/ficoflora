<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 06/07/2015
 * Time: 8:15
 */

namespace App\Ficoflora\Registros\Taxonomia;


use App\Modelos\Taxonomia\Autor;

class AutorRegistro {
    private $autor;

    private $creador_id;

    private $error;
    private $log;
    private $existe=true;


    function __construct($autor, $creador_id) {

        $this->autor = $autor;
        $this->creador_id = $creador_id;
    }


    /**
     * Obtiene el objeto Autor y lo regresa al controllador.
     *
     */
    public function nuevoAutor()
    {
        $registro = $this->getAutor();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }

    /**
     * Obtiene el objeto autor, ya sea buscandolo en la BDD o creandolo en caso de que no exista.
     *
     */
    public function getAutor()
    {
        $obj_autor = Autor::where('nombre', $this->autor)->first();

        if($obj_autor == null){
            $this->existe = false;
            return new Autor(['nombre' => $this->autor, 'creador_id' => $this->creador_id]);
        }

        //El autor ya existe
        $this->log = "El Autor ya existe";

        return $obj_autor;
    }

}