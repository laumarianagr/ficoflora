<?php

namespace App\Providers;

use App\Modelos\Cuentas\Perfil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeNavBar();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     *Muestra el nombre del usuario autenticado en el navbar
     */
    private function composeNavBar()
    {
        view()->composer('master', function ($view) {
            $usuario=Auth::user();
            $perfil= Perfil::find($usuario->perfil_id);
            $view->with('usuario',$usuario)->with('perfil',$perfil);
        });
    }
}
