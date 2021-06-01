<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 12/07/2015
 * Time: 9:55
 */

namespace App\Ficoflora\Registros\Sinonimia;


use App\Ficoflora\Registros\Taxonomia\GeneroRegistro;
use App\Ficoflora\Registros\Taxonomia\EspecificoRegistro;
use App\Ficoflora\Registros\Taxonomia\VarietalRegistro;
use App\Ficoflora\Registros\Taxonomia\FormaRegistro;
use App\Ficoflora\Registros\Taxonomia\SubespecieRegistro;
use App\Ficoflora\Registros\Taxonomia\AutorRegistro;
use App\Modelos\Sinonimias\Sinonimia;

class SinonimiaRegistro {


    private $genero;
    private $especifico;
    private $varietal;
    private $forma;
    private $subespecie;
    private $autor;
    private $creador_id;

    private $existe = true;
    private $log;
    private $error;

    function __construct($datos, $creador_id)
    {
        $this->genero = $datos['genero'];
        $this->especifico = $datos['especie'];
        $this->varietal = $datos['variedad'];
        $this->forma = $datos['forma'];
        $this->subespecie = $datos['subespecie'];
        $this->autor = $datos['autor'];
        $this->creador_id = $creador_id;
    }

    public function nuevaSinonimia()
    {

        $genero_id = $this->getGenero();
        $especifico_id = $this->getEspecifico();
        $varietal_id = $this->getVarietal();
        $forma_id = $this->getForma();
        $subespecie_id = $this->getSubespecie();
        $autor_id = $this->getAutor();

        $registro = $this->getSinonimia($genero_id, $especifico_id, $varietal_id, $forma_id, $subespecie_id, $autor_id);

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }

    /**
     * OBJETO SINONIMIA-------------------------------------------
     * Busca en la BDD si existe la sinonimia sino, crea el objeto
     */
    public function getSinonimia($genero_id, $especifico_id, $varietal_id, $forma_id, $subespecie_id, $autor_id)
    {
        $obj_sinonimia = Sinonimia::where('genero_id', $genero_id)->conEspecificoId($especifico_id)->conVarietalId($varietal_id)->conFormaId($forma_id)->conSubespecieId($subespecie_id)->conAutorId($autor_id)->first();

        if($obj_sinonimia == null){
            $this->existe= false;
            return new Sinonimia(['genero_id' => $genero_id, 'especifico_id' => $especifico_id, 'varietal_id' => $varietal_id, 'forma_id' => $forma_id, 'subespecie_id' => $subespecie_id, 'autor_id' => $autor_id, 'creador_id' => $this->creador_id]);
        }

        $this->log = "La Sinonimia ya existe";

        return $obj_sinonimia;
    }


    /**
     * GENERO-------------------------------------------
     * @return mixed
     */
    public function getGenero()
    {
        $registro = new GeneroRegistro($this->genero, -1, $this->creador_id);
        $respuesta = $registro->nuevoGenero();

        $obj_genero = $respuesta['registro'];

        if ($respuesta['existe'] == false) {
            $obj_genero->save();
        }
        return $obj_genero->id;
    }


    /**
     * ESPECIFICO-------------------------------------------
     * @return mixed
     */
    public function getEspecifico()
    {
        $registro = new EspecificoRegistro($this->especifico, $this->creador_id);
        $respuesta = $registro->nuevoEspecifico();

        $obj_especifico = $respuesta['registro'];

        if ($respuesta['existe'] == false) {
            $obj_especifico->save();
        }
        return $obj_especifico->id;
    }


    /**
     * VARIETAL-------------------------------------------
     * @return null
     */
    public function getVarietal()
    {
        if ($this->varietal != null) {

            $registro = new VarietalRegistro($this->varietal, $this->creador_id);
            $respuesta = $registro->nuevoVarietal();

            $obj_varietal = $respuesta['registro'];

            if ($respuesta['existe'] == false) {
                $obj_varietal->save();
            }
            return $obj_varietal->id;
        }

        return null;
    }


    /**
     * FORMA-------------------------------------------
     * @return null
     */
    public function getForma()
    {
        if ($this->forma != null) {

            $registro = new FormaRegistro($this->forma, $this->creador_id);
            $respuesta = $registro->nuevaForma();

            $obj_forma = $respuesta['registro'];

            if ($respuesta['existe'] == false) {
                $obj_forma->save();
            }
            return $obj_forma->id;
        }

        return null;
    }


    /**
     * SUBESPECIE -------------------------------------------
     * @return null
     */
    public function getSubespecie()
    {
        if ($this->subespecie != null) {

            $registro = new SubespecieRegistro($this->subespecie, $this->creador_id);
            $respuesta = $registro->nuevaSubespecie();

            $obj_subespecie = $respuesta['registro'];

            if ($respuesta['existe'] == false) {
                $obj_subespecie->save();
            }
            return $obj_subespecie->id;
        }

        return null;
    }


    /**
     * AUTOR-------------------------------------------
     * @return mixed
     */
    public function getAutor()
    {
        $registro = new AutorRegistro($this->autor, $this->creador_id);
        $respuesta = $registro->nuevoAutor();

        $obj_autor = $respuesta['registro'];

        if ($respuesta['existe'] == false) {
            $obj_autor->save();
        }

        return $obj_autor->id;
    }

}