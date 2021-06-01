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
                <tr> <td>Catálogo digital de la Ficoflora de Venezuela</td></tr>
                <tr> <td><span class='mutted'>www.ciens.ucv.ve/ficofloravenezuela</span></td> </tr>
            </table>";

        return	$encabezado;
    }

    function pie() {
        $pie ="<table class='tablaPie'>
                    <tr>
                        <td width='70%'>
                            <table class='editores-info'>
                                <tr><td>Proyecto Ficoflora Venezuela  © 2015-{DATE Y}</td></tr>

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
        $meses=[
            1 =>'Enero',
            2 =>'Febrero',
            3 =>'Marzo',
            4 =>'Abril',
            5 =>'Mayo',
            6 =>'Junio',
            7 =>'Julio',
            8 =>'Agosto',
            9 =>'Septiembre',
            10 =>'Octubre',
            11=>'Noviembre',
            12=>'Diciembre',
        ];

        $mes= $meses[$fecha->month];
        $cita="<br/>
            <table>
            <tr><td>
            <h3>¿Cómo citar esta página? </h3> <br/>
                <p><b>Web Ficoflora Venezuela.</b> ".$fecha->year.". <b>Catálogo digital de la Ficoflora de Venezuela.</b> Publicación electrónica. Universidad Central de Venezuela, Caracas. Editores: Santiago Gómez, Yusneyi Carballo Barrera, Mayra García & Nelson Gil. Consultado el ".$fecha->day." de ".$mes." de ".$fecha->year.", de http://www.ciens.ucv.ve/ficofloravenezuela</p>
            </td></tr>
            </table>";
        return $cita;
    }

    function encabezado_pie_marcaAgua($mpdf) {
        $fecha = Carbon::now();

        $mpdf->SetHTMLHeader($this->encabezado());
        $mpdf->SetHTMLFooter($this->pie());

        $mpdf->SetWatermarkText('Ficoflora Venezuela © '.$fecha->year, 0.1, 350);
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