<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 10/09/2015
 * Time: 23:23
 */

namespace App\Ficoflora\Exportar\PDF\Taxonomia;


use App\Modelos\Taxonomia\Clase;

trait ClasePDF {

    //Listado de ORDENES
    public function pdfOrdenesPorClase($clase)
    {
        $titulo_taxonomia = $this->tituloTaxonomia($clase['clase'], $clase, "clase", 'c');

        $listado_especies = $this->listadoOrdenesPorClase($clase['clase_id']);

        $contenido = $titulo_taxonomia."<br/>".$listado_especies;

        return $contenido;
    }

    public function listadoOrdenesPorClase($id)
    {
        $clase = Clase::find($id);

        $ordenes = $clase->ordenes()->get();

        $contenido = $this->getListadoTaxonomicos($ordenes, count($ordenes), "Ordenes", "del orden", "a la clase");

        return $contenido;
    }



    //Listado de SUBLCASES
    public function pdfSubclasesPorClase($clase)
    {
        $titulo_taxonomia = $this->tituloTaxonomia($clase['clase'], $clase, "clase", 'c');

        $listado_especies = $this->listadoSubclasesPorClase($clase['clase_id']);

        $contenido = $titulo_taxonomia."<br/>".$listado_especies;

        return $contenido;
    }

    public function listadoSubclasesPorClase($id)
    {
        $clase = Clase::find($id);

        $subclases = $clase->subclases()->get();

        $contenido = $this->getListadoTaxonomicos($subclases, count($subclases), "Subclase", "de la subclase", "a la clase");

        return $contenido;
    }

}