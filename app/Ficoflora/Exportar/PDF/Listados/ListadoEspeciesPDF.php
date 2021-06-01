<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 14/03/2016
 * Time: 17:16
 */

namespace App\Ficoflora\Exportar\PDF\Listados;


use App\Modelos\Taxonomia\Especie;
use Illuminate\Support\Facades\DB;

trait ListadoEspeciesPDF {

    public function pdfListadoEspecies()
{

    $especies = $this->especies_db();
    $contenido = $this->listadoEspeciesHTML($especies);

    return $contenido;
}



    public function listadoEspeciesHTML($especies_db)
    {

        $especies = Array();

        foreach ($especies_db as $especie) {
//            dd($especie->tipo);
            $datos['nombre'] = $this->objEspecieNombreConSeparador($especie, ' ');
            $datos['autor']= $especie->autor;
            $datos['tipo']= $especie->tipo;
            array_push($especies, $datos);

        }
        $total = Especie::where('especies.catalogo', 1)->get()->count();

        $especies = collect($especies)->sortBy('nombre');
//        dd($especies);

        $i=1;
        $contenido="<br><h3>Número de <b>Especies, Subespecies, Variedades y Formas</b> encontrados: <b>".$total."</b></h3>";
        $head="<thead><tr><th style='text-align:center; width: 5%'>N°</th><th style='padding-left: 10px;'>Nombre</th><th style='padding-left: 10px;'>Estatus nombre</th></tr></thead>";
        $body="";
        foreach ($especies as $especie) {
            $sombra="";
            if ($i % 2 == 0) $sombra="class='sombra'";
            $body.="<tr ".$sombra."><td style='text-align:center;'>".$i."</td><td><h3 style='padding-left: 10px;'><em>".$especie['nombre']."</em> <span class='mutted'>".$especie['autor']."</span></h3></td></tr>";


            if($especie['tipo']== "especie")
               $body=$body."<td><h3 style='padding-left: 10px;'> Válido</h3></td></tr>";
            else{
                $body=$body."<td><h3 style='padding-left: 10px;'> Sinónimo</h3></td></tr>";
            }

            $i++;
        }
        $contenido .= "<table class='listados'>".$head."<tbody>".$body."</tbody></table>";


        return $contenido;
    }


    public function especies_db()
    {

        $sinonimias = DB::table('sinonimias')
            ->join('epitetos_especificos', 'sinonimias.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_subespecies', 'sinonimias.subespecie_id', '=', 'epitetos_subespecies.id')
            ->leftJoin('epitetos_varietales', 'sinonimias.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'sinonimias.forma_id', '=', 'epitetos_formas.id')
            ->join('autores', 'sinonimias.autor_id', '=', 'autores.id')
            ->join('generos', 'sinonimias.genero_id', '=', 'generos.id')
            ->select(DB::raw('sinonimias.id, 1 as catalogo,   generos.nombre as genero, epitetos_especificos.nombre as especifico, epitetos_subespecies.nombre as subespecie, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, autores.nombre as autor, "sinonimia" as tipo'));


        $especies = DB::table('especies')
            ->where('especies.catalogo', 1)
            ->join('epitetos_especificos', 'especies.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_subespecies', 'especies.subespecie_id', '=', 'epitetos_subespecies.id')
            ->leftJoin('epitetos_varietales', 'especies.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'especies.forma_id', '=', 'epitetos_formas.id')
            ->join('autores', 'especies.autor_id', '=', 'autores.id')
            ->join('generos', 'especies.genero_id', '=', 'generos.id')
            ->select(DB::raw('especies.id, especies.catalogo,  generos.nombre as genero, epitetos_especificos.nombre as especifico, epitetos_subespecies.nombre as subespecie, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, autores.nombre as autor, "especie" as tipo'))
            ->union($sinonimias)
            ->orderBy('genero')->orderBy('especifico')->orderBy('subespecie')->orderBy('forma')->orderBy('varietal')
            ->get();


        return $especies;
    }

}