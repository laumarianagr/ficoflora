<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 09/09/2015
 * Time: 22:28
 */

namespace App\Ficoflora\Referencias;


use App\Modelos\Bibliografia\Referencias\Enlace;
use App\Modelos\Bibliografia\Referencias\Libro;
use App\Modelos\Bibliografia\Referencias\Revista;
use App\Modelos\Bibliografia\Referencias\Trabajo;

trait ReferenciasTrait {


    public function getReferenciaPorTipo($id, $tipo)
    {

        switch($tipo){
            case 'R':
                $cita = Revista::find($id);
                break;

            case 'T':
                $cita = Trabajo::find($id);
                break;

            case 'L':
                $cita = Libro::find($id);
                break;

            case 'E':
                $cita = Enlace::find($id);
                break;
        }

        return $cita;
    }



    public function getReferenciaTexto($referencias)
    {
        $bibliografias = Array();
        foreach ($referencias as $referencia) {

            $bibliografia = $referencia['referencia'];//el objeto referencia

            switch($referencia['tipo']){
                case 'R':
                    $texto = $this->getRevistaTexto($bibliografia);
                    break;

                case 'T':
                    $texto = $this->getTrabajoTexto($bibliografia);
                    break;

                case 'L':
                    $texto = $this->getLibroTexto($bibliografia);
                    break;

                case 'E':
                    break;
            }
//            dd($bibliografia);
            array_push($bibliografias, [
                'cita'=>$bibliografia['autores'],
                'fecha'=>$bibliografia['fecha'],
                'referencia'=>$texto,
                'isbn'=>$bibliografia['isbn'],
                'issn'=>$bibliografia['issn'],
                'doi'=>$bibliografia['doi'],
                'enlace'=>$bibliografia['enlace'],
                'comentarios'=>$bibliografia['comentarios'],
            ]);
        }
        return $bibliografias;

    }


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

    public function getLibroTexto($referecia)
    {
        $texto = $referecia->titulo.'.';

        if($referecia->editor != null){

            $texto = $texto.' In: '.$referecia->editor.' (Ed.).';

            if($referecia->capitulo != null){
                $texto = $texto.' '.$referecia->capitulo.', pp. '.$referecia->intervalo;
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

}