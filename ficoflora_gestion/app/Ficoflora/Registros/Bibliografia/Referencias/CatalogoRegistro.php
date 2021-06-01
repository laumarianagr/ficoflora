<?php
/**
 * Created by PhpStorm.
 * User: maria-pinzon
 * Date: 31/07/2015
 * Time: 18:21
 */

namespace App\Ficoflora\Registros\Bibliografia\Referencias;

use App\Ficoflora\Funcionalidades\Referencias;
use App\Ficoflora\Funcionalidades\ReferenciasTrait;
use App\Modelos\Bibliografia\Cita;
use App\Modelos\Bibliografia\Referencias\Catalogo;

class CatalogoRegistro extends Referencias {

    use ReferenciasTrait;

    function __construct($datos, $tipo_registro, $creador_id) {

        $this->autores = $datos['autores'];
        $this->fecha = $datos['fecha'];
        $this->cita = $datos['cita'];
        $this->letra = $datos['letra'];
        $this->titulo = $datos['titulo'];
        $this->nombre = $datos['nombre'];       // catálogo en revista
        $this->edicion = $datos['edicion'];                     // catálogo en libro
        $this->editor_editorial = $datos['editor_editorial'];   // catálogo en libro
        $this->lugar = $datos['lugar'];                         // catálogo en libro
        $this->volumen = $datos['volumen'];     // catálogo en revista
        $this->numero = $datos['numero'];       // catálogo en revista
        $this->paginas = $datos['paginas'];
        $this->isbn = $datos['isbn'];
        $this->doi = $datos['doi'];
        $this->archivo = null;
//        $this->archivo = $datos['archivo'];
        $this->comentarios = $datos['comentarios'];


        $this->tipo_registro = $tipo_registro;

        if($tipo_registro == 'form'){
            $this->intervalo_1 = $datos['intervalo_1'];
            $this->intervalo_2 = $datos['intervalo_2'];
        }

        if($tipo_registro == 'archivo'){
            $this->intervalo = $datos['paginas'];
        }

        $this->creador_id = $creador_id;
    }


    public function nuevoCatalogo()
    {
        list($registro, $cita) = $this->getCatalogo();

//        dd($registro);
        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro, 'cita' => $cita];
        return $respuesta;
    }


    public function getCatalogo()
    {

        if($this->tipo_registro == 'form'){
            $obj_cita = $this->formatoFormulario();
        }else{
            $obj_cita = $this->formatoArchivo();
        }

        if($this->error){
            return array(null, null);
        }

        return array( new Libro([
            'autores' => $this->autores,
            'fecha' => $this->fecha,
            'cita' => $this->cita,
            'cita_html' => $this->cita_html,
            'letra' => $this->letra,
            'titulo' => $this->titulo,
            'nombre' => $this->nombre,
            'edicion' => $this->edicion,
            'editor_editorial' => $this->editor_editorial,
            'lugar' => $this->lugar,
            'volumen' => $this->volumen,
            'numero' => $this->numero,
            'intervalo' => $this->intervalo,
            'isbn' => $this->isbn,
            'doi' => $this->doi,
            'archivo' => $this->archivo,
            'comentarios' => $this->comentarios,
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
            return;
        }else{
            $this->existe = false;
            $this->cita = $citas['cita'];
            $this->cita_html = $citas['cita_html'];            
        }

        //revisa si ya existe la cita
//        $ultima_cita = Libro::where('cita', $citas['cita'])->conFecha($this->fecha)->orderBy('letra')->get()->last();
        $ultima_cita = Cita::where('autores', $this->cita)->conFecha($this->fecha)->orderBy('letra')->get()->last();

        //si existe agregar la letra que corresponde
        if($ultima_cita != null) {
            $this->letra = $this->getLetra($ultima_cita->letra);

        }
            $ultima_cita = new Cita([
                'autores' => $this->cita,
                'fecha' => $this->fecha,
                'letra' => $this->letra,
                'tipo' => 'C'
            ]);


        if($this->intervalo_1!= null){
            $this->intervalo = $this->intervalo_1.'-'.$this->intervalo_2;
        }
//        dd($ultima_cita);
        return $ultima_cita;
    }

    public function formatoArchivo()
    {

        $respuesta = $this->getCitaArchivo($this->cita);

        $this->cita = $respuesta['autores'];
        $this->cita_html = $respuesta['cita_html'];
        $this->fecha = $respuesta['fecha'];
        $this->letra = $respuesta['letra'];


        //revisa si ya existe la cita
//        $cita = Libro::where('cita', $this->cita)->conFecha($this->fecha)->conLetra($this->letra)->first();

        $cita = Cita::where('autores', $this->cita)->conFecha($this->fecha)->conLetra($this->letra)->first();

        if($cita != null){
            $this->error = true;
            $this->existe = true;
            $this->log = ['error'=>"La cita ya existe, si la referecia del sistema es diferente de la que suministra, agregue o cambie la letra a la fecha de la cita.",'tipo'=>'Cita'];
            return null;
        }else{

            $cita = new Cita([
                'autores' => $this->cita,
                'fecha' => $this->fecha,
                'letra' => $this->letra,
                'tipo' => 'L'
            ]);

            $this->existe = false;
        }

        return $cita;

    }

}