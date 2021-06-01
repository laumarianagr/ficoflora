<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 18/07/2015
 * Time: 7:21
 */

namespace App\Ficoflora\Registros\Geograficos;


use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;

class LugarRegistro {

    private $nombre;
    private $localidad_id;
    private $latitud;
    private $longitud;

    private $creador_id;

    private $error;
    private $log;
    private $existe = true;


    function __construct($nombre, $latitud, $longitud, $localidad_id, $creador_id) {

        $this->nombre = $nombre;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->localidad_id = $localidad_id;
        $this->creador_id = $creador_id;
    }


    public function nuevoLugar()
    {
        $registro = $this->getLugar();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }

    /**
     * Obtiene el objeto clase, ya sea buscandolo en la BDD o creandolo en caso de que no exista.
     *
     */
    public function getLugar()
    {
        $obj_lugar = Lugar::where('nombre', $this->nombre)->first();

        //Si no existe o si el lugar existe pero pertenece a otra localidad, es nuevo.
        if(($obj_lugar == null) || ($obj_lugar->localidad_id != $this->localidad_id)){
            $this->existe = false;
            return new Lugar(['nombre' => $this->nombre, 'latitud' => $this->latitud, 'longitud' => $this->longitud, 'localidad_id' => $this->localidad_id,'creador_id' => $this->creador_id]);
        }


        //Verifico que si el lugar existe pero pertenece a otra localidad, es nuevo.
//        if($obj_lugar->localidad_id != $this->localidad_id){
////            $this->error = true;
//            $this->existe = false;
//            return new Lugar(['nombre' => $this->nombre, 'latitud' => $this->latitud, 'longitud' => $this->longitud, 'localidad_id' => $this->localidad_id]);
//        }

        //El Lugar ya existe
        $this->log = "El Lugar ya existe";

        return $obj_lugar;
    }

}