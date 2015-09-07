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
Route::get('buscar', ['as' => 'buscar.index', 'uses' => 'Busquedas\BusquedasController@index']);
Route::post('buscar', ['as' => 'buscar.buscar', 'uses' => 'Busquedas\BusquedasController@buscarEspeciesSinonimias']);

    //Taxonomias
    Route::get('buscar/especies-sinonimias/{query}', ['as' => 'buscar.especies_sinonimias', 'uses' => 'Busquedas\BusquedasController@getEspeciesSinonimias']);
    Route::get('buscar/generos/{query}', ['as' => 'buscar.generos', 'uses' => 'Busquedas\BusquedasController@getGeneros']);
    Route::get('buscar/familias/{query}', ['as' => 'buscar.familias', 'uses' => 'Busquedas\BusquedasController@getFamilias']);

    //Ubicacion
    Route::get('buscar/entidades/{query}', ['as' => 'buscar.entidades', 'uses' => 'Busquedas\BusquedasController@getEntidades']);
    Route::get('buscar/localidades/{query}', ['as' => 'buscar.localidades', 'uses' => 'Busquedas\BusquedasController@getLocalidades']);
    Route::get('buscar/lugares/{query}', ['as' => 'buscar.lugares', 'uses' => 'Busquedas\BusquedasController@getLugares']);





//---------->>>>>>>>>>
// ESPECIES
//---------->>>>>>>>>>
Route::get('sinonimia/{id}', ['as' => 'sinonimia.index', 'uses' => 'Taxonomia\EspeciesController@index']);



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
