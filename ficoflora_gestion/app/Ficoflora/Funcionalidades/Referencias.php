<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 31/07/2015
 * Time: 21:33
 */

namespace App\Ficoflora\Funcionalidades;


class Referencias extends Respuesta{

    public $creador_id;

    public $autores;
    public $fecha;
    public $cita;
    public $cita_html;
    public $letra= null;
    public $titulo;
    public $tipo_registro;

    public $intervalo = null;
    public $intervalo_1;
    public $intervalo_2;

    public $isbn;
    public $issn;
    public $doi;

    public $enlace;
    public $archivo;


    //libro
    public $edicion;
    public $editorial;
    public $capitulo;
    public $editor;

    //revista
    public $volumen;
    public $numero;
    public $comentarios;

    //catalogo
    public $editor_editorial;

    //trabajo
    public $tipo;

    //enlace
    public $dia;
    public $mes;
    public $ano;

    //libro, trabajo, enlace
    public $lugar;

    //libro, trabajo
    public $paginas;

    //trabajo, enlace
    public $institucion;

    //revista, enlace
    public $nombre;

}