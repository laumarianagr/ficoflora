<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 22/06/2015
 * Time: 6:04
 */

namespace App\Ficoflora\Registros;


use App\Modelos\Bibliografia\Cita;
use App\Modelos\Taxonomia\Autor;

class Formulario {

    private $phylum;
    private $clase;
    private $subclase;
    private $orden;
    private $familia;
    private $genero;
    private $especifico;
    private $varietal;
    private $forma;
    private $autor;
    private $creador;
    private $cita_autor;
    private $cita_fecha;
    private $cita_letra;

    private $error;
    private $log;
    private $existe=true;

    private $existe_phylum = true;
    private $existe_clase = true;
    private $existe_subclase = true;
    private $existe_orden = true;
    private $existe_familia = true;
    private $existe_genero = true;
    private $existe_especie = true;
    private $existe_especifico = true;
    private $existe_varietal = true;
    private $existe_forma = true;
    private $existe_autor = true;
    private $existe_cita = true;



    function __construct() {

    }


    /**
     * Constructor para la crear un nuevo AUTOR desde formulario con establcerAutor()
     *
     */
    public function nuevoAutor($autor, $creador)
    {
        $this->autor = $autor;
        $this->creador = $creador;

        $registro = $this->establecerAutor();

        if($this->existe_autor == false){$this->existe = false;}

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }

    /**
     * Busca en la BDD si existe EL AUTOR, sino lo crea.
     *
     */
    public function establecerAutor()
    {
        $obj_autor = Autor::where('nombre', $this->autor)->first();

        if($obj_autor == null)
        {
            $obj_autor =  new Autor(['nombre' => $this->autor]); //Guardo la especie-mariedad-forma asociandola a un orden
            $obj_autor->creador_id = $this->creador;
            $obj_autor->save();

            $this->existe_autor =false;

            return $obj_autor;
        }

        return $obj_autor;
    }

    /**
     * Constructor para la crear una nueva CITA desde formulario con establcerCita()
     *
     */
    public function nuevaCita($autor, $fecha, $letra, $creador)
    {
        $this->cita_autor = $autor;
        $this->cita_fecha = $fecha;
        $this->cita_letra = $letra;
        $this->creador = $creador;

        $registro = $this->establecerCita();

        if($this->existe_cita == false){$this->existe = false;}

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }


    /**
     * Busca en la BDD si existe la CITA, sino la crea.
     *
     */
    public function establecerCita()
    {
        if($this->cita_letra  == '-'){$this->cita_letra = null;}

        $obj_cita  = Cita::where('autores', $this->cita_autor)->conFecha($this->cita_fecha)->conLetra($this->cita_letra)->first();

        if($obj_cita == null){
            $obj_cita = new Cita(['autores' => $this->cita_autor, 'fecha' => $this->cita_fecha, 'letra' => $this->cita_letra]);
            $obj_cita->creador_id = $this->creador;
            $obj_cita->save();

            $this->existe_cita = false;

            return $obj_cita;
        }

        return $obj_cita;
    }

}