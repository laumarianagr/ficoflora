<?php
/**
 * Created by PhpStorm.
 * User: Lupita
 * Date: 26/09/2015
 * Time: 19:32
 */

namespace App\Ficoflora\Archivo\Exportar;


use App\Ficoflora\Archivo\Exportar\Bibliografia\LibrosExportar;
use App\Ficoflora\Archivo\Exportar\Bibliografia\RevistasExportar;
use App\Ficoflora\Archivo\Exportar\Bibliografia\TrabajosExportar;
use App\Ficoflora\Archivo\Exportar\Catalogo\ReportesExportar;

use App\Ficoflora\Archivo\Exportar\Geografico\CoordenadasExportar;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class Exportar
{

    use ReportesExportar;
    use CoordenadasExportar;
    use RevistasExportar;
    use LibrosExportar;
    use TrabajosExportar;

    //REPORTES AL CATÁLOGO
    public function catalogo($modelo)
    {
        if($modelo){
            $data = [];
        }else{

            $data = $this->getReportes();
        }

        ini_set('max_execution_time', 10000);

        Excel::create('Reportes_Catálogo_'.Carbon::create()->format('d-m-y'), function ($excel) use ($data) {

            $excel->setTitle('Reportes_Catálogo');
            $excel->setCreator('Ficoflora Venezuela');

            $excel->sheet('Sheetname', function ($sheet) use ($data) {

                $sheet->fromArray($data, null, 'A1', false, false);

                $sheet->prependRow(1, array(
                    'PHYLUM', 'CLASE', 'SUBCLASE', 'ORDEN', 'FAMILIA', 'GENERO', 'ESPECIE', 'VARIEDAD', 'FORMA', 'AUTOR', 'SINONIMIA', 'CITA', 'ENTIDAD FEDERAL', 'LOCALIDAD', 'COMENTARIO'
                ));
                $sheet->prependRow(2, array(
                    null, null, '(opcional)', null, null, null, null, '(opcional)', '(opcional)', null, '(opcional)', null, '(opcional)', '(opcional)', '(opcional)'
                ));

                $sheet->row(1, function ($row) { $row->setBackground('#eeeeee')->setFontWeight('bold');});
                $sheet->row(2, function ($row) {$row->setFontColor('#FF0000');});
                $sheet->freezeFirstRow();
            });

        })->export('xlsx');
    }


    //ARCHIVO DE COORDENADAS DE UBICACIÓN
    public function coordenadas($modelo)
    {

        if($modelo){
            $data = [];
        }else {

            $data = $this->getCoordenadas();
        }

        Excel::create('Ubicaciones_y_CoordenadasGeográficas_'.Carbon::create()->format('d-m-y'), function ($excel) use ($data) {

            $excel->setTitle('Ubicaciones_y_CoordenadasGeogéficas');
            $excel->setCreator('Ficoflora Venezuela');

            $excel->sheet('Sheetname', function ($sheet) use ($data) {

                $sheet->fromArray($data, null, 'A1', false, false);

                $sheet->prependRow(1, array(
                    'ENTIDAD', 'LOCALIDAD', 'LUGAR', 'SITIO', 'LATITUD', 'LONGITUD'
                ));
                $sheet->prependRow(2, array(
                    null, '(opcional)', '(opcional)', '(opcional)',  null, null
                ));

                $sheet->row(1, function ($row) { $row->setBackground('#eeeeee')->setFontWeight('bold');});
                $sheet->row(2, function ($row) {$row->setFontColor('#FF0000');});
                $sheet->freezeFirstRow();
            });

        })->export('xlsx');
    }

    //ARCHIVO DE REVISTAS
    public function revistas($modelo)
    {

        if($modelo){
            $data = [];
        }else {

            $data = $this->getRevistas();
        }

        Excel::create('Referencias_Revistas_'.Carbon::create()->format('d-m-y'), function ($excel) use ($data) {

            $excel->setTitle('Referencias_Revistas');
            $excel->setCreator('Ficoflora Venezuela');

            $excel->sheet('Sheetname', function ($sheet) use ($data) {

                $sheet->fromArray($data, null, 'A1', false, false);

                $sheet->prependRow(1, array(
                    'Cita', 'Autores', 'Fecha', 'Título', 'Nombre revista', 'Volumen', 'Número', 'Intervalo de páginas', 'ISBN', 'ISSN', 'DOI', 'Enlace', 'Archivo', 'Comentarios'
                ));
                $sheet->prependRow(2, array(
                    null,	null,	null,	null,	null, '(opcional)',	'(opcional)',	null,	'(opcional)',	'(opcional)',	'(opcional)',	'(opcional)',	'(opcional)',	'(opcional)'

                ));

                $sheet->row(1, function ($row) { $row->setBackground('#eeeeee')->setFontWeight('bold');});
                $sheet->row(2, function ($row) {$row->setFontColor('#FF0000');});
                $sheet->freezeFirstRow();
            });

        })->export('xlsx');
    }

    //ARCHIVO DE LIBROS
    public function libros($modelo)
    {
        if($modelo){
            $data = [];
        }else {

            $data = $this->getLibros();
        }

        Excel::create('Referencias_Libros_'.Carbon::create()->format('d-m-y'), function ($excel) use ($data) {

            $excel->setTitle('Referencias_Libros');
            $excel->setCreator('Ficoflora Venezuela');

            $excel->sheet('Sheetname', function ($sheet) use ($data) {

                $sheet->fromArray($data, null, 'A1', false, false);

                $sheet->prependRow(1, array(
                    'Cita', 'Autores', 'Fecha', 'Título libro', 'edición', 'Editorial', 'Lugar', 'Total de páginas', 'Título capítulo', 'Editor', 'Intervalo de páginas','ISBN', 'DOI', 'Enlace', 'Archivo', 'Comentarios'
                ));
                $sheet->prependRow(2, array(
                    null,	null,	null,	null, '(opcional)',	'(opcional)',	null,	null,	'(opcional)',	'(opcional) - (obligatorio si está el título capítulo)', '(opcional) - (obligatorio si está el título capítulo)',	'(opcional)',	'(opcional)',	'(opcional)',	'(opcional)',	'(opcional)'

                ));

                $sheet->row(1, function ($row) { $row->setBackground('#eeeeee')->setFontWeight('bold');});
                $sheet->row(2, function ($row) {$row->setFontColor('#FF0000');});
                $sheet->freezeFirstRow();
            });

        })->export('xlsx');
    }

    //ARCHIVO DE TRABAJOS
    public function trabajos($modelo)
    {

        if($modelo){
            $data = [];
        }else {

            $data = $this->getTrabajos();
        }

        Excel::create('Referencias_TrabajosAcadémicos_'.Carbon::create()->format('d-m-y'), function ($excel) use ($data) {

            $excel->setTitle('Referencias_TrabajosAcadémicos');
            $excel->setCreator('Ficoflora Venezuela');

            $excel->sheet('Sheetname', function ($sheet) use ($data) {

                $sheet->fromArray($data, null, 'A1', false, false);

                $sheet->prependRow(1, array(
                    'Tipo', 'Cita', 'Autores', 'Fecha', 'Título', 'Institución', 'Lugar', 'Páginas', 'Enlace', 'Archivo', 'Comentarios'
                ));
                $sheet->prependRow(2, array(
                    'pregrado, maestría, doctorado o ascenso',	null,	null,	null, null,	null,	null,	null, 	'(opcional)',	'(opcional)',	'(opcional)'

                ));

                $sheet->row(1, function ($row) { $row->setBackground('#eeeeee')->setFontWeight('bold');});
                $sheet->row(2, function ($row) {$row->setFontColor('#FF0000');});
                $sheet->freezeFirstRow();
            });

        })->export('xlsx');
    }

    //ARCHIVO DE TRABAJOS
    public function enlaces($modelo)
    {

        if($modelo){
            $data = [];
        }else {

            $data = $this->getTrabajos();
        }

        Excel::create('Referencias_EnlacesWebs_'.Carbon::create()->format('d-m-y'), function ($excel) use ($data) {

            $excel->setTitle('Referencias_EnlacesWebs_');
            $excel->setCreator('Ficoflora Venezuela');

            $excel->sheet('Sheetname', function ($sheet) use ($data) {

                $sheet->fromArray($data, null, 'A1', false, false);

                $sheet->prependRow(1, array(
                    'Cita', 'Autores', 'Fecha', 'Nombre página', 'Título', 'Institución', 'Lugar', 'Dirección Web', 'Día consulta', 'Mes consulta', 'Año consulta'
                ));
                $sheet->prependRow(2, array(
                    null, '(opcional)',	'(opcional)',	'(opcional)',	'(opcional)', 	'(opcional)',	'(opcional)',	 null,	null,	null,	null
                ));

                $sheet->row(1, function ($row) { $row->setBackground('#eeeeee')->setFontWeight('bold');});
                $sheet->row(2, function ($row) {$row->setFontColor('#FF0000');});
                $sheet->freezeFirstRow();
            });

        })->export('xlsx');
    }

}

