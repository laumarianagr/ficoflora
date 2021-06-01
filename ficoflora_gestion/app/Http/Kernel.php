<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \App\Http\Middleware\Authenticate::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'admin' => \App\Http\Middleware\Administrador::class,
        'coordinador' => \App\Http\Middleware\Coordinador::class,
        'inv.editor' => \App\Http\Middleware\InvestigadorEditor::class,
        'equipo.editor' => \App\Http\Middleware\EquipoEditor::class,
        'equipo.coordinador' => \App\Http\Middleware\EquipoCoordinador::class,
        'investigador' => \App\Http\Middleware\Investigador::class,

        //Creador
            'creador.autores' => \App\Http\Middleware\Creador\Taxonomias\AutoresCreador::class,
            'creador.sinonimias' => \App\Http\Middleware\Creador\Taxonomias\SinonimiasCreador::class,
            'creador.especies' => \App\Http\Middleware\Creador\Taxonomias\EspeciesCreador::class,
            'creador.especificos' => \App\Http\Middleware\Creador\Taxonomias\EspecificosCreador::class,
            'creador.varietales' => \App\Http\Middleware\Creador\Taxonomias\VarietalesCreador::class,
            'creador.formas' => \App\Http\Middleware\Creador\Taxonomias\FormasCreador::class,
            'creador.subespecies' => \App\Http\Middleware\Creador\Taxonomias\SubespeciesCreador::class,
            'creador.generos' => \App\Http\Middleware\Creador\Taxonomias\GenerosCreador::class,
            'creador.familias' => \App\Http\Middleware\Creador\Taxonomias\FamiliasCreador::class,
            'creador.ordenes' => \App\Http\Middleware\Creador\Taxonomias\OrdenesCreador::class,
            'creador.subclases' => \App\Http\Middleware\Creador\Taxonomias\SubclasesCreador::class,
            'creador.clases' => \App\Http\Middleware\Creador\Taxonomias\ClasesCreador::class,
            'creador.phylum' => \App\Http\Middleware\Creador\Taxonomias\PhylumCreador::class,
            'creador.registros' => \App\Http\Middleware\Creador\RegistroCreador::class,

            //referencias
            'creador.libros' => \App\Http\Middleware\Creador\Bibliografias\LibrosCreador::class,
            'creador.revistas' => \App\Http\Middleware\Creador\Bibliografias\RevistasCreador::class,
            'creador.trabajos' => \App\Http\Middleware\Creador\Bibliografias\TrabajosCreador::class,
            'creador.enlaces' => \App\Http\Middleware\Creador\Bibliografias\EnlacesCreador::class,

            //Geograficos
            'creador.entidades' => \App\Http\Middleware\Creador\Geograficos\EntidadesCreador::class,
            'creador.localidades' => \App\Http\Middleware\Creador\Geograficos\LocalidadesCreador::class,
            'creador.lugares' => \App\Http\Middleware\Creador\Geograficos\LugaresCreador::class,
            'creador.sitios' => \App\Http\Middleware\Creador\Geograficos\SitiosCreador::class,


    ];
}
