<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 04/07/2015
 * Time: 10:36
 */

namespace App\Ficoflora\Registros\Taxonomia;


use App\Modelos\Taxonomia\Clase;
use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Genero;
use App\Modelos\Taxonomia\Orden;
use App\Modelos\Taxonomia\Phylum;
use App\Modelos\Taxonomia\Subclase;

class TaxonomiaRegistro{


    private $phylum;
    private $clase;
    private $subclase;
    private $orden;
    private $familia;
    private $genero;

    private $error=false;
    private $log;
    private $existe=true;

    private $datos;
    
    private $flag;
    private $flag_phylum = false;
    private $flag_clase = false;
    private $flag_subclase = false;
    private $flag_orden = false;
    private $flag_familia = false;
    private $flag_genero = false;


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

    private $creador;

    private $actulizar_familia = false;


    function __construct($datos, $flag, $creador_id) {

        $this->datos =$datos;
        $this->flag =$flag;
        $this->creador =$creador_id;
    }


    public function newTaxonomia()
    {
        $this->setFlag();
        $obj_phylum = $obj_clase = $obj_subclase = $obj_orden = $obj_familia = $obj_genero = $registro = null;

        $obj_phylum = $this->establecerPhylum();

        if($this->flag_phylum == false){
            $obj_clase = $this->establecerClase($obj_phylum);

            if(!$this->error && !$this->flag_clase){

                if($this->datos['subclase'] != null) {
                    $obj_subclase = $this->establecerSubclase($obj_clase);
                }

                if(!$this->error && !$this->flag_subclase){
                    $obj_orden = $this->establecerOrden($obj_clase, $obj_subclase);

                    if(!$this->error && !$this->flag_orden){
                        $obj_familia = $this->establecerFamilia($obj_orden);

                        if(!$this->error && !$this->flag_familia){
                            $obj_genero = $this->establecerGenero($obj_familia);

                        }//genero
                    }//familia
                }//orden
            }//subclase
        }// clase

        if(!$this->error && !$this->existe){

            $registro = $this->guardarNuevoRegistro($obj_phylum, $obj_clase, $obj_subclase, $obj_orden, $obj_familia, $obj_genero);
        }

        if($this->existe){
            $this->log =  $this->flag." ya existe";
        }

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];
        return $respuesta;

    }

    public function setFlag()
    {
        switch ($this->flag) {
            case 'phylum':
                $this->flag_phylum = true;
                break;
            case 'clase':
                $this->flag_clase = true;
                break;
            case 'subclase':
                $this->flag_subclase = true;
                break;
            case 'orden':
                $this->flag_orden = true;
                break;
            case 'familia':
                $this->flag_familia = true;
                break;
            case 'genero':
                $this->flag_genero = true;
                break;
        }
    }

    //PHYLUM--------------------------

    public function establecerPhylum()
    {
        $obj_phylum = Phylum::where('nombre', $this->datos['phylum'])->first();

        if($obj_phylum == null){
            $this->existe_phylum = false;
            return new Phylum(['nombre' =>  $this->datos['phylum'], 'creador_id' => $this->creador]);
        }
        return $obj_phylum;
    }

    //CLASE---------------------------------

    public function establecerClase($obj_phylum)
    {
        $obj_clase = Clase::where('nombre', $this->datos['clase'])->first();

        if($obj_clase == null){
            $this->existe = $this->existe_clase = false;
            return new Clase(['nombre' => $this->datos['clase'], 'creador_id' => $this->creador]);
        }

        if($obj_clase->phylum_id != $obj_phylum->id){ //Verifico que si la clase existe pertenece al mismo phylum que el archivo indica.
            $this->error = true;
            $this->log = "la Clase pertenece a un Phylum diferente al que se suministra";
        }
        return $obj_clase;
    }

    //SUBCLASE------------------------

    public function establecerSubclase($obj_clase)
    {
        $obj_subclase = Subclase::where('nombre', $this->datos['subclase'])->first();

        if($obj_subclase == null){
            $this->existe = $this->existe_subclase = false;
            return new Subclase(['nombre' => $this->datos['subclase'], 'creador_id' => $this->creador]);
        }

        if($obj_subclase->clase_id != $obj_clase->id){
            $this->error = true;
            $this->log = "la Subclase pertenece a un Clase diferente a la que se suministra";
        }
        return $obj_subclase;
    }


    //ORDEN-------------------------------

    public function establecerOrden($obj_clase, $obj_subclase)
    {
        $obj_orden = Orden::where('nombre', $this->datos['orden'])->first();

        if($obj_orden == null){
            $this->existe =  $this->existe_orden = false;
            return new Orden(['nombre' => $this->datos['orden'], 'creador_id' => $this->creador]);
        }


        if($obj_subclase != null){ //caso 1: (null 2) - (f 2) antes subclase vacia, ahora con f || caso 2: (b 2) - (f 2) antes sublcase b,  ahora f.
            if (($obj_orden->subclase_id == null) || ($obj_orden->subclase_id  != $obj_subclase->id)){
                $this->error = true;
                $this->log = "el Orden pertenece a una Subclase diferente a la que se suministra";
            }
        }else {
            if(($obj_subclase == null) && ($obj_orden->subclase_id != null)){ //caso 3: (b 2) - (null 2) antes subclase b, ahora vacia.
                $this->error = true;
                $this->log = "el Orden pertenece a una Subclase diferente a la que se suministra";
            }
        }

        if($this->error == false){
            if ($obj_orden->clase_id != $obj_clase->id) {
                $this->error = true;
                $this->log = "el Orden pertenece a una Clase diferente a la que se suministra";
            }
        }

        return $obj_orden;
    }


    //FAMILIA-------------------

    public function establecerFamilia($obj_orden)
    {
        $obj_familia = Familia::where('nombre', $this->datos['familia'])->first();

        if($obj_familia == null){
            $this->existe = $this->existe_familia = false;
            return new Familia(['nombre' => $this->datos['familia'], 'creador_id' => $this->creador]); //Guardo la familia asociandola a un orden

        }

        if($obj_familia->orden_id != $obj_orden->id){ //Verifico que si la familia existe, pertenece al mismo orden que el archivo indica.
            $this->error = true;
            $this->log = "la Familia pertenece a un Orden diferente al que se suministra";
        }

        return $obj_familia;
    }


    //GENERO-------------------------------------------

    public function establecerGenero($obj_familia)
    {
        $obj_genero = Genero::where('nombre', $this->datos['genero'])->first();

        if($obj_genero == null){
            $this->existe = $this->existe_genero= false;
            return new Genero(['nombre' => $this->datos['genero'], 'creador_id' => $this->creador]);
        }


        if($obj_genero->familia_id == -1){
            $this->actulizar_familia = true;

        }else{
            if($obj_genero->familia_id != $obj_familia->id){ //Verifico que si el genero existe, pertenece a la misma familia que el archivo indica.
                $this->error = true;
                $this->log = "el Genero pertenece a una Familia diferente a la que se suministra";
            }
        }

        return $obj_genero;
    }



    //GUARDAR----------------

    private function guardarNuevoRegistro($obj_phylum, $obj_clase, $obj_subclase, $obj_orden, $obj_familia, $obj_genero)
    {

        //PHYLUM
        if($this->existe_phylum == false){
            $obj_phylum = Phylum::Create(['nombre' => $this->datos['phylum'], 'creador_id' => $this->creador]);
        }
        //CLASE
        if($this->existe_clase == false){
            $obj_clase = $obj_phylum->clases()->save($obj_clase); //Guardo la clase asociandola a un phylum
        }
        //SUBCLASE
        if($this->existe_subclase == false) {
            $obj_subclase = $obj_clase->subclases()->save($obj_subclase); //Guardo la subclase asociandola a una clase
        }
        //ORDEN
        if($this->existe_orden == false) {
            if($obj_subclase != null) {
                $obj_orden = $obj_clase->ordenes()->save(new Orden(['nombre' => $this->datos['orden'], 'subclase_id' => $obj_subclase->id, 'creador_id' => $this->creador])); //Guardo el orden asociandola a una clase y subclase
            }else{
                $obj_orden = $obj_clase->ordenes()->save($obj_orden); //Guardo el orden asociandola a una clase nada mÃ¡s.
            }
        }
        //FAMILIA
        if($this->existe_familia== false) {
            $obj_familia = $obj_orden->familias()->save($obj_familia); //Guardo la familia asociandola a un orden
        }
        //GENERO
        if($this->existe_genero == false) {
            $obj_genero = $obj_familia->generos()->save($obj_genero); //Guardo el genero asociandola a una familia
        }else{

            if($this->actulizar_familia == true){
                $obj_genero->familia_id = $obj_familia->id;
                $obj_genero->save();
            }
        }

        return compact('obj_phylum', 'obj_clase', 'obj_subclase', 'obj_orden', 'obj_familia', 'obj_genero');
    }



}