<?php

namespace App\Http\Middleware\Creador\Bibliografias;

use App\Modelos\Bibliografia\Referencias\Enlace;
use App\Modelos\Bibliografia\Referencias\Libro;
use App\Modelos\Bibliografia\Referencias\Revista;
use App\Modelos\Bibliografia\Referencias\Trabajo;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class EnlacesCreador
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
        $especie = Enlace::find($request->route()->parameter('id'));;

        if($especie->creador_id != $usuario->id){
            return redirect('/inicio')->withErrors("")->with('permisos', "Usuario no Autorizado");

        }


        return $next($request);
    }
}