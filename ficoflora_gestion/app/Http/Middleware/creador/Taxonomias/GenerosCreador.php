<?php

namespace App\Http\Middleware\Creador\Taxonomias;

use App\Modelos\Taxonomia\Epitetos\Especifico;
use App\Modelos\Taxonomia\Genero;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class GenerosCreador
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
        $especie = Genero::find($request->route()->parameter('id'));;

        if($especie->creador_id != $usuario->id){
            return redirect('/inicio')->withErrors("")->with('permisos', "Usuario no Autorizado");

        }


        return $next($request);
    }
}
