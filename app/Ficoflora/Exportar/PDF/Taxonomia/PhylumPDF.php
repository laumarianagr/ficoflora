<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 10/09/2015
 * Time: 23:32
 */

namespace App\Ficoflora\Exportar\PDF\Taxonomia;


use App\Modelos\Taxonomia\Phylum;

trait PhylumPDF {

    //Listado de CLASES
    public function pdfClasesPorPhylum($phylum)
    {
        $titulo_taxonomia = $this->tituloTaxonomia($phylum['phylum'], $phylum, "phylum", 'p');

        $listado_especies = $this->listadoClasesPorPhylum($phylum['phylum_id']);

        $contenido = $titulo_taxonomia."<br/>".$listado_especies;

        return $contenido;
    }

    public function listadoClasesPorPhylum($id)
    {
        $phylum = Phylum::find($id);

        $clases = $phylum->clases()->get();

        $contenido = $this->getListadoTaxonomicos($clases, count($clases), "Clases", "de la clase", "al phylum");

        return $contenido;
    }

}