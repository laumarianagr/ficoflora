<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 10/09/2015
 * Time: 16:26
 */

namespace App\Ficoflora\Exportar\PDF\Ubicacion;


use App\Modelos\Geografico\Localidad;

trait LocalidadPDF {


    //LISTADO de especies por localidad
    public function pdfEspeciesPorLocalidad($localidad)
    {
        $titulo_ubicacion = $this->tituloUbicacionHTML($localidad['localidad'],$localidad,"Localidad", 'lo');
        $listado_especies = $this->listadoEspeciesLocalidad($localidad['localidad_id']);

        $contenido = $titulo_ubicacion."<br/>".$listado_especies;

        return $contenido;
    }
    public function listadoEspeciesLocalidad($id)
    {
        $localidad = Localidad::find($id);

        $especies_ids = $localidad->especies()->get();

        $contenido = $this->getListadoEspeciesUbicacion($especies_ids, "la localidad");

        return $contenido;
    }


    //LISTADO de lugares por localidad
    public function pdfLugaresPorLocalidad($localidad)
    {
        $titulo_ubicacion = $this->tituloUbicacionHTML($localidad['localidad'],$localidad,"Localidad", 'lo');
        $listado_especies = $this->listadoLugaresLocalidad($localidad['localidad_id']);

        $contenido = $titulo_ubicacion."<br/>".$listado_especies;

        return $contenido;
    }
    public function listadoLugaresLocalidad($id)
    {
        $localidad = Localidad::find($id);

        $lugares = $localidad->lugares()->get();

        foreach ($lugares as $lugar) {
            $lugar['especies'] = count($lugar->especies()->conCatalogo(true)->get());
        }

        $contenido = $this->getListadoUbicacion($lugares, count($lugares), "Lugares", "del lugar", "a la localidad");

        return $contenido;
    }


}