<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 10/09/2015
 * Time: 23:18
 */

namespace App\Ficoflora\Exportar\PDF\Taxonomia;


use App\Modelos\Taxonomia\Subclase;

trait SubclasePDF {

    //Listado de ORDENES
    public function pdfOrdenesPorSubclase($subclase)
    {
        $titulo_taxonomia = $this->tituloTaxonomia($subclase['subclase'], $subclase, "Subclase", 's');

        $listado_especies = $this->listadoOrdenesPorSubclase($subclase['subclase_id']);

        $contenido = $titulo_taxonomia."<br/>".$listado_especies;

        return $contenido;
    }


    public function listadoOrdenesPorSubclase($id)
    {
        $subclase = Subclase::find($id);

        $ordenes = $subclase->ordenes()->get();

        $contenido = $this->getListadoTaxonomicos($ordenes, count($ordenes), "Ordenes", "del orden", "a la subclase");

        return $contenido;
    }

}