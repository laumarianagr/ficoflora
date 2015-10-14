<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 19/09/2015
 * Time: 23:48
 */

namespace App\Ficoflora\Exportar\PDF\Taxonomia;


trait SinonimiaPDF {


    public function pdfEspeciesPorSinonimia($sinonimia,$obj_sinonimia)
    {
        $titulo_sinonimia = $this->tituloSinonimia($sinonimia, "Sinonimia");
        $listado_especies = $this->listadoEspeciesPorSinonimia($sinonimia,$obj_sinonimia);

        $contenido = $titulo_sinonimia."<br/>".$listado_especies;

        return $contenido;
    }



    public function listadoEspeciesPorSinonimia($sinonimia,$obj_sinonimia)
    {
        $especies_ids = $obj_sinonimia->especies()->get();

        $contenido = $this->getListadoEspeciesdeSinonimias($especies_ids, $sinonimia['nombre']);

        return $contenido;
    }

    public function tituloSinonimia($sinonimia, $tipoNombre)
    {
        $contentido =
            "<table class='contenido' style='width:100%;'>
                <tr>
                    <td>
                        <div style='padding-top: 15px; '>
                            <h1><span class='mutted'> ".$tipoNombre.": </span> <em>".$sinonimia['nombre']."</em> <span class='mutted'>".$sinonimia['autor']."</span></h1>
                        </div>
                    </td>
                </tr>

            </table>";

        return $contentido;
    }


    public function getListadoEspeciesdeSinonimias($especies_ids,$nombre)
    {
        $especies = Array();
        $total = 0;

        foreach ($especies_ids as $especie) {

            if($especie->catalogo==true){

                $datos = $this->especieDatos($especie, null, false);
                array_push($especies, $datos);
                $total++;
            }
        }
        $especies = collect($especies)->sortBy('nombre');

        $i=1;
        $contenido="<h3>Número de <b>Especies</b> con nombres válidos reportadas como <em>".$nombre."</em>: <b>".$total."</b></h3>";
        $head="<thead><tr><th style='text-align:center; width: 5%'>#</th><th style='padding-left: 10px;'>Nombre de la especie</th></tr></thead>";
        $body="";
        foreach ($especies as $especie) {
            $sombra="";
            if ($i % 2 == 0) $sombra="class='sombra'";
            $body.="<tr ".$sombra."><td style='text-align:center;'>".$i."</td><td><h3 style='padding-left: 10px;'><em>".$especie['nombre']."</em> <span class='mutted'>".$especie['autor']."</span></h3></td></tr>";
            $i++;
        }
        $contenido .= "<table class='listados'>".$head."<tbody>".$body."</tbody></table>";

        return $contenido;
    }
}