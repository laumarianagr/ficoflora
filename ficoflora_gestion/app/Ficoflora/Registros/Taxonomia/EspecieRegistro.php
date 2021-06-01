<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 06/07/2015
 * Time: 2:25
 */

namespace App\Ficoflora\Registros\Taxonomia;


use App\Modelos\Taxonomia\Especie;

class EspecieRegistro {


    
    private $datos;
    
    private $genero;
    private $especifico;
    private $varietal;
    private $forma;

    private $varietal_id;
    private $forma_id;

    private $obj_genero;
    private $obj_especifico;
    private $obj_varietal;
    private $obj_forma;

    private $autor;
    private $obj_autor;

    private $familia_id;

    private $creador_id;

    private $error;
    private $log;
    private $existe=true;

    private $existe_genero = true;
    private $existe_especifico = true;
    private $existe_varietal = true;
    private $existe_forma = true;
    private $existe_autor = true;

    function __construct($datos, $familia_id, $creador_id) {

        $this->datos = $datos;
        $this->genero = $datos['genero'];
        $this->especifico = $datos['especie'];
        $this->varietal = $datos['variedad'];
        $this->forma = $datos['forma'];
        $this->autor = $datos['autor'];
        
        $this->familia_id = $familia_id;
        $this->creador_id = $creador_id;
    }


    /**
     * Obtiene el objeto Clase y lo regresa al controllador.
     *
     */
    public function nuevaEspecie()
    {

    //***GENERO-------------------
        $reg_genero = new GeneroRegistro($this->genero, $this->familia_id, $this->creador_id);
        $res_genero = $reg_genero->nuevoGenero();

        //Manejo de errores referentes al género
        if($res_genero['error'] == true){
            return $res_genero;
        }
        //Manejo de errores referentes al género
        if($res_genero['existe'] == false){
            $this->existe_genero = false;
        }
        //obtenemos el objeto Género
        $this->obj_genero = $res_genero['registro'];
//        dd($this->obj_genero->id);

    //***ESPECIFICICO-------------------
        $reg_especifico = new EspecificoRegistro($this->especifico , $this->creador_id);
        $res_especifico = $reg_especifico->nuevoEspecifico();

        //Manejo de errores referentes al epíteto Específico
        if($res_especifico['error'] == true){
            return $res_especifico;
        }
         //Existe epíteto Específico
        if($res_especifico['existe'] == false){
            $this->existe_especifico = false;
        }

        //obtenemos el objeto epíteto Específcio
        $this->obj_especifico = $res_especifico['registro'];

//        dd($this->obj_especifico);

    //***VARIETAL-------------------
        if($this->varietal != null) {

            $reg_varietal = new VarietalRegistro($this->varietal, $this->creador_id);
            $res_varietal = $reg_varietal->nuevoVarietal();

            //Manejo de errores referentes al epíteto Varietal
            if ($res_varietal['error'] == true) {
                return $res_varietal;
            }
            //Existe epíteto Varietal
            if ($res_varietal['existe'] == false) {
                $this->existe_varietal = false;
            }else{
                $this->varietal_id = $res_varietal['registro']->id;// se hace porque puden ser null y al hacer obj_varietal->id da error
            }

            //obtenemos el objeto epíteto Varietal
            $this->obj_varietal = $res_varietal['registro'];
        }

    //***FORMA-------------------
        if($this->forma != null) {

            $reg_forma = new FormaRegistro($this->forma, $this->creador_id);
            $res_forma = $reg_forma->nuevaForma();

            //Manejo de errores referentes al epíteto Varietal
            if ($res_forma['error'] == true) {
                return $res_forma;
            }
            //Existe epíteto Varietal
            if ($res_forma['existe'] == false) {
                $this->existe_forma = false;
            }else{
                $this->forma_id = $res_forma['registro']->id;// se hace porque puden ser null y al hacer obj_forma->id da error
            }

            //obtenemos el objeto epíteto Varietal
            $this->obj_forma = $res_forma['registro'];
        }

        $registro = $this->getEspecie();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }

    /**
     * Obtiene el objeto clase, ya sea buscandolo en la BDD o creandolo en caso de que no exista.
     *
     */
    public function getEspecie()
    {

        if(($this->existe_forma == true) && ($this->existe_varietal == true) && ($this->existe_especifico == true) && ($this->existe_genero == true)) {
            $obj_especie = Especie::where('especifico_id', $this->obj_especifico->id)->conGeneroId($this->obj_genero->id)->conVarietal($this->varietal_id)->conForma($this->forma_id)->first();
        }else{
            $obj_especie = null;
        }

        if($obj_especie == null) {
            $this->existe = false;
            return $this->guardarRegistros();
        }

//        $this->error = true;
        $this->log = "Error: La Especie ya existe";

        return $obj_especie;

    }

    private function getAutor()
    {
        $reg_autor = new AutorRegistro($this->autor, $this->creador_id);
        $res_autor = $reg_autor->nuevoAutor();

        //Existe autor
        if ($res_autor['existe'] == false) {
            $this->existe_autor = false;
        }

        //obtenemos el objeto autor
        $this->obj_autor = $res_autor['registro'];
    }



    public function guardarRegistros()
    {
        $this->getAutor();

        //AUTOR
        if($this->existe_autor == false) {
            $this->obj_autor->save(); //Guardo el autor
        }

        //GENERO
        if($this->existe_genero == false) {
            $this->obj_genero->save(); //Guardo el genero
        }

        //VARIETAL
        if($this->existe_varietal == false){
            $this->obj_varietal->save(); //Guardo el epíteto  varietal
            $this->varietal_id = $this->obj_varietal->id;
        }

        //FORMA
        if($this->existe_forma == false){
            $this->obj_forma->save(); //Guardo el epíteto forma
            $this->forma_id = $this->obj_forma->id;
        }
        //ESPECIFICOS
        if($this->existe_especifico == false){
            $this->obj_especifico->save(); //Guardo el epíteto específico
        }

        $obj_especie = new Especie([
            'genero_id' => $this->obj_genero->id,
            'especifico_id' => $this->obj_especifico->id,
            'varietal_id' => $this->varietal_id,
            'forma_id' => $this->forma_id,
            'creador_id' => $this->creador_id,
            'autor_id' => $this->obj_autor->id,
            'catalogo' => false]);

        return $obj_especie;
    }



}