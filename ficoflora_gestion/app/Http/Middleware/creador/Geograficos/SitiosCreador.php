<?php

namespace App\Http\Middleware\Creador\Geograficos;

use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class SitiosCreador
{
    protected $auth;


    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function handle($request, Closure $next)
    {
        $usuario = $this->auth->user();

        if (($usuario->admin()) ||  ($usuario->coordinador())){
            return $next($request);
        }

//        dd($request->route()->parameter('id'));
        $especie = Sitio::find($request->route()->parameter('id'));;

        if($especie->creador_id != $usuario->id){
            return redirect('/inicio')->withErrors("")->with('permisos', "Usuario no Autorizado");

        }


        return $next($request);
    }
}
