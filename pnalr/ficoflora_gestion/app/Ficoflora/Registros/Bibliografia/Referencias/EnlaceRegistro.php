<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 01/08/2015
 * Time: 16:15
 */

namespace App\Ficoflora\Registros\Bibliografia\Referencias;


use App\Ficoflora\Funcionalidades\Referencias;
use App\Ficoflora\Funcionalidades\ReferenciasTrait;
use App\Modelos\Bibliografia\Cita;
use App\Modelos\Bibliografia\Referencias\Enlace;
use App\Modelos\Bibliografia\Referencias\Trabajo;

class EnlaceRegistro extends Referencias {

    use ReferenciasTrait;

    function __construct($datos,$tipo_registro, $creador_id) {

        $this->cita = $datos['cita'];
        $this->autores = $datos['autores'];
        $this->fecha = $datos['fecha'];
        $this->nombre = $datos['nombre_pagina'];
        $this->titulo = $datos['titulo'];
        $this->lugar = $datos['lugar'];
        $this->institucion = $datos['institucion'];
        $this->enlace = $datos['direccion_web'];
        $this->dia = $datos['dia_consulta'];
        $this->mes = $datos['mes_consulta'];
        $this->ano = $datos['ano_consulta'];
        $this->creador_id = $creador_id;
        $this->tipo_registro = $tipo_registro;


    }

    public function nuevoEnlace()
    {
        list($registro, $cita)  = $this->getEnlace();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro, 'cita' => $cita];

        return $respuesta;
    }


    public function getEnlace()
    {

        if($this->tipo_registro == 'form'){
            $obj_cita = $this->formatoFormulario();
        }else{
            $obj_cita = $this->formatoArchivo();
        }

        if($this->error){
            return array(null, null);
        }



        return array(new Enlace([
            'cita' => $this->cita,
            'autores' => $this->autores,
            'fecha' => $this->fecha,
            'nombre' => $this->nombre,
            'titulo' => $this->titulo,
            'institucion' => $this->institucion,
            'lugar' => $this->lugar,
            'enlace' => $this->enlace,
            'dia' => $this->dia,
            'mes' => $this->mes,
            'ano' => $this->ano,
            'creador_id' => $this->creador_id

        ]), $obj_cita);

    }

    public function formatoFormulario()
    {
        //crea la cita
        $citas = $this->getCita($this->autores, $this->cita);

        if($citas['cita'] == false){
            $this->error = true;
            $this->log = "Formato de Autores invalido";
            return null;
        }else{
            $this->existe = false;
            $this->cita = $citas['cita'];
            $this->cita_html = $citas['cita_html'];
        }


        //revisa si ya existe la cita
//        $ultima_cita = Trabajo::where('cita', $citas['cita'])->conFecha($this->fecha)->orderBy('letra')->get()->last();
        $ultima_cita = Cita::where('autores', $this->cita)->conFecha($this->fecha)->orderBy('letra')->get()->last();

        //si existe agregar la letra que corresponde
        if($ultima_cita != null) {
            $this->letra = $this->getLetra($ultima_cita->letra);
        }

        $ultima_cita = new Cita([
                'autores' => $this->cita,
                'fecha' => $this->fecha,
                'letra' => $this->letra,
                'tipo' => 'T'
            ]);


        $this->tipo = $this->getTipo();

        return $ultima_cita;
    }

    public function formatoArchivo()
    {
        $respuesta = $this->getCitaArchivo($this->cita);
//        dd($respuesta);
        if (!$respuesta['error']) {

            $this->cita = $respuesta['autores'];
            $this->cita_html = $respuesta['cita_html'];
            $this->fecha = $respuesta['fecha'];
            $this->letra = $respuesta['letra'];

            //revisa si ya existe la cita
//        $cita = Trabajo::where('cita', $this->cita)->conFecha($this->fecha)->conLetra($this->letra)->first();
            $cita = Cita::where('autores', $this->cita)->conFecha($this->fecha)->orderBy('letra')->get()->last();

            if ($cita != null) {

                $this->error = true;
                $this->existe = true;
                $this->log = ['error' => "La cita ya existe, si la referecia del sistema es diferente de la que suministra, agregue o cambie la letra a la fecha de la cita.", 'tipo' => 'Cita'];

                return;

            } else {
                $this->existe = false;
                $cita = new Cita([
                    'autores' => $this->cita,
                    'fecha' => $this->fecha,
                    'letra' => $this->letra,
                    'tipo' => 'E'
                ]);
            }
        }else{
            $this->error = true;
            $this->log = ['error' => "Formato de cita incorrecto.", 'tipo' => 'Cita'];

            return null;
        }



        return $cita;

    }



}