<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 11/09/2015
 * Time: 11:14
 */

namespace App\Ficoflora\Exportar\PDF\Ubicacion;


use App\Modelos\Geografico\Entidad;

trait PaisPDF {


    //LISTADO de  Entidades por pais
    public function pdfEntidadesPorPais()
    {
        $titulo =
            "<table class='contenido' style='width:100%;'>
                <tr>
                    <td>
                        <div style='padding-top: 15px; '>
                            <h1><span class='mutted'>País: </span> Venezuela</h1>
                        </div>
                    </td>
                </tr>
            </table>";

        $listado_especies = $this->listadoEntidadesPais();

        $contenido = $titulo."<br/>".$listado_especies;

        return $contenido;
    }
    public function listadoEntidadesPais()
    {
        $entidades = Entidad::all();

        foreach ($entidades as $entidad) {
            $entidad['especies'] = count($entidad->especies()->conCatalogo(true)->get());
        }

        $contenido = $this->getListadoUbicacion($entidades, count($entidades), "Entidades federales", "de la entidad federal", "a el pais");

        return $contenido;
    }
}