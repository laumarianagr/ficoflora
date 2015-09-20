<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 10/09/2015
 * Time: 20:45
 */

namespace App\Ficoflora\Exportar\PDF\Ubicacion;


use App\Modelos\Geografico\Sitio;

trait SitioPDF {

    //LISTADO de especies por sitio
    public function pdfEspeciesPorSitio($sitio)
    {
        $titulo_ubicacion = $this->tituloUbicacionHTML($sitio['sitio'],$sitio,"Sitio", 's');
        $listado_especies = $this->listadoEspeciesSitio($sitio['sitio_id']);

        $contenido = $titulo_ubicacion."<br/>".$listado_especies;

        return $contenido;
    }
    public function listadoEspeciesSitio($id)
    {
        $sitio = Sitio::find($id);

        $especies_ids = $sitio->especies()->get();

        $contenido = $this->getListadoEspeciesUbicacion($especies_ids, "el sitio");

        return $contenido;
    }


}