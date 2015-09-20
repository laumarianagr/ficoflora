<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 10/09/2015
 * Time: 12:39
 */

namespace App\Ficoflora\Exportar\PDF\Taxonomia;

use App\Modelos\Taxonomia\Genero;


trait GeneroPDF {

    public function pdfEspeciesPorGenero($genero)
    {
        $titulo_taxonomia = $this->tituloTaxonomia($genero['genero'], $genero, "Género", 'g');
        $listado_especies = $this->listadoEspeciesPorGenero($genero['genero_id']);

        $contenido = $titulo_taxonomia."<br/>".$listado_especies;

        return $contenido;
    }



    public function listadoEspeciesPorGenero($id)
    {
        $genero = Genero::find($id);

        $especies_ids = $genero->especies()->get();

        $contenido = $this->getListadoEspecies($especies_ids, "al género");

        return $contenido;
    }
}