<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 02/09/2015
 * Time: 18:19
 */

namespace App\Ficoflora\Archivo\Datos\Geografico;

use App\Ficoflora\Archivo\Geografico\UbicacionArchivo;

class UbicacionDatos {

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
        if(($datos['entidad'] == null ) || ($datos['latitud'] == null ) || ($datos['longitud'] == null ))
        {
//            array_push($this->log,"Fila ". $this->fila.": no posee todos los campos obligatorios");
            array_push($this->log,['fila'=> $this->fila, 'error'=>"No posee todos los campos obligatorios", 'tipo'=>"Campos obligatorios"]);

            return 0;
        }else{
            return 1;
        }
    }


//
    private function guardarDatos($dato, $creador_id)
    {
        $ubicacion =  new UbicacionArchivo($dato);
        $respuesta = $ubicacion->newUbicacion();

        if ($respuesta['error'] == true) {
//            array_push($this->log, "En la fila " . $this->fila . " " . $respuesta['log']);
            array_push($this->log, ['fila'=> $this->fila, 'error' => $respuesta['log']['error'], 'tipo' => $respuesta['log']['tipo']]);

        }
    }

}