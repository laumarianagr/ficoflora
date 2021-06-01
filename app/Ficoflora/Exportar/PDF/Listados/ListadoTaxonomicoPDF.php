<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 14/03/2016
 * Time: 17:16
 */

namespace App\Ficoflora\Exportar\PDF\Listados;


use App\Modelos\Taxonomia\Clase;
use App\Modelos\Taxonomia\Especie;
use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Genero;
use App\Modelos\Taxonomia\Orden;
use App\Modelos\Taxonomia\Phylum;
use App\Modelos\Taxonomia\Subclase;
use Illuminate\Support\Facades\DB;

trait ListadoTaxonomicoPDF {

    //GENEROS
    public function pdfListadoGeneros()
    {
        $generos = Genero::select('nombre')->get();
        $contenido = $this->listadoTaxonomicoHTML($generos, 'Géneros');

        return $contenido;
    }

    //FAMILIAS
    public function pdfListadoFamilias()
    {
        $familias = Familia::select('nombre')->get();
        $contenido = $this->listadoTaxonomicoHTML($familias, 'Familias');

        return $contenido;
    }

    //ORDENES
    public function pdfListadoOrdenes()
    {
        $ordenes = Orden::select('nombre')->get();
        $contenido = $this->listadoTaxonomicoHTML($ordenes, 'Órdenes');

        return $contenido;
    }

    //SUBCLASES
    public function pdfListadoSubclases()
    {
        $subclases = Subclase::select('nombre')->get();
        $contenido = $this->listadoTaxonomicoHTML($subclases, 'Subclases');

        return $contenido;
    }

    //CLASES
    public function pdfListadoClases()
    {
        $clases = Clase::select('nombre')->get();
        $contenido = $this->listadoTaxonomicoHTML($clases, 'Clases');

        return $contenido;
    }

    //Phylum
    public function pdfListadoPhylum()
    {
        $phylum = Phylum::select('nombre')->get();
        $contenido = $this->listadoTaxonomicoHTML($phylum, 'Phylum');

        return $contenido;
    }



    public function listadoTaxonomicoHTML($elementos, $elemento_tipo)
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

        $elementos = $elementos->sortBy('nombre');
        $total = $elementos->count();

        $i=1;
        $contenido.="<h3 style='padding-left: 0px;'>Número de <b>$elemento_tipo</b>: <b>".$total."</b></h3>";
        $head="<thead><tr><th style='text-align:center;width: 5%'>N°</th><th style='padding-left: 10px;'>Nombre</th></tr></thead>";
        $body="";
        foreach ($elementos as $elemento) {
            $sombra="";
            if ($i % 2 == 0) $sombra="class='sombra'";
            $body.="<tr ".$sombra."><td style='text-align:center;'>".$i."</td><td><h3><em>".$elemento['nombre']."</em> </h3></td></tr>";
            $i++;
        }
        $contenido .= "<table class='listados'>".$head."<tbody>".$body."</tbody></table>";

        return $contenido;
    }

}