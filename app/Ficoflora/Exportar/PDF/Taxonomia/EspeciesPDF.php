<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 10/09/2015
 * Time: 11:41
 */

namespace App\Ficoflora\Exportar\PDF\Taxonomia;


use App\Ficoflora\Especies\EspecieDatosTrait;
use App\Ficoflora\Especies\ReportesReferenciasTrait;



trait EspeciesPDF {

    use ReportesReferenciasTrait;


    public function pdfEspecie($id)
    {

        $especie = $this->especieDatos(null, $id, true);

        $taxonomia= $this->getTaxonmiaHTML($especie, 'e');

        list($citas_reportes, $referencias, $ubicaciones_ids)= $this->getReportesReferenciasEspecie($id);
        $reporatado = $this->getReportesHTML_PDF($citas_reportes);

        $referencias = $this->getReferenciaTexto($referencias);
        $bibliografia = $this->getReferenciasHTML($referencias);

        // ficha de la especie
        $listado = "";
        $listado .=
            "<table class='contenido' style='width:100%;'>
                <tr>
                    <td style='text-align:justify'> <!-- identificación del listado -->

                        <div style='padding-top: 15px; '>

                            <h1><span class='mutted'>Especie: </span><em>". $especie['nombre'] . "</em> <span class='mutted'>".$especie['autor']."</span></h1>
                            <br/>
                             ".$taxonomia."

                            <br/><br/>

                             <h3>Especie reportada en:</h3>
                             <br/>

                        </div>
                    </td>
                </tr>

            </table>
             ".$reporatado."

            <br/>
             ".$bibliografia;



        return	$listado;

    }


    public function getReportesHTML_PDF($citas_reportes)
    {
        $reportado = "";

        foreach ($citas_reportes as $referencia) {

            $reportado .= "<tr><td><h4>" . $referencia['cita'] . ", " . $referencia['fecha'] . "</h4></td></tr>";

            $text_reporte = "";

            foreach ($referencia['reportes'] as $reporte) {

                if (!empty($reporte['sinonimia'])) {
                    $text_reporte .= "<tr><td class='sinonimia'><h5>como: <em><b>" . $reporte['sinonimia']['nombre'] . "</b></em> <small>" . $reporte['sinonimia']['autor'] . "</small></h5></td></tr>";
                }
                if (!empty($reporte['ubicaciones'])) {

                    $text_reporte .= "<tr><td><ul>";

                    foreach ($reporte['ubicaciones'] as $ubicacion) {
                        $text_reporte .= "<li><span>" . $ubicacion['entidad'];

                        if($ubicacion['localidad']!= null){
                            $text_reporte .=", ".$ubicacion['localidad'];
                            if(!empty($ubicacion['lugares'])){
                                $text_reporte .=" (";
                                $i= 1;
                                $cant_lugares = count($ubicacion['lugares']);
                                foreach($ubicacion['lugares'] as $lugar){
                                    $text_reporte .=$lugar['lugar'];

                                    if(!empty($lugar['sitios'])){
                                        $text_reporte .=", [";
                                        $j=1;
                                        $cant_sitios = count($lugar['sitios']);
                                        foreach($lugar['sitios'] as $sitio){
                                            $text_reporte .=$sitio['sitio'];

                                            if($j != $cant_sitios){$text_reporte .=", ";}
                                            $j++;
                                        }
                                        $text_reporte .="]";

                                    }

                                    if($i != $cant_lugares){$text_reporte .=", ";}
                                    $i++;
                                }
                                $text_reporte .=")";
                            }
                        }
                        $text_reporte .= "</span></li>";//
                    }
                    $text_reporte .= "</ul></td></tr>";//
                }
            }
            $reportado .="<table class='reportado'>".$text_reporte.= "</table>";
        }

        $reportes ="<table class=''>".$reportado.= "</table>";

        return $reportes;
    }







}