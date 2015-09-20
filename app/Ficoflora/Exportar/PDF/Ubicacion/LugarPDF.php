<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 10/09/2015
 * Time: 20:38
 */

namespace App\Ficoflora\Exportar\PDF\Ubicacion;


use App\Modelos\Geografico\Lugar;

trait LugarPDF {

    //LISTADO de especies por lugar
    public function pdfEspeciesPorLugar($lugar)
    {
        $titulo_ubicacion = $this->tituloUbicacionHTML($lugar['lugar'],$lugar,"Lugar", 'lu');
        $listado_especies = $this->listadoEspeciesLugar($lugar['lugar_id']);

        $contenido = $titulo_ubicacion."<br/>".$listado_especies;

        return $contenido;
    }
    public function listadoEspeciesLugar($id)
    {
        $lugar = Lugar::find($id);

        $especies_ids = $lugar->especies()->get();

        $contenido = $this->getListadoEspeciesUbicacion($especies_ids, "el lugar");

        return $contenido;
    }



    //LISTADO de localidades por lugar
    public function pdfSitiosPorLugar($lugar)
    {
        $titulo_ubicacion = $this->tituloUbicacionHTML($lugar['lugar'],$lugar,"Lugar", 'lu');
        $listado_especies = $this->listadoSitiosLugar($lugar['lugar_id']);

        $contenido = $titulo_ubicacion."<br/>".$listado_especies;

        return $contenido;
    }
    public function listadoSitiosLugar($id)
    {
        $lugar = Lugar::find($id);

        $sitios = $lugar->sitios ()->get();

        foreach ($sitios as $sitio) {
            $sitio['especies'] = count($sitio->especies()->conCatalogo(true)->get());
        }

        $contenido = $this->getListadoUbicacion($sitios, count($sitios), "Sitios", "del sitio", "al lugar");

        return $contenido;
    }
}