<?php


namespace App\Ficoflora\Especies;

use App\Ficoflora\Referencias\ReferenciasTrait;
use App\Ficoflora\Sinonimias\SinonimiasTrait;
use App\Ficoflora\Funcionalidades\NombresTrait;

use App\Modelos\Catalogo\Registro;
use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;
use App\Modelos\Geografico\Ubicacion;

use Illuminate\Support\Facades\DB;


trait ReportesReferenciasTrait {

    use SinonimiasTrait;
    use ReferenciasTrait;

    public function getReferenciaTextoPorId($id, $tipo){

        if ($tipo == 'r') {//consulta para un artículo específico en Revista
            $referencia = Revista::find($id);
            $tipo = "Artículo en Revista";
            return view('listados.referencias.referencia', compact('tipo', 'referencia'));

        }elseif ($tipo == 'l') {//consulta para una referencia en un Libro
            $referencia = Libro::find($id);
            $tipo = "Libro";
            return view('listados.referencias.referencia', compact('tipo', 'referencia'));

        }elseif ($tipo == 'c') {//consulta para una referencia en un Catálogo
            $referencia = Catalogo::find($id);
            $tipo = "Catálogo";
            return view('listados.referencias.referencia', compact('tipo', 'referencia'));

        }elseif ($tipo == 'e') {//consulta para una referencia en un Sitio Web
            $referencia = Enlace::find($id);
            $tipo = "Sitio Web";
            return view('listados.referencias.referencia', compact('tipo', 'referencia'));

        }elseif ($tipo == 't') {//consulta para una referencia en un Trabajo Académico
            $referencia = Trabajo::find($id)
                ->where('comentarios', 'not LIKE', '%NSM%')
                ->orwhereNull('comentarios');
            $tipo = "Trabajo Académico";
            return view('listados.referencias.referencia', compact('tipo', 'referencia'));
        }
    }

    public function getEliminarHTML($texto)
    {
        $texto = str_replace('<i>', '', $texto);
        $texto = str_replace('</i>', '', $texto);
        $texto = str_replace('<b>', '', $texto);
        $texto = str_replace('</b>', '', $texto);
        $texto = str_replace('<em>', '', $texto);
        $texto = str_replace('</em>', '', $texto);
        $texto = str_replace('<br/>', '', $texto);
        $texto = str_replace('<br />', '', $texto);
    return $texto;
    }

    public function getReportesReferenciasEspecie($id)
    {

        //obtengo todos los registros asociados con la especie (relacion especie_id, referencia_id)
        $registros = Registro::where('especie_id', $id)->get();

        $citas_reportes = Array();
        $referencias = Array();
        $ubicaciones_ids = Array();


        foreach ($registros as $registro) {// id (registro), especie_id, referencia_id

            $referencia_id = $registro->referencia_id;
            $tipo_referencia = $registro->tipo_referencia;

            $obj_referencia = $this->getReferenciaPorTipo($referencia_id, $tipo_referencia);  //obtiene el obj referencia, de acuerdo al tipo
            array_push($referencias, ['referencia' => $obj_referencia, 'tipo' =>$tipo_referencia]);//Guardamos en un arreglo todas las referencias de la especie

            //NIVEL A
            $autor = $obj_referencia['cita'];$et = 'et al.'; $et2 = '<i>et al.</i>';
            $cita_reporte['cita'] =str_replace($et, $et2, $autor);
            $cita_reporte['fecha'] = $obj_referencia['fecha'];
            $cita_reporte['letra'] = $obj_referencia['letra'];
            $cita_reporte['referencia_id'] = $registro->referencia_id;
            $cita_reporte['comentario'] = $registro->comentario;

            $texto = trim($cita_reporte['cita']) .', '. $cita_reporte['fecha'] . $cita_reporte['letra'] .'. '.
                    $this->getTextoReferenciaTooltip($referencia_id, $tipo_referencia);
            $cita_reporte['referencia'] =  $this->getEliminarHTML($texto);

            $reportes = Array();

            //Trae todas las filas de la tabla registro_ubicacion_sinonimia con el registro id del reporte
            $re_ub_si = DB::table('registro_ubicacion_sinonimia')->where('registro_id', $registro->id)->get();
            $col = collect($re_ub_si);


            //registro_ubicacion_sinonimia que pertenecen al reporte ordenados y agrupados por sinonimias
            $by_sinonimias = $col->sortBy('sinonimia_id')->groupBy('sinonimia_id');

            foreach ($by_sinonimias as $sinonimia_id =>$values_r_u_s) {//$values_r_u_s registro, ubicacion, sinonimia ids

                if($sinonimia_id != null){
                    //Nivel C-1
                    list($sinonimia['nombre'], $sinonimia['autor'])= $this->getSinonimia($sinonimia_id, null);
                }else{
                    $sinonimia=[];// no posee sinonimia
                }

                //NIVEL B
                $reporte['sinonimia'] = $sinonimia;

                $ubicaciones = Array();

                foreach ($values_r_u_s as $val) {

                    if($val->ubicacion_id != null) {//el registro posee ubicaciones

                        $ubicacion = Ubicacion::find($val->ubicacion_id);

                        $obj = [
                            'entidad' => $ubicacion['entidad_id'],
                            'localidad' => $ubicacion['localidad_id'],
                            'lugar' => $ubicacion['lugar_id'],
                            'sitio' => $ubicacion['sitio_id'],
                            'id' => $ubicacion['id']

                        ];
                        array_push($ubicaciones, $obj);
                        array_push($ubicaciones_ids, $ubicacion['id']);//Guardamos todos los ids de ubicaciones que se usan, para la funcionalidad de los mapas

                    }
                }

                $ubicacion_nombres = Array();

                //Ordenamos las ubicaciones por localidades
                $by_localidades = collect($ubicaciones)->groupBy('localidad');


                foreach ($by_localidades as $keyL=>$values_ubicacion) {

                    $ubicacion = Array();
                    $lugares = Array();

                    if($keyL != null){//Posee localidades

                        //Nivel C-2
                        $ubicacion['entidad'] =  Entidad::find($values_ubicacion[0]['entidad'])->nombre;
                        $ubicacion['entidad_id'] =  $values_ubicacion[0]['entidad'];
                        $ubicacion['localidad'] =  Localidad::find($keyL)->nombre;
                        $ubicacion['localidad_id'] =  $keyL;

                        //ordenamos las unicaciones por lugares
                        $by_lugares = collect($values_ubicacion->groupBy('lugar'));

                        foreach ($by_lugares as $keyLug => $valuesL) {

                            $lugar = Array();

                            if($keyLug != null) {//posee lugares

                                //Nivel D
                                $lugar['lugar'] = Lugar::find($keyLug)->nombre;
                                $lugar['lugar_id'] = $keyLug;
                                $sitios = Array();

                                foreach ($valuesL as $valueS) {
                                    if($valueS['sitio']!= null){//posee sitios
                                        //Nivel E
                                        $sitio['sitio'] = Sitio::find($valueS['sitio'])->nombre;
                                        $sitio['sitio_id'] = $valueS['sitio'];
                                        $sitio['ubicacion_id'] = $valueS['id'];//id de la ubicacion
                                        array_push($sitios, $sitio);
                                    }else{
                                        //Nivel D
                                        $lugar['ubicacion_id'] = $valuesL[0]['id'];//id de la ubicacion
                                    }
                                }

                                //Nivel D
                                $lugar['sitios'] = $sitios;
                                array_push($lugares, $lugar);
                            }else{
                                //Nivel C-2
                                $ubicacion['ubicacion_id'] =  $valuesL[0]['id'];//id de la ubicacion

                            }
                        }

                        //Nivel C-2
                        $ubicacion['lugares']= $lugares;
                        array_push($ubicacion_nombres, $ubicacion);//Objeto con Entidad Localidad y [] de lugares y sitios

                    }else{

                        //Como se están agrupando por localidad todos los que solo tienen entidad quedan junto en
                        // el grupo de localidad null, por lo que hay que procesarlas a parte
                        foreach ($values_ubicacion as $val_ubi) {

                            $ubicacion['ubicacion_id'] =  $val_ubi['id'];//id de la ubicacion
                            $ubicacion['entidad_id'] =  Entidad::find($val_ubi['entidad'])->id;
                            $ubicacion['entidad'] =  Entidad::find($val_ubi['entidad'])->nombre;
                            $ubicacion['localidad'] = null;
                            $ubicacion['lugares']= [];
                            array_push($ubicacion_nombres, $ubicacion);//Objeto con Entidad Localidad y [] de lugares y sitios
                        }
                    }
                }


                //NIVEL B
                $reporte['ubicaciones'] = $ubicacion_nombres;
                array_push($reportes, $reporte);
            }

            //NIVEL A
            $cita_reporte['reportes'] = $reportes;
            array_push($citas_reportes, $cita_reporte);

        }

        $col_ref= collect($citas_reportes);
        $citas_reportes= $col_ref->sortByDesc('fecha');

        //Formato texto html a las referencias
//        dd($citas_reportes);
        return [$citas_reportes, $referencias, $ubicaciones_ids];
    }
}