<?php namespace App\Ficoflora\Archivo\Taxonomia;


use App\Modelos\Taxonomia\Phylum;
use App\Modelos\Taxonomia\Clase;
use App\Modelos\Taxonomia\Subclase;
use App\Modelos\Taxonomia\Orden;
use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Genero;
use App\Modelos\Taxonomia\Especie;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Epitetos\Varietal;
use App\Modelos\Taxonomia\Epitetos\Especifico;
use App\Modelos\Taxonomia\Epitetos\Forma;
use App\Modelos\Taxonomia\Epitetos\Subespecie;

class TaxonomiaArchivo {

    private $phylum;
    private $clase;
    private $subclase;
    private $orden;
    private $familia;
    private $genero;
    private $especifico;
    private $varietal;
    private $forma;
    private $subespecie;
    private $autor;
    private $creador;

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
    private $existe_subespecie = true;

    private $actulizar_familia = false;


    function __construct($datos, $creador) {

        $this->phylum = $datos['phylum'];
        $this->clase = $datos['clase'];
        $this->subclase = $datos['subclase'];
        $this->orden = $datos['orden'];
        $this->familia = $datos['familia'];
        $this->genero = $datos['genero'];
        $this->especifico = $datos['especie'];
        $this->varietal = $datos['variedad'];
        $this->forma = $datos['forma'];
        $this->subespecie = $datos['subespecie'];
        $this->autor = $datos['autor'];
        $this->creador = $creador;
    }


    public function setTaxonomia()
    {
        $obj_especie = null;

        $obj_phylum = $this->establecerPhylum();

        $obj_clase = $this->establecerClase($obj_phylum);

        if(!$this->error){
            // echo " no hubo error de clase </br>";
            $obj_subclase = $this->subclase;// se  hace por que si no hay subclase, se pasa una variable que no existe a la llamada de establecerOrden($obj_clase, $obj_subclase)
            if($obj_subclase != null) {
                $obj_subclase = $this->establecerSubclase($obj_clase);
            }
//            dd($obj_subclase);
            if(!$this->error){
                // echo " no hubo error de subclase </br>";
                $obj_orden = $this->establecerOrden($obj_clase, $obj_subclase);

                if(!$this->error) {
                    // echo " no hubo error de orden </br>";
                    $obj_familia = $this->establecerFamilia($obj_orden);
                    if(!$this->error) {
                        // echo " no hubo error de familia </br>";
                        $obj_genero = $this->establecerGenero($obj_familia);
                        if(!$this->error) {
                            // echo " no hubo error de genero </br>";
                            $obj_especie = $this->establecerEspecie($obj_genero);
                            if(!$this->error) {
                                // echo " no hubo error de especie </br>";

                                if(($this->existe_phylum == false) || ($this->existe_clase == false) || ($this->existe_subclase == false) || ($this->existe_orden == false)
                                    || ($this->existe_familia == false) || ($this->existe_genero == false) || ($this->existe_especie == false))
                                {
                                    //si no hay ningun error y algun elemento de la taxonomia es nuevo
                                    $this->existe = false;
                                    $obj_especie = $this->guardarNuevoRegistro($obj_phylum, $obj_clase, $obj_subclase, $obj_orden, $obj_familia, $obj_genero, $obj_especie);
                                }

                            }
                        }
                    }
                }
            }
        }
        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'especie' => $obj_especie];

        return $respuesta;
    }

    /**
     * Busca el Phylum en la BDD, sino lo crea.
     *
     * @return static
     */
    public function establecerPhylum()
    {
        $obj_phylum = Phylum::where('nombre', $this->phylum)->first();

        if($obj_phylum == null){
            // echo "</br>NO EXISTE phylum</br>";
//            return Phylum::Create(['nombre' => $this->phylum]);
            $this->existe_phylum = false;
            return new Phylum(['nombre' => $this->phylum, 'creador_id' => $this->creador]);
        }
        // echo "</br>EXISTE phylum</br>";

        return $obj_phylum;
    }

    /**
     * Busca la Clase en la BDD, sino lo crea.
     *
     * @param $obj_phylum
     * @return mixed
     */
    public function establecerClase($obj_phylum)
    {
        $obj_clase = Clase::where('nombre', $this->clase)->first();

        if($obj_clase == null){
            // echo "NO EXISTE clase</br>";
//            return $obj_phylum->clases()->save(new Clase(['nombre' => $this->clase])); //Guardo la clase asociandola a un phylum
            $this->existe_clase = false;
            return new Clase(['nombre' => $this->clase, 'creador_id' => $this->creador]);
        }

        // echo "</br>EXISTE clase</br>";

        if($obj_clase->phylum_id != $obj_phylum->id){ //Verifico que si la clase existe pertenece al mismo phylum que el archivo indica.
            $this->error = true;
            $this->log = ['error'=>"La Clase pertenece a un Phylum diferente al que se suministra",'tipo'=>'Taxonomía'];
            // echo "error clase registrada pero no pertenece al phylum </br>";
        }
        return $obj_clase;
    }


    /**
     * Busca la subclase en la BDD, sino lo crea.
     *
     * @param $obj_clase
     * @return mixed
     */
    public function establecerSubclase($obj_clase)
    {
        $obj_subclase = Subclase::where('nombre', $this->subclase)->first();

        if($obj_subclase == null){
            // echo "NO EXISTE subclase</br>";
//            return $obj_clase->subclases()->save(new Subclase(['nombre' => $this->subclase])); //Guardo la subclase asociandola a una clase
            $this->existe_subclase = false;
            return new Subclase(['nombre' => $this->subclase, 'creador_id' => $this->creador]);
        }
        // echo "</br>EXISTE subclase</br>";

        if($obj_subclase->clase_id != $obj_clase->id){
            $this->error = true;
            $this->log =  ['error'=>"La Subclase pertenece a un Clase diferente a la que se suministra",'tipo'=>'Taxonomía'];
            // echo "error subclase registrada pero no pertenece a la clase </br>";
        }
        return $obj_subclase;
    }


    /**
     * Busca el Orden en la BDD, sino lo crea.
     *
     * @param $obj_clase
     * @param $obj_subclase
     * @return mixed
     */
    public function establecerOrden($obj_clase, $obj_subclase)
    {
        $obj_orden = Orden::where('nombre', $this->orden)->first();

        if($obj_orden == null){
            // echo "NO EXISTE orden</br>";
            $this->existe_orden = false;
//            if($obj_subclase != null)
//                return new Orden(['nombre' => $this->orden, 'subclase_id' => $obj_subclase->id]); //Guardo el orden asociandola a una clase y subclase
//                return $obj_clase->ordenes()->save(new Orden(['nombre' => $this->orden, 'subclase_id' => $obj_subclase->id])); //Guardo el orden asociandola a una clase y subclase
//            return $obj_clase->ordenes()->save(new Orden(['nombre' => $this->orden])); //Guardo el orden asociandola a una clase nada mÃ¡s.
            return new Orden(['nombre' => $this->orden, 'creador_id' => $this->creador]);
        }

        // echo "</br>EXISTE orden</br>";


        if($obj_subclase != null){ //caso 1: (null 2) - (f 2) antes subclase vacia, ahora con f || caso 2: (b 2) - (f 2) antes sublcase b,  ahora f.
            if (($obj_orden->subclase_id == null) || ($obj_orden->subclase_id  != $obj_subclase->id)){
                $this->error = true;
                $this->log = ['error'=>"El Orden pertenece a una Subclase diferente a la que se suministra",'tipo'=>'Taxonomía'];
                // echo "error orden registrado pero no pertenece a la subclase </br>";
            }
        }else {
            if(($obj_subclase == null) && ($obj_orden->subclase_id != null)){ //caso 3: (b 2) - (null 2) antes subclase b, ahora vacia.
                $this->error = true;
                $this->log = ['error'=>"El Orden pertenece a una Subclase diferente a la que se suministra",'tipo'=>'Taxonomía'];
                // echo "error orden registrado pero no pertenece a la subclase </br>";
            }
        }

        if($this->error == false){
            if ($obj_orden->clase_id != $obj_clase->id) {
                $this->error = true;
                $this->log = ['error'=>"El Orden pertenece a una Clase diferente a la que se suministra",'tipo'=>'Taxonomía'];
                // echo "error orden registrado pero no pertenece a la clase </br>";
            }
        }

        return $obj_orden;
    }

    /**
     * Busca la familia en la BDD, sino lo crea.
     *
     * @param $obj_orden
     * @return mixed
     */
    public function establecerFamilia($obj_orden)
    {
        $obj_familia = Familia::where('nombre', $this->familia)->first();

        if($obj_familia == null){
            // echo "NO EXISTE familia</br>";
//            return $obj_orden->familias()->save(new Familia(['nombre' => $this->familia])); //Guardo la familia asociandola a un orden
            $this->existe_familia = false;
            return new Familia(['nombre' => $this->familia, 'creador_id' => $this->creador]); //Guardo la familia asociandola a un orden

        }
        // echo "</br>EXISTE familia</br>";

        if($obj_familia->orden_id != $obj_orden->id){ //Verifico que si la familia existe, pertenece al mismo orden que el archivo indica.
            $this->error = true;
            $this->log = ['error'=>"La Familia pertenece a un Orden diferente al que se suministra",'tipo'=>'Taxonomía'];
            // echo "error familia registrada pero no pertenece al orden </br>";
        }

        return $obj_familia;
    }

    /**
     * Busca el Genero en la BDD, sino lo crea.
     *
     * @param $obj_familia
     * @return mixed
     */
    public function establecerGenero($obj_familia)
    {
        $obj_genero = Genero::where('nombre', $this->genero)->first();

        if($obj_genero == null){
            // echo "NO EXISTE genero</br>";
//            return $obj_familia->generos()->save(new Genero(['nombre' => $this->genero])); //Guardo el genero asociandola a una familia
            $this->existe_genero= false;
            return new Genero(['nombre' => $this->genero, 'creador_id' => $this->creador]);
        }


        if($obj_genero->familia_id == -1){
            $this->actulizar_familia = true;
//            echo "</br> familia -1 </br>";

        }else{
            if($obj_genero->familia_id != $obj_familia->id){ //Verifico que si el genero existe, pertenece a la misma familia que el archivo indica.
                $this->error = true;
                $this->log = ['error'=>"El Genero pertenece a una Familia diferente a la que se suministra",'tipo'=>'Taxonomía'];
                // echo "error Genero registrado pero no pertenece a la Familia </br>";
            }
        }

        return $obj_genero;
    }


    /**
     * Busca la Especie en la BDD, sino lo crea.
     *
     * @param $obj_genero
     * @return mixed
     */
    public function establecerEspecie($obj_genero)
    {
        if($this->varietal != null){
            // echo " varietal NO NULL</br>";

            $obj_varietal = Varietal::where('nombre', $this->varietal)->first();
            if($obj_varietal == null){
                $this->existe_varietal = false;
            }else{
                $this->varietal = $obj_varietal->id;
            }
        }

        if($this->forma != null){
            // echo " fORMA NO NULL</br>";

            $obj_forma = Forma::where('nombre', $this->forma)->first();
            if($obj_forma == null){
                $this->existe_forma = false;
            }else{
                $this->forma = $obj_forma->id;
            }
        }

        if($this->subespecie != null){
            // echo " subespecie NO NULL</br>";

            $obj_subespecie = Subespecie::where('nombre', $this->subespecie)->first();
            if($obj_subespecie == null){
                $this->existe_subespecie = false;
            }else{
                $this->subespecie = $obj_subespecie->id;
            }
        }


        //Busco el id del epiteto especifico
        $obj_especifico = Especifico::where('nombre', $this->especifico)->first();
        if($obj_especifico == null){
            $this->existe_especifico = false;
        }else{
            $this->especifico = $obj_especifico->id;

        }


        if(($this->existe_forma == true) && ($this->existe_varietal == true) && ($this->existe_subespecie == true) && ($this->existe_especifico == true) && ($this->existe_genero == true)) {
            $obj_especie = Especie::where('especifico_id', $this->especifico)->conVarietal($this->varietal)->conForma($this->forma)->conSubespecie($this->subespecie)->conGeneroId($obj_genero->id)->first();
        }else{
            $obj_especie = null;
        }

        if($obj_especie == null)
        {
            // echo "NO EXISTE especie</br>";
//            $autor_id = $this->establecerAutor();
//            // echo "</br> AUTOR id: ".$autor_id;

//            return $obj_genero->especies()->save(new Especie(['nombre' => $this->especie, 'varietal' => $this->varietal, 'forma' => $this->forma, 'autor_id' => $autor_id])); //Guardo la especie-mariedad-forma asociandola a un orden
            $this->existe_especie = false;
//            return new Especie(['nombre' => $this->especie, 'varietal' => $this->varietal, 'forma' => $this->forma, 'autor_id' => $autor_id]);
            return null;
        }
        // echo "</br>EXISTE especie</br>";

        return $obj_especie;
    }

    /**
     * Busca el Autor en la BDD, sino lo crea.
     * @return mixed
     */
    private function establecerAutor()
    {
        $obj_autor = Autor::where('nombre', $this->autor)->first();

        if($obj_autor == null)
        {
            // echo "NO EXISTE autor</br>";

            $obj_autor =  Autor::Create(['nombre' => $this->autor, 'creador_id' => $this->creador]); //Guardo la especie-mariedad-forma asociandola a un orden
            return $obj_autor->id;
        }
        // echo "</br>EXISTE autor</br>";

        return $obj_autor->id;
    }


    /**
     * Si despues de  procesar todos los valores de la taxonomia no hay error, se guardan los que no existan.
     *
     * @return mixed
     */
    private function guardarNuevoRegistro($obj_phylum, $obj_clase, $obj_subclase, $obj_orden, $obj_familia, $obj_genero, $obj_especie)
    {


        //PHYLUM
        if($this->existe_phylum == false){
            $obj_phylum = Phylum::Create(['nombre' => $this->phylum, 'creador_id' => $this->creador]);
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
                $obj_orden = $obj_clase->ordenes()->save(new Orden(['nombre' => $this->orden, 'subclase_id' => $obj_subclase->id, 'creador_id' => $this->creador])); //Guardo el orden asociandola a una clase y subclase
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
        //ESPECIE
        if($this->existe_especie == false) {
            $autor_id = $this->establecerAutor();

            if($this->existe_varietal == false){
                // echo " varietal SE CREA</br>";
                $obj_varietal = Varietal::create(['nombre' => $this->varietal, 'creador_id' => $this->creador]);
                $this->varietal = $obj_varietal->id;
            }
            if($this->existe_forma == false){
                // // echo " FORMA SE CREA</br>";
                $obj_forma = Forma::create(['nombre' => $this->forma, 'creador_id' => $this->creador]);
                $this->forma = $obj_forma->id;
            }
            if($this->existe_subespecie == false){
                // // echo " SUBESPECIE SE CREA</br>";
                $obj_subespecie = Subespecie::create(['nombre' => $this->subespecie, 'creador_id' => $this->creador]);
                $this->subespecie = $obj_subespecie->id;
            }
            if($this->existe_especifico == false){
                //  // echo " ESPECIFICO SE CREA</br>";
                $obj_especifico = Especifico::create(['nombre' => $this->especifico, 'genero_id' => $obj_genero->id, 'creador_id' => $this->creador]);
                $this->especifico = $obj_especifico->id;
            }

            $obj_especie = new Especie(['genero_id' => $obj_genero->id, 'especifico_id' => $this->especifico, 'varietal_id' => $this->varietal, 'forma_id' => $this->forma,  'subespecie_id' => $this->subespecie, 'autor_id' => $autor_id]);
            $obj_especie->creador_id = $this->creador;
            $obj_especie->save();
        }

        return $obj_especie;
    }
}