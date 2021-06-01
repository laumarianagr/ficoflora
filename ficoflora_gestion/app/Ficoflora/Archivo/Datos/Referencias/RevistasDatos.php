<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 08/08/2015
 * Time: 18:12
 */

namespace App\Ficoflora\Archivo\Datos\Referencias;


use App\Ficoflora\Registros\Bibliografia\Referencias\RevistaRegistro;

class RevistasDatos {



    private $fila=3;// numero de fila en el archivo, para indicar los errores.

    private  $log = array();


    public function procesar($datos)
    {
        $creador_id = 2; // 2 es el id del Coordinador

        foreach ($datos as $dato) {
            //verificamos que estan los campos obligarorios
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
        //Si alguno de estos campos es null no se procesa.
        if(($datos['cita'] == null ) || ($datos['autores'] == null )
            || ($datos['fecha'] == null ) || ($datos['titulo'] == null )
            ||  ($datos['nombre_revista'] == null )  || ($datos['intervalo_de_paginas'] == null ))
//            ||  ($datos['nombre_revista'] == null ) ||  ($datos['volumen'] == null ) || ($datos['intervalo_de_paginas'] == null ))
        {
            array_push($this->log,['fila'=> $this->fila, 'error'=>"No posee todos los campos obligatorios", 'tipo'=>"Campos obligatorios"]);

//            array_push($this->log,"Fila ". $this->fila.": No posee todos los campos obligatorios");
            return 0;
        }else{
            return 1;
        }
    }



    private function guardarDatos($dato, $creador_id)
    {

//        Pasando del formato de los archivos al de los formularios para reutilizar el código del procesamieto de referencias
        $datos = array(
            'autores' => $dato['autores'],
            'fecha' => $dato['fecha'],
            'cita' => $dato['cita'],
            'titulo' => $dato['titulo'],
            'nombre' => $dato['nombre_revista'],
            'volumen' => $dato['volumen'],
            'numero' => $dato['numero'],
            'intervalo' => $dato['intervalo_de_paginas'],
            'isbn' => $dato['isbn'],
            'issn' => $dato['issn'],
            'doi' => $dato['doi'],
            'enlace' => $dato['enlace'],
            'archivo' => $dato['archivo'],
            'comentarios' => $dato['comentarios']
        );


        $registro = new RevistaRegistro($datos, 'archivo', 2);
        $respuesta = $registro->nuevaRevista();

//        dd($respuesta);

        if ($respuesta['error'] == true) {
//            array_push($this->log, "Fila " . $this->fila . ": " . $respuesta['log']);
            array_push($this->log, ['fila'=> $this->fila, 'error' => $respuesta['log']['error'], 'tipo' => $respuesta['log']['tipo']]);

        }else{
            $libro = $respuesta['registro'];
            $libro->save();

            $cita = $respuesta['cita'];
            $cita->referencia_id = $libro->id;
            $cita->save();
        }
    }

}