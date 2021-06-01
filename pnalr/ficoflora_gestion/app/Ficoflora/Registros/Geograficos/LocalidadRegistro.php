<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 18/07/2015
 * Time: 2:28
 */

namespace App\Ficoflora\Registros\Geograficos;



use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Ubicacion;
use Illuminate\Support\Facades\Request;

class LocalidadRegistro {



    private $nombre;
    private $entidad_id;
    private $latitud;
    private $longitud;

    private $creador_id;

    private $error;
    private $log;
    private $existe = true;


    function __construct($nombre, $latitud, $longitud, $entidad_id, $creador_id) {

        $this->nombre = $nombre;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->entidad_id = $entidad_id;
        $this->creador_id = $creador_id;
    }


    public function nuevaLocalidad()
    {
        $registro = $this->getLocalidad();
        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }

    /**
     * Obtiene el objeto clase, ya sea buscandolo en la BDD o creandolo en caso de que no exista.
     *
     */
    public function getLocalidad()
    {
        $obj_localidad = Localidad::where('nombre', $this->nombre)->first();

        if($obj_localidad == null){
            $this->existe = false;
            return new Localidad(['nombre' => $this->nombre, 'latitud' => $this->latitud, 'longitud' => $this->longitud, 'entidad_id' => $this->entidad_id,'creador_id' => $this->creador_id]);
        }

        //La localidad ya existe
        $this->log = "La Localidad ya existe";

        //Verifico que si la localidad existe pertenece a la misma entidad que el usuario indica.
        if($obj_localidad->entidad_id != $this->entidad_id){
            $this->error = true;
            $entidad = Entidad::find($obj_localidad->entidad_id);
            $this->log = "La Localidad ya existe, pertenece a la entidad \"".$entidad->nombre."\"";
        }

        return $obj_localidad;
    }

}