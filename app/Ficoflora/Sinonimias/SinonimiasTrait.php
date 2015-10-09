<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 09/09/2015
 * Time: 22:21
 */
namespace App\Ficoflora\Sinonimias;

use App\Modelos\Sinonimias\Sinonimia;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Epitetos\Especifico;
use App\Modelos\Taxonomia\Epitetos\Forma;
use App\Modelos\Taxonomia\Epitetos\Varietal;
use App\Modelos\Taxonomia\Genero;

trait SinonimiasTrait {


    public function getSinonimia($id, $sinonimia)
    {
        if($sinonimia == null){
            $sinonimia = Sinonimia::find($id);
        }

//        dd($sinonimia);
        $genero = Genero::find($sinonimia['genero_id']);
        $especifico = Especifico::find($sinonimia['especifico_id']);

        $especie = $genero['nombre'].' '.$especifico['nombre'];

        if($sinonimia['varietal_id'] != null){
            $varietal= Varietal::find($sinonimia['varietal_id']);
            $especie = $especie.' var. '.$varietal['nombre'];
        }
        if($sinonimia['forma_id'] != null){
            $forma= Forma::find($sinonimia['forma_id']);
            $especie= $especie.' f. '.$forma['nombre'];
        }

        $autor = Autor::find($sinonimia['autor_id']);

        return [$especie, $autor['nombre']];

    }


    public function getSinonimias($obj_sinonimias)
    {
        $sinonimias = collect();

        foreach ($obj_sinonimias as $sinonimia) {
            list($nombre, $autor)= $this->getSinonimia(null, $sinonimia);
//            array_push($sinonimias, ['nombre'=>$nombre, 'autor'=>$autor, 'id'=>$sinonimia->id]);
//            $sinonimias->push(collect(['nombre'=>$nombre, 'autor'=>$autor, 'id'=>$sinonimia->id]));
            $sinonimias->push(['nombre'=>$nombre, 'autor'=>$autor, 'id'=>$sinonimia->id]);
        }

//        dd($sinonimias->sortBy('nombre'));
        return $sinonimias->sortBy('nombre');
    }
}