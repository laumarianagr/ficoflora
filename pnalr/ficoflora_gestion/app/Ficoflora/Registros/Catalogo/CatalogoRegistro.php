<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 17/08/2015
 * Time: 16:20
 */

namespace App\Ficoflora\Registros\Catalogo;


use App\Ficoflora\Funcionalidades\Respuesta;
use App\Modelos\Catalogo\Registro;
use App\Modelos\Taxonomia\Especie;
use Illuminate\Support\Facades\DB;

class CatalogoRegistro extends Respuesta {


    private $especie_id;
    private $referencia;
    private $sinonimias = Array();
    private $ubicaciones = Array();
    private $creador_id;
    private $tipo;
    private $obj_especie;
    private $obj_registro;

    function __construct($datos, $creador_id)
    {
        $this->especie_id = $datos['especie'];
        $this->referencia = $datos['referencia'];
        $this->tipo = $datos['tipo'];
//        $this->sinonimias = $datos['sinonimias'];
//        $this->ubicaciones = $datos['ubicaciones'];

        $this->creador_id = $creador_id;
    }


    public function newRegistro()
    {
        $registro = $this->setRelaciones();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro];

        return $respuesta;
    }



    private function setRelaciones()
    {
        //relacion especie-referencia
        $this->setEspecieReferencia();
  
        //actualizamos especie
        $this->actualizarEspecie();

        //realcion sinonimia con especie y registro
//        if(!empty($this->sinonimias)){
//            $this->setRelacionSinonimia();
//        }
//        //realcion sinonimia con especie y registro
//        if(!empty($this->ubicaciones)){
//            $this->setRelacionUbicacion();
//            $this->setRelacionUbicacionSinonimia();
//        }

        return $this->obj_registro;

    }

    /**
     * Se llena la tabla registros  que guarda la relación especie-referencia
     */
    private function setEspecieReferencia()
    {
        $this->obj_registro = Registro::where('especie_id', $this->especie_id)->conReferencia($this->referencia)->conTipo($this->tipo)->first();

        if($this->obj_registro == null){
            $this->obj_registro = new Registro(['especie_id' => $this->especie_id, 'referencia_id' => $this->referencia, 'tipo_referencia' => $this->tipo, 'creador_id' => $this->creador_id ]);
            $this->obj_registro->save();
            $this->error = false;
            $this->existe = false;
        }
    }

    /**
     * Actualiza el valor catalogo de la especie para saber que ya puede
     * desplegarse en el catalgo por que posee una referencia;
     */
    private function actualizarEspecie()
    {
        $this->obj_especie = Especie::find($this->especie_id);

        if(!$this->obj_especie->catalogo){

            $this->obj_especie->catalogo = true;
            $this->obj_especie->save();
        }
    }


//----------------------------
//    SINONIMIAS
//----------------------------

    public function setRelacionSinonimia()
    {
        $sinonimias = $this->sinonimias;

        foreach ($sinonimias as $sinonimia) {

                $this->setSinonimiaEspecie($sinonimia);//relacion Especie-Sinonimia

//                $this->setSinonimiaRegistro($sinonimia);//relacion Registro-sinonimia
        }
        return;
    }


    /**
     * Busca en la BDD si existe una relación entre la ESPECIE y la SINONIMIA, sino la crea.
     */
    public function setSinonimiaEspecie($sinonimia_id)
    {
        $sinonimia_especie = $this->obj_especie->sinonimias()->conId($sinonimia_id)->exists();

        if($sinonimia_especie == null){
            $this->obj_especie->sinonimias()->attach($sinonimia_id);//guardamos en la tabla sinonimia_especie
        }
    }

    /**
     * Busca en la BDD si existe una relación entre el Registro y la SINONIMIA, sino la crea.
     */
    private function setSinonimiaRegistro($sinonimia_id)
    {
        $sinonimia_registro = $this->obj_registro->sinonimias()->conId($sinonimia_id)->exists();

        if($sinonimia_registro == null){
            $this->obj_registro->sinonimias()->attach($sinonimia_id); //guardamos en la tabla registro_sinonimia
        }
    }



//----------------------------
//    UBICACIONES
//----------------------------


    private function setRelacionUbicacion()
    {
        $ubicaciones = $this->ubicaciones;

        foreach ($ubicaciones as $ubicacion) {

            $this->setUbicacionEspecie($ubicacion);//relacion Especie-Ubicacion(entidad, localidad, ...)

//            $this->setUbicacionRegistro($ubicacion);//relacion Registro-ubicacion
        }
    }

    private function setUbicacionEspecie($ubicacion)
    {
        $this->tablaEspecieEntidad($ubicacion['entidad_id']);

        if($ubicacion['localidad_id'] != null){
            $this->tablaEspecieLocalidad($ubicacion['localidad_id']);

            if($ubicacion['lugar_id'] != null){
                $this->tablaEspecieLugar($ubicacion['lugar_id']);

                if($ubicacion['sitio_id']!= null){
                    $this->tablaEspecieSitio($ubicacion['sitio_id']);
                }
            }
        }

    }

    private function setUbicacionRegistro($ubicacion)
    {
        $ubicacion_registro = $this->obj_registro->ubicaciones()->conId($ubicacion['id'])->exists();

        if($ubicacion_registro == null){
            $this->obj_registro->ubicaciones()->attach($ubicacion['id']); //guardamos en la tabla registro_ubicacion
        }
    }



    /**
     * Verifica si existe una relacion entre la entidad y la especie, sino la crea.
     * @param $entidad_id
     */
    private function tablaEspecieEntidad($entidad_id)
    {
        $especie_entidad = $this->obj_especie->entidades()->conId($entidad_id)->exists();

        if($especie_entidad == false){
            $this->obj_especie->entidades()->attach($entidad_id);
        }
    }

    /**
     * Verifica si existe una relacion entre la LOCALIDAD y la ESPECIE, sino la crea.
     *
     */
    private function tablaEspecieLocalidad($localidad_id)
    {
        $especie_localidad = $this->obj_especie->localidades()->conId($localidad_id)->exists();
        if($especie_localidad == false){
            $this->obj_especie->localidades()->attach($localidad_id);
        }
    }


    /**
     * Verifica si existe una relacion entre el LUGAR y la ESPECIE, sino la crea.
     *
     */
    private function tablaEspecieLugar($lugar_id)
    {
        $especie_lugar = $this->obj_especie->lugares()->conId($lugar_id)->exists();
        if($especie_lugar == false){
            $this->obj_especie->lugares()->attach($lugar_id);
        }
    }




    /**
     * Verifica si existe una relacion entre el SITIO y la ESPECIE, sino la crea.
     *
     * @param $sitio_id
     */
    private function tablaEspecieSitio($sitio_id)
    {
        $especie_sitio = $this->obj_especie->sitios()->conId($sitio_id)->exists();

        if($especie_sitio == false){
            $this->obj_especie->sitios()->attach($sitio_id);
        }
    }



//----------------------------
//    UBICACIONES-SINONIMIAS
//----------------------------


    private function setRelacionUbicacionSinonimia()
    {
        $ubicaciones = $this->ubicaciones;
        $sinonimias = $this->sinonimias;

        if(!empty($sinonimias)){

            foreach ($ubicaciones as $ubicacion) {
                foreach ($sinonimias as $sinonimia) {
                    $this->setUbicacionSinonimiaRegistro($ubicacion, $sinonimia);
                }
            }
        }else{
            foreach ($ubicaciones as $ubicacion) {
                $this->setUbicacionSinonimiaRegistro($ubicacion, null);
            }
        }
    }

    public function setUbicacionSinonimiaRegistro($ubicacion, $sinonimia)
    {
        $ubicacion_sinonimia = DB::table('registro_ubicacion_sinonimia')
            ->where('registro_id', $this->obj_registro->id)
            ->where('ubicacion_id', $ubicacion)
            ->where('sinonimia_id', $sinonimia)
            ->get();

        if($ubicacion_sinonimia == null){
            DB::table('registro_ubicacion_sinonimia')->insert(
                ['registro_id' => $this->obj_registro->id, 'ubicacion_id' => $ubicacion, 'sinonimia_id' => $sinonimia]
            );
        }


    }

}