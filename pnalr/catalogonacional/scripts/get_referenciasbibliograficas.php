<?php 
/* procedimientos varios para consultar información de las citas y referencias bibliográficas */

function consultarReferencias_revistas() {
// consulta la información de la referencia bibliográfica según la fuente

    $query = "SELECT autores, fecha, cita, letra, titulo, nombre, volumen, numero, intervalo, isbn, issn, doi, comentarios
              FROM referencias_revistas
              ORDER BY autores";
    $res = ejecutarQuerySQL($query);
    $total = getNumFilas($res);
    $referencias = "";
    $i=0;

    if ($total > 0) {
        $title= "Artículos en Revistas:";
        while ($i < $total) {
            $actual = getFila($res);
            $referencias .= '<li style="margin-top:20px;">';
            //$referencias .= $actual["cita"] . " (" . $actual["fecha"] . $actual["letra"] . ")<br />";
            $referencias .= "<b>" . $actual["autores"] . ", " . $actual["fecha"] . $actual["letra"] . ". </b><br />";
            $referencias .= $actual["titulo"] . ". ";
            $referencias .= "<b><em>";
            $referencias .= $actual["nombre"];
            $referencias .= "</em>. ";
            $referencias .= $actual["volumen"];
            if ($actual["numero"]<>"") $referencias .= "(" . $actual["numero"] . ")";
            $referencias .= ":" . $actual["intervalo"];
            $referencias .= ".</b>";
            if ($actual["isbn"]<>"") $referencias .= "ISBN: " . $actual["isbn"] . ". ";
            if ($actual["issn"]<>"") $referencias .= "ISSN: " . $actual["issn"] . ". ";
            if ($actual["doi"]<>"") $referencias .= "ISSN: " . $actual["doi"] . ". ";
            if ($actual["comentarios"]<>"")
                $referencias .= "<br /><span class='comentario'>Comentario: " . $actual["comentarios"] .
                    ".</span>";
            $referencias .= '</li>';
            $i++;
            }
        }
    $referencias = "<div class='title' style='margin-top: 40px;'><h3> $title ($total) </h3>" .
        "<a href='#inicio' target='_parent'> &#710; subir </a>  </div>" .
        "<ol type='1'> $referencias </ol>";
    return($referencias);
} //end function

function consultarReferencias_libros() {
// consulta la información de la referencia bibliográfica según la fuente

$query = "SELECT autores, fecha, cita, letra, titulo, edicion, editorial, lugar, paginas, capitulo,
                      editor, intervalo, isbn, doi, comentarios
                      FROM referencias_libros";
$res = ejecutarQuerySQL($query);
$total = getNumFilas($res);
$referencias = "";
$i=0;

if ($total > 0) {
    $title= "Libros:";
    while ($i < $total) {
        $actual = getFila($res);
        $referencias .= '<li style="margin-top:20px;">';
        //$referencias .= $actual["cita"] . " (" . $actual["fecha"] . $actual["letra"] . ")<br />";
        $referencias .= "<b>" . $actual["autores"] . ", " . $actual["fecha"] . $actual["letra"] . ". </b><br />";
        $referencias .= $actual["titulo"] . ". ";
        $referencias .= "<b><em>";
        $referencias .= "In: " . $actual["editor"] . " (Ed.). ";
        if ($actual["edicion"]<>"") $referencias .= $actual["edicion"] . ", ";
        if ($actual["editorial"]<>"") $referencias .= $actual["editorial"] . ", ";
        if ($actual["lugar"]<>"") $referencias .= $actual["lugar"] . ", ";
        $referencias .= "</em>" ;
        $referencias .= $actual["paginas"] . " pp";
        $referencias .= ".</b>";
        if ($actual["isbn"]<>"") $referencias .= " ISBN: " . $actual["isbn"] . ". ";
        if ($actual["doi"]<>"") $referencias .= " doi: " . $actual["doi"] . ". ";
        if ($actual["comentarios"]<>"")
            $referencias .= "<br /><span class='comentario'>Comentario: " . $actual["comentarios"] .
                ".</span>";
        $referencias .= '</li>';
        $i++;
    }
}
    $referencias = "<div class='title' style='margin-top: 40px;'><h3> $title ($total) </h3>" .
        "<a href='#inicio' target='_parent'> &#710; subir </a>  </div>" .
        "<ol type='1'> $referencias </ol>";
return($referencias);
} //end function


function consultarReferencias_trabajos() {
// consulta la información de la referencia bibliográfica según la fuente

    $query = "SELECT tipo, autores, fecha, cita, letra, titulo, institucion, lugar, paginas, comentarios
                      FROM referencias_trabajos";
    $res = ejecutarQuerySQL($query);
    $total = getNumFilas($res);
    $referencias = "";
    $i=0;

    if ($total > 0) {
        $title= "Trabajos Académicos:";
        while ($i < $total) {
            $actual = getFila($res);

            switch ($actual["tipo"]) {
                case "Tesis (Doctorado)":
                        $tipo = "Tesis Doctoral";
                        break;
                case "Trabajos Especiales de Grado (Licenciatura)":
                        $tipo = "Trabajo Especial de Grado";
                        break;
                case "Monografías de Trabajos de Ascenso":
                        $tipo = "Trabajo de Ascenso";
                        break;
                default: $tipo = "";
            }

            $referencias .= '<li style="margin-top:20px;">';
            //$referencias .= $actual["cita"] . " (" . $actual["fecha"] . $actual["letra"] . ")<br />";
            $referencias .= "<b>" . $actual["autores"] . ", " . $actual["fecha"] . $actual["letra"] . ". </b><br />";
            $referencias .= $actual["titulo"] . ". ";
            $referencias .= "<b><em>";
            $referencias .= $tipo . ". ";
            $referencias .= $actual["institucion"] . ". " . $actual["lugar"] . ", ";
            $referencias .= "</em>" ;
            $referencias .= $actual["paginas"] . " pp";
            $referencias .= ".</b>";
            if ($actual["comentarios"]<>"")
                $referencias .= "<br /><span class='comentario'>Comentario: " . $actual["comentarios"] .
                    ".</span>";
            $referencias .= '</li>';
            $i++;
        }
    }

    $referencias = "<div class='title' style='margin-top: 40px;'><h3> $title ($total) </h3>" .
        "<a href='#inicio' target='_parent'> &#710; subir </a>  </div>" .
        "<ol type='1'> $referencias </ol>";
    return($referencias);
} //end function


function consultarReferencias_web() {
// consulta la información de la referencia bibliográfica según la fuente

    $query = "SELECT autores, fecha, cita, letra, nombre, titulo, institucion, lugar, enlace, dia, mes, ano
                      FROM referencias_enlaces";
    $res = ejecutarQuerySQL($query);
    $total = getNumFilas($res);
    $referencias = "";
    $i=0;

    if ($total > 0) {
        $title= "Sitios Web:";
        while ($i < $total) {
            $actual = getFila($res);

            $referencias .= '<li style="margin-top:20px;">';
            //$referencias .= $actual["cita"] . " (" . $actual["fecha"] . $actual["letra"] . ")<br />";
            $referencias .= "<b>" . $actual["autores"] . ", " . $actual["fecha"] . $actual["letra"] . ". </b><br />";
            $referencias .= "<b><em>";
            if ($actual["titulo"]<>"") $referencias .= $actual["titulo"] . ". ";
            $referencias .= "</em>" ;
            $referencias .= "</b>";
            if ($actual["institucion"]<>"") $referencias .= $actual["institucion"] . ". ";
            $referencias .= "<br /><a href='".$actual["enlace"]."' target='_blank'>" . $actual["enlace"] . "</a>, ";
            $referencias .= "consulta: " . $actual["dia"] . "-" . $actual["mes"] . "-" . $actual["ano"] . ". ";
            $referencias .= '</li>';
            $i++;
        }
    }

    $referencias= "<div class='title' style='margin-top: 40px;'><h3> $title ($total) </h3>" .
        "<a href='#inicio' target='_parent'> &#710; subir </a>  </div>" .
        "<ol type='1'> $referencias </ol>";
    return($referencias);
} //end function


function consultarReferencias($fuente) {
// consulta la información de la referencia bibliográfica según la fuente

    $referencias="";
    switch ($fuente) {
        case "revistas":
            $referencias = consultarReferencias_revistas();
            echo $referencias;
            break;
        case "libros":
            $referencias = consultarReferencias_libros();
            echo $referencias;
            break;
        case "trabajos":
            $referencias = consultarReferencias_trabajos();
            echo $referencias;
            break;
        case "web":
            $referencias = consultarReferencias_web();
            echo $referencias;
            break;
    }
} //end function

?>