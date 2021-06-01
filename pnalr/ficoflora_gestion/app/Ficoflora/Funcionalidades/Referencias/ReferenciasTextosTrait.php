<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 29/09/2015
 * Time: 22:35
 */

namespace App\Ficoflora\Funcionalidades\Referencias;


use App\Modelos\Bibliografia\Referencias\Libro;
use App\Modelos\Bibliografia\Referencias\Revista;
use App\Modelos\Bibliografia\Referencias\Trabajo;

trait ReferenciasTextosTrait {


    public function getRevistaTexto($referecia)
    {

        $texto = $referecia->titulo.'. <b><em>'.$referecia->nombre.'</em> '.$referecia->volumen;

        if($referecia->numero != null){
            $texto = $texto.'('.$referecia->numero.')';
        }
        $texto = $texto.':'.$referecia->intervalo.'</b>.';

        return $texto;
    }

    public function getTrabajoTexto($referecia)
    {
        $texto = $referecia->titulo.'. <b><em>'.$referecia->tipo.'. '.$referecia->institucion.'. '.$referecia->lugar.'</em>, '.$referecia->paginas.' pp.</b>';
        return $texto;
    }

    public function getEnlaceTexto($referecia)
    {
        $texto = '';

        if($referecia->autores !=null){
            $texto = $texto.' <b>'.$referecia->autores.'.</b> ';
        }

        if($referecia->fecha !=null){
            $texto = $texto.$referecia->fecha.'. ';
        }

        if($referecia->nombre !=null){
            $texto = $texto.' <b><em>'.$referecia->nombre.'</em>.</b> ';
        }
        $texto = $texto.'Publicación electronica. ';

        if($referecia->institucion !=null){
            $texto = $texto.$referecia->institucion.'. ';
        }
        $texto = $texto.'Consultado el '.$referecia->dia.' de '. $referecia->mes.' de '. $referecia->ano.', de '. $referecia->enlace;

        return $texto;
    }

    public function getLibroTexto($referecia)
    {
        $texto = $referecia->titulo.'.';

        if($referecia->editor != null){

            $texto = $texto.' In: '.$referecia->editor.' (Ed.).';

                $texto = $texto.' '.$referecia->capitulo.', pp. '.$referecia->intervalo;            if($referecia->capitulo != null){

                }
        }

        if($referecia->edicion != null){
            $texto = $texto.' <b>'.$referecia->edicion.' Ed.</b>';
        }

        if($referecia->editorial != null){
            $texto = $texto.' <b><em>'.$referecia->editorial.'</em>.</b>';
        }
        $texto = $texto.' <b><em>'.$referecia->lugar.'</em>. '.$referecia->paginas.' pp.</b>';

        return $texto;


    }


    public function getObjetoLibro($request)
    {
        $referencia = new Libro([
        'tipo'=>$request->referencia,
        'autores' => $request->autores,
        'fecha' => $request->fecha,
        'cita' => $request->cita,
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


    public function getObjetoRevista($request)
    {
        $referencia = new Revista([
            'autores' => $request->autores,
            'fecha'  => $request->fecha,
            'cita' => $request->cita,
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

    public function getObjetoTrabajo($request)
    {
        $referencia = new Trabajo([
            'tipo' => $request->tipo,
            'autores' => $request->autores,
            'fecha' => $request->fecha,
            'cita' => $request->cita,
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

}