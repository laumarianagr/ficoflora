<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 11/07/2015
 * Time: 12:34
 */

namespace App\Ficoflora\Archivo\Sinonimia;


use App\Ficoflora\Registros\Sinonimia\RegistroSinonimia;
use App\Ficoflora\Registros\Sinonimia\SinonimiaRegistro;

class SinonimiaArchivo {


    private $datos;
    private $creador_id;
    private $especie_id;

    private $sinonimias_id = Array();

    function __construct($datos, $creador_id, $especie_id)
    {
        $this->datos = $datos;
        $this->creador_id = $creador_id;
        $this->especie_id = $especie_id;

//        $this->nuevaSinonimia();

    }


    public function nuevaSinonimia()
    {
        $sinominias = trim($this->datos, " ,");
        $sinominias = explode("||", $sinominias);

        $v='|v|';
        $f='|f|';
        $s='|s|';
        $varietal = $forma = $subespecie = null;

        foreach($sinominias as $sinominia){

            if($sinominia != null) {

                $sinominia = trim($sinominia, " ");

                $dim = explode(" ", $sinominia, 3);

                if(count($dim)>2){

                    $genero = $dim[0];
                    $especifico = $dim[1];
                    $autor = $dim[2];

                    $autor = trim($autor, " ");

                    $check = explode(" ", $autor, 3);

                    //tiene subespecie
                    if ($check[0] == $s) {
                        $subespecie = $check[1];
                        $autor = $check[2];
                        $autor = trim($autor, " ");
                        $check_subespecie = explode(" ", $autor, 3);
                    }

                    //tiene varietal
                    if ($check[0] == $v) { // si esta el varietal antes que la forma
                        $varietal = $check[1];
                        $autor = $check[2];
                        $autor = trim($autor, " ");
                        $check_forma = explode(" ", $autor, 3);

                        //tiene forma
                        if ($check_forma[0] == $f) {
                            $forma = $check_forma[1];
                            $autor = $check_forma[2];
                        }

                    } else { //Si esta la forma antes que el varietal

                        //tiene forma
                        if ($check[0] == $f) {
                            $forma = $check[1];
                            $autor = $check[2];
                            $autor = trim($autor, " ");
                            $check_var = explode(" ", $autor, 3);

                            //tiene varietal
                            if ($check_var[0] == $v) {
                                $varietal = $check_var[1];
                                $autor = $check_var[2];
                            }
                        }
                    }
                    $this->guardarSinonimia($genero, $especifico, $varietal, $forma, $subespecie, $autor);
                }else{
                    $respuesta = ['error' => true, 'log' => ['error'=>'Estructura de la sinonimia incorrecta','tipo'=>'Sinonimia'], 'registro' => null];
                    return $respuesta;
                }

            }// no NULL

        }// End foreach

        $respuesta = ['error' => false, 'log' => null, 'registro' => $this->sinonimias_id];

        return $respuesta;
    }

    /**
     * Busca en la BDD si existe la sinonimia, sino la crea.
     */
    public function guardarSinonimia($genero, $especifico, $varietal, $forma, $subespecie, $autor)
    {

        $datos = array(
            'genero' => $genero,
            'especie' => $especifico,
            'variedad' => $varietal,
            'forma' => $forma,
            'subespecie' => $subespecie,
            'autor' => $autor
        );


        $registro = new SinonimiaRegistro($datos, $this->creador_id);
        $respuesta = $registro->nuevaSinonimia();

        $obj_sinonimia = $respuesta['registro'];

        if ($respuesta['existe'] == false) {
            $obj_sinonimia->save();
        }

        //guardamos los ids de las sinonimias para despues llenar la tabla registro_sinonimia
        array_push($this->sinonimias_id, $obj_sinonimia->id);

    }
}