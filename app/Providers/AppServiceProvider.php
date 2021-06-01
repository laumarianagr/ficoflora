<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('master', function ($view) {
            $fecha = Carbon::now();

            $meses=[
                1 =>'Enero',
                2 =>'Febrero',
                3 =>'Marzo',
                4 =>'Abril',
                5 =>'Mayo',
                6 =>'Junio',
                7 =>'Julio',
                8 =>'Agosto',
                9 =>'Septiembre',
                10 =>'Octubre',
                11=>'Noviembre',
                12=>'Diciembre',
            ];

            $view->with('mes',$meses[$fecha->month]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
