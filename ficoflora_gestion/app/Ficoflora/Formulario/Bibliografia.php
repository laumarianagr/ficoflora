<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 04/07/2015
 * Time: 6:35
 */

namespace App\Ficoflora\Formulario;


class Bibliografia {

    private $especie_id;
    private $creador;

    function __construct($especie_id, $creador)
    {
        $this->especie_id = $especie_id;
        $this->creador = $creador;
    }


    /**
     * Busca en la BDD si existe la Cita, sino la crea.
     * Formato de cita desde creaciond de especies desde formularios.
     *
     */
    public function setCitaRegistro($autores, $fecha, $cita_letra)
    {
        if($cita_letra == '-'){$letra = null;}

        $obj_cita  = Cita::where('autores', $autores)->conFecha($fecha)->conLetra($letra)->first();

        if($obj_cita == null){
            $obj_cita = new Cita(['autores' => $autores, 'fecha' => $fecha, 'letra' => $letra]);
            $obj_cita->creador_id = $this->creador;
            $obj_cita->save();
        }


        return $obj_cita;
    }
}