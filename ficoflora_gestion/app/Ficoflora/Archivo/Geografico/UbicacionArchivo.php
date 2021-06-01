<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 02/09/2015
 * Time: 18:57
 */

namespace App\Ficoflora\Archivo\Geografico;


use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;
use App\Modelos\Geografico\Ubicacion;

class UbicacionArchivo {


    private $error = false;
    private $log;

    private $entidad;
    private $localidad;
    private $lugar;
    private $sitio;
    private $latitud;
    private $longitud;

    private $creador_id;

    private $flag='e';

    function __construct($datos)
    {
        $this->entidad = trim($datos['entidad'], " ");
        $this->localidad = trim($datos['localidad']," ");
        $this->lugar = trim($datos['lugar']," ");
        $this->sitio = trim($datos['sitio']," ");
        $this->latitud = trim($datos['latitud']," ");
        $this->longitud = trim($datos['longitud']," ");
        $this->creador_id = 2;
    }


    public function newUbicacion()
    {
        $this->setUbicacion();
        $respuesta = ['error' => $this->error, 'log' => $this->log];

        return $respuesta;

    }


    public function setUbicacion()
    {

        $this->setFlag();
        $entidad = $this->getEntidad();

        $localidad = $lugar = $sitio = null;

        if(!$this->error) {
            if ($this->localidad != null) {

                $localidad = $this->getLocalidad($entidad);

                if (!$this->error) {//localidad de otra entidad

                    if ($this->lugar != null) {
                        $lugar = $this->getLugar($localidad);

                        if (!$this->error) {//localidad de otra entidad

                            if ($this->sitio != null) {
                                $sitio = $this->getSitio($lugar);
                            }
                        }
                    }
                }
            }
        }

        if(!$this->error) {

            $ubicacion = Ubicacion::where('entidad_id', $entidad)->conLocalidad($localidad)->conLugar($lugar)->conSitio($sitio)->first();

            if ($ubicacion == null) {
                Ubicacion::create([
                    'entidad_id' => $entidad,
                    'localidad_id' => $localidad,
                    'lugar_id' => $lugar,
                    'sitio_id' => $sitio,
                    'latitud' => $this->latitud,
                    'longitud' => $this->longitud
                ]);

            }
        }
    }


    //ENTIDAD
    private function getEntidad()
    {
        $obj_entidad = Entidad::where('nombre', $this->entidad)->first(); //verifico si ya existe en la BD

        if($obj_entidad == null){ //Creo la entidad si no existe
            if($this->flag == 'e'){
                $obj_entidad = new Entidad(['nombre' => $this->entidad,'creador_id' => $this->creador_id]);

                $obj_entidad->latitud = $this->latitud;
                $obj_entidad->longitud = $this->longitud;
                $obj_entidad->save();

                return $obj_entidad->id;
            }else{
                $this->error = true;
                $this->log = ['error'=>"Se intento ingresar una localidad en una entidad (".$this->entidad.") que no está registrada", 'tipo'=>'Entidad'];
                return null;
            }


        }
        return $obj_entidad->id;
    }


    //LOCALIDAD
    private function getLocalidad($entidad)
    {

        $obj_localidad = Localidad::where('nombre', $this->localidad)->first(); //verifico si ya existe en la BD
//        $obj_localidad = Localidad::where('nombre', $this->localidad)->ConEntidadId($entidad)->first(); //verifico si ya existe en la BD

        if ($obj_localidad == null) { //Creo la entidad si no existe

            if($this->flag == 'lo'){
                $obj_localidad = new  Localidad(['nombre' => $this->localidad, 'entidad_id'=>$entidad,'creador_id' => $this->creador_id]);

                $obj_localidad->latitud = $this->latitud;
                $obj_localidad->longitud = $this->longitud;
                $obj_localidad->save();

                return $obj_localidad->id;
            }else{
                $this->error = true;
                $this->log = ['error'=>"Se intento ingresar un lugar en una localidad (".$this->localidad.") que no está registrada", 'tipo'=>'Localidad'];
                return null;
            }


        }

        if($obj_localidad->entidad_id != $entidad){
            if($obj_localidad->nombre != 'P.N. Mochima'){//está en mas de una entidad
                $this->error = true;
                $ent = Entidad::find($obj_localidad->entidad_id);
//                $this->log = ['error'=>"La Localidad pertenece a otra entidad (".$this->entidad.")", 'tipo'=>'Localidad'];
                $this->log = ['error'=>"La Localidad pertenece a otra entidad (".$ent->nombre.")", 'tipo'=>'Localidad'];
                return null;
            }else{
                $obj_localidad = Localidad::where('nombre', $this->localidad)->ConEntidadId($entidad)->first();

                if($obj_localidad == null){
                    $obj_localidad = new  Localidad(['nombre' => $this->localidad, 'entidad_id'=>$entidad,'creador_id' => $this->creador_id]);
                }

                if($this->flag == 'lo'){
                    $obj_localidad->latitud = $this->latitud;
                    $obj_localidad->longitud = $this->longitud;
                }
                $obj_localidad->save();
            }

        }

         return $obj_localidad->id;

    }

    //LOCALIDAD
    private function getLugar($localidad)
    {
        $obj_lugar = Lugar::where('nombre', $this->lugar)->conLocalidadId($localidad)->first(); //verifico si ya existe en la BD

//        $obj_lugar = Lugar::where('nombre', $this->lugar)->first(); //verifico si ya existe en la BD

        if($obj_lugar == null){ //Creo la entidad si no existe

            if($this->flag == 'lu'){
                $obj_lugar =  new Lugar(['nombre' => $this->lugar, 'localidad_id'=> $localidad,'creador_id' => $this->creador_id]);

                $obj_lugar->latitud = $this->latitud;
                $obj_lugar->longitud = $this->longitud;
                $obj_lugar->save();

                return $obj_lugar->id;
            }else{
                $this->error = true;
                $this->log = ['error'=>"Se intento ingresar un sitio en un lugar (".$this->lugar.") que no está registrado", 'tipo'=>'Lugar'];
                return null;
            }


        }
        return $obj_lugar->id;
    }


    //LOCALIDAD
    private function getSitio($lugar)
    {
        $obj_sitio = Sitio::where('nombre', $this->sitio)->conLugarId($lugar)->first(); //verifico si ya existe en la BD

//        $obj_sitio = Sitio::where('nombre', $this->sitio)->first(); //verifico si ya existe en la BD

        if($obj_sitio == null){ //Creo la entidad si no existe
            $obj_sitio = new Sitio(['nombre' => $this->sitio, 'lugar_id'=> $lugar,'creador_id' => $this->creador_id]);

            if($this->flag == 's'){
                $obj_sitio->latitud = $this->latitud;
                $obj_sitio->longitud = $this->longitud;
            }

            $obj_sitio->save();

            return $obj_sitio->id;
        }
        return $obj_sitio->id;
    }



    //FLAG COORDENADAS
    public function setFlag()
    {
        if($this->sitio != null){
            $this->flag = 's';
        }else{
            if($this->lugar != null){
                $this->flag = 'lu';
            }else{
                if($this->localidad != null){
                    $this->flag = 'lo';
                }
            }
        }
    }
}