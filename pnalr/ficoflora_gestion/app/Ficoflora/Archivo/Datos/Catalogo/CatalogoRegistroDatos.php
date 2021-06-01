<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 07/08/2015
 * Time: 19:31
 */

namespace App\Ficoflora\Archivo\Datos\Catalogo;


use App\Ficoflora\Archivo\Bibliografia;
use App\Ficoflora\Archivo\Catalogo\CatalogoArchivo;
use App\Ficoflora\Archivo\Geografico\UbicacionArchivo;
use App\Ficoflora\Archivo\Geografico\UbicacionCatalogoArchivo;
use App\Ficoflora\Archivo\Reportes;
use App\Ficoflora\Archivo\Sinonimia\SinonimiaArchivo;
use App\Ficoflora\Archivo\Taxonomia\TaxonomiaArchivo;
use App\Ficoflora\Funcionalidades\ReferenciasTrait;
use App\Modelos\Bibliografia\Cita;

class CatalogoRegistroDatos {

    use ReferenciasTrait;

    private $fila =3; // número de fila en el archivo, para indicar los errores.
    private  $log = array();


    public function procesar($datos)
    {
        $creador_id = 2; // 2 es el id del Coordinador

        foreach ($datos as $dato) {

            //verificamos que en la fila están los campos obligarorios
            $obligatorios = $this->camposObligatorios($dato);

            if($obligatorios == true){
                $this->guardarDatos($dato, $creador_id);
            }

            $this->fila++;
        }
        return $this->log;

    }


    /**
     * Verifica que en la fila esten los campos obligatorios.
     *
     */
    public function camposObligatorios($datos)
    {
        //Si alguno de estos capos es null no  se procesa.
        if(($datos['phylum'] == null ) || ($datos['clase'] == null ) || ($datos['orden'] == null ) || ($datos['familia'] == null )
            ||  ($datos['genero'] == null ) || ($datos['especie'] == null )|| ($datos['autor'] == null )  ||  ($datos['cita'] == null ))
        {
            array_push($this->log,['fila'=> $this->fila, 'error'=>"No posee todos los campos obligatorios", 'tipo'=>"Campos obligatorios"]);
//            array_push($this->log,"Fila ". $this->fila.": no posee todos los campos obligatorios");

            return 0;
        }else{
            return 1;
        }
    }


//
    private function guardarDatos($dato, $creador_id)
    {

        // TAXONOMIA----------------------------
        $taxonomia = new TaxonomiaArchivo($dato, $creador_id);
        $respuesta = $taxonomia->setTaxonomia();
        if ($respuesta['error'] == false) {
            $obj_especie = $respuesta['especie'];

            // CITA----------------------------
            $respuesta = $this->getReferencia($dato['cita']);

            if ($respuesta['error'] == false) {//Se encotro la referencia que corresponde a la cita

                $referencia_id = $respuesta['registro'];
                $referencia_tipo = $respuesta['tipo'];
//
//                $referencia_id = 1;
//                $referencia_tipo = 'L';


                // SINONIMIAS----------------------------
                $sinonimias_id = null; $error = false;

                if($dato['sinonimia'] != null){
                    $sinonimia = new SinonimiaArchivo($dato['sinonimia'], $creador_id, $obj_especie->id);
                    $respuesta = $sinonimia->nuevaSinonimia();
                    $sinonimias_id = $respuesta['registro'];
                    $error = $respuesta['error'];
                }

                if($error == false){

                    // UBICACIÓN----------------------------
                    $ubicaciones_id = null;

                    if($dato['entidad_federal'] != null) {
                        $ubicacion = new UbicacionCatalogoArchivo($dato['entidad_federal'], $dato['localidad'], $obj_especie);
                        $respuesta = $ubicacion->newUbicacion();
                        $ubicaciones_id = $respuesta['registro'];
                        $error = $respuesta['error'];
                    }

                        if($error == false) {
                            // REGISTRO CATALOGO (relación Especie-Referencia, registro-sinonimia, registro-ubicacion)----------------------------
                            $registro = new CatalogoArchivo($obj_especie, $referencia_id, $referencia_tipo, $sinonimias_id, $ubicaciones_id, $creador_id, $dato['comentario']);
                            $registro->newRegistro();
                        }

                }

            }
        }

        if ($respuesta['error'] == true) {
            array_push($this->log, ['fila'=> $this->fila, 'error' => $respuesta['log']['error'], 'tipo' => $respuesta['log']['tipo']]);
//            array_push($this->log, ['error' => "En la fila " . $this->fila . " " . $respuesta['log']['error'], 'tipo' => $respuesta['log']['tipo']]);
        }
    }


    public function getReferencia($cita)
    {
        $registro = $log = $tipo = null;
        $error = false;
//        dd($cita);
        $datos = $this->getCitaArchivo($cita);
//        dd($datos);

        if(!$datos['error']) {
            $autores = $datos['autores'];// solo los appelidos que conforman la cita
            $fecha = $datos['fecha'];
            $letra = $datos['letra'];


            //revisa si ya existe la cita
            $obj_cita = Cita::where('autores', $autores)->conFecha($fecha)->conLetra($letra)->first();

            if ($obj_cita == null) {
                $error = true;
                $log = ['error' => "No existe una referencia que corresponda con la cita: (" . $autores . ", " . $fecha . $letra.")", 'tipo' => 'Referencia'];
            } else {
                $registro = $obj_cita->referencia_id;
                $tipo = $obj_cita->tipo;
            }
        }else{
            $error = true;
            $log = ['error' => "La cita no posee la estructura correcta", 'tipo' => 'Estructura'];
        }
//        dd($log);
        $respuesta = ['error' => $error, 'log' => $log, 'registro' => $registro, 'tipo' => $tipo];

        return $respuesta;

    }


}