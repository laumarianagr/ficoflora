<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 14/03/2016
 * Time: 17:16
 */

namespace App\Ficoflora\Exportar\PDF\Listados;


use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;
use Illuminate\Support\Facades\DB;

trait ListadoGeograficoPDF {

    //ENTIDADES
    public function pdfListadoEntidades()
    {
        $entidades = Entidad::select('id', 'nombre')->orderBy('nombre')->get();

        foreach ($entidades as $entidad) {
            $entidad['especies'] = count($entidad->especies()->conCatalogo(true)->get());
        }
        $contenido = $this->listadoGeograficoHTML($entidades, 'Entidades Federales');

        return $contenido;
    }

   //LOCALIDADES
    public function pdfListadoLocalidades()
    {
        $localidades = Localidad::select('id', 'nombre')->orderBy('nombre')->get();

        foreach ($localidades as $localidad) {
            $localidad['especies'] = count($localidad->especies()->conCatalogo(true)->get());
        }
        $contenido = $this->listadoGeograficoHTML($localidades, 'Localidades');

        return $contenido;
    }

    //LUGARES
    public function pdfListadoLugares()
    {
        $lugares = Lugar::select('id', 'nombre')->orderBy('nombre')->get();

        foreach ($lugares as $lugar) {
            $lugar['especies'] = count($lugar->especies()->conCatalogo(true)->get());
        }
        $contenido = $this->listadoGeograficoHTML($lugares, 'Lugares');

        return $contenido;
    }

    //SITIOS
    public function pdfListadoSitios()
    {
        $sitios = Sitio::select('id', 'nombre')->orderBy('nombre')->get();

        foreach ($sitios as $sitio) {
            $sitio['especies'] = count($sitio->especies()->conCatalogo(true)->get());
        }
        $contenido = $this->listadoGeograficoHTML($sitios, 'Sitio');

        return $contenido;
    }



    public function listadoGeograficoHTML($elementos, $elemento_tipo)
    {

        $contenido =
            "<table class='contenido' style='width:100%;'>
                <tr>
                    <td>
                        <div style='padding-top: 15px; '>
                            <h1><span class='mutted'> Listado de: </span> <em>".$elemento_tipo."</em></h1>
                        </div>
                    </td>
                </tr>
            </table>";

//        $elementos = $elementos->sortBy('nombre');
        $total = count($elementos);


        $i=1;
        $contenido.="<h3 style='padding-left: 0px;'>Número de <b>$elemento_tipo</b>: <b>".$total."</b></h3>";
        $head="<thead><tr><th style='text-align:center;width: 5%'>N°</th><th style='padding-left: 10px;'>Nombre</th></tr><th style='padding-left: 10px;'>N° de Especies</th></tr></thead>";
        $body="";
        foreach ($elementos as $elemento) {
            $sombra="";
            if ($i % 2 == 0) $sombra="class='sombra'";
            $body.="<tr ".$sombra."><td style='text-align:center;'>".$i."</td><td style='padding-left: 10px;'><h3><em>".$elemento['nombre']."</em> </h3></td><td  style='width:120px;text-align:center;'><h3>".$elemento['especies']."</h3></td></tr>";
            $i++;
        }
        $contenido .= "<table class='listados'>".$head."<tbody>".$body."</tbody></table>";

        return $contenido;
    }
}