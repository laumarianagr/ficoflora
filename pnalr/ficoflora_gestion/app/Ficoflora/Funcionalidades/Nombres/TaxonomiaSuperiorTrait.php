<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 05/09/2015
 * Time: 0:03
 */

namespace App\Ficoflora\Funcionalidades\Nombres;


use App\Modelos\Taxonomia\Clase;
use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Genero;
use App\Modelos\Taxonomia\Orden;
use App\Modelos\Taxonomia\Phylum;
use App\Modelos\Taxonomia\Subclase;

trait TaxonomiaSuperiorTrait {



    public function taxoGenero($id)
    {
        $genero = Genero::find($id);
        $taxo = $this->taxoFamilia($genero->familia_id);

        $taxo['genero'] = $genero->nombre;
        $taxo['genero_id'] = $genero->id;
        $taxo['creador_id'] = $genero->creador_id;

        return $taxo;
    }

    public function taxoFamilia($id)
    {
        $familia = Familia::find($id);

        $taxo = $this->taxoOrden($familia->orden_id);

        $taxo['familia'] = $familia->nombre;
        $taxo['familia_id'] = $familia->id;
                $taxo['creador_id'] = $familia->creador_id;


        return $taxo;

    }


    public function taxoOrden($id)
    {
        $orden = Orden::find($id);

        if($orden->subclase_id != null){
            $taxo = $this->taxoSubclase($orden->subclase_id);
        }else{
            $taxo = $this->taxoClase($orden->clase_id);
            $taxo['subclase'] = null;
        }

        $taxo['orden'] = $orden->nombre;
        $taxo['orden_id'] = $orden->id;
                $taxo['creador_id'] = $orden->creador_id;


        return $taxo;
    }


    public function taxoSubclase($id)
    {
        $subclase = Subclase::find($id);

        $taxo = $this->taxoClase($subclase->clase_id);

        $taxo['subclase'] = $subclase->nombre;
        $taxo['subclase_id'] = $subclase->id;
                $taxo['creador_id'] = $subclase->creador_id;


        return $taxo;
    }


    public function taxoClase($id)
    {
        $clase = Clase::find($id);

        $taxo = $this->taxoPhylum($clase->phylum_id);

        $taxo['clase'] = $clase->nombre;
        $taxo['clase_id'] = $clase->id;
                $taxo['creador_id'] = $clase->creador_id;


        return $taxo;
    }


    public function taxoPhylum($id)
    {
        $phylum = Phylum::find($id);
        return ['phylum' =>$phylum->nombre, 'phylum_id' =>$phylum->id, 'creador_id' =>$phylum->creador_id];
    }

}