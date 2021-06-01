<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 28/09/2015
 * Time: 12:30
 */

namespace App\Ficoflora\Archivo\Exportar\Bibliografia;


use App\Modelos\Bibliografia\Referencias\Libro;

trait LibrosExportar {

    public function getLibros()
    {
        $libros = Libro::all();
        $referencias = [];
        foreach ($libros as $libro) {

            $referencia[0] = $libro['cita'].', '.$libro['fecha'];
            $referencia[1] = $libro['autores'];
            $referencia[2] = $libro['fecha'];
            $referencia[3] = $libro['titulo'];
            $referencia[4] = $libro['edicion'];
            $referencia[5] = $libro['editorial'];
            $referencia[6] = $libro['lugar'];
            $referencia[7] = $libro['paginas'];
            $referencia[8] = $libro['capitulo'];
            $referencia[9] = $libro['editor'];
            $referencia[10] = $libro['intervalo'];
            $referencia[11] = $libro['isbn'];
            $referencia[12] = $libro['doi'];
            $referencia[13] = $libro['enlace'];
            $referencia[14] = $libro['archivo'];
            $referencia[15] = $libro['comentarios'];

            array_push($referencias,$referencia);
        }

        return $referencias;
    }
}