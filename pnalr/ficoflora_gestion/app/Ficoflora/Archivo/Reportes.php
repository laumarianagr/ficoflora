<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 04/07/2015
 * Time: 2:46
 */

namespace App\Ficoflora\Archivo;


use App\Modelos\Reportes\Reporte;

class Reportes {

    private $especie_id;
    private $reporte;

    function __construct($especie_id, $reporte)
    {
        $this->especie_id = $especie_id;
        $this->reporte = $reporte;
    }


    /**
     * Verifica si existe una relacion entre la CITA y la ESPECIE, sino la crea en la table REPORTES.
     * @param $cita
     * @return
     */
    public function setReporte($cita, $creador_id)
    {
        $obj_reporte = Reporte::where('cita_id', $cita->id)->conEspecieID($this->especie_id)->first(); //verifico si ya existe en la BD

        if($obj_reporte == null){
            $obj_reporte = $cita->reportes()->create(['especie_id' =>$this->especie_id, 'creador_id' =>  $creador_id]);
        }

        return $obj_reporte;
    }

    /**
     * Relaciona un REPORTE y la ENTIDAD donde se hace
     *
     * @param $entidad_id
     */
    public function setReporteEntidad($entidad_id)
    {
        $reporte_entidad =  $this->reporte->entidades()->conId($entidad_id)->exists();//verifico si ya existe en la BD

        if ($reporte_entidad == null) { //Creo un nuevo registro ReporteEntidad si no existe
            $this->reporte->entidades()->attach($entidad_id);
        }
    }


    /**
     * Relaciona un REPORTE con la LOCALIDAD donde se hace
     * @param $localidad_id
     * @param $entidad_id
     */
    public function setReporteLocalidad($localidad_id,$entidad_id)
    {
        $reporte_localidad = $this->reporte->localidades()->conID($localidad_id)->wherePivot('entidad_id', $entidad_id)->exists();//verifico si ya existe en la BD
//        $reporte_localidad = $reporte->localidades()->conID($localidad_id)->where('reporte_localidad.entidad_id', $entidad_id)->get();//verifico si ya existe en la BD

        if ($reporte_localidad == null) { //Creo unuevo registro en reporte_localidad si no existe

            $this->reporte->localidades()->attach($localidad_id, ['entidad_id' => $entidad_id]);
        }
    }

    /**
     * Relaciona un REPORTE con el LUGAR donde se hace
     * @param $lugar_id
     * @param $localidad_id
     */
    public function setCitaLugar($lugar_id,$localidad_id)
    {
        $reporte_lugar = $this->reporte->lugares()->conID($lugar_id)->wherePivot('localidad_id', $localidad_id)->exists();//verifico si ya existe en la BD

        if ($reporte_lugar == null) { //Creo un nuevo registro en reporte_lugar si no existe
            $this->reporte->lugares()->attach($lugar_id, ['localidad_id' => $localidad_id]);
        }
    }


    /**
     * Relaciona un REPORTE con el SITIO donde se hace
     * @param $sitio_id
     * @param $lugar_id
     */
    public function setCitaSitio($sitio_id,$lugar_id)
    {
        $reporte_sitio = $this->reporte->sitios()->conID($sitio_id)->wherePivot('lugar_id', $lugar_id)->exists();//verifico si ya existe en la BD

        if ($reporte_sitio == null) { //Creo la CitaSitio si no existe
            $this->reporte->sitios()->attach($sitio_id, ['lugar_id' => $lugar_id]);
        }
    }

}