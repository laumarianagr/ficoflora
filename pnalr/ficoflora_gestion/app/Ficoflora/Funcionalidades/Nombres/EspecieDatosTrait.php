<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 30/08/2015
 * Time: 17:07
 */

namespace App\Ficoflora\Funcionalidades\Nombres;

use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Clase;
use App\Modelos\Taxonomia\Epitetos\Especifico;
use App\Modelos\Taxonomia\Epitetos\Forma;
use App\Modelos\Taxonomia\Epitetos\Varietal;
use App\Modelos\Taxonomia\Especie;
use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Genero;
use App\Modelos\Taxonomia\Orden;
use App\Modelos\Taxonomia\Phylum;
use App\Modelos\Taxonomia\Subclase;
use Illuminate\Support\Facades\DB;


trait EspecieDatosTrait {


    public function especieDatos($mi_especie, $id, $taxo_superior)
    {
        if($mi_especie== null){
            $mi_especie = Especie::find($id);
        }

        $especie['id'] = $mi_especie->id;
        $especie['creador_id'] = $mi_especie->creador_id;

        //GENERO
        $genero = Genero::find($mi_especie->genero_id);
        $especie['genero'] = $genero->nombre;
        $especie['genero_id'] = $genero->id;

        
        //ESPECIFICO
        $especifico= Especifico::find($mi_especie->especifico_id);
        $especie['especifico'] = $especifico->nombre;
        $especie['especifico_id'] = $especifico->id;


        //VARIETAL
        if($mi_especie->varietal_id != null){
            $varietal = Varietal::find($mi_especie->varietal_id);
            $especie['varietal'] = $varietal->nombre;
            $especie['varietal_id'] = $varietal->id;
        }else{
            $especie['varietal'] = null;
        }
        
        //FORMA
        if($mi_especie->forma_id != null){
            $forma = Forma::find($mi_especie->forma_id);
            $especie['forma'] = $forma->nombre;
            $especie['forma_id'] = $forma->id;
        }else{
            $especie['forma'] = null;
        }

        //AUTOR
        $autor = Autor::find($mi_especie->autor_id);
        $especie['autor'] = $autor->nombre;
        $especie['autor_id'] = $autor->id;

        //nombre completo
        $nombre = $especie['genero']. " ". $especie['especifico'];

        if ($especie['varietal']!= null)  $nombre .=  " var. " . $especie['varietal'];
        if ($especie['forma'] != null)  $nombre .=  " f. " . $especie['forma'];

        $especie['nombre'] = $nombre;

        //TAXONOMIA SUPERIOR
        if($taxo_superior){

            //FAMILIA
            $familia = Familia::find($genero->familia_id);
            $especie['familia'] = $familia->nombre;
            $especie['familia_id'] = $familia->id;


            //ORDEN
            $orden = Orden::find($familia->orden_id);
            $especie['orden'] = $orden->nombre;
            $especie['orden_id'] = $orden->id;

            //SUBCLASE
            if($orden->subclase_id != null){
                $subclase = Subclase::find($orden->subclase_id);
                $especie['subclase'] = $subclase->nombre;
                $especie['subclase_id'] = $subclase->id;

            }else{
                $especie['subclase'] = null;
            }

            //CLASE
            $clase = Clase::find($orden->clase_id);
            $especie['clase'] = $clase->nombre;
            $especie['clase_id'] = $clase->id;

            //PHYLUM
            $phylum = Phylum::find($clase->phylum_id);
            $especie['phylum'] = $phylum->nombre;
            $especie['phylum_id'] = $phylum->id;
        }


        return $especie;
       
    }

    public function especieNombre($especie)
    {
        $nombre = $especie->genero.' '.$especie->especifico;

        if($especie->varietal != null){
            $nombre = $nombre .' v. '.$especie->varietal;
        }
        if($especie->forma != null){
            $nombre = $nombre .' f. '.$especie->forma;
        }

        return $nombre;

    }

    public function especieNombreConSeparador($especie, $separador)
    {
        $nombre = $especie['genero']. $separador. $especie['especifico'];

        if ($especie['varietal']!= null)  $nombre .= $separador."var.".$separador . $especie['varietal'];
        if ($especie['forma'] != null)  $nombre .=  $separador."f.".$separador . $especie['forma'];

        return $nombre;

    }
    public function especieNombrePorIds($especie)
    {
        $nombre = $especie->genero_id.' '.$especie->especifico_id;

        if($especie->varietal_id != null){
            $nombre = $nombre .' v. '.$especie->varietal_id;
        }
        if($especie->forma_id != null){
            $nombre = $nombre .' f. '.$especie->forma_id;
        }

        return $nombre;

    }
    public function especieObjNombre($especie)
    {
        $nombre = $especie->genero.' '.$especie->especifico;

        if($especie->varietal != null){
            $nombre = $nombre .' v. '.$especie->varietal;
        }
        if($especie->forma != null){
            $nombre = $nombre .' f. '.$especie->forma;
        }

        $nombre = $nombre.' '.$especie->autor;

        return $nombre;

    }
    public function especieNombreArray($especie)
    {
        $nombre = $especie['genero'].' '.$especie['especifico'];

        if($especie['varietal'] != null){
            $nombre = $nombre .' v. '.$especie['varietal'];
        }
        if($especie['forma']!= null){
            $nombre = $nombre .' f. '.$especie['forma'];
        }

        return $nombre;

    }


    public function listaSinonimia()
    {
        $sinonimias = collect(DB::table('sinonimias')
            ->join('epitetos_especificos', 'sinonimias.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'sinonimias.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'sinonimias.forma_id', '=', 'epitetos_formas.id')
            ->join('generos', 'sinonimias.genero_id', '=', 'generos.id')
            ->join('autores', 'sinonimias.autor_id', '=', 'autores.id')
            ->select(DB::raw('sinonimias.id, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, generos.nombre as genero, autores.nombre as autor'))
            ->orderBy('genero')->orderBy('especifico')->orderBy('forma')->orderBy('varietal')
            ->get());

        foreach ($sinonimias as $sinonimia) {

            $nombre = $this->especieNombre($sinonimia);
            $sinonimia->nombre = $nombre;
        }

        return $sinonimias;

    }

    public function listaNombreSinonimia()
    {
        $sinonimias = DB::table('sinonimias')
            ->join('epitetos_especificos', 'sinonimias.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'sinonimias.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'sinonimias.forma_id', '=', 'epitetos_formas.id')
            ->join('generos', 'sinonimias.genero_id', '=', 'generos.id')
            ->join('autores', 'sinonimias.autor_id', '=', 'autores.id')
            ->select(DB::raw('sinonimias.id, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, generos.nombre as genero, autores.nombre as autor'))
            ->orderBy('genero')->orderBy('especifico')->orderBy('forma')->orderBy('varietal')
            ->get();

        $lista_sinonimias = [];

        foreach ($sinonimias as $sinonimia) {

            $nombre = $this->especieObjNombre($sinonimia);
            $lista_sinonimias[$sinonimia->id] = $nombre;
//            $lista_sinonimias->push(['nombre'=>$nombre]);
//            array_push($lista_sinonimias, );
        }

        return $lista_sinonimias;
//        return $sinonimias;
    }



    public function listaNombresEspecies()
    {
        $especies = DB::table('especies')
            ->join('epitetos_especificos', 'especies.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'especies.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'especies.forma_id', '=', 'epitetos_formas.id')
            ->join('generos', 'especies.genero_id', '=', 'generos.id')
            ->join('autores', 'especies.autor_id', '=', 'autores.id')
            ->select(DB::raw('especies.id, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, generos.nombre as genero, autores.nombre as autor'))
            ->orderBy('genero')->orderBy('especifico')->orderBy('forma')->orderBy('varietal')
            ->get();

        $lista = [];

        foreach ($especies as $especie) {
            $nombre = $this->especieObjNombre($especie);
            $lista[$especie->id] = $nombre;
        }

        return $lista;
    }




//
//    public function listaEspecies()
//    {
//        $especies = DB::table('especies')
//            ->join('epitetos_especificos', 'especies.especifico_id', '=', 'epitetos_especificos.id')
//            ->leftJoin('epitetos_varietales', 'especies.varietal_id', '=', 'epitetos_varietales.id')
//            ->leftJoin('epitetos_formas', 'especies.forma_id', '=', 'epitetos_formas.id')
//            ->join('generos', 'especies.genero_id', '=', 'generos.id')
//            ->join('autores', 'especies.autor_id', '=', 'autores.id')
//            ->select(DB::raw('especies.id, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, generos.nombre as genero, autores.nombre as autor'))
//            ->orderBy('genero')->orderBy('especifico')->orderBy('forma')->orderBy('varietal')
//            ->get();
//
//
//
//        return $especies;
//    }
//






    
}