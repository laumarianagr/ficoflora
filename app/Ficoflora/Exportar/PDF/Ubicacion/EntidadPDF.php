<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 10/09/2015
 * Time: 17:17
 */

namespace App\Ficoflora\Exportar\PDF\Ubicacion;


use App\Modelos\Geografico\Entidad;

trait EntidadPDF {

    //LISTADO de Especies por Entidad
    public function pdfEspeciesPorEntidad($entidad)
    {
        $titulo_ubicacion = $this->tituloUbicacionHTML($entidad['entidad'],$entidad,"Entidad", 'e');
        $listado_especies = $this->listadoEspeciesEntidad($entidad['entidad_id']);

        $contenido = $titulo_ubicacion."<br/>".$listado_especies;

        return $contenido;
    }
    public function listadoEspeciesEntidad($id)
    {
        $entidad = Entidad::find($id);

        $especies_ids = $entidad->especies()->get();

        $contenido = $this->getListadoEspeciesUbicacion($especies_ids, "la entidad");

        return $contenido;
    }


    //LISTADO de Especies por Entidad
    public function pdfLocalidadesPorEntidad($entidad)
    {
        $titulo_ubicacion = $this->tituloUbicacionHTML($entidad['entidad'],$entidad,"Entidad federal", 'e');
        $listado_especies = $this->listadoLocalidadesEntidad($entidad['entidad_id']);

        $contenido = $titulo_ubicacion."<br/>".$listado_especies;

        return $contenido;
    }
    public function listadoLocalidadesEntidad($id)
    {
        $entidad = Entidad::find($id);

        $localidades = $entidad->localidades()->get();

        foreach ($localidades as $localidad) {
            $localidad['especies'] = count($localidad->especies()->conCatalogo(true)->get());
        }

        $contenido = $this->getListadoUbicacion($localidades, count($localidades), "Localidades", "de la localidad", "a la entidad federal");

        return $contenido;
    }
}