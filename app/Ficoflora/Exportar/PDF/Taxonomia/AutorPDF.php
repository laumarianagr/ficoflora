<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 19/09/2015
 * Time: 21:59
 */

namespace App\Ficoflora\Exportar\PDF\Taxonomia;


trait AutorPDF {

    public function pdfEspeciesPorAutor($autor)
    {
        $titulo_taxonomia = $this->tituloTaxonomia($autor['nombre'], $autor, "Autor", 'p');
        $listado_especies = $this->listadoEspeciesPorAutor($autor);

        $contenido = $titulo_taxonomia."<br/>".$listado_especies;

        return $contenido;
    }



    public function listadoEspeciesPorAutor($autor)
    {
        $especies_ids = $autor->especies()->get();

        $contenido = $this->getListadoEspecies($especies_ids, "al autor");

        return $contenido;
    }

}