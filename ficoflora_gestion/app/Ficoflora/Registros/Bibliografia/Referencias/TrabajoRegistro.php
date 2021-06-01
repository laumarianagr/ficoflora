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
use App\Modelos\Bibliografia\Referencias\Trabajo;

class TrabajoRegistro extends Referencias {

    use ReferenciasTrait;

    function __construct($datos,$tipo_registro, $creador_id) {

        $this->tipo = $datos['tipo'];
        $this->autores = $datos['autores'];
        $this->fecha = $datos['fecha'];
        $this->cita = $datos['cita'];
        $this->titulo = $datos['titulo'];
        $this->lugar = $datos['lugar'];
        $this->institucion = $datos['institucion'];
        $this->paginas = $datos['paginas'];
        $this->enlace = $datos['enlace'];
        $this->archivo = null;
//        $this->archivo = $datos['archivo'];
        $this->comentarios = $datos['comentarios'];
        $this->tipo_registro = $tipo_registro;

        $this->creador_id = $creador_id;


    }

    public function nuevoTrabajo()
    {
        list($registro, $cita)  = $this->getTrabajo();

        $respuesta = ['error' => $this->error, 'log' => $this->log, 'existe' => $this->existe, 'registro' => $registro, 'cita' => $cita];

        return $respuesta;
    }


    public function getTrabajo()
    {

        if($this->tipo_registro == 'form'){
            $obj_cita = $this->formatoFormulario();
        }else{
            $obj_cita = $this->formatoArchivo();
        }

        if($this->error){
            return array(null, null);
        }



        return array(new Trabajo([
            'tipo' => $this->tipo,
            'autores' => $this->autores,
            'fecha' => $this->fecha,
            'cita' => $this->cita,
            'cita_html' => $this->cita_html,
            'letra' => $this->letra,
            'titulo' => $this->titulo,
            'institucion' => $this->institucion,
            'lugar' => $this->lugar,
            'paginas' => $this->paginas,
            'enlace' => $this->enlace,
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

        $this->cita = $respuesta['autores'];
        $this->cita_html = $respuesta['cita_html'];
        $this->fecha = $respuesta['fecha'];
        $this->letra = $respuesta['letra'];

        //revisa si ya existe la cita
//        $cita = Trabajo::where('cita', $this->cita)->conFecha($this->fecha)->conLetra($this->letra)->first();
        $cita = Cita::where('autores', $this->cita)->conFecha($this->fecha)->orderBy('letra')->get()->last();

        if($cita != null){

            $this->error = true;
            $this->existe = true;
            $this->log = ['error'=>"La cita ya existe, si la referecia del sistema es diferente de la que suministra, agregue o cambie la letra a la fecha de la cita.",'tipo'=>'Cita'];

            return;

        }else{
            $this->existe = false;
            $cita = new Cita([
                'autores' => $this->cita,
                'fecha' => $this->fecha,
                'letra' => $this->letra,
                'tipo' => 'T'
            ]);
        }

        $this->tipo = $this->getTipo();

        return $cita;

    }



    public function getTipo()
    {
        $tipo = strtolower($this->tipo);

        switch($tipo){

            case 'pregrado':
                $tipo = 'Trabajos Especiales de Grado (Licenciatura)';
                break;
            case 'maestria':
                $tipo = 'Tesis de Grado (Maestría)';
                break;
            case 'doctorado':
                $tipo = 'Tesis (Doctorado)';
                break;
            case 'ascenso':
                $tipo = 'Monografías de Trabajos de Ascenso';
                break;
            default:
                $this->log = ['error'=>"El tipo de documento no es válido, opciones aceptadas pregrado, maestria, doctorado o ascenso",'tipo'=>'Cita'];
                $this->error = true;
                return;
        }

        return $tipo;

    }
}