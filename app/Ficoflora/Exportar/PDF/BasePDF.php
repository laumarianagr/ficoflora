<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 10/09/2015
 * Time: 11:44
 */

namespace App\Ficoflora\Exportar\PDF;


use Carbon\Carbon;

trait BasePDF {


    function encabezado() {
        $encabezado =
            "<table class='encabezado'>
                <tr> <td>Catálogo de la Ficoflora de Venezuela</td></tr>
                <tr> <td><span class='mutted'>www.ciens.ucv.ve/ficofloravenezuela</span></td> </tr>
            </table>";

        return	$encabezado;
    }

    function pie() {
        $pie ="<table class='tablaPie'>
                    <tr>
                        <td width='70%'>
                            <table class='editores-info'>
                                <tr><td>{DATE Y} © Santiago Gómez, Yusneyi Carballo-Barrera, Mayra García y Nelson Gil </td></tr>

                            </table>
                        </td>

                        <td width='30%'>
                            <table class='pie-info'>
                                <tr><td>Fecha de la consulta: {DATE d-m-Y}</td></tr>
                                <tr> <td>Página: {PAGENO} / {nbpg}</td></tr>
                            </table>
                        </td>
				    </tr>
				</table>";

        return	$pie;
    }

    public function citaPagina()
    {
        $fecha = Carbon::now();
        $cita="<br/>
            <table>
            <tr><td>
            <h3>¿Cómo citar esta página? </h3> <br/>
                <p><b>Web Ficoflora Venezuela.</b> ".$fecha->year.". <b>Catálogo de la Ficoflora de Venezuela.</b> Publicación electrónica. Universidad Central de Venezuela, Caracas. Editores: Yusneyi Carballo-Barrera, Santiago Gómez, Mayra García & Nelson Gil. Consultado el ".$fecha->day." de ".$fecha->format('M')." de ".$fecha->year.", de http://www.ciens.ucv.ve/ficofloravenezuela</p>
            </td></tr>
            </table>";
        return $cita;
    }

    function encabezado_pie_marcaAgua($mpdf) {

        $mpdf->SetHTMLHeader($this->encabezado());
        $mpdf->SetHTMLFooter($this->pie());

        $mpdf->SetWatermarkText('Ficoflora Venezuela © 2015', 0.1, 350);
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->showWatermarkText = true;
    }


    function estilos($mpdf) {

        $stylesheet = file_get_contents(base_path('public/css/mpdf.css'));
        $mpdf->WriteHTML($stylesheet,1);
    }

    function generar($mpdf, $html, $nombreFile) {

        $mpdf->WriteHTML($html); // se solicita la creación del pdf con el contenido en $mpdf
        $mpdf->Output($nombreFile, 'D'); // se dispara la creación del pdf llamando a ventana de abrir / guardar
        exit;
    }
}