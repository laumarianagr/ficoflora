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
use App\Modelos\Bibliografia\Referencias\Catalogo;
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

            case 'C':
                $cita = Catalogo::find($id);
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

    public function getEditarComentario($texto)
    {
        $texto2 = str_replace('Catálogo', '', $texto);
        return $texto2;
    }

    public function hayNSM($texto)
    {// retorna true si en el comentario de la referencia está agregado el estado NSM: No Se Muestra
        $buscar = "NSM";
        $resultado = strpos($texto, $buscar);
        return ($resultado !== FALSE);
    }


    public function getReferenciaTexto($referencias)
    {
        $bibliografias = Array();
        foreach ($referencias as $referencia) {

            $bibliografia = $referencia['referencia'];//el objeto referencia

            if (!$this->hayNSM($bibliografia['comentarios'])) {

            switch($referencia['tipo']){
                case 'R':
                    $texto = $this->getRevistaTexto($bibliografia);
                    break;

                case 'T':
                    $texto = $this->getTrabajoTexto($bibliografia);
                    break;

                case 'C':
                    $texto = $this->getCatalogoTexto($bibliografia);
                    break;

                case 'L':
                    $texto = $this->getLibroTexto($bibliografia);
                    break;

                case 'E':
                    $texto = $this->getEnlaceTexto($bibliografia);
                    break;
            }
//            dd($bibliografia);
            array_push($bibliografias, [
                'id'=>$bibliografia['id'],
                'cita'=>$bibliografia['autores'],
                'fecha'=>$bibliografia['fecha'],
                'referencia'=>$texto,
                'isbn'=>$bibliografia['isbn'],
                'issn'=>$bibliografia['issn'],
                'doi'=>$bibliografia['doi'],
                'enlace'=>$bibliografia['enlace'],
                'archivo'=>$bibliografia['archivo'],
                'comentarios'=> $this->getEditarComentario($bibliografia['comentarios'])
            ]);
            }// end if hayNSM
        }
        return $bibliografias;
    }


    public function getTextoReferenciaTooltip($id, $tipo)
    {

        switch($tipo){
            case 'R':
                $cita = Revista::find($id);
                $texto = $this->getRevistaTextoTooltip($cita);
                break;

            case 'T':
                $cita = Trabajo::find($id);
                $texto = $this->getTrabajoTexto($cita);
                break;

            case 'C':
                $cita = Catalogo::find($id);
                $texto = $this->getCatalogoTextoTooltip($cita);
                break;

            case 'L':
                $cita = Libro::find($id);
                $texto = $this->getLibroTextoTooltip($cita);
                break;

            case 'E':
                $cita = Enlace::find($id);
                $texto = $this->getEnlaceTexto_2($cita);
                break;
        }

        return $texto;
    }


    public function getRevistaTexto($referencia)
    {
        $texto = $referencia['titulo'].'. <b><em>'.$referencia['nombre'].'</em> '.$referencia['volumen'];

        if($referencia['numero'] != null){
            $texto = $texto.'('.$referencia['numero'].')';
        }
        $texto = $texto.':'.$referencia['intervalo'].'</b>.';

        if($referencia['archivo'] != null){
            // aquí código que muestra el enlace al pdf


        // aquí código que muestra el enlace al pdf o el mensaje en este caso
        $textoPdf = 'Estimado visitante, disponemos de este artículo original en formato pdf, si requiere una copia del mismo,
                solicítelo al correo electrónico santiago.gomez@ciens.ucv.ve o yusneyicarballo@gmail.com Gracias.';
        $imagenpdf = "<img src='".asset('../public/img_publicas/icon_pdf.gif')."' />";

        $enlacepdf = "<br />
                    <a href='#' class='pdf' data-toggle='tooltip' data-placement='right'
                    onclick='return false;' title='".$textoPdf."'>";
        $enlacepdf .= $imagenpdf . "<b>&nbsp; pdf</b></a>";
        $texto = $texto . $enlacepdf;
        }

        return $texto;
    }

    public function getRevistaTextoTooltip($referencia)
    {  // equivalente a getRevistaTexto sin incluir el enlace e imagen del pdf
        $texto = $referencia['titulo'].'. <b><em>'.$referencia['nombre'].'</em> '.$referencia['volumen'];

        if($referencia['numero'] != null){
            $texto = $texto.'('.$referencia['numero'].')';
        }
        $texto = $texto.':'.$referencia['intervalo'].'</b>.';

        return $texto;
    }

    public function tipoTrabajoAcademico($tipo)
    {
        switch ($tipo){
            case 'Tesis (Doctorado)': $ta = 'Tesis de Doctorado'; break;
            case 'Tesis (Maestría)': $ta = 'Tesis de Maestría'; break;
            case 'Trabajo Especial de Grado (Licenciatura)': $ta = 'Trabajo Especial de Grado'; break;
            case 'Monografías de Trabajos de Ascenso': $ta = 'Trabajo de Ascenso'; break;
            default: $ta = ''; break;
        }
        return $ta;
    }


    public function getTrabajoTexto($referencia)
    {
        $texto = $referencia['titulo'].'. <b><em>'.$this -> tipoTrabajoAcademico($referencia['tipo']).'. '.$referencia['institucion'].
            '. '.$referencia['lugar'].'</em>, '.$referencia['paginas'].' pp.</b>';
        return $texto;
    }

    public function getLibroTexto($referencia)
    {
        $texto = $referencia['titulo'].'.';

        if($referencia['editor'] != null){

            $texto = $texto.' '.$referencia['editor'].' (Ed.).';  /*  ' In: ' */

            if($referencia['capitulo'] != null){
                $texto = $texto.' '.$referencia['capitulo'].', pp. '.$referencia['intervalo'];
            }
        }

        if($referencia['edicion'] != null){
            $texto = $texto.' <b>'.$referencia['edicion'].' Ed.</b>';
        }

        if($referencia['editorial'] != null){
            $texto = $texto.' <b><em>'.$referencia['editorial'].'</em>.</b>';
        }
        $texto = $texto.' <b><em>'.$referencia['lugar'].'</em>. '.$referencia['paginas'].' pp.</b>';

        if($referencia['archivo'] != null){
            // aquí código que muestra el enlace al pdf o el mensaje en este caso
            $textoPdf = 'Estimado visitante, disponemos de este artículo original en formato pdf, si requiere una copia del mismo,
                solicítelo al correo electrónico santiago.gomez@ciens.ucv.ve o yusneyicarballo@gmail.com Gracias.';
            $imagenpdf = "<img src='".asset('../public/img_publicas/icon_pdf.gif')."' />";

            $enlacepdf = "<br />
                    <a href='#' class='pdf' data-toggle='tooltip' data-placement='right'
                    onclick='return false;' title='".$textoPdf."'>";
            $enlacepdf .= $imagenpdf . "<b>&nbsp; pdf</b></a>";
            $texto = $texto . $enlacepdf;
        }
        return $texto;
    }


    public function getLibroTextoTooltip($referencia)
    {  // equivalente a getLibroTexto sin incluir el enlace e imagen del pdf
        $texto = $referencia['titulo'].'.';

        if($referencia['editor'] != null){

            $texto = $texto.' '.$referencia['editor'].' (Ed.).';  /*  ' In: ' */

            if($referencia['capitulo'] != null){
                $texto = $texto.' '.$referencia['capitulo'].', pp. '.$referencia['intervalo'];
            }
        }

        if($referencia['edicion'] != null){
            $texto = $texto.' <b>'.$referencia['edicion'].' Ed.</b>';
        }

        if($referencia['editorial'] != null){
            $texto = $texto.' <b><em>'.$referencia['editorial'].'</em>.</b>';
        }
        $texto = $texto.' <b><em>'.$referencia['lugar'].'</em>. '.$referencia['paginas'].' pp.</b>';

        return $texto;
    }


    public function getCatalogoTexto($referencia)
    {
        $texto = $referencia['titulo'].'.';

        // campos de catálogo en revista nombre, volumen y número
        $texto = $texto . ' <b>';
        if($referencia['nombre'] != null){
            $texto = $texto. '<em>'.$referencia['nombre'].'</em>. ';
        }
        if($referencia['volumen'] != null){
            $texto = $texto. ' '.$referencia['volumen'];
        }
        if($referencia['numero'] != null){
            $texto = $texto.'('.$referencia['numero'].')';
        }
        $texto = $texto . ' </b>';

        // campos de catálogo en libro editor_editorial, edición y lugar
        $texto = $texto . ' <b><em>';
        if($referencia['editor_editorial'] != null){
            $texto = $texto.' '.$referencia['editor_editorial'].' (Ed.).';  /*  ' In: ' */
        }
        if($referencia['edicion'] != null){
            $texto = $texto. $referencia['edicion'].' Ed.';
        }
        if($referencia['lugar'] != null){
            $texto = $texto. $referencia['lugar'];
        }

        $texto = $texto.' </em>' . $referencia['paginas'].' pp.</b>';

        if($referencia['archivo'] != null){
            // aquí código que muestra el enlace al pdf o el mensaje en este caso
            $textoPdf = 'Estimado visitante, disponemos de este artículo original en formato pdf, si requiere una copia del mismo,
                solicítelo al correo electrónico santiago.gomez@ciens.ucv.ve o yusneyicarballo@gmail.com Gracias.';
            $imagenpdf = "<img src='".asset('../public/img_publicas/icon_pdf.gif')."' />";

            $enlacepdf = "<br />
                    <a href='#' class='pdf' data-toggle='tooltip' data-placement='right'
                    onclick='return false;' title='".$textoPdf."'>";
            $enlacepdf .= $imagenpdf . "<b>&nbsp; pdf</b></a>";
            $texto = $texto . $enlacepdf;
        }
        return $texto;
    }


    public function getCatalogoTextoTooltip($referencia)
    {
        $texto = $referencia['titulo'].'.';

        // campos de catálogo en revista nombre, volumen y número
        if($referencia['nombre'] != null){
            $texto = $texto. '<b><em>'.$referencia['nombre'].'</em>. ';
        }
        if($referencia['volumen'] != null){
            $texto = $texto. ' '.$referencia['volumen'];
        }
        if($referencia['numero'] != null){
            $texto = $texto.'('.$referencia['numero'].')';
        }

        // campos de catálogo en libro editor_editorial, edición y lugar
        $texto = $texto . ' <b><em>';
        if($referencia['editor_editorial'] != null){
            $texto = $texto.' '.$referencia['editor_editorial'].' (Ed.).';  /*  ' In: ' */
        }
        if($referencia['edicion'] != null){
            $texto = $texto. $referencia['edicion'].' Ed.';
        }
        if($referencia['lugar'] != null){
            $texto = $texto. $referencia['lugar'];
        }

        $texto = $texto.' </em>' . $referencia['paginas'].' pp.</b>';
        return $texto;
    }


    public function getEnlaceTexto($referencia)
    {
        $texto = '<b><em>'.$referencia['nombre'].'</em></b>. '.$referencia['institucion'].
            '. '.$referencia['lugar'].'.<br />'.
            '<a href="'.$referencia['enlace'].'" target="_blank">'.$referencia['enlace'].
            '</a> consulta: ' .$referencia['dia'].'/'.$referencia['mes'].'/'.$referencia['ano'].'.';
        return $texto;
    }


    public function getEnlaceTexto_2($referencia)
    {// versión  usada en el texto del tooltip de la ficha especie
        $texto = '<b><em>'.$referencia['nombre'].'</em></b>. '.$referencia['institucion'].
            '. '.$referencia['lugar']. '. ' .$referencia['enlace'];
        return $texto;
    }
}