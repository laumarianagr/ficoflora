<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 04/07/2015
 * Time: 2:38
 */

namespace App\Ficoflora\Archivo;

use App\Modelos\Bibliografia\Cita;

class Bibliografia {

    private $especie_id;
    private $creador_id;

    function __construct($especie_id, $creador_id)
    {
        $this->especie_id = $especie_id;
        $this->creador_id = $creador_id;
    }


    /**
     * Busca en la BDD si existe la Cita, sino la crea.
     * Formato de cita desde importación de especies desde archivo.
     *
     */
    public function setCita($datos)
    {

        $ultima = strrpos($datos,',');//ultima coma ejem: "Bello, Pérez & Yang, 1995a"

        $autores = substr($datos, 0, $ultima);

        $fecha = substr($datos, $ultima+1, strlen($datos));
        $fecha = trim($fecha, " ");

        $letra = null;

        if(strlen($fecha)>4)//la fecha tiene letra ejem: "1995a"
        {
            $letra = substr($fecha, -1);
            $fecha= substr($fecha,0,4);
        }

        //Busco si ya exite la cita
        $obj_cita  = Cita::where('autores', $autores)->conFecha($fecha)->conLetra($letra)->first();

        //Si no existe la creao
        if($obj_cita == null){
            $obj_cita = new Cita(['autores' => $autores, 'fecha' => $fecha, 'letra' => $letra]);
            $obj_cita->creador_id = $this->creador_id;
            $obj_cita->save();
        }

//        $this->tabla_reportes($obj_cita);

        return $obj_cita;

    }
}