<?php


Route::get('/', function () {
    return view('welcome');
});


// Authenticacion
Route::get('auth/login',  ['as' => 'auth', 'uses' =>'Auth\AuthController@getLogin']);
Route::post('auth/login',  ['as' => 'auth.login', 'uses' =>'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);


Route::get('/inicio', ['as' => 'inicio', 'uses' => 'Ficoflora\AppController@inicio']);
// Registration routes...
Route::get('auth/registrar', 'Auth\AuthController@getRegister');
//Route::post('auth/registrar', ['as' => 'usuarios.crear', 'uses' =>'Auth\AuthController@postRegister']);
Route::post('auth/registrar', ['as' => 'usuarios.crear', 'uses' =>'Cuentas\UsuariosController@crear']);


Route::get('cuenta/editar', ['as' => 'cuenta.editar','uses' => 'Cuentas\CuentaController@editar']);
Route::post('cuenta/actualizar/clave', ['as' => 'actualizar.clave','uses' => 'Cuentas\CuentaController@actualizarClave']);
Route::post('cuenta/actualizar/imagen', ['as' => 'actualizar.imagen','uses' => 'Cuentas\CuentaController@actualizarImagen']);
Route::post('cuenta/actualizar/informacion', ['as' => 'actualizar.info','uses' => 'Cuentas\CuentaController@actualizarInfo']);

Route::get('usuario/{username}', ['as' => 'usuario.index','uses' => 'Cuentas\UsuariosController@mostrar']);

//Grupo de Usuarios
Route::get('usuarios', ['as' => 'usuarios.index', 'uses' => 'Cuentas\UsuariosController@index']);
Route::delete('usuarios', ['as' => 'usuarios.eliminar', 'uses' => 'Cuentas\UsuariosController@eliminar']);
Route::patch('usuarios', ['as' => 'usuarios.editar.perfil', 'uses' => 'Cuentas\UsuariosController@editarPerfil']);


Route::get('setimagen', ['as' => 'imagenes.set', 'uses' => 'Archivo\ArchivoController@setImagenes']);
Route::get('uperName', ['as' => 'imagenes.set', 'uses' => 'Archivo\ArchivoController@uperName']);


//Registros Usuario

   //Taxonómicos
    Route::get('usuario/registros/autores', ['as' => 'usuario.autores','uses' => 'Cuentas\UsuarioController@autores']);
    Route::get('usuario/registros/especificos', ['as' => 'usuario.especificos','uses' => 'Cuentas\UsuarioController@especificos']);
    Route::get('usuario/registros/varietales', ['as' => 'usuario.varietales','uses' => 'Cuentas\UsuarioController@varietales']);
    Route::get('usuario/registros/formas', ['as' => 'usuario.formas','uses' => 'Cuentas\UsuarioController@formas']);
    Route::get('usuario/registros/especies', ['as' => 'usuario.especies','uses' => 'Cuentas\UsuarioController@especies']);
    Route::get('usuario/registros/generos', ['as' => 'usuario.generos','uses' => 'Cuentas\UsuarioController@generos']);
    Route::get('usuario/registros/familias', ['as' => 'usuario.familias','uses' => 'Cuentas\UsuarioController@familias']);
    Route::get('usuario/registros/ordenes', ['as' => 'usuario.ordenes','uses' => 'Cuentas\UsuarioController@ordenes']);
    Route::get('usuario/registros/subclases', ['as' => 'usuario.subclases','uses' => 'Cuentas\UsuarioController@subclases']);
    Route::get('usuario/registros/clases', ['as' => 'usuario.clases','uses' => 'Cuentas\UsuarioController@clases']);
    Route::get('usuario/registros/phylums', ['as' => 'usuario.phylums','uses' => 'Cuentas\UsuarioController@phylums']);
    Route::get('usuario/registros/sinonimias', ['as' => 'usuario.sinonimias','uses' => 'Cuentas\UsuarioController@sinonimias']);

    //Bibliográficos
    Route::get('usuario/registros/libros', ['as' => 'usuario.libros','uses' => 'Cuentas\UsuarioController@libros']);
    Route::get('usuario/registros/revistas', ['as' => 'usuario.revistas','uses' => 'Cuentas\UsuarioController@revistas']);
    Route::get('usuario/registros/trabajos', ['as' => 'usuario.trabajos','uses' => 'Cuentas\UsuarioController@trabajos']);
    Route::get('usuario/registros/enlaces', ['as' => 'usuario.enlaces','uses' => 'Cuentas\UsuarioController@enlaces']);

    //Ubicaciones
    Route::get('usuario/registros/entidades', ['as' => 'usuario.entidades','uses' => 'Cuentas\UsuarioController@entidades']);
    Route::get('usuario/registros/localidades', ['as' => 'usuario.localidades','uses' => 'Cuentas\UsuarioController@localidades']);
    Route::get('usuario/registros/lugares', ['as' => 'usuario.lugares','uses' => 'Cuentas\UsuarioController@lugares']);
    Route::get('usuario/registros/sitios', ['as' => 'usuario.sitios','uses' => 'Cuentas\UsuarioController@sitios']);
    Route::get('usuario/registros/ubicaciones', ['as' => 'usuario.ubicaciones','uses' => 'Cuentas\UsuarioController@ubicaciones']);

    //Reportes
    Route::get('usuario/registros/reportes', ['as' => 'usuario.reportes','uses' => 'Cuentas\UsuarioController@reportes']);


//---------->>>>>>>>>>
// LISTADOS
//---------->>>>>>>>>>

Route::get('listados', ['as' => 'listados.index', 'uses' => 'Listados\ListadosTaxonomicosController@index']);

   //Taxonómicos
    Route::get('listado/autores', ['as' => 'listado.autores','uses' => 'Listados\ListadosTaxonomicosController@autores']);
    Route::get('listado/especificos', ['as' => 'listado.especificos','uses' => 'Listados\ListadosTaxonomicosController@especificos']);
    Route::get('listado/varietales', ['as' => 'listado.varietales','uses' => 'Listados\ListadosTaxonomicosController@varietales']);
    Route::get('listado/formas', ['as' => 'listado.formas','uses' => 'Listados\ListadosTaxonomicosController@formas']);
    Route::get('listado/especies', ['as' => 'listado.especies','uses' => 'Listados\ListadosTaxonomicosController@especies']);
    Route::get('listado/generos', ['as' => 'listado.generos','uses' => 'Listados\ListadosTaxonomicosController@generos']);
    Route::get('listado/familias', ['as' => 'listado.familias','uses' => 'Listados\ListadosTaxonomicosController@familias']);
    Route::get('listado/ordenes', ['as' => 'listado.ordenes','uses' => 'Listados\ListadosTaxonomicosController@ordenes']);
    Route::get('listado/subclases', ['as' => 'listado.subclases','uses' => 'Listados\ListadosTaxonomicosController@subclases']);
    Route::get('listado/clases', ['as' => 'listado.clases','uses' => 'Listados\ListadosTaxonomicosController@clases']);
    Route::get('listado/phylums', ['as' => 'listado.phylums','uses' => 'Listados\ListadosTaxonomicosController@phylums']);
    Route::get('listado/sinonimias', ['as' => 'listado.sinonimias','uses' => 'Listados\ListadosTaxonomicosController@sinonimias']);

    //Bibliográficos
    Route::get('listado/libros', ['as' => 'listado.libros','uses' => 'Listados\ListadosBibliograficosController@libros']);
    Route::get('listado/revistas', ['as' => 'listado.revistas','uses' => 'Listados\ListadosBibliograficosController@revistas']);
    Route::get('listado/trabajos', ['as' => 'listado.trabajos','uses' => 'Listados\ListadosBibliograficosController@trabajos']);
    Route::get('listado/enlaces', ['as' => 'listado.enlaces','uses' => 'Listados\ListadosBibliograficosController@enlaces']);

    //Ubicaciones
    Route::get('listado/entidades', ['as' => 'listado.entidades','uses' => 'Listados\ListadosGeograficosController@entidades']);
    Route::get('listado/localidades', ['as' => 'listado.localidades','uses' => 'Listados\ListadosGeograficosController@localidades']);
    Route::get('listado/lugares', ['as' => 'listado.lugares','uses' => 'Listados\ListadosGeograficosController@lugares']);
    Route::get('listado/sitios', ['as' => 'listado.sitios','uses' => 'Listados\ListadosGeograficosController@sitios']);
    Route::get('listado/ubicaciones', ['as' => 'listado.ubicaciones','uses' => 'Listados\ListadosGeograficosController@ubicaciones']);

    //Reportes
    Route::get('listado/registros', ['as' => 'listado.registros','uses' => 'Listados\ListadosRegistrosController@registros']);






//Perfiles
Route::get('perfiles', ['as' => 'perfiles.index', 'uses' => 'Cuentas\PerfilesController@index']);
Route::get('perfiles/{nombre}', ['as' => 'perfiles.usuarios', 'uses' => 'Cuentas\PerfilesController@usuarios']);
Route::post('perfiles', ['as' => 'perfiles.guardar', 'uses' => 'Cuentas\PerfilesController@guardar']);
Route::patch('perfiles', ['as' => 'perfiles.editar', 'uses' => 'Cuentas\PerfilesController@editar']);
Route::delete('perfiles', ['as' => 'perfiles.eliminar', 'uses' => 'Cuentas\PerfilesController@eliminar']);



Route::get('buscar', ['as' => 'buscar.index', 'uses' => 'Buscar\BuscarController@index']);


Route::get('casa', function () {
    return 'casa';
});



Route::get('archivos', ['as' => 'archivo.index', 'uses' =>'Archivo\ArchivoController@importar']);
Route::get('archivos/exportar', ['as' => 'archivo.exportar.index', 'uses' =>'Archivo\ArchivoController@exportar_index']);
Route::post('archivos/exportar', ['as' => 'archivo.exportar', 'uses' =>'Archivo\ArchivoController@exportar']);
Route::post('archivo/importar', ['as' => 'archivo.guardar', 'uses' =>'Archivo\ArchivoController@guardar' ]);
Route::get('archivo/descargar/log', ['as' => 'archivo.descargar.log', 'uses' =>'Archivo\ArchivoController@descargarArchivoLog' ]);
Route::get('archivos/modelo/{tipo}', ['as' => 'archivo.modelo', 'uses' =>'Archivo\ArchivoController@modelo' ]);



//---------------------------
//   ESTADISTICAS
//---------------------------

    // Especies
    //---------------
    Route::get('estadisticas', ['as' => 'estadisticas.index',  function () {
        return view('estadisticas.index');
    }]);

    Route::get('estadisticas/especies', ['as' => 'estadisticas.especies', 'uses' => 'Estadisticas\EstadisticasEspeciesController@especies']);
    Route::get('estadisticas/especificos', ['as' => 'estadisticas.especificos', 'uses' => 'Estadisticas\EstadisticasEspeciesController@especificos']);
    Route::get('estadisticas/varietales', ['as' => 'estadisticas.varietales', 'uses' => 'Estadisticas\EstadisticasEspeciesController@varietales']);
    Route::get('estadisticas/formas', ['as' => 'estadisticas.formas', 'uses' => 'Estadisticas\EstadisticasEspeciesController@formas']);
    Route::get('estadisticas/autoridades', ['as' => 'estadisticas.autoridades', 'uses' => 'Estadisticas\EstadisticasEspeciesController@autoridades']);
    Route::get('estadisticas/sinonimias', ['as' => 'estadisticas.sinonimias', 'uses' => 'Estadisticas\EstadisticasEspeciesController@sinonimias']);
    Route::get('estadisticas/registros', ['as' => 'estadisticas.registros', 'uses' => 'Estadisticas\EstadisticasEspeciesController@registros']);


    // Taxonomia
    //---------------
    Route::get('estadisticas/taxonomias', ['as' => 'estadisticas.taxonomias', 'uses' => 'Estadisticas\EstadisticasTaxonomiasController@index']);
    Route::get('estadisticas/phylums', ['as' => 'estadisticas.phylums', 'uses' => 'Estadisticas\EstadisticasTaxonomiasController@phylums']);
    Route::get('estadisticas/clases', ['as' => 'estadisticas.clases', 'uses' => 'Estadisticas\EstadisticasTaxonomiasController@clases']);
    Route::get('estadisticas/subclases', ['as' => 'estadisticas.subclases', 'uses' => 'Estadisticas\EstadisticasTaxonomiasController@subclases']);
    Route::get('estadisticas/ordenes', ['as' => 'estadisticas.ordenes', 'uses' => 'Estadisticas\EstadisticasTaxonomiasController@ordenes']);
    Route::get('estadisticas/familias', ['as' => 'estadisticas.familias', 'uses' => 'Estadisticas\EstadisticasTaxonomiasController@familias']);
    Route::get('estadisticas/generos', ['as' => 'estadisticas.generos', 'uses' => 'Estadisticas\EstadisticasTaxonomiasController@generos']);



    // Geografia
    //---------------
    Route::get('estadisticas/geograficas', ['as' => 'estadisticas.geograficas', 'uses' => 'Estadisticas\EstadisticasGeograficasController@index']);
    Route::get('estadisticas/entidades', ['as' => 'estadisticas.entidades', 'uses' => 'Estadisticas\EstadisticasGeograficasController@entidades']);
    Route::get('estadisticas/localidades', ['as' => 'estadisticas.localidades', 'uses' => 'Estadisticas\EstadisticasGeograficasController@localidades']);
    Route::get('estadisticas/lugares', ['as' => 'estadisticas.lugares', 'uses' => 'Estadisticas\EstadisticasGeograficasController@lugares']);
    Route::get('estadisticas/sitios', ['as' => 'estadisticas.sitios', 'uses' => 'Estadisticas\EstadisticasGeograficasController@sitios']);


    // Geografia
    //---------------
    Route::get('estadisticas/bibliograficas', ['as' => 'estadisticas.bibliograficas', 'uses' => 'Estadisticas\EstadisticasBibliograficasController@index']);
    Route::get('estadisticas/libros', ['as' => 'estadisticas.libros', 'uses' => 'Estadisticas\EstadisticasBibliograficasController@libros']);
    Route::get('estadisticas/revistas', ['as' => 'estadisticas.revistas', 'uses' => 'Estadisticas\EstadisticasBibliograficasController@revistas']);
    Route::get('estadisticas/trabajos', ['as' => 'estadisticas.trabajos', 'uses' => 'Estadisticas\EstadisticasBibliograficasController@trabajos']);




Route::get('registros', ['as' => 'registros.index', 'uses' => 'RegistroController@index']);
Route::get('registros/nuevos', ['as' => 'registros.nuevo.index', 'uses' => 'RegistroController@nuevos']);
Route::get('registros/usuario', ['as' => 'usuario.registros', 'uses' => 'RegistroController@usuario']);

//---------------------------
//   Registros Venezuela
//---------------------------

// Taxonomia
//---------------

//Especifico
Route::get('especificos/crear', ['as' => 'especifico.crear', 'uses' => 'RegistrosVenezuela\Taxonomia\Epitetos\EspecificosController@crear']);
Route::post('especificos', ['as' => 'especifico.guardar', 'uses' => 'RegistrosVenezuela\Taxonomia\Epitetos\EspecificosController@guardar']);
Route::get('especificos/{id}', ['as' => 'especifico.mostrar', 'uses' => 'RegistrosVenezuela\Taxonomia\Epitetos\EspecificosController@mostrar']);
Route::get('especificos/{id}/editar', ['as' => 'especifico.editar', 'uses' => 'RegistrosVenezuela\Taxonomia\Epitetos\EspecificosController@editar']);
Route::patch('especificos/{id}/', ['as' => 'especifico.actualizar', 'uses' => 'RegistrosVenezuela\Taxonomia\Epitetos\EspecificosController@actualizar']);
Route::delete('especificos/{id}', ['as' => 'especifico.eliminar', 'uses' => 'RegistrosVenezuela\Taxonomia\Epitetos\EspecificosController@eliminar']);


//Varietal
Route::get('varietales/crear', ['as' => 'varietal.crear', 'uses' => 'RegistrosVenezuela\Taxonomia\Epitetos\VarietalesController@crear']);
Route::post('varietales', ['as' => 'varietal.guardar', 'uses' => 'RegistrosVenezuela\Taxonomia\Epitetos\VarietalesController@guardar']);
Route::get('varietales/{id}', ['as' => 'varietal.mostrar', 'uses' => 'RegistrosVenezuela\Taxonomia\Epitetos\VarietalesController@mostrar']);
Route::get('varietales/{id}/editar', ['as' => 'varietal.editar', 'uses' => 'RegistrosVenezuela\Taxonomia\Epitetos\VarietalesController@editar']);
Route::patch('varietales/{id}/', ['as' => 'varietal.actualizar', 'uses' => 'RegistrosVenezuela\Taxonomia\Epitetos\VarietalesController@actualizar']);
Route::delete('varietales/{id}', ['as' => 'varietal.eliminar', 'uses' => 'RegistrosVenezuela\Taxonomia\Epitetos\VarietalesController@eliminar']);


//Forma
Route::get('formas/crear', ['as' => 'forma.crear', 'uses' => 'RegistrosVenezuela\Taxonomia\Epitetos\FormasController@crear']);
Route::post('formas', ['as' => 'forma.guardar', 'uses' => 'RegistrosVenezuela\Taxonomia\Epitetos\FormasController@guardar']);
Route::get('formas/{id}', ['as' => 'forma.mostrar', 'uses' => 'RegistrosVenezuela\Taxonomia\Epitetos\FormasController@mostrar']);
Route::get('formas/{id}/editar', ['as' => 'forma.editar', 'uses' => 'RegistrosVenezuela\Taxonomia\Epitetos\FormasController@editar']);
Route::patch('formas/{id}/', ['as' => 'forma.actualizar', 'uses' => 'RegistrosVenezuela\Taxonomia\Epitetos\FormasController@actualizar']);
Route::delete('formas/{id}', ['as' => 'forma.eliminar', 'uses' => 'RegistrosVenezuela\Taxonomia\Epitetos\FormasController@eliminar']);


//Especies
Route::get('especies/crear', ['as' => 'especie.crear', 'uses' => 'RegistrosVenezuela\Taxonomia\EspeciesController@crear']);
Route::post('especies', ['as' => 'especie.guardar', 'uses' => 'RegistrosVenezuela\Taxonomia\EspeciesController@guardar']);
Route::get('especies/{id}', ['as' => 'especie.mostrar', 'uses' => 'RegistrosVenezuela\Taxonomia\EspeciesController@mostrar']);
Route::get('especies/{id}/editar', ['as' => 'especie.editar', 'uses' => 'RegistrosVenezuela\Taxonomia\EspeciesController@editar']);
Route::patch('especies/{id}/', ['as' => 'especie.actualizar', 'uses' => 'RegistrosVenezuela\Taxonomia\EspeciesController@actualizar']);
Route::delete('especies/{id}', ['as' => 'especie.eliminar', 'uses' => 'RegistrosVenezuela\Taxonomia\EspeciesController@eliminar']);
Route::post('especies/{id}/sinonimia/quitar', ['as' => 'especie.sinonimia.quitar', 'uses' => 'RegistrosVenezuela\Taxonomia\EspeciesController@sinonimiaQuitar']);
Route::post('especies/{id}/sinonimia/agregar', ['as' => 'especie.sinonimia.agregar', 'uses' => 'RegistrosVenezuela\Taxonomia\EspeciesController@sinonimiaAgregar']);

//Generos
Route::get('generos/crear', ['as' => 'genero.crear', 'uses' => 'RegistrosVenezuela\Taxonomia\GenerosController@crear']);
Route::post('generos', ['as' => 'genero.guardar', 'uses' => 'RegistrosVenezuela\Taxonomia\GenerosController@guardar']);
Route::get('generos/{id}', ['as' => 'genero.mostrar', 'uses' => 'RegistrosVenezuela\Taxonomia\GenerosController@mostrar']);
Route::get('generos/{id}/editar', ['as' => 'genero.editar', 'uses' => 'RegistrosVenezuela\Taxonomia\GenerosController@editar']);
Route::patch('generos/{id}/', ['as' => 'genero.actualizar', 'uses' => 'RegistrosVenezuela\Taxonomia\GenerosController@actualizar']);
Route::delete('generos/{id}', ['as' => 'genero.eliminar', 'uses' => 'RegistrosVenezuela\Taxonomia\GenerosController@eliminar']);

//Familias
Route::get('familias/crear', ['as' => 'familia.crear', 'uses' => 'RegistrosVenezuela\Taxonomia\FamiliasController@crear']);
Route::post('familias', ['as' => 'familia.guardar', 'uses' => 'RegistrosVenezuela\Taxonomia\FamiliasController@guardar']);
Route::get('familias/{id}', ['as' => 'familia.mostrar', 'uses' => 'RegistrosVenezuela\Taxonomia\FamiliasController@mostrar']);
Route::get('familias/{id}/editar', ['as' => 'familia.editar', 'uses' => 'RegistrosVenezuela\Taxonomia\FamiliasController@editar']);
Route::patch('familias/{id}/', ['as' => 'familia.actualizar', 'uses' => 'RegistrosVenezuela\Taxonomia\FamiliasController@actualizar']);
Route::delete('familias/{id}', ['as' => 'familia.eliminar', 'uses' => 'RegistrosVenezuela\Taxonomia\FamiliasController@eliminar']);
Route::get('familia/{id}/taxonomia', ['as' => 'familia.taxo', 'uses' => 'RegistrosVenezuela\Taxonomia\FamiliasController@taxonomia']);

//Ordenes
Route::get('ordenes/crear', ['as' => 'orden.crear', 'uses' => 'RegistrosVenezuela\Taxonomia\OrdenesController@crear']);
Route::post('ordenes', ['as' => 'orden.guardar', 'uses' => 'RegistrosVenezuela\Taxonomia\OrdenesController@guardar']);
Route::get('ordenes/{id}', ['as' => 'orden.mostrar', 'uses' => 'RegistrosVenezuela\Taxonomia\OrdenesController@mostrar']);
Route::get('ordenes/{id}/editar', ['as' => 'orden.editar', 'uses' => 'RegistrosVenezuela\Taxonomia\OrdenesController@editar']);
Route::patch('ordenes/{id}/', ['as' => 'orden.actualizar', 'uses' => 'RegistrosVenezuela\Taxonomia\OrdenesController@actualizar']);
Route::delete('ordenes/{id}', ['as' => 'orden.eliminar', 'uses' => 'RegistrosVenezuela\Taxonomia\OrdenesController@eliminar']);

//Subclases
Route::get('subclases/crear', ['as' => 'subclase.crear', 'uses' => 'RegistrosVenezuela\Taxonomia\SubclasesController@crear']);
Route::post('subclases', ['as' => 'subclase.guardar', 'uses' => 'RegistrosVenezuela\Taxonomia\SubclasesController@guardar']);
Route::get('subclases/{id}', ['as' => 'subclase.mostrar', 'uses' => 'RegistrosVenezuela\Taxonomia\SubclasesController@mostrar']);
Route::get('subclases/{id}/editar', ['as' => 'subclase.editar', 'uses' => 'RegistrosVenezuela\Taxonomia\SubclasesController@editar']);
Route::patch('subclases/{id}/', ['as' => 'subclase.actualizar', 'uses' => 'RegistrosVenezuela\Taxonomia\SubclasesController@actualizar']);
Route::delete('subclases/{id}', ['as' => 'subclase.eliminar', 'uses' => 'RegistrosVenezuela\Taxonomia\SubclasesController@eliminar']);

//Clases
Route::get('clases/crear', ['as' => 'clase.crear', 'uses' => 'RegistrosVenezuela\Taxonomia\ClasesController@crear']);
Route::post('clases', ['as' => 'clase.guardar', 'uses' => 'RegistrosVenezuela\Taxonomia\ClasesController@guardar']);
Route::get('clases/{id}', ['as' => 'clase.mostrar', 'uses' => 'RegistrosVenezuela\Taxonomia\ClasesController@mostrar']);
Route::get('clases/{id}/editar', ['as' => 'clase.editar', 'uses' => 'RegistrosVenezuela\Taxonomia\ClasesController@editar']);
Route::patch('clases/{id}/', ['as' => 'clase.actualizar', 'uses' => 'RegistrosVenezuela\Taxonomia\ClasesController@actualizar']);
Route::delete('clases/{id}', ['as' => 'clase.eliminar', 'uses' => 'RegistrosVenezuela\Taxonomia\ClasesController@eliminar']);

//Phylum
Route::get('phylums/crear', ['as' => 'phylum.crear', 'uses' => 'RegistrosVenezuela\Taxonomia\PhylumsController@crear']);
Route::post('phylums', ['as' => 'phylum.guardar', 'uses' => 'RegistrosVenezuela\Taxonomia\PhylumsController@guardar']);
Route::get('phylums/{id}', ['as' => 'phylum.mostrar', 'uses' => 'RegistrosVenezuela\Taxonomia\PhylumsController@mostrar']);
Route::get('phylums/{id}/editar', ['as' => 'phylum.editar', 'uses' => 'RegistrosVenezuela\Taxonomia\PhylumsController@editar']);
Route::patch('phylums/{id}/', ['as' => 'phylum.actualizar', 'uses' => 'RegistrosVenezuela\Taxonomia\PhylumsController@actualizar']);
Route::delete('phylums/{id}', ['as' => 'phylum.eliminar', 'uses' => 'RegistrosVenezuela\Taxonomia\PhylumsController@eliminar']);


//Taxonomias
Route::get('taxonomia/phylum', ['as' => 'taxonomia.phylum', 'uses' => 'RegistrosVenezuela\Taxonomia\TaxonomiasController@getTaxonomiaPhylum']);
Route::get('taxonomia/clase', ['as' => 'taxonomia.clase', 'uses' => 'RegistrosVenezuela\Taxonomia\TaxonomiasController@getTaxonomiaClase']);
Route::get('taxonomia/subclase', ['as' => 'taxonomia.subclase', 'uses' => 'RegistrosVenezuela\Taxonomia\TaxonomiasController@getTaxonomiaSubclase']);
Route::get('taxonomia/orden', ['as' => 'taxonomia.orden', 'uses' => 'RegistrosVenezuela\Taxonomia\TaxonomiasController@getTaxonomiaOrden']);
Route::get('taxonomia/familia', ['as' => 'taxonomia.familia', 'uses' => 'RegistrosVenezuela\Taxonomia\TaxonomiasController@getTaxonomiaFamilia']);
Route::get('taxonomia/genero', ['as' => 'taxonomia.genero', 'uses' => 'RegistrosVenezuela\Taxonomia\TaxonomiasController@getTaxonomiaGenero']);
Route::post('taxonomia/{taxo}', ['as' => 'taxonomia.guardar', 'uses' => 'RegistrosVenezuela\Taxonomia\TaxonomiasController@guardar']);





// Autor
//-----------------

Route::get('autores/crear', ['as' => 'autor.crear', 'uses' => 'RegistrosVenezuela\AutoresController@crear']);
Route::post('autores', ['as' => 'autor.guardar', 'uses' => 'RegistrosVenezuela\AutoresController@guardar']);
Route::get('autores/{id}', ['as' => 'autor.mostrar', 'uses' => 'RegistrosVenezuela\AutoresController@mostrar']);
Route::get('autores/{id}/editar', ['as' => 'autor.editar', 'uses' => 'RegistrosVenezuela\AutoresController@editar']);
Route::patch('autores/{id}/', ['as' => 'autor.actualizar', 'uses' => 'RegistrosVenezuela\AutoresController@actualizar']);
Route::delete('autores/{id}', ['as' => 'autor.eliminar', 'uses' => 'RegistrosVenezuela\AutoresController@eliminar']);

// Sinonimia
//-----------------
Route::post('sinonimias/asociacion', ['as' => 'sinonimia.asociacion', 'uses' => 'RegistrosVenezuela\Sinonimia\SinonimiaController@asociacion']);

Route::get('sinonimias/crear', ['as' => 'sinonimia.crear', 'uses' => 'RegistrosVenezuela\Sinonimia\SinonimiaController@crear']);
Route::post('sinonimias', ['as' => 'sinonimia.guardar', 'uses' => 'RegistrosVenezuela\Sinonimia\SinonimiaController@guardar']);
Route::get('sinonimias/listado', ['as' => 'sinonimia.listado', 'uses' => 'RegistrosVenezuela\Sinonimia\SinonimiaController@listado']);
Route::get('sinonimias/{id}', ['as' => 'sinonimia.mostrar', 'uses' => 'RegistrosVenezuela\Sinonimia\SinonimiaController@mostrar']);
Route::get('sinonimias/{id}/editar', ['as' => 'sinonimia.editar', 'uses' => 'RegistrosVenezuela\Sinonimia\SinonimiaController@editar']);
Route::patch('sinonimias/{id}/', ['as' => 'sinonimia.actualizar', 'uses' => 'RegistrosVenezuela\Sinonimia\SinonimiaController@actualizar']);
Route::delete('sinonimias/{id}', ['as' => 'sinonimia.eliminar', 'uses' => 'RegistrosVenezuela\Sinonimia\SinonimiaController@eliminar']);
Route::post('sinonimias/{id}/especie/quitar', ['as' => 'sinonimia.especie.quitar', 'uses' => 'RegistrosVenezuela\Sinonimia\SinonimiaController@especieQuitar']);




//---------------------------<<<<<<<<<<
//  END Registros Venezuela
//---------------------------<<<<<<<<<<





//Route::get('pruebas', ['as' => 'pruebas', 'uses' => 'PruebasController@index']);
Route::get('pruebas', function(){

    return view('prueba');
});



//---------------------------
//  GEOGRAFICOS
//---------------------------


Route::get('pais/venezuela', ['as' => 'pais.mostrar', 'uses' => 'Geograficos\PaisesController@mostrar']);


//Entidad
Route::get('entidades/crear', ['as' => 'entidad.crear', 'uses' => 'Geograficos\EntidadesController@crear']);
Route::post('entidades', ['as' => 'entidad.guardar', 'uses' => 'Geograficos\EntidadesController@guardar']);
Route::get('entidades/{id}', ['as' => 'entidad.mostrar', 'uses' => 'Geograficos\EntidadesController@mostrar']);
Route::get('entidades/{id}/editar', ['as' => 'entidad.editar', 'uses' => 'Geograficos\EntidadesController@editar']);
Route::patch('entidades/{id}/', ['as' => 'entidad.actualizar', 'uses' => 'Geograficos\EntidadesController@actualizar']);
Route::delete('entidades/{id}', ['as' => 'entidad.eliminar', 'uses' => 'Geograficos\EntidadesController@eliminar']);


//Localidad
Route::get('localidades/crear', ['as' => 'localidad.crear', 'uses' => 'Geograficos\LocalidadesController@crear']);
Route::post('localidades', ['as' => 'localidad.guardar', 'uses' => 'Geograficos\LocalidadesController@guardar']);
Route::get('localidades/{id}', ['as' => 'localidad.mostrar', 'uses' => 'Geograficos\LocalidadesController@mostrar']);
Route::get('localidades/{id}/editar', ['as' => 'localidad.editar', 'uses' => 'Geograficos\LocalidadesController@editar']);
Route::patch('localidades/{id}/', ['as' => 'localidad.actualizar', 'uses' => 'Geograficos\LocalidadesController@actualizar']);
Route::delete('localidades/{id}', ['as' => 'localidad.eliminar', 'uses' => 'Geograficos\LocalidadesController@eliminar']);


//Lugar
Route::get('lugares/crear', ['as' => 'lugar.crear', 'uses' => 'Geograficos\LugaresController@crear']);
Route::post('lugares', ['as' => 'lugar.guardar', 'uses' => 'Geograficos\LugaresController@guardar']);
Route::get('lugares/{id}', ['as' => 'lugar.mostrar', 'uses' => 'Geograficos\LugaresController@mostrar']);
Route::get('lugares/{id}/editar', ['as' => 'lugar.editar', 'uses' => 'Geograficos\LugaresController@editar']);
Route::patch('lugares/{id}/', ['as' => 'lugar.actualizar', 'uses' => 'Geograficos\LugaresController@actualizar']);
Route::delete('lugares/{id}', ['as' => 'lugar.eliminar', 'uses' => 'Geograficos\LugaresController@eliminar']);


//Sitio
Route::get('sitios/crear', ['as' => 'sitio.crear', 'uses' => 'Geograficos\SitiosController@crear']);
Route::post('sitios', ['as' => 'sitio.guardar', 'uses' => 'Geograficos\SitiosController@guardar']);
Route::get('sitios/{id}', ['as' => 'sitio.mostrar', 'uses' => 'Geograficos\SitiosController@mostrar']);
Route::get('sitios/{id}/editar', ['as' => 'sitio.editar', 'uses' => 'Geograficos\SitiosController@editar']);
Route::patch('sitios/{id}/', ['as' => 'sitio.actualizar', 'uses' => 'Geograficos\SitiosController@actualizar']);
Route::delete('sitios/{id}', ['as' => 'sitio.eliminar', 'uses' => 'Geograficos\SitiosController@eliminar']);


//Ubicación

Route::get('ubicacion/crear', ['as' => 'ubicacion.crear', 'uses' => 'Geograficos\UbicacionController@crear']);
Route::post('ubicacion', ['as' => 'ubicacion.guardar', 'uses' => 'Geograficos\UbicacionController@guardar']);
Route::get('ubicacion/{id}', ['as' => 'ubicacion.mostrar', 'uses' => 'Geograficos\UbicacionController@mostrar']);
Route::get('ubicacion/{id}/editar', ['as' => 'ubicacion.editar', 'uses' => 'Geograficos\UbicacionController@editar']);
Route::patch('ubicacion/{id}/', ['as' => 'ubicacion.actualizar', 'uses' => 'Geograficos\UbicacionController@actualizar']);
Route::delete('ubicacion/{id}', ['as' => 'ubicacion.eliminar', 'uses' => 'Geograficos\UbicacionController@eliminar']);


//---------------------------
//  END GEOGRAFICOS
//---------------------------




//---------------------------
//  REFERENCIAS
//---------------------------



//Cita
Route::get('referencias/crear', ['as' => 'referencias.crear', 'uses' => 'Bibliografia\ReferenciasController@crear']);
//Route::post('citas', ['as' => 'cita.guardar', 'uses' => 'Bibliografia\CitasController@guardar']);
//Route::get('citas/{id}', ['as' => 'cita.mostrar', 'uses' => 'Bibliografia\CitasController@mostrar']);


//Libros
//Route::get('referencias/libros/crear', ['as' => 'libro.crear', 'uses' => 'Bibliografia\Referencias\LibrosController@crear']);
Route::post('referencias/libros', ['as' => 'libro.guardar', 'uses' => 'Bibliografia\Referencias\LibrosController@guardar']);
Route::get('referencias/libros/{id}', ['as' => 'libro.mostrar', 'uses' => 'Bibliografia\Referencias\LibrosController@mostrar']);
Route::get('referencias/libros/{id}/editar', ['as' => 'libro.editar', 'uses' => 'Bibliografia\Referencias\LibrosController@editar']);
Route::patch('referencias/libros/{id}/', ['as' => 'libro.actualizar', 'uses' => 'Bibliografia\Referencias\LibrosController@actualizar']);
Route::delete('referencias/libros/{id}', ['as' => 'libro.eliminar', 'uses' => 'Bibliografia\Referencias\LibrosController@eliminar']);



//Revistas
//Route::get('referencias/revistas/crear', ['as' => 'revista.crear', 'uses' => 'Bibliografia\Referencias\RevistasController@crear']);
Route::post('referencias/revistas', ['as' => 'revista.guardar', 'uses' => 'Bibliografia\Referencias\RevistasController@guardar']);
Route::get('referencias/revistas/{id}', ['as' => 'revista.mostrar', 'uses' => 'Bibliografia\Referencias\RevistasController@mostrar']);
Route::get('referencias/revistas/{id}/editar', ['as' => 'revista.editar', 'uses' => 'Bibliografia\Referencias\RevistasController@editar']);
Route::patch('referencias/revistas/{id}/', ['as' => 'revista.actualizar', 'uses' => 'Bibliografia\Referencias\RevistasController@actualizar']);
Route::delete('referencias/revistas/{id}', ['as' => 'revista.eliminar', 'uses' => 'Bibliografia\Referencias\RevistasController@eliminar']);


//Trabajos
//Route::get('referencias/trabajos/crear', ['as' => 'trabajo.crear', 'uses' => 'Bibliografia\Referencias\TrabajosController@crear']);
Route::post('referencias/trabajos', ['as' => 'trabajo.guardar', 'uses' => 'Bibliografia\Referencias\TrabajosController@guardar']);
Route::get('referencias/trabajos/{id}', ['as' => 'trabajo.mostrar', 'uses' => 'Bibliografia\Referencias\TrabajosController@mostrar']);
Route::get('referencias/trabajos/{id}/editar', ['as' => 'trabajo.editar', 'uses' => 'Bibliografia\Referencias\TrabajosController@editar']);
Route::patch('referencias/trabajos/{id}/', ['as' => 'trabajo.actualizar', 'uses' => 'Bibliografia\Referencias\TrabajosController@actualizar']);
Route::delete('referencias/trabajos/{id}', ['as' => 'trabajo.eliminar', 'uses' => 'Bibliografia\Referencias\TrabajosController@eliminar']);


//Trabajos
//Route::get('referencias/trabajos/crear', ['as' => 'trabajo.crear', 'uses' => 'Bibliografia\Referencias\TrabajosController@crear']);
Route::post('referencias/enlaces', ['as' => 'enlace.guardar', 'uses' => 'Bibliografia\Referencias\EnlacesController@guardar']);
Route::get('referencias/enlaces/{id}', ['as' => 'enlace.mostrar', 'uses' => 'Bibliografia\Referencias\EnlacesController@mostrar']);
Route::get('referencias/enlaces/{id}/editar', ['as' => 'enlace.editar', 'uses' => 'Bibliografia\Referencias\EnlacesController@editar']);
Route::patch('referencias/enlaces/{id}/', ['as' => 'enlace.actualizar', 'uses' => 'Bibliografia\Referencias\EnlacesController@actualizar']);
Route::delete('referencias/enlaces/{id}', ['as' => 'enlace.eliminar', 'uses' => 'Bibliografia\Referencias\EnlacesController@eliminar']);


//Enlaces
//Route::get('referencias/enlaces/crear', ['as' => 'enlace.crear', 'uses' => 'Bibliografia\Referencias\EnlacesController@crear']);
Route::post('referencias/enlaces', ['as' => 'enlace.guardar', 'uses' => 'Bibliografia\Referencias\EnlacesController@guardar']);
Route::get('referencias/enlaces/{id}', ['as' => 'enlace.mostrar', 'uses' => 'Bibliografia\Referencias\EnlacesController@mostrar']);


//---------------------------
//  END REFERENCIAS
//---------------------------





//---------------------------
//  REGISTRO AL CATÁLOGO
//---------------------------

//Libros
//Route::get('catalogo/crear', ['as' => 'catalogo.crear', 'uses' => 'Catalogo\RegistrosController@crear']);
//Route::post('catalogo', ['as' => 'catalogo.guardar', 'uses' => 'Catalogo\RegistrosController@guardar']);



Route::get('reportes', ['as' => 'reporte.crear', 'uses' => 'Catalogo\RegistrosController@crear']);
Route::post('reportes', ['as' => 'reporte.guardar', 'uses' => 'Catalogo\RegistrosController@guardar']);
Route::get('reportes/{id}', ['as' => 'reporte.mostrar', 'uses' => 'Catalogo\RegistrosController@mostrar']);
Route::get('reportes/{id}/editar', ['as' => 'reporte.editar', 'uses' => 'Catalogo\RegistrosController@editar']);
Route::patch('reportes/{id}/', ['as' => 'reporte.actualizar', 'uses' => 'Catalogo\RegistrosController@actualizar']);
Route::delete('reportes/{id}', ['as' => 'reporte.eliminar', 'uses' => 'Catalogo\RegistrosController@eliminar']);
Route::patch('reportes/{id}/sinonimia-ubicacion/{id_tabla}', ['as' => 'reporte.actualizar.sin-ubi', 'uses' => 'Catalogo\RegistrosController@actualizarReporteUbicacionSinonimia']);
Route::delete('reportes/sinonimia-ubicacion/{id}', ['as' => 'reporte.eliminar.sin-ubi', 'uses' => 'Catalogo\RegistrosController@eliminarReporteUbicacionSinonimia']);
Route::get('reportes/{id}/sinonimia-ubicacion', ['as' => 'reporte.ubicacion', 'uses' => 'Catalogo\RegistrosController@getSinonimiaUbicacionRUStabla']);
Route::post('reportes/{id}/sinonimia-ubicacion', ['as' => 'reporte.agregar.sin-ubi', 'uses' => 'Catalogo\RegistrosController@agregarReporteUbicacionSinonimia']);


//---------------------------
//  END REGISTROS AL CATÁLOGO
//---------------------------







//---------------------------
//  REGISTRO TEMPORALES
//---------------------------

Route::get('temporales/usuario', ['as' => 'usuario.temporales', 'uses' => 'RegistrosTemporales\TemporalesController@temporales']);
Route::get('temporales', ['as' => 'temporal.index', 'uses' => 'RegistrosTemporales\TemporalesController@index']);
Route::get('temporales/crear', ['as' => 'temporal.crear', 'uses' => 'RegistrosTemporales\TemporalesController@crear']);
Route::post('temporales', ['as' => 'temporal.guardar', 'uses' => 'RegistrosTemporales\TemporalesController@guardar']);
Route::get('temporales/{id}', ['as' => 'temporal.mostrar', 'uses' => 'RegistrosTemporales\TemporalesController@mostrar']);
//Route::get('temporales/{id}/editar', ['as' => 'temporal.editar', 'uses' => 'RegistrosTemporales\TemporalesController@editar']);
//Route::patch('temporales/{id}/', ['as' => 'temporal.actualizar', 'uses' => 'RegistrosTemporales\TemporalesController@actualizar']);
Route::delete('temporales/{id}', ['as' => 'temporal.eliminar', 'uses' => 'RegistrosTemporales\TemporalesController@eliminar']);



//---------------------------
//  END REGISTROS AL CATÁLOGO
//---------------------------





//---------->>>>>>>>>>
// BUSQUEDAS
//---------->>>>>>>>>>
Route::get('buscar', ['as' => 'buscar.index', 'uses' => 'Buscar\BusquedasController@index']);
Route::get('buscar/especies', ['as' => 'buscar.especies.index', 'uses' => 'Buscar\BusquedasController@especies']);
Route::post('buscar/especies', ['as' => 'buscar.especies', 'uses' => 'Buscar\BusquedasController@buscarEspeciesYSinonimias']);

Route::get('buscar/taxonomia', ['as' => 'buscar.taxonomia.index', 'uses' => 'Buscar\BusquedasController@taxonomia']);
Route::get('buscar/ubicacion', ['as' => 'buscar.ubicacion.index', 'uses' => 'Buscar\BusquedasController@ubicacion']);
Route::get('buscar/referencia', ['as' => 'buscar.referencia.index', 'uses' => 'Buscar\BusquedasController@referencia']);

    //Taxonomias
    Route::get('buscar/formas/{query}', ['as' => 'buscar.formas', 'uses' => 'Buscar\BusquedasController@getformas']);
    Route::get('buscar/varietales/{query}', ['as' => 'buscar.varietales', 'uses' => 'Buscar\BusquedasController@getVarietales']);
    Route::get('buscar/especificos/{query}', ['as' => 'buscar.especificos', 'uses' => 'Buscar\BusquedasController@getEspecificos']);
    Route::get('buscar/autores/{query}', ['as' => 'buscar.autores', 'uses' => 'Buscar\BusquedasController@getAutores']);
    Route::get('buscar/especies-sinonimias/{query}', ['as' => 'buscar.especies_sinonimias', 'uses' => 'Buscar\BusquedasController@getEspeciesYSinonimias']);
    Route::get('buscar/generos/{query}', ['as' => 'buscar.generos', 'uses' => 'Buscar\BusquedasController@getGeneros']);
    Route::get('buscar/familias/{query}', ['as' => 'buscar.familias', 'uses' => 'Buscar\BusquedasController@getFamilias']);
    Route::get('buscar/ordenes/{query}', ['as' => 'buscar.ordenes', 'uses' => 'Buscar\BusquedasController@getOrdenes']);
    Route::get('buscar/subclases/{query}', ['as' => 'buscar.subclases', 'uses' => 'Buscar\BusquedasController@getSubclases']);
    Route::get('buscar/clases/{query}', ['as' => 'buscar.clases', 'uses' => 'Buscar\BusquedasController@getClases']);
    Route::get('buscar/phylums/{query}', ['as' => 'buscar.phylums', 'uses' => 'Buscar\BusquedasController@getPhylums']);

    //Ubicacion
    Route::get('buscar/entidades/{query}', ['as' => 'buscar.entidades', 'uses' => 'Buscar\BusquedasController@getEntidades']);
    Route::get('buscar/localidades/{query}', ['as' => 'buscar.localidades', 'uses' => 'Buscar\BusquedasController@getLocalidades']);
    Route::get('buscar/lugares/{query}', ['as' => 'buscar.lugares', 'uses' => 'Buscar\BusquedasController@getLugares']);
    Route::get('buscar/sitios/{query}', ['as' => 'buscar.sitios', 'uses' => 'Buscar\BusquedasController@getSitios']);

    Route::get('buscar/ubicaciones/{query}', ['as' => 'buscar.ubicaciones', 'uses' => 'Buscar\BusquedasController@getUbicaciones']);

    //Referencias
    Route::get('buscar/libros/autores/{query}', ['as' => 'buscar.libros.autores', 'uses' => 'Buscar\BusquedasController@getLibrosAutores']);
    Route::get('buscar/libros/titulos/{query}', ['as' => 'buscar.libros.titulos', 'uses' => 'Buscar\BusquedasController@getLibrosTitulos']);
    Route::get('buscar/revistas/autores/{query}', ['as' => 'buscar.revistas.autores', 'uses' => 'Buscar\BusquedasController@getRevistasAutores']);
    Route::get('buscar/revistas/titulos/{query}', ['as' => 'buscar.revistas.titulos', 'uses' => 'Buscar\BusquedasController@getRevistasTitulos']);
    Route::get('buscar/trabajos/autores/{query}', ['as' => 'buscar.trabajos.autores', 'uses' => 'Buscar\BusquedasController@getTrabajosAutores']);
    Route::get('buscar/trabajos/titulos/{query}', ['as' => 'buscar.trabajos.titulos', 'uses' => 'Buscar\BusquedasController@getTrabajosTitulos']);





Route::get('log', ['as' => 'log.index','uses' => 'Logs\LogsController@index']);










//---------------------------
//  PROCESAMIENTO DE IMAGENES
//---------------------------
Route::post('imagenes/{id}', ['as' => 'imagen.agregar', 'uses' => 'Imagenes\ImagenesController@agregar']);
Route::delete('imagenes/{id}', ['as' => 'imagen.eliminar', 'uses' => 'Imagenes\ImagenesController@eliminar']);



//---------------------------
//  END  PROCESAMIENTO DE IMAGENES
//---------------------------




