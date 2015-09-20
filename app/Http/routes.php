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
    return view('welcome');
});

//Route::get('mapas', function () {
//
//
//    return view('mapas.mapas');
//});



Route::get('mapas', ['as' => 'mapas', 'uses' => 'Taxonomia\EspeciesController@mapas']);


//---------->>>>>>>>>>
// BUSQUEDAS
//---------->>>>>>>>>>
Route::get('buscar', ['as' => 'buscar.index', 'uses' => 'Busquedas\BusquedasController@especies']);
Route::get('buscar/especies', ['as' => 'buscar.especies.index', 'uses' => 'Busquedas\BusquedasController@especies']);
Route::post('buscar/especies', ['as' => 'buscar.especies', 'uses' => 'Busquedas\BusquedasController@buscarEspeciesYSinonimias']);

Route::get('buscar/taxonomia', ['as' => 'buscar.taxonomia.index', 'uses' => 'Busquedas\BusquedasController@taxonomia']);
Route::get('buscar/ubicacion', ['as' => 'buscar.ubicacion.index', 'uses' => 'Busquedas\BusquedasController@ubicacion']);

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








//---------->>>>>>>>>>
// PAIS
//---------->>>>>>>>>>
Route::get('pais/venezuela/entidades', ['as' => 'pais.entidades', 'uses' => 'Ubicacion\PaisesController@entidades']);


//---------->>>>>>>>>>
// ENTIDAD
//---------->>>>>>>>>>
Route::get('entidad/{id}/especies', ['as' => 'entidad.especies', 'uses' => 'Ubicacion\EntidadesController@especies']);
Route::get('entidad/{id}/localidades', ['as' => 'entidad.localidades', 'uses' => 'Ubicacion\EntidadesController@localidades']);


//---------->>>>>>>>>>
// LOCALIDAD
//---------->>>>>>>>>>
Route::get('localidad/{id}/especies', ['as' => 'localidad.especies', 'uses' => 'Ubicacion\LocalidadesController@especies']);
Route::get('localidad/{id}/lugares', ['as' => 'localidad.lugares', 'uses' => 'Ubicacion\LocalidadesController@lugares']);


//---------->>>>>>>>>>
// LUGAR
//---------->>>>>>>>>>
Route::get('lugar/{id}/especies', ['as' => 'lugar.especies', 'uses' => 'Ubicacion\LugaresController@especies']);
Route::get('lugar/{id}/sitios', ['as' => 'lugar.sitios', 'uses' => 'Ubicacion\LugaresController@sitios']);

//---------->>>>>>>>>>
// SITIO
//---------->>>>>>>>>>
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


