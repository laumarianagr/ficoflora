<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 10/09/2015
 * Time: 23:04
 */

namespace App\Ficoflora\Exportar\PDF\Taxonomia;


use App\Modelos\Taxonomia\Orden;

trait OrdenPDF {

    //Listado de FAMILIAS
    public function pdfFamiliasPorOrden($orden)
    {
        $titulo_taxonomia = $this->tituloTaxonomia($orden['orden'], $orden, "Orden", 'o');

        $listado_especies = $this->listadoFamiliasPorOrden($orden['orden_id']);

        $contenido = $titulo_taxonomia."<br/>".$listado_especies;

        return $contenido;
    }


    public function listadoFamiliasPorOrden($id)
    {
        $orden = Orden::find($id);

        $familias = $orden->familias()->get();

        $contenido = $this->getListadoTaxonomicos($familias, count($familias), "Familias", "de la familia", "al orden");

        return $contenido;
    }
}