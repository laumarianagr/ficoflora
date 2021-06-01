<?php
/**
 * Created by PhpStorm.
 * User: Yusneyi Carballo Barrera
 * Date: 25/03/2016
 * Time: 17:16
 */

namespace App\Ficoflora\Exportar\PDF\Listados;

use Illuminate\Support\Facades\DB;

trait ListadoReferenciasPDF {

//---------->>>>>>>>>>
// LISTADO DE TODAS LAS REFERENCIAS BIBLIOGRÁFICAS
//---------->>>>>>>>>>

    public function referencias_db()
    {
         $revistas = DB::table('referencias_revistas')
            ->select(DB::raw('autores as c1, fecha as c2, letra as c3,
                                titulo as c4, nombre as c5, volumen as c6,
                                numero as c7, intervalo as c8, isbn as c9,
                                issn as c10, comentarios as c11, "Artículo en Revista" as c12'))
             ->where('comentarios', 'not LIKE', '%Catálogo%')
             ->orwhereNull('comentarios');

        $revistas_catalogos = DB::table('referencias_revistas')
            ->select(DB::raw('autores as c1, fecha as c2, letra as c3,
                                titulo as c4, nombre as c5, volumen as c6,
                                numero as c7, intervalo as c8, isbn as c9,
                                issn as c10, comentarios as c11, "Catálogo en Revista" as c12'))
            ->where('referencias_revistas.comentarios', 'like', '%Catálogo%');

        $libros = DB::table('referencias_libros')
            ->select(DB::raw('autores as c1, fecha as c2, letra as c3,
                                titulo as c4, editor as c5, editorial as c6,
                                edicion as c7, lugar as c8, paginas as c9,
                                isbn as c10, comentarios as c11, "Libro" as c12'))
            ->where('comentarios', 'not LIKE', '%Catálogo%')
            ->orwhereNull('comentarios');

        $libros_catalogos = DB::table('referencias_libros')
        ->select(DB::raw('autores as c1, fecha as c2, letra as c3,
                                titulo as c4, editor as c5, editorial as c6,
                                edicion as c7, lugar as c8, paginas as c9,
                                isbn as c10, comentarios as c11, "Catálogo en Libro" as c12'))
            ->where('referencias_libros.comentarios', 'like', '%Catálogo%');

        $trabajos = DB::table('referencias_trabajos')
            ->select(DB::raw('autores as c1, fecha as c2, letra as c3,
                                titulo as c4, tipo as c5, institucion as c6,
                                lugar as c7, paginas as c8, "" as c9,
                                "" as c10, comentarios as c11, "Trabajo Académico" as c12'))
            ->where('comentarios', 'not LIKE', '%NSM%')
            ->orwhereNull('comentarios');

        $enlaces = DB::table('referencias_enlaces')
        ->select(DB::raw('autores as c1, fecha as c2, letra as c3,
                                nombre as c4, titulo as c5, institucion as c6,
                                lugar as c7, enlace as c8, dia as c9,
                                mes as c10, ano as c11, "Sitio Web" as c12'))
        ->union($revistas)
        ->union($libros)
        ->union($revistas_catalogos)
        ->union($libros_catalogos)
         ->union($trabajos)
        ->orderBy('c1')->orderBy('c2')->orderBy('c3')
        ->get();

        return $enlaces;
    }

    public function pdfListadoReferencias()
    {
        $referencias = $this->referencias_db();
        $contenido = $this->listadoReferenciasHTML($referencias);

        return $contenido;
    }


    // funciones de apoyo para el contenido de los PDFs
    public function arregloDatos($referencias_db)
    {
        $referencias = Array();

        foreach ($referencias_db as $referencia) {

            $datos['c1'] = $referencia->c1;   $datos['c2'] = $referencia->c2;   $datos['c3'] = $referencia->c3;
            $datos['c4'] = $referencia->c4;   $datos['c5'] = $referencia->c5;   $datos['c6'] = $referencia->c6;
            $datos['c7'] = $referencia->c7;   $datos['c8'] = $referencia->c8;   $datos['c9'] = $referencia->c9;
            $datos['c10'] = $referencia->c10; $datos['c11'] = $referencia->c11; $datos['c12'] = $referencia->c12;

            array_push($referencias, $datos);
        }
        return $referencias;
    }

    public function revista($referencia)
    {
        // se arma la referencia según formato de revista

        $body = "<td><h3 style='padding-left: 10px;'><b>" . $referencia['c1'] . ", " . $referencia['c2'] . $referencia['c3'] . "<b/></h3>";
        $body .= $referencia['c4'] . ". <b><em> " . trim($referencia['c5']) . ". </em>" . $referencia['c6'];
        if ($referencia['c7'] != null) $body .= "(" . $referencia['c7'] . ")";
        if (($referencia['c8'] != null) and (($referencia['c6'] != null) or ($referencia['c7'] != null)))
            $body .= ":" . $referencia['c8'] . ". ";
        $body .= "</b>";
        if ($referencia['c9'] != null) $body .= " ISBN: " . $referencia['c9'] . ". ";
        if ($referencia['c10'] != null) $body .= " ISSN: " . $referencia['c10'] . ". ";
        $body .= "<br />";
        if ($referencia['c11'] != null) $body .= "<span class='mutted'>" . $referencia['c11'] . ". </span>";
        $body .= "<span class='mutted'>" . $referencia['c12'] . ".</span>";
        // ->select(DB::raw('autores as c1, fecha as c2, letra as c3, titulo as c4, nombre as c5, volumen as c6,
        // numero as c7, intervalo as c8, isbn as c9, issn as c10, comentarios as c11, "revista" as c12'));

        return $body;
    }

    public function libro($referencia)
    {
        // se arma la referencia según formato de libro

        $body = "<td><h3 style='padding-left: 10px;'><b>" . $referencia['c1'] . ", " . $referencia['c2'] . $referencia['c3'] . "<b/></h3>";
        $body .= $referencia['c4'] . ". <b><em>". $referencia['c5'] . " (Ed.). ";   /*  In:  */
        if($referencia['c6'] != null) $body .= $referencia['c6'] . ", ";
        if($referencia['c7'] != null) $body .= $referencia['c7'] . ", ";
        if($referencia['c8'] != null) $body .= $referencia['c8'] . ", ";
        $body .= "</em>";
        if($referencia['c9'] != null) $body .= $referencia['c9'] . "pp. ";
        $body .= "</b>";
        if($referencia['c10'] != "") $body .= " ISBN: " . $referencia['c10'] . ". ";
        $body .= "<br />";
        if($referencia['c11'] != null) $body .= "<span class='mutted'>" . $referencia['c11'] . "</span>. ";
        $body .= "<span class='mutted'>" . $referencia['c12'] . ".</span>";
        //->select(DB::raw('autores as c1, fecha as c2, letra as c3, titulo as c4, editor as c5, editorial as c6,
        // edicion as c7, lugar as c8, paginas as c9, isbn as c10, comentarios as c11, "libros" as c12'));

        return $body;
    }

    public function enlace($referencia)
    {
        // se arma la referencia según formato de enlaces o sitio web

        $body = "<td><h3 style='padding-left: 10px;'><b>" . $referencia['c1'] . ", " . $referencia['c2'] . $referencia['c3'] . "<b/></h3>";
        $body .= $referencia['c4'] . "<b><em> ". $referencia['c5'] . ". </em></b>";
        if($referencia['c6'] != null) $body .= $referencia['c6'] . ". ";
        $body .= "<a href='>". $referencia['c8'] . "' target='_blank'>" . $referencia['c8'] . "</a>";
        $body .= ", consulta: ". $referencia['c9'] . "/". $referencia['c10']. "/". $referencia['c11'] . ".";
        $body .= "<br />";
        $body .= "<span class='mutted'>" . $referencia['c12'] . ".</span>";
        //  ->select(DB::raw('autores as c1, fecha as c2, letra as c3, nombre as c4, titulo as c5, institucion as c6,
        // lugar as c7, enlace as c8, dia as c9, mes as c10, ano as c11, "enlaces" as c12'))

        return $body;
    }

    public function trabajo($referencia)
    {
        // se determina el tipo de trabajo académico
        $t="";
        switch ($referencia['c5']){
            case "Trabajos de Ascenso": $t = "Trabajo de Ascenso"; break;
            case "Trabajos Especiales de Grado (Licenciatura)": $t = "Trabajo Especial de Grado"; break;
            case "Tesis (Doctorado)": $t = "Tesis de Doctorado"; break;
        }

        // se arma la referencia según formato de trabajo académico
        $body = "<td><h3 style='padding-left: 10px;'><b>" . $referencia['c1'] . ", " . $referencia['c2'] . $referencia['c3'] . "<b/></h3>";
        $body .= $referencia['c4'] . ". ";
        $body .= "<b><em> ". $t . ". " . $referencia['c6'] . ", ";
        $body .= $referencia['c7'] . "</em>, ". $referencia['c8'] . "pp.";
        $body .= "</b>";
        $body .= "<br />";
        if($referencia['c11'] != null) $body .= "<span class='mutted'>" . $referencia['c11'] . ". </span>";
        $body .= "<span class='mutted'>" . $referencia['c12'] . ".</span>";
        //->select(DB::raw('autores as c1, fecha as c2, letra as c3, titulo as c4, tipo as c5, institucion as c6, lugar as c7,
        //    paginas as c8, archivo as c9, enlace as c10, comentarios as c11, "trabajos" as c12'))

        return $body;
    }


    // generación del contenido de los PDFs
    public function listadoReferenciasHTML($referencias_db)
    {
        $referencias = $this->arregloDatos($referencias_db);
        $total = count($referencias);
        $referencias = collect($referencias)->sortBy('c1');


        $i=1; $contRevistas=0; $contLibros=0; $contEnlaces=0; $contTrabajos=0; $contCRevistas=0; $contCLibros=0;
        $contenido="<br><h3>Número de <b>Referencias Bibliográficas</b> encontradas: <b>".$total."</b></h3>";

        $head="<thead><tr><th style='text-align:center; width:5%;'>N°</th>
                <th style='padding-left: 10px;'>Referencia</th></tr></thead>";
        $body="";
        foreach ($referencias as $referencia) {
            $sombra="";
            if ($i % 2 == 0) $sombra="class='sombra'";
            $body.="<tr ".$sombra."><td style='text-align:center;'>".$i."</td>";

            if($referencia['c12'] == "Artículo en Revista") {
                $contRevistas++;
                $body .= $this->revista($referencia);   // arma la referencia usando el formato de revista
            }

            if($referencia['c12'] == "Catálogo en Revista") {
                $contCRevistas++;
                $body .= $this->revista($referencia);   // arma la referencia usando el formato de revista
            }

            if($referencia['c12']== "Libro"){
                $contLibros++;
                $body .= $this->libro($referencia);   // arma la referencia usando el formato de libro
            }

            if($referencia['c12'] == "Catálogo en Libro"){
                $contCLibros++;
                $body .= $this->libro($referencia);   // arma la referencia usando el formato de libro
            }

            if($referencia['c12']== "Sitio Web") {
                $contEnlaces++;
                $body .= $this->enlace($referencia);   // arma la referencia usando el formato de enlaces
            }

            if($referencia['c12']== "Trabajo Académico") {
                $contTrabajos++;
                $body .= $this->trabajo($referencia);   // arma la referencia usando el formato de trabajo académico
            }

            $body .= "</td>"; // fin de la fila de la referencia

            $i++;
        }
        $contenido .= "<h3>Artículos en revistas: ".$contRevistas.", Libros: ".$contLibros.
                        ", Trabajos Académicos: ".$contTrabajos.", Sitios Web: ".$contEnlaces.
                        ", Catálogos: ". ($contCRevistas + $contCLibros) . "</h3>";
        $contenido .= "<table class='listados'>".$head."<tbody>".$body."</tbody></table>";

        return $contenido;
    }


//---------->>>>>>>>>>
// LISTADO EN PDF POR TIPO DE REFERENCIA
//---------->>>>>>>>>>

    // Revistas
    public function revistas_db()
    {
        $revistas = DB::table('referencias_revistas')
            ->select(DB::raw('autores as c1, fecha as c2, letra as c3,
                                titulo as c4, nombre as c5, volumen as c6,
                                numero as c7, intervalo as c8, isbn as c9,
                                issn as c10, comentarios as c11, "Artículo en Revista" as c12'))
            ->where('comentarios', 'not LIKE', '%Catálogo%')
            ->orwhereNull('comentarios')
            ->orderBy('c1')->orderBy('c2')->orderBy('c3')
            ->get();

        return $revistas;
    }

    public function pdfListadoRevistas()
    {
        $referencias = $this->revistas_db();
        $contenido = $this->listadoRevistasHTML($referencias);

        return $contenido;
    }

    // generación del contenido de los PDFs
    public function listadoRevistasHTML($referencias_db)
    {
        $referencias = $this->arregloDatos($referencias_db);
        $total = count($referencias);
        $referencias = collect($referencias)->sortBy('c1');

        $i=1;
        $contenido="<br><h3>Número de <b>Artículos en Revistas</b> encontrados: <b>".$total."</b></h3>";

        $head="<thead><tr><th style='text-align:center; width:5%;'>N°</th>
                <th style='padding-left: 10px;'>Referencia</th></tr></thead>";
        $body="";
        foreach ($referencias as $referencia) {
            $sombra="";
            if ($i % 2 == 0) $sombra="class='sombra'";
            $body.="<tr ".$sombra."><td style='text-align:center;'>".$i."</td>";
                $body .= $this->revista($referencia);   // arma la referencia usando el formato de revista
            $body .= "</td>"; // fin de la fila de la referencia
            $i++;
        }
        $contenido .= "<table class='listados'>".$head."<tbody>".$body."</tbody></table>";

        return $contenido;
    }

    // Libros
    public function libros_db()
    {
        $libros = DB::table('referencias_libros')
            ->select(DB::raw('autores as c1, fecha as c2, letra as c3,
                                titulo as c4, editor as c5, editorial as c6,
                                edicion as c7, lugar as c8, paginas as c9,
                                isbn as c10, comentarios as c11, "Libro" as c12'))
            ->where('comentarios', 'not LIKE', '%Catálogo%')
            ->orwhereNull('comentarios')
            ->orderBy('c1')->orderBy('c2')->orderBy('c3')
            ->get();

        return $libros;
    }

    public function pdfListadoLibros()
    {
        $referencias = $this->libros_db();
        $contenido = $this->listadoLibrosHTML($referencias);

        return $contenido;
    }

    // generación del contenido de los PDFs
    public function listadoLibrosHTML($referencias_db)
    {
        $referencias = $this->arregloDatos($referencias_db);
        $total = count($referencias);
        $referencias = collect($referencias)->sortBy('c1');

        $i=1;
        $contenido="<br><h3>Número de <b>Libros</b> encontrados: <b>".$total."</b></h3>";

        $head="<thead><tr><th style='text-align:center; width:5%;'>N°</th>
                <th style='padding-left: 10px;'>Referencia</th></tr></thead>";
        $body="";
        foreach ($referencias as $referencia) {
            $sombra="";
            if ($i % 2 == 0) $sombra="class='sombra'";
            $body.="<tr ".$sombra."><td style='text-align:center;'>".$i."</td>";
            $body .= $this->libro($referencia);   // arma la referencia usando el formato de libro
            $body .= "</td>"; // fin de la fila de la referencia
            $i++;
        }
        $contenido .= "<table class='listados'>".$head."<tbody>".$body."</tbody></table>";

        return $contenido;
    }


    // Enlaces o Sitios Web
    public function enlaces_db()
    {
        $enlaces = DB::table('referencias_enlaces')
            ->select(DB::raw('autores as c1, fecha as c2, letra as c3,
                                nombre as c4, titulo as c5, institucion as c6,
                                lugar as c7, enlace as c8, dia as c9,
                                mes as c10, ano as c11, "Sitio Web" as c12'))
            ->orderBy('c1')->orderBy('c2')->orderBy('c3')
            ->get();

        return $enlaces;
    }

    public function pdfListadoEnlaces()
    {
        $referencias = $this->enlaces_db();
        $contenido = $this->listadoEnlacesHTML($referencias);

        return $contenido;
    }

    // generación del contenido de los PDFs
    public function listadoEnlacesHTML($referencias_db)
    {
        $referencias = $this->arregloDatos($referencias_db);
        $total = count($referencias);
        $referencias = collect($referencias)->sortBy('c1');

        $i=1;
        $contenido="<br><h3>Número de <b>Sitios Web</b> encontrados: <b>".$total."</b></h3>";

        $head="<thead><tr><th style='text-align:center; width:5%;'>N°</th>
                <th style='padding-left: 10px;'>Referencia</th></tr></thead>";
        $body="";
        foreach ($referencias as $referencia) {
            $sombra="";
            if ($i % 2 == 0) $sombra="class='sombra'";
            $body.="<tr ".$sombra."><td style='text-align:center;'>".$i."</td>";
            $body .= $this->enlace($referencia);   // arma la referencia usando el formato de enlace o sitio web
            $body .= "</td>"; // fin de la fila de la referencia
            $i++;
        }
        $contenido .= "<table class='listados'>".$head."<tbody>".$body."</tbody></table>";

        return $contenido;
    }

    // Trabajos Académicos
    public function trabajos_db()
    {
        $trabajos = DB::table('referencias_trabajos')
            ->select(DB::raw('autores as c1, fecha as c2, letra as c3,
                                titulo as c4, tipo as c5, institucion as c6,
                                lugar as c7, paginas as c8, "" as c9,
                                "" as c10, comentarios as c11, "Trabajo Académico" as c12'))
            ->orderBy('c1')->orderBy('c2')->orderBy('c3')
            ->get();

        return $trabajos;
    }

    public function pdfListadoTrabajos()
    {
        $referencias = $this->trabajos_db();
        $contenido = $this->listadoTrabajosHTML($referencias);

        return $contenido;
    }

    // generación del contenido de los PDFs
    public function listadoTrabajosHTML($referencias_db)
    {
        $referencias = $this->arregloDatos($referencias_db);
        $total = count($referencias);
        $referencias = collect($referencias)->sortBy('c1');

        $i=1;
        $contenido="<br><h3>Número de <b>Trabajos Académicos</b> encontrados: <b>".$total."</b></h3>";

        $head="<thead><tr><th style='text-align:center; width:5%;'>N°</th>
                <th style='padding-left: 10px;'>Referencia</th></tr></thead>";
        $body="";
        foreach ($referencias as $referencia) {
            $sombra="";
            if ($i % 2 == 0) $sombra="class='sombra'";
            $body.="<tr ".$sombra."><td style='text-align:center;'>".$i."</td>";
            $body .= $this->trabajo($referencia);   // arma la referencia usando el formato de trabajo academico
            $body .= "</td>"; // fin de la fila de la referencia
            $i++;
        }
        $contenido .= "<table class='listados'>".$head."<tbody>".$body."</tbody></table>";

        return $contenido;
    }


    // Catálogos
    public function catalogos_db()
    {
        $revistas = DB::table('referencias_revistas')
            ->select(DB::raw('autores as c1, fecha as c2, letra as c3,
                                titulo as c4, nombre as c5, volumen as c6,
                                numero as c7, intervalo as c8, isbn as c9,
                                issn as c10, comentarios as c11, "Catálogo en Revista" as c12'))
            ->where('referencias_revistas.comentarios', 'like', '%Catálogo%');

        $catalogos = DB::table('referencias_libros')
            ->select(DB::raw('autores as c1, fecha as c2, letra as c3,
                                titulo as c4, editor as c5, editorial as c6,
                                edicion as c7, lugar as c8, paginas as c9,
                                isbn as c10, comentarios as c11, "Catálogo en Libro" as c12'))
            ->where('referencias_libros.comentarios', 'like', '%Catálogo%')
            ->union($revistas)
            ->orderBy('c1')->orderBy('c2')->orderBy('c3')
            ->get();

        return $catalogos;
    }

    public function pdfListadoCatalogos()
    {
        $referencias = $this->catalogos_db();
        $contenido = $this->listadoCatalogosHTML($referencias);

        return $contenido;
    }

    // generación del contenido de los PDFs
    public function listadoCatalogosHTML($referencias_db)
    {
        $referencias = $this->arregloDatos($referencias_db);
        $total = count($referencias);
        $referencias = collect($referencias)->sortBy('c1');

        $i=1;
        $contenido="<br><h3>Número de <b>Catálogos</b> encontrados: <b>".$total."</b></h3>";

        $head="<thead><tr><th style='text-align:center; width:5%;'>N°</th>
                <th style='padding-left: 10px;'>Referencia</th></tr></thead>";
        $body="";
        foreach ($referencias as $referencia) {
            $sombra="";
            if ($i % 2 == 0) $sombra="class='sombra'";
            $body.="<tr ".$sombra."><td style='text-align:center;'>".$i."</td>";
            if ($referencia['c12']== 'Catálogo en Revista' )
                $body .= $this->revista($referencia);   // arma la referencia usando el formato de artículo en revista
            if ($referencia['c12']== 'Catálogo en Libro' )
                $body .= $this->libro($referencia);   // arma la referencia usando el formato de libro
            $body .= "</td>"; // fin de la fila de la referencia
            $i++;
        }
        $contenido .= "<table class='listados'>".$head."<tbody>".$body."</tbody></table>";

        return $contenido;
    }

}