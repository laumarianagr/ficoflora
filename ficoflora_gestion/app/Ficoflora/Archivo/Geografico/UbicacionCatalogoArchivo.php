<?php
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 27-05-2015
 * Time: 12:07 PM
 */

namespace App\Ficoflora\Archivo\Geografico;

use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;
use App\Modelos\Geografico\Ubicacion;

class UbicacionCatalogoArchivo {
    
    private $entidad;
    private $ubicacion;
    private $especie;
    private $reporte;

    private $error = false;
    private $log;

    private $ubicaciones_id = Array();



    function __construct($entidad, $ubicacion, $especie)
    {
        $this->entidad = trim($entidad, " \n");;
        $this->ubicacion = $ubicacion;//el conjunto de localidades, lugares y sitios
        $this->especie = $especie;
    }

    public function newUbicacion()
    {

        $this->setUbicacion();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'registro' => $this->ubicaciones_id];

        return $respuesta;
    }

    public function setUbicacion()
    {
        if ($this->entidad != null) {
            $mi_entidad = $this->setEntidad();
//            $this->tablaEspecieEntidad($mi_entidad->id);

            if(!$this->error) {
                if ($this->ubicacion != null) {
                    $this->distribucionLocalidades($mi_entidad);
                }else {
                    $this->setUbicaciones($mi_entidad->id, null, null, null);
                }
            }
        }
    }


    /**
     * Busca en la BDD si existe la entidad, sino la crea.
     * 
     */
    private function setEntidad()
    {
        $obj_entidad = Entidad::where('nombre', $this->entidad)->first(); //verifico si ya existe en la BD

        if($obj_entidad == null){ //Creo la entidad si no existe YA NO
//            return Entidad::Create(['nombre' => $this->entidad]);

            $this->error=true;
            $this->log = ['error'=>'La entidad "'. $this->entidad.'" no está registrada en el sistema','tipo'=>'Ubicación'];
            return null;
        }

        return $obj_entidad;
    }

    /**
     * Verifica si existe una relacion entre la entidad y la especie, sino la crea.
     * @param $entidad_id
     */
    private function tablaEspecieEntidad($entidad_id)
    {
        $especie_entidad = $this->especie->entidades()->conId($entidad_id)->exists();

        if($especie_entidad == false){
            $this->especie->entidades()->attach($entidad_id);
        }
    }


    /**
     * Procesa los datos de la columna Localidad.
     *
     * Ejemplo:
     * Península de Araya (Laguna de Chacopata / Chacopata) || Golfo de Cariaco (Playa / Arenas:agua / Bahía de Mochima: Taguapire, Varadero)
     *
     */
    public  function distribucionLocalidades($mi_entidad)
    {
        $localidades = explode("||", $this->ubicacion); //separa por localidades
        /*
         * [0] Península de Araya (Laguna de Chacopata / Chacopata)
         * [1] Golfo de Cariaco (Playa  / Arenas:agua / Bahía de Mochima: Taguapire, Varadero) ->(localidad, lugeres, sitios)
        */

        foreach ($localidades as $localidad) {

            $localidad_y_lugares = explode("(", $localidad); //separo la localidad de sus lugares
            /*
             * $localidad_y_lugares[]
             *[0]Golfo de Cariaco ->(localidad)
             *[1]Playa / Arenas:agua / Bahía de Mochima: Taguapire, Varadero) ->(lugares, sitios)
            */

            $mi_localidad = $this->setLocalidad($localidad_y_lugares[0], $mi_entidad);

            if(!$this->error) {

//                $this->tablaEspecieLocalidad($mi_localidad->id);

                if (sizeof($localidad_y_lugares) > 1)// si posee lugares
                {
                    $this->distribucionLugares($localidad_y_lugares[1], $mi_localidad, $mi_entidad);
                }
                else {
                    $this->setUbicaciones($mi_entidad->id, $mi_localidad->id, null, null);
                }
            }
        }

    }


    /**
     * Revisa si existe la localidad en la BDD, sino la crea.
     *
     */
    private function setLocalidad($cadena_localidad, $entidad)
    {
        $localidad = trim($cadena_localidad, " \n");//quitamos posibles especios en blanco antes y despues de la localidad

        $obj_localidad = Localidad::where('nombre', $localidad)->ConEntidadId($entidad->id)->first(); //verifico si ya existe en la BD

        if($obj_localidad == null){
//            return $entidad->localidades()->save(new Localidad(['nombre' => $localidad])); //Guardo la localidad asociandola a la entidad
            $this->error = true;
            $this->log = ['error'=>'La localidad "'.$localidad.'", con entidad '.$entidad->nombre.' no está registrada en el sistema','tipo'=>'Ubicación'];

            return null;
        }

        return $obj_localidad;
    }


    /**
     * Verifica si existe una relacion entre la LOCALIDAD y la ESPECIE, sino la crea.
     *
     */
    private function tablaEspecieLocalidad($localidad_id)
    {
        $especie_localidad = $this->especie->localidades()->conId($localidad_id)->exists();
        if($especie_localidad == false){
            $this->especie->localidades()->attach($localidad_id);
        }
    }


    /**
     * Si la LOCALIDAD posee LUGARES se procesan.
     * @param $cadena_lugaresSitios
     * @param $mi_localidad
     * @param $reporte
     */
    private function distribucionLugares($cadena_lugaresSitios, $mi_localidad, $mi_entidad)
    {
        $cadena_lugaresSitios = trim($cadena_lugaresSitios, " \n");
        $cadena_lugaresSitios = rtrim($cadena_lugaresSitios, ")");
//        dd($cadena_lugaresSitios);

        $lugares = explode("/", $cadena_lugaresSitios); //separar por lugares
        /*
         * $lugares[]
         * [0] Playa ->(lugar, sitios)
         * [1] Arenas:agua ->(lugar, sitios)
         * [2] Bahía de Mochima: Taguapire, Varadero ->(lugar, sitios)
         */

        foreach ($lugares as $lugar) {

            $lugar_y_sitios = explode(":",$lugar); //separo el lugar de sus sitios
            /*
             * $lugar_y_sitios[]
             * [0]Bahía de Mochima ->(Lugar)
             * [1]Taguapire, Varadero ->(sitios)
             */

            $mi_lugar = $this->setLugar($lugar_y_sitios[0], $mi_localidad);

            if(!$this->error) {
//                $this->tablaEspecieLugar($mi_lugar->id);

                if (sizeof($lugar_y_sitios) > 1)// si posee sitios
                {
                    $this->distribucionSitios($lugar_y_sitios[1], $mi_lugar, $mi_localidad, $mi_entidad);
                } else {
                    $this->setUbicaciones($mi_entidad->id, $mi_localidad->id, $mi_lugar->id, null);
                }
            }
        }
    }



    /**
     * Revisa si existe el LUGAR en la BDD, sino lo crea.
     *
     */
    private function setLugar($cadena_lugar, $localidad)
    {
        $lugar = trim($cadena_lugar, " \n");//quitamos posibles especios en blanco antes y despues del lugar

//        dd($lugar, $localidad);

//        dd($lugar, $localidad->id);

        $obj_lugar = Lugar::where('nombre', $lugar)->conLocalidadId($localidad->id)->first(); //verifico si ya existe en la BD

        if($obj_lugar == null)
        {
//            return $localidad->lugares()->save(new Lugar(['nombre' => $lugar])); //Guardo el lugar asociandola a la localidad
            $this->error = true;
            $this->log = ['error'=>'El lugar "'.$lugar.'", con localidad '.$localidad->nombre.' no está registrado en el sistema','tipo'=>'Ubicación'];
            return null;
        }

        return $obj_lugar;
    }


    /**
     * Verifica si existe una relacion entre el LUGAR y la ESPECIE, sino la crea.
     *
     */
    private function tablaEspecieLugar($lugar_id)
    {
        $especie_lugar = $this->especie->lugares()->conId($lugar_id)->exists();
        if($especie_lugar == false){
            $this->especie->lugares()->attach($lugar_id);
        }
    }


    /**
     * Si el LUGAR posee SITIOS se procesan.
     *
     */
    private function distribucionSitios($cadena_sitios, $mi_lugar,  $mi_localidad, $mi_entidad)
    {
        $sitios = explode(",",$cadena_sitios); //separar por sitios
        /*
         * $sitios[]
         * [0] Taguapire ->(sitio)
         * [1] Varadero ->(sitio)
         */
        foreach ($sitios as $sitio)
        {
            $mi_sitio= $this->setSitio($sitio, $mi_lugar);
//                $this->tablaEspecieSitio($mi_sitio->id);
            if(!$this->error) {
                $this->setUbicaciones($mi_entidad->id, $mi_localidad->id, $mi_lugar->id, $mi_sitio->id);
            }

        }
    }


    /**
     * Revisa si existe el LUGAR en la BDD, sino lo crea.
     *
     */
    private function setSitio($cadena_sitio, $lugar)
    {
        $sitio = trim($cadena_sitio, " \n");//quitamos posibles especios en blanco antes y despues del sitio

        $obj_sitio = Sitio::where('nombre', $sitio)->conLugarId($lugar->id)->first(); //verifico si ya existe en la BD

        if($obj_sitio == null){
//            return $lugar->sitios()->save(new Sitio(['nombre' => $sitio])); //Guardo el sitio asociandola a un lugar

            $this->error = true;
            $this->log = ['error'=>'El sitio "'.$sitio.'", con lugar '.$lugar->nombre.' no está registrado en el sistema','tipo'=>'Ubicación'];
            return null;
        }

        return $obj_sitio;
    }

    /**
     * Verifica si existe una relacion entre el SITIO y la ESPECIE, sino la crea.
     *
     * @param $sitio_id
     */
    private function tablaEspecieSitio($sitio_id)
    {
        $especie_sitio = $this->especie->sitios()->conId($sitio_id)->exists();

        if($especie_sitio == false){
            $this->especie->sitios()->attach($sitio_id);
        }
    }

    public function setUbicaciones($entidad, $localidad, $lugar, $sitio)
    {
        $obj_ubicacion = Ubicacion::where('entidad_id', $entidad)->conLocalidad($localidad)->conLugar($lugar)->conSitio($sitio)->first();

        if($obj_ubicacion == null) {

            $obj_ubicacion = new Ubicacion([
                'entidad_id' => $entidad,
                'localidad_id' => $localidad,
                'lugar_id' => $lugar,
                'sitio_id' => $sitio,
            ]);

            $obj_ubicacion->save();
        }


       //guardamos los ids de las ubicaciones para despues llenar la tabla registro_ubicacion
        array_push($this->ubicaciones_id, $obj_ubicacion->id);

    }


}