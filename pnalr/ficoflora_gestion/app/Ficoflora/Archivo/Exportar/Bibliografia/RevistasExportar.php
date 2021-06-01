<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 28/09/2015
 * Time: 11:59
 */

namespace App\Ficoflora\Archivo\Exportar\Bibliografia;


use App\Modelos\Bibliografia\Referencias\Revista;

trait RevistasExportar {

    public function getRevistas()
    {
        $revistas = Revista::all();
        $referencias = [];
        foreach ($revistas as $revista) {

            $referencia[0] = $revista['cita'].', '.$revista['fecha'];
            $referencia[1] = $revista['autores'];
            $referencia[2] = $revista['fecha'];
            $referencia[3] = $revista['titulo'];
            $referencia[4] = $revista['nombre'];
            $referencia[5] = $revista['volumen'];
            $referencia[6] = $revista['numero'];
            $referencia[7] = $revista['intervalo'];
            $referencia[8] = $revista['isbn'];
            $referencia[9] = $revista['issn'];
            $referencia[10] = $revista['doi'];
            $referencia[11] = $revista['enlace'];
            $referencia[12] = $revista['archivo'];
            $referencia[13] = $revista['comentarios'];

            array_push($referencias,$referencia);
        }

        return $referencias;
    }

}