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

//Route::get('especie', function () {
//    return view('taxonomia.especies.especie');
//});
//


Route::get('especie/{id}', ['as' => 'especie.index', 'uses' => 'Taxonomia\EspeciesController@index']);



//---------->>>>>>>>>>
// GENERO
//---------->>>>>>>>>>
Route::get('genero/{id}/especies', ['as' => 'genero.especies', 'uses' => 'Taxonomia\GenerosController@especies']);
