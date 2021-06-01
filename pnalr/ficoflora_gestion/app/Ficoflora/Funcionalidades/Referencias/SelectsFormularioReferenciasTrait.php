<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 03/10/2015
 * Time: 21:53
 */

namespace App\Ficoflora\Funcionalidades\Referencias;


trait SelectsFormularioReferenciasTrait {


    public function citaCantidadAutores()
    {
        $cita_autores = Array(
            null => 'seleccione la cantidad de autores',
            '1' => '1 autor',
            '2' => '2 autores',
            '3' => '3 o más autores',

        );

        return $cita_autores;


    }

    public function tipoTrabajos()
    {
        $tipo_trabajos = Array(
            null => 'seleccione el tipo de trabajo',
            'pregrado'=> 'Trabajos Especiales de Grado (Licenciatura), ',
            'maestria'=> 'Tesis de Grado (Maestría)',
            'doctorado'=> 'Tesis (Doctorado)',
            'ascenso'=> 'Monografías de Trabajos de Ascenso',

        );

        return $tipo_trabajos;
    }
    public function fechas()
    {
//
        //fecha referencia
        $fecha_actual = date('Y');
//        $rango = range( 1800, $fecha_actual);
        $rango = range($fecha_actual,  1800);
        $fecha = array_combine($rango, $rango);
        $fecha[null]='seleccione una fecha';
//        ksort($fecha);


        //año enlace
//        $rango = range( 1980,$fecha_actual);
        $rango = range( $fecha_actual, 1980);
        $fecha_ano = array_combine($rango, $rango);
        $fecha_ano[null]='seleccione el año';
//        ksort($fecha_ano);


        //dia enlace
        $rango = range(1,31);
        $fecha_dia = array_combine($rango, $rango);
        $fecha_dia[null]='seleccione el día';
        ksort($fecha_dia);

        //mes enlace
        $fecha_mes = Array(
            null => 'seleccione el mes',
            'Enero'=> 'Enero',
            'Febrero'=> 'Febrero',
            'Marzo'=> 'Marzo',
            'Abril'=> 'Abril',
            'Mayo'=> 'Mayo',
            'Junio'=> 'Junio',
            'Julio'=> 'Julio',
            'Agosto'=> 'Agosto',
            'Septiembre'=> 'Septiembre',
            'Octubre'=> 'Octubre',
            'Noviembre'=> 'Noviembre',
            'Diciembre'=> 'Diciembre',
        );

        return [$fecha, $fecha_ano, $fecha_mes, $fecha_dia ];
    }
}