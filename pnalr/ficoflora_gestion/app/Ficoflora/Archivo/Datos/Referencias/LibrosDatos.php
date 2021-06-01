<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 08/08/2015
 * Time: 11:51
 */

namespace App\Ficoflora\Archivo\Datos\Referencias;


use App\Ficoflora\Registros\Bibliografia\Referencias\LibroRegistro;

class LibrosDatos {

    private  $log = array();
    private $fila=3;// numero de fila en el archivo, para indicar los errores.


    public function procesar($datos)
    {

        $creador_id = 2; // 2 es el id del Coordinador
//        dd($datos);
        foreach ($datos as $dato) {
//            dd($dato);
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
        
        //Si alguno de estos capos es null no  se procesa.
        if(($datos['cita'] == null ) || ($datos['autores'] == null )
            || ($datos['fecha'] == null ) || ($datos['titulo_libro'] == null )
            ||  ($datos['lugar'] == null ) || ($datos['total_de_paginas'] == null ))
        {
            array_push($this->log,['fila'=> $this->fila, 'error'=>"No posee todos los campos obligatorios", 'tipo'=>"Campos obligatorios"]);

//            array_push($this->log,"Fila ". $this->fila.": No posee todos los campos obligatorios");
            return 0;
        }else{
            if(($datos['titulo_capitulo'] != null ) && (($datos['editor'] == null )|| ($datos['intervalo_de_paginas'] == null ))){
//                array_push($this->log,"Fila  ". $this->fila.": Los campos Editor e Intervalo de páginas son obligatorios cuando se especifica el título del capítulo");
                array_push($this->log,['fila'=> $this->fila, 'error'=>": Los campos Editor e Intervalo de páginas son obligatorios cuando se especifica el título del capítulo", 'tipo'=>"Campos obligatorios"]);

                return 0;
            }
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
            'titulo' => $dato['titulo_libro'],
            'edicion' => $dato['edicion'],
            'editorial' => $dato['editorial'],
            'lugar' => $dato['lugar'],
            'paginas' => $dato['total_de_paginas'],
            'capitulo' => $dato['titulo_capitulo'],
            'editor' => $dato['editor'],
            'intervalo' => $dato['intervalo_de_paginas'],
            'isbn' => $dato['isbn'],
            'doi' => $dato['doi'],
            'enlace' => $dato['enlace'],
            'archivo' => $dato['archivo'],
            'comentarios' => $dato['comentarios']
        );
        

        $registro = new LibroRegistro($datos, 'archivo', 2);//creador para datos importados
        $respuesta = $registro->nuevoLibro();

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