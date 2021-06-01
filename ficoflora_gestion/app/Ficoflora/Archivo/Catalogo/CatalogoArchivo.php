<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 19/08/2015
 * Time: 19:14
 */

namespace App\Ficoflora\Archivo\Catalogo;


use App\Modelos\Catalogo\Registro;
use App\Modelos\Geografico\Ubicacion;
use App\Modelos\Taxonomia\Especie;
use Illuminate\Support\Facades\DB;

class CatalogoArchivo{


    private $obj_especie;
    private $creador_id;
    private $referencia_id;
    private $tipo;
    private $sinonimias;
    private $ubicaciones;
    private $comentario;

    private $obj_registro;

    function __construct($obj_especie, $referencia_id, $tipo, $sinonimias, $ubicaciones, $creador_id,$comentario)
    {
        $this->obj_especie = $obj_especie;
        $this->referencia_id = $referencia_id;
        $this->tipo = $tipo;
        $this->sinonimias = $sinonimias;
        $this->ubicaciones = $ubicaciones;

        $this->creador_id = $creador_id;
        $this->comentario = $comentario;
    }


    public function newRegistro()
    {
        $registro = $this->setRelaciones();
//        dd($registro);

    }


    private function setRelaciones()
    {
        //relacion especie-referencia
        $this->setEspecieReferencia();

        //actualizamos especie
        $this->actualizarEspecie();
        //realcion sinonimia con especie y registro
        if(!empty($this->sinonimias)){
            $this->setRelacionSinonimia();
        }
        //realcion sinonimia con especie y registro
        if(!empty($this->ubicaciones)){
            $this->setRelacionUbicacion();

        }
        if((!empty($this->sinonimias)) || (!empty($this->ubicaciones))){
            $this->setRelacionUbicacionSinonimia();
        }


    }

    /**
     * Se llena la tabla registros  que guarda la relación especie-referencia
     */
    private function setEspecieReferencia()
    {
        $this->obj_registro = Registro::where('especie_id', $this->obj_especie->id)->conReferencia($this->referencia_id)->conTipo($this->tipo)->first();

        if($this->obj_registro == null){
            $this->obj_registro = new Registro(['especie_id' => $this->obj_especie->id, 'referencia_id' => $this->referencia_id, 'tipo_referencia' => $this->tipo, 'creador_id' => $this->creador_id, 'comentario' => $this->comentario ]);
            $this->obj_registro->save();
        }
    }


    /**
     * Actualiza el valor catalogo de la especie para saber que ya puede
     * desplegarse en el catalgo por que posee una referencia;
     */
    private function actualizarEspecie()
    {
        $obj_especie = Especie::find($this->obj_especie->id);

        if(!$obj_especie->catalogo){

            $obj_especie->catalogo = true;
            $obj_especie->save();
        }
    }

//----------------------------
//    SINONIMIAS
//----------------------------

    public function setRelacionSinonimia()
    {
        $sinonimias = $this->sinonimias;

        foreach ($sinonimias as $sinonimia) {

            $this->setSinonimiaEspecie($sinonimia);
//            $this->setSinonimiaRegistro($sinonimia);//relacion Registro-sinonimia
        }
        return;
    }

    /**
     * Busca en la BDD si existe una relación entre la ESPECIE y la SINONIMIA, sino la crea.
     * @param $obj_sinonimia
     */
    public function setSinonimiaEspecie($sinonimia)
    {
        $sinonimia_especie = $this->obj_especie->sinonimias()->conId($sinonimia)->exists();

        if($sinonimia_especie == null){
            $this->obj_especie->sinonimias()->attach($sinonimia);
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
            $this->setUbicacionEspecie($ubicacion);//relacion especie-ubicacion
//            $this->setUbicacionRegistro($ubicacion);//relacion Registro-ubicacion
        }
    }



    private function setUbicacionEspecie($id)
    {
        $ubicacion = Ubicacion::find($id);

        //revisamos si existe la relacion especie entidad
        if(!$this->obj_especie->entidades()->conId($ubicacion['entidad_id'])->exists()){
            $this->obj_especie->entidades()->attach($ubicacion['entidad_id']);
        }

        if($ubicacion['localidad_id'] != null) {
            //revisamos si existe la relacion especie localidad
            if (!$this->obj_especie->localidades()->conId($ubicacion['localidad_id'])->exists()) {
                $this->obj_especie->localidades()->attach($ubicacion['localidad_id']);
            }

            if ($ubicacion['lugar_id'] != null) {
                //revisamos si existe la relacion especie lugar
                if (!$this->obj_especie->lugares()->conId($ubicacion['lugar_id'])->exists()) {
                    $this->obj_especie->lugares()->attach($ubicacion['lugar_id']);
                }

                if ($ubicacion['sitio_id'] != null) {
                    //revisamos si existe la relacion especie sitio
                    if (!$this->obj_especie->sitios()->conId($ubicacion['sitio_id'])->exists()) {
                        $this->obj_especie->sitios()->attach($ubicacion['sitio_id']);
                    }
                }
            }
        }
    }

    private function setUbicacionRegistro($ubicacion_id)
    {
        $ubicacion_registro = $this->obj_registro->ubicaciones()->conId($ubicacion_id)->exists();

        if($ubicacion_registro == null){
            $this->obj_registro->ubicaciones()->attach($ubicacion_id); //guardamos en la tabla registro_ubicacion
        }
    }



//----------------------------
//    UBICACIONES-SINONIMIAS
//----------------------------


    private function setRelacionUbicacionSinonimia()
    {
        $ubicaciones = $this->ubicaciones;
        $sinonimias = $this->sinonimias;

        if((!empty($sinonimias)) && (!empty($ubicaciones))){

            foreach ($ubicaciones as $ubicacion) {
                foreach ($sinonimias as $sinonimia) {
                    $this->setUbicacionSinonimiaRegistro($ubicacion, $sinonimia);
                }
            }
        }

        if((empty($sinonimias)) && (!empty($ubicaciones))){
            foreach ($ubicaciones as $ubicacion) {
                $this->setUbicacionSinonimiaRegistro($ubicacion, null);
            }
        }

        if((!empty($sinonimias)) && (empty($ubicaciones))){
            foreach ($sinonimias as $sinonimia) {
                $this->setUbicacionSinonimiaRegistro(null, $sinonimia);
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