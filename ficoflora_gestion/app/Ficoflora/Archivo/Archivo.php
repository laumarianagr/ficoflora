<?php namespace App\Ficoflora\Archivo;


use App\Ficoflora\Funcionalidades\Respuesta;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class Archivo  {

    public $error = false;
    public $log;

    /**
     * Guardamos temporalmente el archivo.
     *
     * @param $archivo
     * @return string
     */
    public static function guardar($archivo)
    {
        $extension = $archivo->getClientOriginalExtension();
        $nombreArchivo = $archivo->getFilename() . '.' . $extension;

        Storage::disk('local')->put($nombreArchivo,  $archivo);

        return $nombreArchivo;

    }


    /**
     * Verifica que de acuerdo al tipo de archivo (especies, referencias, etc),
     * estos tengan las columnas necesarias con los nombres establecidos.
     *
     * @param $archivo
     * @return bool
     */
    public  function revisarFormato($archivo, $tipo_archivo)
    {


        Excel::selectSheetsByIndex(0)->load($archivo, function($reader) use ($tipo_archivo) {

            $reader->noHeading();

            $firstrow = $reader->first()->toArray();

        /*
         *Normalizando los nombres de las columnas (eliminamos acentos,espacios y Ñ)
         */
            $originales ='áéíóú ñ';
            $modificadas ='aeiou_n';

            for($i=0; $i < count($firstrow); $i++){
                $cadena = $firstrow[$i];
                $cadena = utf8_decode($cadena);
                $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
                $cadena = strtolower($cadena);
                $firstrow[$i] = utf8_encode($cadena);
            }

        /*
         * Revisamos que el archivo tiene todas las columnas que se piden
         * y que sus nombres corresponden con los establecidos
         */

            switch($tipo_archivo)
            {
                case "registros":
                    if (count($firstrow) >= 15) {
                        if (($firstrow[0] == 'phylum') && ($firstrow[1] == 'clase') && (($firstrow[2] == 'subclase')
                                && ($firstrow[3] == 'orden') && ($firstrow[4] == 'familia') && ($firstrow[5] == 'genero')
                                && ($firstrow[6] == 'especie') && ($firstrow[7] == 'variedad') && ($firstrow[8]) == 'forma')
                            && ($firstrow[9] == 'autor') && ($firstrow[10] == 'sinonimia') && ($firstrow[11] == 'cita')
                            && ($firstrow[12] == 'entidad_federal') && ($firstrow[13] == 'localidad') && ($firstrow[14] == 'comentario')
                        ) {
                            $this->log = "Archivo de Registros para el Catálogo con estructura correcta";
                            $this->error = false;
                        } else {
                            $this->log = "NOMBRE de columnas inválidas";
                            $this->error =  true;
                        }
                    } else {
                        $this->log = "NÚMERO de columnas inválidas";
                        $this->error =  true;
                    }
                    break;


                case "libros":
                    if (count($firstrow) >= 16) {
                        if (($firstrow[0] == 'cita') && ($firstrow[1] == 'autores') && (($firstrow[2] == 'fecha')
                                && ($firstrow[3] == 'titulo_libro') && ($firstrow[4] == 'edicion') && ($firstrow[5] == 'editorial')
                                && ($firstrow[6] == 'lugar') && ($firstrow[7] == 'total_de_paginas') && ($firstrow[8]) == 'titulo_capitulo')
                            && ($firstrow[9] == 'editor') && ($firstrow[10] == 'intervalo_de_paginas') && ($firstrow[11] == 'isbn')
                            && ($firstrow[12] == 'doi') && ($firstrow[13] == 'enlace')&& ($firstrow[14] == 'archivo')  && ($firstrow[15] == 'comentarios')
                        ) {
                            $this->log = 'Archivo de Referencias de Libros con estructura correcta';
                            $this->error = false;
                        } else {
                            $this->log = "NOMBRE de columnas inválidas";
                            $this->error = true;
                        }
                    } else {
                        $this->log = "NÚMERO de columnas inválidas";
                        $this->error = true;
                    }
                    break;


                case "revistas":
                    if (count($firstrow) >= 14) {
                        if (($firstrow[0] == 'cita') && ($firstrow[1] == 'autores') && (($firstrow[2] == 'fecha')
                                && ($firstrow[3] == 'titulo') && ($firstrow[4] == 'nombre_revista') && ($firstrow[5] == 'volumen')
                                && ($firstrow[6] == 'numero') && ($firstrow[7] == 'intervalo_de_paginas') && ($firstrow[8]) == 'isbn')
                            && ($firstrow[9] == 'issn') && ($firstrow[10] == 'doi') && ($firstrow[11] == 'enlace')
                            && ($firstrow[12] == 'archivo') && ($firstrow[13] == 'comentarios')
                        ) {
                            $this->log = 'Archivo de Referencias de Revistas con estructura correcta';
                            $this->error = false;
                        } else {
                            $this->log = "NOMBRE de columnas inválidas";
                            $this->error = true;
                        }
                    } else {
                        $this->log = "NÚMERO de columnas inválidas";
                        $this->error = true;
                    }
                    break;


                case "trabajos":
                    if (count($firstrow) >= 11) {
                        if (($firstrow[0] == 'tipo') && ($firstrow[1] == 'cita') && ($firstrow[2] == 'autores') && ($firstrow[3] == 'fecha')
                                && ($firstrow[4] == 'titulo') && ($firstrow[5] == 'institucion') && ($firstrow[6] == 'lugar')
                                && ($firstrow[7] == 'paginas') && ($firstrow[8] == 'enlace') && ($firstrow[9] == 'archivo')  && ($firstrow[10] == 'comentarios')
                            ) {
                            $this->log = 'Archivo de Referencias de Revistas con estructura correcta';
                            $this->error = false;
                        } else {
                            $this->log = "NOMBRE de columnas inválidas";
                            $this->error = true;
                        }
                    } else {
                        $this->log = "NÚMERO de columnas inválidas";
                        $this->error = true;
                    }
                    break;

                case "enlaces":
                    if (count($firstrow) >= 11) {
                        if (($firstrow[0] == 'cita') && ($firstrow[1] == 'autores') && ($firstrow[2] == 'fecha') && ($firstrow[3] == 'nombre_pagina')
                                && ($firstrow[4] == 'titulo') && ($firstrow[5] == 'institucion') && ($firstrow[6] == 'lugar')
                                && ($firstrow[7] == 'direccion_web') && ($firstrow[8] == 'dia_consulta') && ($firstrow[9] == 'mes_consulta')  && ($firstrow[10] == 'ano_consulta')
                            ) {
                            $this->log = 'Archivo de Referencias de Revistas con estructura correcta';
                            $this->error = false;
                        } else {
                            $this->log = "NOMBRE de columnas inválidas";
                            $this->error = true;
                        }
                    } else {
                        $this->log = "NÚMERO de columnas inválidas";
                        $this->error = true;
                    }
                    break;


                case "coordenadas":
                    if (count($firstrow) >= 6) {
                        if (($firstrow[0] == 'entidad') && ($firstrow[1] == 'localidad') && ($firstrow[2] == 'lugar') && ($firstrow[3] == 'sitio')
                                && ($firstrow[4] == 'latitud') && ($firstrow[5] == 'longitud')
                            ) {
                            $this->log = 'Archivo de Coordenadas con estructura correcta';
                            $this->error = false;
                        } else {
                            $this->log = "NOMBRE de columnas inválidas";
                            $this->error = true;
                        }
                    } else {
                        $this->log = "NÚMERO de columnas inválidas";
                        $this->error = true;
                    }
                    break;

                default:
                    $this->log = "Error en el tipo de archivo";
                    $this->error = true;
            }





        });

        $respuesta = ['error' => $this->error, 'log' => $this->log];

        return $respuesta;
    }




    /**
     * Extraemos los datos del archivo de Excel y lo pasamos a un arreglo.
     *
     * @param $archivo
     * @return array
     */
    public static function extraerDatos($archivo)
    {
        // extendemos el tiempo de procesamiento hasta 5 minutos
        ini_set('max_execution_time', 10000);

        $datos = Array();

        Excel::selectSheetsByIndex(0)->load($archivo, function ($reader) use (&$datos){

//            $results = $reader->all();
            $results = $reader->skip(1);//fila que indica que campos son opcionales
            $datos = $results->toArray();

        });

        return $datos;


    }

}