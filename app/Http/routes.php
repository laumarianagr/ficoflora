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
Route::get('buscar/especies-sinonimias/{query}', ['as' => 'buscar.especies_sinonimias', 'uses' => 'Busquedas\BusquedasController@getEspeciesSinonimias']);
Route::get('buscar/generos/{query}', ['as' => 'buscar.generos', 'uses' => 'Busquedas\BusquedasController@getGeneros']);
Route::get('buscar/familias/{query}', ['as' => 'buscar.familias', 'uses' => 'Busquedas\BusquedasController@getFamilias']);


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
