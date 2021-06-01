<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 28/09/2015
 * Time: 12:40
 */

namespace App\Ficoflora\Archivo\Exportar\Bibliografia;


use App\Modelos\Bibliografia\Referencias\Trabajo;

trait TrabajosExportar {

    public function getTrabajos()
    {
        $revistas = Trabajo::all();
        $referencias = [];
        foreach ($revistas as $revista) {

            $referencia[0] = $revista['tipo'];
            $referencia[1] = $revista['cita'].', '.$revista['fecha'];
            $referencia[2] = $revista['autores'];
            $referencia[3] = $revista['fecha'];
            $referencia[4] = $revista['titulo'];
            $referencia[5] = $revista['institucion'];
            $referencia[6] = $revista['lugar'];
            $referencia[7] = $revista['paginas'];
            $referencia[8] = $revista['enlace'];
            $referencia[9] = $revista['archivo'];
            $referencia[10] = $revista['comentarios'];

            array_push($referencias,$referencia);
        }

        return $referencias;
    }
}