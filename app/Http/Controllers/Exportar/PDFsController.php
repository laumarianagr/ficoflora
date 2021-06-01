<?php

namespace App\Http\Controllers\Exportar;


use App\Ficoflora\Especies\EspecieDatosTrait;
use App\Ficoflora\Exportar\PDF\BasePDF;
use App\Ficoflora\Exportar\PDF\FormatosHTML;

use App\Ficoflora\Exportar\PDF\Listados\ListadoEspeciesPDF;
use App\Ficoflora\Exportar\PDF\Listados\ListadoGenerosPDF;
use App\Ficoflora\Exportar\PDF\Listados\ListadoGeograficoPDF;
use App\Ficoflora\Exportar\PDF\Listados\ListadoTaxonomicoPDF;
use App\Ficoflora\Exportar\PDF\Listados\ListadoReferenciasPDF;

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

    use ListadoEspeciesPDF;
    use ListadoTaxonomicoPDF;
    use ListadoGeograficoPDF;
    use ListadoReferenciasPDF;

//---------->>>>>>>>>>
// LISTADOS TAXONÓMICOS
//---------->>>>>>>>>>

    //LISTADO de Especies
    public function especies($id)
    {
        $especie_nombre = $this->especieDatos(null, $id, false);
        $html = $this->pdfEspecie($id);
        $nombreArchivo = "Especie " . $especie_nombre['nombre'];

        $this->generarPDF($html, $nombreArchivo);
    }


    //LISTADO de Especies por Familia
    public function especiesPorFamilia($id)
    {
        $familia = $this->taxoFamilia($id);
        $html = $this->pdfEspeciesPorFamilia($familia);
        $nombreArchivo = "Especies_de_la_familia " . $familia['familia'];

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Especies por Género
    public function especiesPorGenero($id)
    {
        $genero = $this->taxoGenero($id);
        $html = $this->pdfEspeciesPorGenero($genero);
        $nombreArchivo = "Especies_del_género " . $genero['genero'];

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Especies por Autor
    public function especiesPorAutor($id)
    {
        $autor = Autor::find($id);
        $html = $this->pdfEspeciesPorAutor($autor);
        $nombreArchivo = "Especies_del_autor " . $autor['nombre'];

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Especies por Sinonimia
    public function especiesPorSinonimia($id)
    {
        $obj_sinonimia = Sinonimia::find($id);
        $sinonimia = $this->especieDatos($obj_sinonimia, null, false);
        $html = $this->pdfEspeciesPorSinonimia($sinonimia,$obj_sinonimia);
        $nombreArchivo = "Especies_de_la_sinonimia " . $sinonimia['nombre'];

        $this->generarPDF($html, $nombreArchivo);
    }



    //LISTADO de Especies por Entidad
    public function especiesPorEntidad($id)
    {
        $entidad = $this->ubicacionEntidad($id);
        $html = $this->pdfEspeciesPorEntidad($entidad);
        $nombreArchivo = "Especies_de_la_entidad_federal" . $entidad['entidad'];

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Especies por LOCALIDAD
    public function especiesPorLocalidad($id)
    {
        $localidad = $this->ubicacionLocalidad($id);
        $html = $this->pdfEspeciesPorLocalidad($localidad);
        $nombreArchivo = "Especies_de_la_localidad " . $localidad['localidad'];

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Especies por LUGAR
    public function especiesPorLugar($id)
    {
        $lugar = $this->ubicacionLugar($id);
        $html = $this->pdfEspeciesPorLugar($lugar);
        $nombreArchivo = "Especies_del_lugar " . $lugar['lugar'];

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Especies por SITIO
    public function especiesPorSitio($id)
    {
        $sitio = $this->ubicacionSitio($id);
        $html = $this->pdfEspeciesPorSitio($sitio);
        $nombreArchivo = "Especies_del_sitio " . $sitio['sitio'];

        $this->generarPDF($html, $nombreArchivo);
    }


    //Listado de GENEROS
    public function generosPorFamilia($id)
    {
        $familia = $this->taxoFamilia($id);
        $html = $this->pdfGenerosPorFamilia($familia);
        $nombreArchivo = "Géneros_de_la_familia " . $familia['familia'];

        $this->generarPDF($html, $nombreArchivo);
    }

    //Listado de FAMILIAS
    public function familiasPorOrden($id)
    {
        $orden = $this->taxoOrden($id);
        $html = $this->pdfFamiliasPorOrden($orden);
        $nombreArchivo = "Familias_del_orden " . $orden['orden'];

        $this->generarPDF($html, $nombreArchivo);
    }

    //Listado de ORDENES por SUBCLASE
    public function ordenesPorSubclase($id)
    {
        $subclase = $this->taxoSubclase($id);
        $html = $this->pdfOrdenesPorSubclase($subclase);
        $nombreArchivo = "Ordenes_de_la_subclase " . $subclase['subclase'];

        $this->generarPDF($html, $nombreArchivo);
    }

    //Listado de ORDENES por CLASE
    public function ordenesPorclase($id)
    {
        $clase = $this->taxoClase($id);
        $html = $this->pdfOrdenesPorClase($clase);
        $nombreArchivo = "Ordenes_de_la_clase " . $clase['clase'];

        $this->generarPDF($html, $nombreArchivo);
    }

    //Listado de SUBCLASES por CLASE
    public function subclasesPorClase($id)
    {
        $clase = $this->taxoClase($id);
        $html = $this->pdfSubclasesPorclase($clase);
        $nombreArchivo = "Subclases_de_la_clase " . $clase['clase'];

        $this->generarPDF($html, $nombreArchivo);
    }


    //Listado de ORDENES por CLASE
    public function clasesPorPhylum($id)
    {
        $phylum = $this->taxoClase($id);
        $html = $this->pdfClasesPorPhylum($phylum);
        $nombreArchivo = "Clases_del_phylum " . $phylum['phylum'];

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de entidades por PAis
    public function entidadesPorPais()
    {
        $html = $this->pdfEntidadesPorPais();
        $nombreArchivo = "Entidades_federales_del_país Venezuela";

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Localidades por Entidad
    public function localidadesPorEntidad($id)
    {
        $entidad = $this->ubicacionEntidad($id);
        $html = $this->pdfLocalidadesPorEntidad($entidad);
        $nombreArchivo = "Localidades_de_la_entidad_federal " . $entidad['entidad'];

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Lugares por LOCALIDAD
    public function lugaresPorLocalidad($id)
    {
        $localidad = $this->ubicacionLocalidad($id);
        $html = $this->pdfLugaresPorLocalidad($localidad);
        $nombreArchivo = "Lugares_de_la_localidad " . $localidad['localidad'];

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Especies por LUGAR
    public function sitiosPorLugar($id)
    {
        $lugar = $this->ubicacionLugar($id);
        $html = $this->pdfSitiosPorLugar($lugar);
        $nombreArchivo = "Sitios_del_lugar " . $lugar['lugar'];

        $this->generarPDF($html, $nombreArchivo);
    }


    //LISTADO de Especies
    public function listadoEspecies()
    {
        $html = $this->pdfListadoEspecies();
        $nombreArchivo = "Listado_especies_variedades_formas";
        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Géneros
    public function listadoGeneros()
    {
        $html = $this->pdfListadoGeneros();
        $nombreArchivo = "Listado_géneros";

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Familias
    public function listadoFamilias()
    {
        $html = $this->pdfListadoFamilias();
        $nombreArchivo = "Listado_familias";
        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Órdenes
    public function listadoOrdenes()
    {
        $html = $this->pdfListadoOrdenes();
        $nombreArchivo = "Listado_órdenes";

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de subclases
    public function listadoSubclases()
    {
        $html = $this->pdfListadoSubclases();
        $nombreArchivo = "Listado_subclases";

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de clases
    public function listadoClases()
    {
        $html = $this->pdfListadoClases();
        $nombreArchivo = "Listado_Clases";

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Phylum
    public function listadoPhylum()
    {
        $html = $this->pdfListadoPhylum();
        $nombreArchivo = "Listado_Phylum";

        $this->generarPDF($html, $nombreArchivo);
    }

//---------->>>>>>>>>>
// LISTADOS UBICACIÓN GEOGRÁFICA
//---------->>>>>>>>>>

    //LISTADO de Entidades
    public function listadoEntidades()
    {
        $html = $this->pdfListadoEntidades();
        $nombreArchivo = "Listado_Entidades";

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Localidades
    public function listadoLocalidades()
    {
        $html = $this->pdfListadoLocalidades();
        $nombreArchivo = "Listado_Localidades";

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Lugares
    public function listadoLugares()
    {
        $html = $this->pdfListadoLugares();
        $nombreArchivo = "Listado_Lugares";

        $this->generarPDF($html, $nombreArchivo);
    }
    //LISTADO de Sitios
    public function listadoSitios()
    {
        $html = $this->pdfListadoSitios();
        $nombreArchivo = "Listado_Sitios";

        $this->generarPDF($html, $nombreArchivo);
    }


//---------->>>>>>>>>>
// LISTADOS REFERENCIAS
//---------->>>>>>>>>>

    //LISTADO de Referencias bibliograficas
    public function listadoReferencias()
    {
        $html = $this->pdfListadoReferencias();
        $nombreArchivo = "Listado_ReferenciasBibliograficas";

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Revistas
    public function listadoRevistas()
    {
        $html = $this->pdfListadoRevistas();
        $nombreArchivo = "Listado_ReferenciasBibliograficas_Revistas";

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Libros
    public function listadoLibros()
    {
        $html = $this->pdfListadoLibros();
        $nombreArchivo = "Listado_ReferenciasBibliograficas_Libros";

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Enlaces
    public function listadoEnlaces()
    {
        $html = $this->pdfListadoEnlaces();
        $nombreArchivo = "Listado_ReferenciasBibliograficas_SitiosWeb";

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Trabajos Académicos
    public function listadoTrabajos()
    {
        $html = $this->pdfListadoTrabajos();
        $nombreArchivo = "Listado_ReferenciasBibliograficas_TrabajosAcademicos";

        $this->generarPDF($html, $nombreArchivo);
    }

    //LISTADO de Trabajos Catálogos
    public function listadoCatalogos()
    {
        $html = $this->pdfListadoCatalogos();
        $nombreArchivo = "Listado_ReferenciasBibliograficas_Catalogos";

        $this->generarPDF($html, $nombreArchivo);
    }


    // se indican los atributos del pdf y crea la instancia del documento
    public function generarPDF($html, $nombreArchivo)
    {
        $fecha = Carbon::now();
        $nombreArchivo.= " (versión_" . $fecha->format('d-m-y') . ").pdf";

        $mpdf = new mPDF('utf-8', 'Letter', 0, '', 18, 18, 15, 15, 6, 6, '');
        $html .= $this->citaPagina();
        $this->encabezado_pie_marcaAgua($mpdf);
        $this->estilos($mpdf);
        $this->generar($mpdf, $html, $nombreArchivo);
    }
}