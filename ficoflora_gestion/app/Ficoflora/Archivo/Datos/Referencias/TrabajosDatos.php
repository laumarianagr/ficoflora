<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 08/08/2015
 * Time: 22:59
 */

namespace App\Ficoflora\Archivo\Datos\Referencias;


use App\Ficoflora\Registros\Bibliografia\Referencias\TrabajoRegistro;

class TrabajosDatos {


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
        if(($datos['tipo'] == null ) ||($datos['cita'] == null ) || ($datos['autores'] == null )
            || ($datos['fecha'] == null ) || ($datos['titulo'] == null )
            ||  ($datos['institucion'] == null ) ||  ($datos['lugar'] == null ) || ($datos['paginas'] == null ))
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
        $registro = new TrabajoRegistro($dato, 'archivo', 2);
        $respuesta = $registro->nuevoTrabajo();

//        dd($respuesta);

        if ($respuesta['error'] == true) {
            array_push($this->log, ['fila'=> $this->fila, 'error' => $respuesta['log']['error'], 'tipo' => $respuesta['log']['tipo']]);

//            array_push($this->log, "Fila " . $this->fila . ": " . $respuesta['log']);
        }else{
            $libro = $respuesta['registro'];
            $libro->save();

            $cita = $respuesta['cita'];
            $cita->referencia_id = $libro->id;
            $cita->save();
        }
    }

}