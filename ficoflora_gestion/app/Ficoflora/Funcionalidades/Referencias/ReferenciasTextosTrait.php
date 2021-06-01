<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 29/09/2015
 * Time: 22:35
 */

namespace App\Ficoflora\Funcionalidades\Referencias;


use App\Modelos\Bibliografia\Referencias\Revista;
use App\Modelos\Bibliografia\Referencias\Libro;
use App\Modelos\Bibliografia\Referencias\Catalogo;
use App\Modelos\Bibliografia\Referencias\Trabajo;
use App\Modelos\Bibliografia\Referencias\Enlace;

trait ReferenciasTextosTrait {


    public function getRevistaTexto($referencia)
    {

        $texto = $referencia->titulo.'. <b><em>'.$referencia->nombre.'</em> '.$referencia->volumen;

        if($referencia->numero != null){
            $texto = $texto.'('.$referencia->numero.')';
        }
        $texto = $texto.':'.$referencia->intervalo.'</b>.';

        return $texto;
    }
    

    public function getLibroTexto($referencia)
    {
        $texto = $referencia->titulo.'.';

        if($referencia->editor != null) {

            $texto = $texto . ' In: ' . $referencia->editor . ' (Ed.).';
        }
        if($referencia->capitulo != null){
            $texto = $texto.' '.$referencia->capitulo.', pp. '.$referencia->intervalo;
        }

        if($referencia->edicion != null){
            $texto = $texto.' <b>'.$referencia->edicion.' Ed.</b>';
        }

        if($referencia->editorial != null){
            $texto = $texto.' <b><em>'.$referencia->editorial.'</em>.</b>';
        }
        $texto = $texto.' <b><em>'.$referencia->lugar.'</em>. '.$referencia->paginas.' pp.</b>';

        return $texto;
    }



    public function getCatalogoTexto($referencia)
    {
        $texto = $referencia->titulo.'.';

        // campos de catálogo en revista nombre, volumen y número
        $texto = $texto . ' <b>';
        if($referencia->nombre != null){
            $texto = $texto. '<em>'. $referencia->nombre.'</em>. ';
        }
        if($referencia->volumen != null){
            $texto = $texto. ' '. $referencia->volumen;
        }
        if($referencia->numero != null){
            $texto = $texto.'('. $referencia->numero.')';
        }
        $texto = $texto . ' </b>';


        // campos de catálogo en libro editor_editorial, edición y lugar
        $texto = $texto . ' <b><em>';
        if($referencia->editor_editorial != null){
            $texto = $texto.' '.$referencia->editor_editorial.' (Ed.).';  /*  ' In: ' */
        }
        if($referencia->edicion != null){
            $texto = $texto. $referencia->edicion.' Ed.';
        }
        if($referencia->lugar != null){
            $texto = $texto. $referencia->lugar;
        }

        $texto = $texto.' </em>' . $referencia->intervalo.' pp.</b>';

        return $texto;
    }   

    public function getTrabajoTexto($referencia)
    {
        $texto = $referencia->titulo.'. <b><em>'.$referencia->tipo.'. '.$referencia->institucion.'. '.$referencia->lugar.'</em>, '.$referencia->paginas.' pp.</b>';
        return $texto;
    }

    public function getEnlaceTexto($referencia)
    {
        $texto = '';

        if($referencia->autores !=null){
            $texto = $texto.' <b>'.$referencia->autores.'.</b> ';
        }

        if($referencia->fecha !=null){
            $texto = $texto.$referencia->fecha.'. ';
        }

        if($referencia->nombre !=null){
            $texto = $texto.' <b><em>'.$referencia->nombre.'</em>.</b> ';
        }
        $texto = $texto.'Publicación electronica. ';

        if($referencia->institucion !=null){
            $texto = $texto.$referencia->institucion.'. ';
        }
        $texto = $texto.'Consultado el '.$referencia->dia.' de '. $referencia->mes.' de '. $referencia->ano.', de '. $referencia->enlace;

        return $texto;
    }


    public function getObjetoRevista($request)
    {
        $referencia = new Revista([
            'autores' => $request->autores,
            'fecha'  => $request->fecha,
            'cita' => $request->cita,
            'letra' => $request->letra,
            'titulo'  => $request->titulo,
            'nombre' => $request->nombre,
            'volumen'  => $request->volumen,
            'numero' => $request->numero,
            'intervalo'  => $request->intervalo_1.'-'. $request->intervalo_2,
            'isbn'  => $request->isbn,
            'issn' => $request->issn,
            'doi'  => $request->doi,
            'enlace' => $request->enlace,
            'archivo'  => $request->archivo,
            'comentarios' => $request->comentarios
        ]);

        return $referencia;

    }


    public function getObjetoLibro($request)
    {
        $referencia = new Libro([
            'tipo'=>$request->referencia,
            'autores' => $request->autores,
            'fecha' => $request->fecha,
            'cita' => $request->cita,
            'letra' => $request->letra,
            'titulo' => $request->titulo,
            'edicion' => $request->edicion,
            'editorial' => $request->editorial,
            'lugar' => $request->lugar,
            'paginas' => $request->paginas,
            'capitulo' => $request->capitulo,
            'editor' => $request->editor,
            'intervalo_1' => $request->intervalo_1,
            'intervalo_2' => $request->intervalo_2,
            'isbn' => $request->isbn,
            'issn' => $request->issn,
            'doi' => $request->doi,
            'enlace' => $request->enlace,
            'archivo' => $request->archivo,
            'comentarios' => $request->comentarios
        ]);

        return $referencia;
    }


    public function getObjetoCatalogo($request)
    {
        $referencia = new Catalogo([
            'tipo'=>$request->referencia,
            'autores' => $request->autores,
            'fecha' => $request->fecha,
            'cita' => $request->cita,
            'letra' => $request->letra,
            'titulo' => $request->titulo,
            'nombre' => $request->nombre,
            'edicion' => $request->edicion,
            'editor_editorial' => $request->editor_editorial,
            'lugar' => $request->lugar,
            'volumen' => $request->volumen,
            'numero' => $request->numero,
            'intervalo_1' => $request->intervalo_1,
            'intervalo_2' => $request->intervalo_2,
            'intervalo' => $request->intervalo,
            'isbn' => $request->isbn,
            'doi' => $request->doi,
            'archivo' => $request->archivo,
            'comentarios' => $request->comentarios
        ]);

        return $referencia;
    }


    public function getObjetoTrabajo($request)
    {
        $referencia = new Trabajo([
            'tipo' => $request->tipo,
            'autores' => $request->autores,
            'fecha' => $request->fecha,
            'cita' => $request->cita,
            'letra' => $request->letra,
            'titulo' => $request->titulo,
            'institucion' => $request->institucion,
            'lugar' => $request->lugar,
            'paginas' => $request->paginas,
            'enlace' => $request->enlace,
            'archivo' => $request->archivo,
            'comentarios' => $request->comentarios
        ]);

        return $referencia;

    }


    public function getObjetoEnlace($request)
    {
        $referencia = new Enlace([
            'tipo' => $request->tipo,
            'autores' => $request->autores,
            'fecha' => $request->fecha,
            'cita' => $request->cita,
            'letra' => $request->letra,
            'nombre' => $request->nombre,
            'titulo' => $request->titulo,
            'institucion' => $request->institucion,
            'lugar' => $request->lugar,
            'enlace' => $request->enlace,
            'dia' => $request->dia,
            'mes' => $request->mes,
            'ano' => $request->ano
        ]);

        return $referencia;

    }


}