<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 27/09/2015
 * Time: 9:56
 */

namespace App\Ficoflora\Archivo\Exportar\Catalogo;

use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Modelos\Bibliografia\Referencias\Libro;
use App\Modelos\Bibliografia\Referencias\Catalogo;
use App\Modelos\Bibliografia\Referencias\Revista;
use App\Modelos\Bibliografia\Referencias\Trabajo;
use App\Modelos\Bibliografia\Referencias\Enlace;
use App\Modelos\Catalogo\Registro;
use App\Modelos\Sinonimias\Sinonimia;
use Illuminate\Support\Facades\DB;

trait ReportesExportar {

    use EspecieDatosTrait;

    public function getReportes()
    {
        $registross = Registro::all()->sortBy('especie_id');

//        $registros = $registross->take(400);
        $registros = $registross;

        $re_ub_si = DB::table('registro_ubicacion_sinonimia')
            ->leftjoin('ubicaciones','registro_ubicacion_sinonimia.ubicacion_id',  '=','ubicaciones.id' )
            ->leftjoin('entidades','ubicaciones.entidad_id',  '=','entidades.id' )
            ->leftjoin('localidades','ubicaciones.localidad_id',  '=','localidades.id' )
            ->leftjoin('lugares','ubicaciones.lugar_id',  '=','lugares.id' )
            ->leftjoin('sitios','ubicaciones.sitio_id',  '=','sitios.id' )
            ->select(DB::raw('registro_ubicacion_sinonimia.registro_id, registro_ubicacion_sinonimia.sinonimia_id, ubicaciones.id as ubicacion, entidades.nombre as entidad, localidades.nombre as localidad, lugares.nombre as lugar, sitios.nombre as sitio'))
            ->get();

        $col_r_u_s = collect($re_ub_si);

        $reportes = [];
//        $registros = $registross->where('especie_id', 3);
        ini_set('max_execution_time', 1500);  /* 25 min */

        foreach ($registros as $registro) {

            $reporte = null;

            $taxonomia = $this->setTaxonomia($registro->especie_id);
            $cita = $this->getCita($registro->referencia_id, $registro->tipo_referencia);

            $sus_reportes = $col_r_u_s->where('registro_id', $registro->id);

            // si no esta vacio, es decir tiene sinonimias y/o ubicaciocaiones
            if(!$sus_reportes->isEmpty()) {

                $porSinonimias = $sus_reportes->groupBy('sinonimia_id');

                foreach ($porSinonimias as $s_id => $grupo_sinonimia) {

                    $sinonmia= null;

                    if ($s_id != null) {
                        $sinonmia_obj = Sinonimia::find($s_id);
                        $sinonmia = $this->getSinonimia($sinonmia_obj);
                    }

                    $porEntidad = $grupo_sinonimia->groupBy('entidad');

                    foreach ($porEntidad as $e => $ubicaciones) {

                        $entidad = $ubicacion = null;

                        if ($e != null) {
                            $entidad = $e;

                            $porLocalidad = $ubicaciones->groupBy('localidad');

                            foreach ($porLocalidad as $localidad =>$ubicacionesL) {

                                if($localidad != null) {

                                    $porLugar = $ubicacionesL->groupBy('lugar');
                                    $lugares = null;

                                    foreach ($porLugar as $lugar => $ubicacionesLu) {

                                        if ($lugar != null) {

                                            $porSitio = $ubicacionesLu->groupBy('sitio');
                                            $sitios = null;

                                            foreach ($porSitio as $sitio =>$ubicacionesS) {

                                                if($sitio != null){

                                                    if($sitios != null){
                                                        $sitios .= ', '.$sitio;
                                                    }else{
                                                        $sitios = $sitio;
                                                    }
                                                }
                                            }

                                            if($sitios != null){
                                                $sitios = ': '.$sitios;
                                                $lugar .= $sitios;
                                            }


                                            if ($lugares != null) {
                                                $lugares .= ' / ' . $lugar;
                                            }else{
                                                $lugares = $lugar;
                                            }
                                        }
                                    }

                                    if($lugares != null){
                                        $lugares = '('.$lugares.')';
                                        $localidad .=' '.$lugares;
                                    }


                                    if ($ubicacion != null) {
                                        $ubicacion = $ubicacion . ' || ' . $localidad;
                                    } else {
                                        $ubicacion = $localidad;
                                    }
                                }
                            }
                        }
                        $reporte = $this->setReporte($taxonomia, $cita, $sinonmia, $entidad, $ubicacion);
                        array_push($reportes, $reporte);
                    }

                }

            }else{
                $reporte = $this->setReporte($taxonomia, $cita, null, null, null);
                array_push($reportes, $reporte);
            }
        }

        return $reportes;

    }

    public function setTaxonomia($especie_id)
    {
        $taxonomia = $this->especieDatos(null, $especie_id, true);

        return $taxonomia;

    }

    public function getCita($referencia_id, $tipo)
    {
        switch($tipo)
        {
            case "R":
                $referencia = Revista::find($referencia_id);
                break;

            case "L":
                $referencia = Libro::find($referencia_id);
                break;

            case "C":
                $referencia = Catalogo::find($referencia_id);
                break;

            case "T":
                $referencia = Trabajo::find($referencia_id);
                break;

            case "E":
                $referencia = Enlace::find($referencia_id);
                break;
        }

        $cita = $referencia['cita'].', '.$referencia['fecha'];

        return $cita;
    }

    public function getSinonimia($sinonimia_obj)
    {
        $sinonimia = $this->especieDatos($sinonimia_obj, null, false);

        return $sinonimia['nombre'].' '.$sinonimia['autor'];
    }

    public function setReporte($taxonomia, $cita, $sinonimia, $entidad, $ubicacion)
    {
        $reporte[0] = $taxonomia['phylum'];
        $reporte[1] = $taxonomia['clase'];
        $reporte[2] = $taxonomia['subclase'];
        $reporte[3] = $taxonomia['orden'];
        $reporte[4] = $taxonomia['familia'];
        $reporte[5] = $taxonomia['genero'];
        $reporte[6] = $taxonomia['especifico'];
        $reporte[7] = $taxonomia['varietal'];
        $reporte[8] = $taxonomia['forma'];
        $reporte[9] = $taxonomia['autor'];
        $reporte[10] = $sinonimia;
        $reporte[11] = $cita;
        $reporte[12] = $entidad;
        $reporte[13] = $ubicacion;

        return $reporte;
    }


}