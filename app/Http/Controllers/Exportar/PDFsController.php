<?php

namespace App\Http\Controllers\Exportar;


use App\Ficoflora\Especies\EspecieDatosTrait;
use App\Ficoflora\Exportar\PDF\BasePDF;
use App\Ficoflora\Exportar\PDF\FormatosHTML;
use App\Ficoflora\Exportar\PDF\Taxonomia\AutorPDF;
use App\Ficoflora\Exportar\PDF\Taxonomia\EspeciesPDF;
use App\Ficoflora\Exportar\PDF\Taxonomia\GeneroPDF;
use App\Ficoflora\Exportar\PDF\Taxonomia\ClasePDF;
use App\Ficoflora\Exportar\PDF\Taxonomia\FamiliaPDF;
use App\Ficoflora\Exportar\PDF\Taxonomia\OrdenPDF;
use App\Ficoflora\Exportar\PDF\Taxonomia\PhylumPDF;
use App\Ficoflora\Exportar\PDF\Taxonomia\SinonimiaPDF;
use App\Ficoflora\Exportar\PDF\Taxonomia\SubclasePDF;
use App\Ficoflora\Exportar\PDF\Ubicacion\EntidadPDF;
use App\Ficoflora\Exportar\PDF\Ubicacion\LocalidadPDF;
use App\Ficoflora\Exportar\PDF\Ubicacion\LugarPDF;
use App\Ficoflora\Exportar\PDF\Ubicacion\PaisPDF;
use App\Ficoflora\Exportar\PDF\Ubicacion\SitioPDF;
use App\Ficoflora\Funcionalidades\TaxonomiaSuperiorTrait;
use App\Ficoflora\Ubicacion\UbicacionSuperiorTrait;
use App\Modelos\Sinonimias\Sinonimia;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Genero;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use mPDF;

require_once base_path('public/plugins/mpdf60/mpdf.php');

class PDFsController extends Controller
{
    use EspecieDatosTrait;

    use BasePDF;
    use FormatosHTML;

    use TaxonomiaSuperiorTrait;
    use EspeciesPDF;
    use GeneroPDF;
    use FamiliaPDF;
    use OrdenPDF;
    use SubclasePDF;
    use ClasePDF;
    use PhylumPDF;
    use AutorPDF;
    use SinonimiaPDF;

    use UbicacionSuperiorTrait;
    use PaisPDF;
    use EntidadPDF;
    use LocalidadPDF;
    use LugarPDF;
    use SitioPDF;


    public function especies($id)
    {
        $especie_nombre = $this->especieDatos(null, $id, false);
        $html = $this->pdfEspecie($id);
        $fecha = Carbon::now();
        $nombreArchivo = "Especie " . $especie_nombre['nombre']. " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');

        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }


    //LISTADO de Especies por Género
    public function especiesPorFamilia($id)
    {
        $familia = $this->taxoFamilia($id);
        $html = $this->pdfEspeciesPorFamilia($familia);
        $fecha = Carbon::now();
        $nombreArchivo = "Especies_de_la_familia " . $familia['familia']. " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }

        //LISTADO de Especies por Género
    public function especiesPorGenero($id)
    {
        $genero = $this->taxoGenero($id);
        $html = $this->pdfEspeciesPorGenero($genero);
        $fecha = Carbon::now();
        $nombreArchivo = "Especies_del_género " . $genero['genero']. " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }

        //LISTADO de Especies por Género
    public function especiesPorAutor($id)
    {
        $autor = Autor::find($id);
        $html = $this->pdfEspeciesPorAutor($autor);
        $fecha = Carbon::now();
        $nombreArchivo = "Especies_del_autor " . $autor['nombre']. " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }


        //LISTADO de Especies por Sinonimia
    public function especiesPorSinonimia($id)
    {
        $obj_sinonimia = Sinonimia::find($id);
        $sinonimia = $this->especieDatos($obj_sinonimia, null, false);
        $html = $this->pdfEspeciesPorSinonimia($sinonimia,$obj_sinonimia);
        $fecha = Carbon::now();
        $nombreArchivo = "Especies_de_la_sinonimia " . $sinonimia['nombre']. " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }



    //LISTADO de Especies por Entidad
    public function especiesPorEntidad($id)
    {
        $entidad = $this->ubicacionEntidad($id);
        $html = $this->pdfEspeciesPorEntidad($entidad);
        $fecha = Carbon::now();
        $nombreArchivo = "Especies_de_la_entidad_federal" . $entidad['entidad']. " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }

    //LISTADO de Especies por LOCALIDAD
    public function especiesPorLocalidad($id)
    {
        $localidad = $this->ubicacionLocalidad($id);
        $html = $this->pdfEspeciesPorLocalidad($localidad);
        $fecha = Carbon::now();
        $nombreArchivo = "Especies_de_la_localidad " . $localidad['localidad']. " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }

    //LISTADO de Especies por LUGAR
    public function especiesPorLugar($id)
    {
        $lugar = $this->ubicacionLugar($id);
        $html = $this->pdfEspeciesPorLugar($lugar);
        $fecha = Carbon::now();
        $nombreArchivo = "Especies_del_lugar " . $lugar['lugar']. " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }

    //LISTADO de Especies por SITIO
    public function especiesPorSitio($id)
    {
        $sitio = $this->ubicacionSitio($id);
        $html = $this->pdfEspeciesPorSitio($sitio);
        $fecha = Carbon::now();
        $nombreArchivo = "Especies_del_sitio " . $sitio['sitio']. " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }


    //Listado de GENEROS
    public function generosPorFamilia($id)
    {
        $familia = $this->taxoFamilia($id);
        $html = $this->pdfGenerosPorFamilia($familia);
        $fecha = Carbon::now();
        $nombreArchivo = "Géneros_de_la_familia " . $familia['familia']. " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }

    //Listado de FAMILIAS
    public function familiasPorOrden($id)
    {
        $orden = $this->taxoOrden($id);
        $html = $this->pdfFamiliasPorOrden($orden);
        $fecha = Carbon::now();
        $nombreArchivo = "Familias_del_orden " . $orden['orden']. " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }

    //Listado de ORDENES por SUBCLASE
    public function ordenesPorSubclase($id)
    {
        $subclase = $this->taxoSubclase($id);
        $html = $this->pdfOrdenesPorSubclase($subclase);
        $fecha = Carbon::now();
        $nombreArchivo = "Ordenes_de_la_subclase " . $subclase['subclase']. " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }

    //Listado de ORDENES por CLASE
    public function ordenesPorclase($id)
    {
        $clase = $this->taxoClase($id);
        $html = $this->pdfOrdenesPorClase($clase);
        $fecha = Carbon::now();
        $nombreArchivo = "Ordenes_de_la_clase " . $clase['clase']. " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }

    //Listado de SUBCLASES por CLASE
    public function subclasesPorClase($id)
    {
        $clase = $this->taxoClase($id);
        $html = $this->pdfSubclasesPorclase($clase);
        $fecha = Carbon::now();
        $nombreArchivo = "Subclases_de_la_clase " . $clase['clase']. " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }


    //Listado de ORDENES por CLASE
    public function clasesPorPhylum($id)
    {
        $phylum = $this->taxoClase($id);
        $html = $this->pdfClasesPorPhylum($phylum);
        $fecha = Carbon::now();
        $nombreArchivo = "Clases_del_phylum " . $phylum['phylum']. " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }


    //LISTADO de entidades por PAis
    public function entidadesPorPais()
    {
        $html = $this->pdfEntidadesPorPais();
        $fecha = Carbon::now();
        $nombreArchivo = "Entidades_federales_del_país Venezuela (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }

    //LISTADO de Localidades por Entidad
    public function localidadesPorEntidad($id)
    {
        $entidad = $this->ubicacionEntidad($id);
        $html = $this->pdfLocalidadesPorEntidad($entidad);
        $fecha = Carbon::now();
        $nombreArchivo = "Localidades_de_la_entidad_federal " . $entidad['entidad']. " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }

    //LISTADO de Lugares por LOCALIDAD
    public function lugaresPorLocalidad($id)
    {
        $localidad = $this->ubicacionLocalidad($id);
        $html = $this->pdfLugaresPorLocalidad($localidad);
        $fecha = Carbon::now();
        $nombreArchivo = "Lugares_de_la_localidad " . $localidad['localidad']. " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }

    //LISTADO de Especies por LUGAR
    public function sitiosPorLugar($id)
    {
        $lugar = $this->ubicacionLugar($id);
        $html = $this->pdfSitiosPorLugar($lugar);
        $fecha = Carbon::now();
        $nombreArchivo = "Sitios_del_lugar " . $lugar['lugar']. " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }


}
