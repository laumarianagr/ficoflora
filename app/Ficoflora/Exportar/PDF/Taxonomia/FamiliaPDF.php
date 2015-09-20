<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 10/09/2015
 * Time: 22:32
 */

namespace App\Ficoflora\Exportar\PDF\Taxonomia;


use App\Modelos\Taxonomia\Familia;

trait FamiliaPDF {

    //ESPECIES
    public function pdfEspeciesPorFamilia($familia)
    {
        $titulo_taxonomia = $this->tituloTaxonomia($familia['familia'], $familia, "Familia", 'f');

        $listado_especies = $this->listadoEspeciesPorFamilia($familia['familia_id']);

        $contenido = $titulo_taxonomia."<br/>".$listado_especies;

        return $contenido;
    }
    public function listadoEspeciesPorFamilia($id)
    {
        $familia = Familia::find($id);

        $generos = $familia->generos()->get();

        $especies_ids = collect();

        foreach ($generos as $genero) {
            $especies = $genero->especies()->get();
            $especies_ids = $especies_ids->merge($especies);
        }

        $contenido = $this->getListadoEspecies($especies_ids, "a la familia");

        return $contenido;
    }



    //GENEROS
    public function pdfGenerosPorFamilia($familia)
    {
        $titulo_taxonomia = $this->tituloTaxonomia($familia['familia'], $familia, "Familia", 'f');

        $listado_especies = $this->listadoGenerosPorFamilia($familia['familia_id']);

        $contenido = $titulo_taxonomia."<br/>".$listado_especies;

        return $contenido;
    }


    public function listadoGenerosPorFamilia($id)
    {
        $familia = Familia::find($id);

        $generos = $familia->generos()->get();

        $contenido = $this->getListadoTaxonomicos($generos, count($generos), "Géneros", "del género", "a la familia");

        return $contenido;
    }

}