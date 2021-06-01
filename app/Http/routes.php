<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {

    $usuario = \Illuminate\Support\Facades\Auth::user();
    return view('publicas.index', compact('usuario'));
    /* antes para que apreciera la venta de bienvenida previa
    return view('welcome', compact('usuario'));
    */
});

//Route::get('mapas', function () {
//
//
//    return view('mapas.mapas');
//});

// Authenticacion
Route::get('auth/login',  ['as' => 'auth', 'uses' =>'Auth\AuthController@getLogin']);
Route::post('auth/login',  ['as' => 'auth.login', 'uses' =>'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);


//---------->>>>>>>>>>
// INICIO Y PÁGINAS PÚBLICAS
//---------->>>>>>>>>>
    Route::get('index', ['as' => 'index', function() {return view('publicas.index');}]);
    //Route::get('index', ['as' => 'index', 'uses' => 'Estadisticas\EstadisticasTotalesController@totalesIndex']);
    Route::get('proyecto', ['as' => 'proyecto', function() {return view('publicas.proyecto');}]);
    Route::get('proyecto#creditos', ['as' => 'proyecto_creditos', function() {return view('publicas.proyecto');}]);
    Route::get('catalogo', ['as' => 'catalogo', 'uses' => 'Estadisticas\EstadisticasTotalesController@totalesCatalogo']);
    Route::get('contactos', ['as' => 'contactos', function() {return view('publicas.contactos');}]);
    Route::get('otroscatalogos', ['as' => 'otroscatalogos', 'uses' => 'Listados\ListadosReferenciasController@catalogos']);


//---------->>>>>>>>>>
// MAPAS
//---------->>>>>>>>>>
    Route::get('mapas', ['as' => 'mapas', 'uses' => 'Taxonomia\EspeciesController@mapas']);

    //Route::get('pruebas', function(){return view('_modal-mapa.blade.php');});


//---------->>>>>>>>>>
// BUSQUEDAS
//---------->>>>>>>>>>

    Route::get('buscar', ['as' => 'buscar.index', 'uses' => 'Busquedas\BusquedasController@especies']);
    Route::get('buscar/especies', ['as' => 'buscar.especies.index', 'uses' => 'Busquedas\BusquedasController@especies']);
    Route::post('buscar/especies', ['as' => 'buscar.especies', 'uses' => 'Busquedas\BusquedasController@buscarEspeciesYSinonimias']);

    Route::get('buscar/taxonomia', ['as' => 'buscar.taxonomia.index', 'uses' => 'Busquedas\BusquedasController@taxonomia']);
    Route::get('buscar/ubicacion', ['as' => 'buscar.ubicacion.index', 'uses' => 'Busquedas\BusquedasController@ubicacion']);

    Route::get('buscar/referencias', ['as' => 'buscar.referencias.index', 'uses' => 'Busquedas\BusquedasController@referencias']);


//Taxonomias
    Route::get('buscar/autores/{query}', ['as' => 'buscar.autores', 'uses' => 'Busquedas\BusquedasController@getAutores']);
    Route::get('buscar/especies-sinonimias/{query}', ['as' => 'buscar.especies_sinonimias', 'uses' => 'Busquedas\BusquedasController@getEspeciesYSinonimias']);
    Route::get('buscar/generos/{query}', ['as' => 'buscar.generos', 'uses' => 'Busquedas\BusquedasController@getGeneros']);
    Route::get('buscar/familias/{query}', ['as' => 'buscar.familias', 'uses' => 'Busquedas\BusquedasController@getFamilias']);
    Route::get('buscar/ordenes/{query}', ['as' => 'buscar.ordenes', 'uses' => 'Busquedas\BusquedasController@getOrdenes']);
    Route::get('buscar/subclases/{query}', ['as' => 'buscar.subclases', 'uses' => 'Busquedas\BusquedasController@getSubclases']);
    Route::get('buscar/clases/{query}', ['as' => 'buscar.clases', 'uses' => 'Busquedas\BusquedasController@getClases']);
    Route::get('buscar/phylums/{query}', ['as' => 'buscar.phylums', 'uses' => 'Busquedas\BusquedasController@getPhylums']);


 //Ubicacion
    Route::get('buscar/entidades/{query}', ['as' => 'buscar.entidades', 'uses' => 'Busquedas\BusquedasController@getEntidades']);
    Route::get('buscar/localidades/{query}', ['as' => 'buscar.localidades', 'uses' => 'Busquedas\BusquedasController@getLocalidades']);
    Route::get('buscar/lugares/{query}', ['as' => 'buscar.lugares', 'uses' => 'Busquedas\BusquedasController@getLugares']);
    Route::get('buscar/sitios/{query}', ['as' => 'buscar.sitios', 'uses' => 'Busquedas\BusquedasController@getSitios']);

    Route::get('buscar/ubicaciones/{query}', ['as' => 'buscar.ubicaciones', 'uses' => 'Busquedas\BusquedasController@getUbicaciones']);

 //Referencias
    Route::get('buscar/referencia/{query}', ['as' => 'buscar.referencia', 'uses' => 'Busquedas\BusquedasController@getReferencias']);


//---------->>>>>>>>>>
// AUTORES
//---------->>>>>>>>>>
Route::get('autor/{id}/especies', ['as' => 'autor.especies', 'uses' => 'Taxonomia\AutoresController@especies']);


//---------->>>>>>>>>>
// SINONIMIAS
//---------->>>>>>>>>>
Route::get('sinonimia/{id}/especies', ['as' => 'sinonimia.index', 'uses' => 'Taxonomia\SinonimiasController@especies']);


//---------->>>>>>>>>>
// ESPECIES
//---------->>>>>>>>>>
Route::get('especie/{id}', ['as' => 'especie.index', 'uses' => 'Taxonomia\EspeciesController@index']);


//---------->>>>>>>>>>
// GENEROS
//---------->>>>>>>>>>
Route::get('genero/{id}/especies', ['as' => 'genero.especies', 'uses' => 'Taxonomia\GenerosController@especies']);


//---------->>>>>>>>>>
// FAMILIAS
//---------->>>>>>>>>>
Route::get('familia/{id}/especies', ['as' => 'familia.especies', 'uses' => 'Taxonomia\FamiliasController@especies']);
Route::get('familia/{id}/generos', ['as' => 'familia.generos', 'uses' => 'Taxonomia\FamiliasController@generos']);


//---------->>>>>>>>>>
// ORDENES
//---------->>>>>>>>>>
Route::get('orden/{id}/especies', ['as' => 'orden.especies', 'uses' => 'Taxonomia\OrdenesController@especies']);
Route::get('orden/{id}/familias', ['as' => 'orden.familias', 'uses' => 'Taxonomia\OrdenesController@familias']);


//---------->>>>>>>>>>
// SUBCLASES
//---------->>>>>>>>>>
Route::get('subclase/{id}/ordenes', ['as' => 'subclase.ordenes', 'uses' => 'Taxonomia\SubclasesController@ordenes']);


//---------->>>>>>>>>>
// CLASES
//---------->>>>>>>>>>
Route::get('clase/{id}/ordenes', ['as' => 'clase.ordenes', 'uses' => 'Taxonomia\ClasesController@ordenes']);
Route::get('clase/{id}/subclases', ['as' => 'clase.subclases', 'uses' => 'Taxonomia\ClasesController@subclases']);


//---------->>>>>>>>>>
// PHYLUM
//---------->>>>>>>>>>
Route::get('phylum/{id}/clases', ['as' => 'phylum.clases', 'uses' => 'Taxonomia\PhylumsController@clases']);


Route::get('galerias', ['as' => 'phylum.galeria', 'uses' => 'Taxonomia\PhylumsController@galeria']);


//---------->>>>>>>>>>
// FICHA DE REPORTES Y REFERENCIAS BIBLIOGRÁFICAS POR INVESTIGADOR
//---------->>>>>>>>>>
Route::get('listado/{id}/{tipo}/referencia', ['as' => 'listado.referencia', 'uses' => 'Listados\ListadosReferenciasController@referenciaInfo']);
Route::get('investigador/{id}/referencias', ['as' => 'investigador.referencias', 'uses' => 'Investigador\InvestigadorReferenciasController@reportesyReferencias']);


//---------->>>>>>>>>>
// GEOGRÁFICO
//---------->>>>>>>>>>
        //País
        //----------------
        Route::get('pais/venezuela/entidades', ['as' => 'pais.entidades', 'uses' => 'Ubicacion\PaisesController@entidades']);

        // ENTIDAD
        //--------------
        Route::get('entidad/{id}/especies', ['as' => 'entidad.especies', 'uses' => 'Ubicacion\EntidadesController@especies']);
        Route::get('entidad/{id}/localidades', ['as' => 'entidad.localidades', 'uses' => 'Ubicacion\EntidadesController@localidades']);

        // LOCALIDAD
        //----------------------
        Route::get('localidad/{id}/especies', ['as' => 'localidad.especies', 'uses' => 'Ubicacion\LocalidadesController@especies']);
        Route::get('localidad/{id}/lugares', ['as' => 'localidad.lugares', 'uses' => 'Ubicacion\LocalidadesController@lugaresyespecies']);
        Route::get('localidad/{id}/lugaresyespecies', ['as' => 'localidad.lugaresyespecies', 'uses' => 'Ubicacion\LocalidadesController@lugaresyespecies']);

        // LUGAR
        //----------------
        Route::get('lugar/{id}/especies', ['as' => 'lugar.especies', 'uses' => 'Ubicacion\LugaresController@especies']);
        Route::get('lugar/{id}/sitios', ['as' => 'lugar.sitios', 'uses' => 'Ubicacion\LugaresController@sitiosyespecies']);
        Route::get('lugar/{id}/sitiosyespecies', ['as' => 'lugar.sitiosyespecies', 'uses' => 'Ubicacion\LugaresController@sitiosyespecies']);

        // SITIO
        //----------------
        Route::get('sitio/{id}/especies', ['as' => 'sitio.especies', 'uses' => 'Ubicacion\SitiosController@especies']);


//---------->>>>>>>>>>
// PDF
//---------->>>>>>>>>>
    //Taxonomias
    Route::get('exportar/pdf/especies/{id}', ['as' => 'pdf.especie', 'uses' => 'Exportar\PDFsController@especies']);
    Route::get('exportar/pdf/genero/{id}/especies', ['as' => 'pdf.genero.especies', 'uses' => 'Exportar\PDFsController@especiesPorGenero']);
    Route::get('exportar/pdf/familia/{id}/especies', ['as' => 'pdf.familia.especies', 'uses' => 'Exportar\PDFsController@especiesPorFamilia']);
    Route::get('exportar/pdf/autor/{id}/especies', ['as' => 'pdf.autor.especies', 'uses' => 'Exportar\PDFsController@especiesPorAutor']);
    Route::get('exportar/pdf/sinononimia/{id}/especies', ['as' => 'pdf.sinonimia.especies', 'uses' => 'Exportar\PDFsController@especiesPorSinonimia']);

    Route::get('exportar/pdf/familia/{id}/generos', ['as' => 'pdf.familia.generos', 'uses' => 'Exportar\PDFsController@generosPorFamilia']);
    Route::get('exportar/pdf/orden/{id}/familias', ['as' => 'pdf.orden.familias', 'uses' => 'Exportar\PDFsController@familiasPorOrden']);
    Route::get('exportar/pdf/subclase/{id}/ordenes', ['as' => 'pdf.subclase.ordenes', 'uses' => 'Exportar\PDFsController@ordenesPorSubclase']);
    Route::get('exportar/pdf/clase/{id}/ordenes', ['as' => 'pdf.clase.ordenes', 'uses' => 'Exportar\PDFsController@ordenesPorClase']);
    Route::get('exportar/pdf/clase/{id}/subclases', ['as' => 'pdf.clase.subclases', 'uses' => 'Exportar\PDFsController@subclasesPorClase']);
    Route::get('exportar/pdf/phylum/{id}/clases', ['as' => 'pdf.phylum.clases', 'uses' => 'Exportar\PDFsController@clasesPorPhylum']);


    //Ubicación
    Route::get('exportar/pdf/pais/entidades', ['as' => 'pdf.pais.entidades', 'uses' => 'Exportar\PDFsController@entidadesPorPais']);

    Route::get('exportar/pdf/entidad/{id}/especies', ['as' => 'pdf.entidad.especies', 'uses' => 'Exportar\PDFsController@especiesPorEntidad']);
    Route::get('exportar/pdf/entidad/{id}/localidades', ['as' => 'pdf.entidad.localidades', 'uses' => 'Exportar\PDFsController@localidadesPorEntidad']);

    Route::get('exportar/pdf/localidad/{id}/especies', ['as' => 'pdf.localidad.especies', 'uses' => 'Exportar\PDFsController@especiesPorLocalidad']);
    Route::get('exportar/pdf/localidad/{id}/lugares', ['as' => 'pdf.localidad.lugares', 'uses' => 'Exportar\PDFsController@lugaresPorLocalidad']);

    Route::get('exportar/pdf/lugar/{id}/especies', ['as' => 'pdf.lugar.especies', 'uses' => 'Exportar\PDFsController@especiesPorLugar']);
    Route::get('exportar/pdf/lugar/{id}/sitios', ['as' => 'pdf.lugar.sitios', 'uses' => 'Exportar\PDFsController@sitiosPorLugar']);

    Route::get('exportar/pdf/sitios/{id}/especies', ['as' => 'pdf.sitio.especies', 'uses' => 'Exportar\PDFsController@especiesPorSitio']);


    //Listados
    Route::get('exportar/pdf/listado/especies', ['as' => 'pdf.listado.especies', 'uses' => 'Exportar\PDFsController@listadoEspecies']);
    Route::get('exportar/pdf/listado/generos', ['as' => 'pdf.listado.generos', 'uses' => 'Exportar\PDFsController@listadoGeneros']);
    Route::get('exportar/pdf/listado/familias', ['as' => 'pdf.listado.familias', 'uses' => 'Exportar\PDFsController@listadoFamilias']);
    Route::get('exportar/pdf/listado/ordenes', ['as' => 'pdf.listado.ordenes', 'uses' => 'Exportar\PDFsController@listadoOrdenes']);
    Route::get('exportar/pdf/listado/subclases', ['as' => 'pdf.listado.subclases', 'uses' => 'Exportar\PDFsController@listadoSubclases']);
    Route::get('exportar/pdf/listado/clases', ['as' => 'pdf.listado.clases', 'uses' => 'Exportar\PDFsController@listadoClases']);
    Route::get('exportar/pdf/listado/phylum', ['as' => 'pdf.listado.phylum', 'uses' => 'Exportar\PDFsController@listadoPhylum']);


    //Geográficos
    Route::get('exportar/pdf/listado/entidades', ['as' => 'pdf.listado.entidades', 'uses' => 'Exportar\PDFsController@listadoEntidades']);
    Route::get('exportar/pdf/listado/localidades', ['as' => 'pdf.listado.localidades', 'uses' => 'Exportar\PDFsController@listadoLocalidades']);
    Route::get('exportar/pdf/listado/lugares', ['as' => 'pdf.listado.lugares', 'uses' => 'Exportar\PDFsController@listadoLugares']);
    Route::get('exportar/pdf/listado/sitios', ['as' => 'pdf.listado.sitios', 'uses' => 'Exportar\PDFsController@listadoSitios']);


    //Referencias Bibliográficas
    Route::get('exportar/pdf/investigador/{id}', ['as' => 'pdf.investigador', 'uses' => 'Exportar\PDFsController@investigador']);

    Route::get('exportar/pdf/listado/referencias', ['as' => 'pdf.listado.referencias', 'uses' => 'Exportar\PDFsController@listadoReferencias']);
    Route::get('exportar/pdf/listado/revistas', ['as' => 'pdf.listado.revistas', 'uses' => 'Exportar\PDFsController@listadoRevistas']);
    Route::get('exportar/pdf/listado/libros', ['as' => 'pdf.listado.libros', 'uses' => 'Exportar\PDFsController@listadoLibros']);
    Route::get('exportar/pdf/listado/enlaces', ['as' => 'pdf.listado.enlaces', 'uses' => 'Exportar\PDFsController@listadoEnlaces']);
    Route::get('exportar/pdf/listado/trabajos', ['as' => 'pdf.listado.trabajos', 'uses' => 'Exportar\PDFsController@listadoTrabajos']);
    Route::get('exportar/pdf/listado/catalogos', ['as' => 'pdf.listado.catalogos', 'uses' => 'Exportar\PDFsController@listadoCatalogos']);



//---------->>>>>>>>>>
// LISTADOS
//---------->>>>>>>>>>

    //Taxonomia
    Route::get('listado/especies', ['as' => 'listado.especies', 'uses' => 'Listados\ListadosTaxonomiasController@especies']);
    Route::get('listado/generos', ['as' => 'listado.generos', 'uses' => 'Listados\ListadosTaxonomiasController@generos']);
    Route::get('listado/familias', ['as' => 'listado.familias', 'uses' => 'Listados\ListadosTaxonomiasController@familias']);
    Route::get('listado/ordenes', ['as' => 'listado.ordenes', 'uses' => 'Listados\ListadosTaxonomiasController@ordenes']);
    Route::get('listado/subclases', ['as' => 'listado.subclases', 'uses' => 'Listados\ListadosTaxonomiasController@subclases']);
    Route::get('listado/clases', ['as' => 'listado.clases', 'uses' => 'Listados\ListadosTaxonomiasController@clases']);
    Route::get('listado/phylum', ['as' => 'listado.phylum', 'uses' => 'Listados\ListadosTaxonomiasController@phylum']);

    //Ubicacion
    Route::get('listado/entidades', ['as' => 'listado.entidades', 'uses' => 'Listados\ListadosUbicacionController@entidades']);
    Route::get('listado/localidades', ['as' => 'listado.localidades', 'uses' => 'Listados\ListadosUbicacionController@localidades']);
    Route::get('listado/lugares', ['as' => 'listado.lugares', 'uses' => 'Listados\ListadosUbicacionController@lugares']);
    Route::get('listado/sitios', ['as' => 'listado.sitios', 'uses' => 'Listados\ListadosUbicacionController@sitios']);

    //Referencias Bibliograficas
    Route::get('listado/referencias', ['as' => 'listado.referencias', 'uses' => 'Listados\ListadosReferenciasController@referencias']);
    Route::get('listado/revistas', ['as' => 'listado.revistas', 'uses' => 'Listados\ListadosReferenciasController@revistas']);
    Route::get('listado/libros', ['as' => 'listado.libros', 'uses' => 'Listados\ListadosReferenciasController@libros']);
    Route::get('listado/enlaces', ['as' => 'listado.enlaces', 'uses' => 'Listados\ListadosReferenciasController@enlaces']);
    Route::get('listado/trabajos', ['as' => 'listado.trabajos', 'uses' => 'Listados\ListadosReferenciasController@trabajos']);
    Route::get('listado/catalogos', ['as' => 'listado.catalogos', 'uses' => 'Listados\ListadosReferenciasController@catalogos']);

//SideBar

    Route::get('sidebar', ['as' => 'sidebar', function(){
        return view ('publicas.sidebar');
    }]);    


