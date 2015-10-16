<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 10/09/2015
 * Time: 12:22
 */

namespace App\Ficoflora\Exportar\PDF;


trait FormatosHTML {

    //TAXONOMIA
    //----------------------------------------------------
    public function getTaxonmiaHTML($datos, $tipo)
    {
        if ($datos['subclase'] != null) {
            $subclase = " > Subclase: <b>".$datos['subclase']."</b> ";
        } else {
            $subclase = "";
        }

        $taxonomia=null;

        if($tipo != 'p') {
            $taxonomia = "Phylum: <b>" . $datos['phylum'] . "</b>";

            if ($tipo != 'c') {
                $taxonomia .= " > Clase: <b>" . $datos['clase'] . "</b>";

                if ($tipo != 's') {
                    $taxonomia .= $subclase;

                    if ($tipo != 'o') {
                        $taxonomia .= " > Orden: <b>" . $datos['orden'] . "</b>";

                        if ($tipo != 'f') {
                            $taxonomia .= " > Familia: <b>" . $datos['familia'] . "</b>";
                        }
                    }
                }
            }
        }

        $contenido = "<h6>".$taxonomia."</h6>";

        return $contenido;
    }

    public function tituloTaxonomia($nombre, $datos, $tipoNombre, $tipo)
    {
        $taxonomia = $this->getTaxonmiaHTML($datos, $tipo);

        $contentido =
            "<table class='contenido' style='width:100%;'>
                <tr>
                    <td>
                        <div style='padding-top: 15px; '>
                            <h1><span class='mutted'> ".$tipoNombre.": </span> <em>".$nombre."</em></h1>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        ".$taxonomia."
                    </td>
                </tr>
            </table>";

        return $contentido;
    }








    //UBICACION
    //----------------------------------------------------
    public function tituloUbicacionHTML($nombre, $datos,$tipoNombre, $tipo)
    {
        $ubicacion = $this->getUbicacionHTML($datos,$tipo);

        $contentido =
            "<table class='contenido' style='width:100%;'>
                <tr>
                    <td>
                        <div style='padding-top: 15px; '>
                            <h1><span class='mutted'>".$tipoNombre.": </span> ".$nombre."</h1>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        ".$ubicacion."
                    </td>
                </tr>
            </table>";

        return $contentido;
    }

    public function getUbicacionHTML($datos,$tipo)
    {

        $ubicacion="";

        $ubicacion .="País: <b>Venezuela</b>";

        if($tipo != 'e'){
            $ubicacion .=" > Entidad Federal: <b>".$datos['entidad']."</b>";

            if($tipo != 'lo'){
                $ubicacion .=" > Localidad: <b>".$datos['localidad']."</b>";

                if($tipo != 'lu'){
                    $ubicacion .=" > Lugar: <b>".$datos['lugar']."</b>";
                }
            }
        }

        $contenido = "<h6>".$ubicacion."</h6>";

        return $contenido;
    }




    //REFERENCIAS BIBLIOGRAFICAS
    //----------------------------------------------------
    public function getReferenciasHTML($referencias)
    {
        $bibliografia ="<tr><td><h3>Referencias Bibliográficas:</h3></td></tr>" ;

        $contenido = "";

        foreach($referencias as $referencia) {

            $contenido = "<h4>" . $referencia['cita'] . ", " . $referencia['fecha'] . "</h4>";
            $contenido .="<p>".$referencia['referencia']."</p>";

            $bibliografia.="<tr><td>".$contenido."</td></tr>";
        }

        return "<table class='referencias'>".$bibliografia."</table>";
    }




    // LISTADO DE ESPECIES
    //----------------------------------------------------
    public function getListadoEspecies($especies_ids,$pertenece)
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
        $contenido="<h3>Número de <b>Especies</b> que pertenecen ".$pertenece.": <b>".$total."</b></h3>";
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


    // LISTADO DE ESPECIES por ubicacion
    //----------------------------------------------------
    public function getListadoEspeciesUbicacion($especies_ids,$reportado)
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
        $contenido="<h3>Número de <b>Especies</b> reportadas para ".$reportado.": <b>".$total."</b></h3>";
        $head="<thead><tr><th style='text-align:center; width: 5%'>#</th><th style='padding-left: 10px;'>Nombre de la especie</th></tr></thead>";
        $body="";
        foreach ($especies as $especie) {
            $sombra="";
            if ($i % 2 == 0) $sombra="class='sombra'";
            $body.="<tr ".$sombra."><td style='text-align:center;'>".$i."</td><td><h3><em>".$especie['nombre']."</em> <span class='mutted'>".$especie['autor']."</span></h3></td></tr>";
            $i++;
        }
        $contenido .= "<table class='listados'>".$head."<tbody>".$body."</tbody></table>";

        return $contenido;
    }



    // LISTADO Taxonomicos
    //----------------------------------------------------
    public function getListadoTaxonomicos($elementos,$total,$elemento_tipo, $taxo_listar, $pertenece)
    {

        $elementos = $elementos->sortBy('nombre');

        $i=1;
        $contenido="<h3>Número de <b>$elemento_tipo</b> que pertenecen ".$pertenece.": <b>".$total."</b></h3>";
        $head="<thead><tr><th style='text-align:center;width: 5%'>N°</th><th style='padding-left: 10px;'>Nombre ".$taxo_listar."</th></tr></thead>";
        $body="";
        foreach ($elementos as $elemento) {
            $sombra="";
            if ($i % 2 == 0) $sombra="class='sombra'";
            $body.="<tr ".$sombra."><td style='text-align:center;'>".$i."</td><td><h3><em>".$elemento['nombre']."</em> </h3></td></tr>";
            $i++;
        }
        $contenido .= "<table class='listados'>".$head."<tbody>".$body."</tbody></table>";

        return $contenido;
    }


    // LISTADO de Ubicación
    //----------------------------------------------------
    public function getListadoUbicacion($elementos,$total,$elemento_tipo, $ubicacion_listar, $pertenece)
    {
        $elementos = $elementos->sortBy('nombre');

        $i=1;
        $contenido="<h3>Número de <b>$elemento_tipo</b> que pertenecen ".$pertenece.": <b>".$total."</b></h3>";
        $head="<thead><tr><th style=text-align:center; 'width: 5%'>N°</th><th style='padding-left: 10px;'>Nombre ".$ubicacion_listar."</th><th>Especies</th></tr></thead>";
        $body="";
        foreach ($elementos as $elemento) {
            $sombra="";
            if ($i % 2 == 0) $sombra="class='sombra'";
            $body.="<tr ".$sombra."><td style='text-align:center;'>".$i."</td><td><h3>".$elemento['nombre']." </h3></td><td style='width: 120px; text-align:center;'>".$elemento['especies']."</td></tr>";
            $i++;
        }
        $contenido .= "<table class='listados'>".$head."<tbody>".$body."</tbody></table>";

        return $contenido;
    }

}