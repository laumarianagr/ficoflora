<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 17/01/2016
 * Time: 11:43
 */

namespace App\Ficoflora\Funcionalidades\Logs;


use App\Modelos\Log\Log;

trait LogsTrait {

    public function LogCrear($usuario,$elemento,$nuevo,$id,$ruta){
//        dd($nuevo);
        Log::create([
            'actividad'=>'c',
            'usuario'=>$usuario,
            'elemento'=>$elemento,
            'id_elem'=>$id,
            'ruta'=>$ruta,
            'proceso'=>null,
            'anterior'=>null,
            'nuevo'=>$nuevo
        ]);


        return;
    }



    public function LogEliminar($usuario,$elemento,$anterior,$id){
//        dd($nuevo);
        Log::create([
            'actividad'=>'d',
            'usuario'=>$usuario,
            'elemento'=>$elemento,
            'id_elem'=>$id,
            'ruta'=>null,
            'proceso'=>null,
            'anterior'=>$anterior,
            'nuevo'=>null
        ]);


        return;
    }


    public function LogEditar($usuario,$elemento,$anterior,$nuevo,$proceso,$id,$ruta){
//        dd($nuevo);
        Log::create([
            'actividad'=>'e',
            'usuario'=>$usuario,
            'elemento'=>$elemento,
            'id_elem'=>$id,
            'ruta'=>$ruta,
            'proceso'=>$proceso,
            'anterior'=>$anterior,
            'nuevo'=>$nuevo
        ]);


        return;
    }

}