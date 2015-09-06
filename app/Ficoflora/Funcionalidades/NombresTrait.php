<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 30/08/2015
 * Time: 17:07
 */

namespace App\Ficoflora\Funcionalidades;

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


trait NombresTrait {


    public function especieNombre($mi_especie, $id, $taxo_superior)
    {
        if($mi_especie== null){
            $mi_especie = Especie::find($id);
        }

        $especie['id'] = $mi_especie->id;

        //GENERO
        $genero = Genero::find($mi_especie->genero_id);
        $especie['genero'] = $genero->nombre;
        $especie['genero_id'] = $genero->id;

        
        //ESPECIFICO
        $especie['especifico'] = Especifico::find($mi_especie->especifico_id)->nombre;
        
        
        //VARIETAL
        if($mi_especie->varietal_id != null){
            $especie['varietal'] = Varietal::find($mi_especie->varietal_id)->nombre;
        }else{
            $especie['varietal'] = null;
        }
        
        //FORMA
        if($mi_especie->forma_id != null){
            $especie['forma'] = Forma::find($mi_especie->forma_id)->nombre;
        }else{
            $especie['forma'] = null;
        }

        //AUTOR
        $autor = Autor::find($mi_especie->autor_id);
        $especie['autor'] = $autor->nombre;


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




    public function nombreGenero($id)
    {
        $genero = Genero::find($id);
        $taxo = $this->nombreFamilia($genero->familia_id);

        $taxo['genero'] = $genero->nombre;
        $taxo['genero_id'] = $genero->id;

        return $taxo;
    }

    public function nombreFamilia($id)
    {
        $familia = Familia::find($id);

        $taxo = $this->nombreOrden($familia->orden_id);

        $taxo['familia'] = $familia->nombre;
        $taxo['familia_id'] = $familia->id;

        return $taxo;

    }


    public function nombreOrden($id)
    {
        $orden = Orden::find($id);

        if($orden->subclase_id != null){
            $taxo = $this->nombreSubclase($orden->subclase_id);
        }else{
            $taxo = $this->nombreClase($orden->clase_id);
            $taxo['subclase'] = null;
        }

        $taxo['orden'] = $orden->nombre;
        $taxo['orden_id'] = $orden->id;

        return $taxo;
    }


    public function nombreSubclase($id)
    {
        $subclase = Subclase::find($id);

        $taxo = $this->nombreClase($subclase->clase_id);

        $taxo['subclase'] = $subclase->nombre;
        $taxo['subclase_id'] = $subclase->id;

        return $taxo;
    }


    public function nombreClase($id)
    {
        $clase = Clase::find($id);

        $taxo = $this->nombrePhylum($clase->phylum_id);

        $taxo['clase'] = $clase->nombre;
        $taxo['clase_id'] = $clase->id;

        return $taxo;
    }
    
    
    public function nombrePhylum($id)
    {         
        $phylum = Phylum::find($id);         
        return ['phylum' =>$phylum->nombre, 'phylum_id' =>$phylum->id];
    }





    
}