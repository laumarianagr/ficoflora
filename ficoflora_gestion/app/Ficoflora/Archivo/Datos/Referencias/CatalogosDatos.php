<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 08/08/2015
 * Time: 11:51
 */

namespace App\Ficoflora\Archivo\Datos\Referencias;


use App\Ficoflora\Registros\Bibliografia\Referencias\CatalogoRegistro;

class CatalogosDatos {

    private  $log = array();
    private $fila=3;// número de fila en el archivo, para indicar los errores.


    public function procesar($datos)
    {

        $creador_id = 2; // 2 es el id del Coordinador
//        dd($datos);
        foreach ($datos as $dato) {
//            dd($dato);
            //verificamos que están los campos obligarorios
            $obligatorios = $this->camposObligatorios($dato);

            if($obligatorios == true){
                $this->guardarDatos($dato, $creador_id);
            }

            $this->fila++;
        }

        return $this->log;
    }


    /**
     * Verifica que en la fila estén los campos obligatorios.
     *
     */
    public function camposObligatorios($datos)
    {
        
        //Si alguno de estos campos es null no  se procesa.
        if(($datos['cita'] == null ) || ($datos['autores'] == null )
            || ($datos['fecha'] == null ) || ($datos['titulo'] == null )
            || ($datos['intervalo'] == null ))
        {
            array_push($this->log,['fila'=> $this->fila, 'error'=>"No posee todos los campos obligatorios", 'tipo'=>"Campos obligatorios"]);

//            array_push($this->log,"Fila ". $this->fila.": No posee todos los campos obligatorios");
            return 0;
        }
        return 1;
    }


    private function guardarDatos($dato, $creador_id)
    {

//        Pasando del formato de los archivos al de los formularios para reutilizar el código del procesamiento de referencias
        $datos = array(
            'autores' => $dato['autores'],
            'fecha' => $dato['fecha'],
            'cita' => $dato['cita'],
            'letra' => $dato['letra'],
            'titulo' => $dato['titulo'],
            'nombre' => $dato['nombre'],
            'edicion' => $dato['edicion'],
            'editor_editorial' => $dato['editor_editorial'],
            'lugar' => $dato['lugar'],
            'volumen' => $dato['volumen'],
            'numero' => $dato['numero'],
            'paginas' => $dato['intervalo'],
            'isbn' => $dato['isbn'],
            'doi' => $dato['doi'],
            'archivo' => $dato['archivo'],
            'comentarios' => $dato['comentarios']
        );
        

        $registro = new CatalogoRegistro($datos, 'archivo', 2);//creador para datos importados
        $respuesta = $registro->nuevoCatalogo();

//        dd($respuesta);

        if ($respuesta['error'] == true) {
            array_push($this->log, ['fila'=> $this->fila, 'error' => $respuesta['log']['error'], 'tipo' => $respuesta['log']['tipo']]);

//            array_push($this->log, "Fila " . $this->fila . ": " . $respuesta['log']);
        }else{
            $catalogo = $respuesta['registro'];
            $catalogo->save();

            $cita = $respuesta['cita'];
            $cita->referencia_id = $catalogo->id;
            $cita->save();
        }
    }
}