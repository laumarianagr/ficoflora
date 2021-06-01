<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class EquipoEditor
{
    protected $auth;


    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function handle($request, Closure $next)
    {
        $usuario = $this->auth->user();

        if (!$usuario->admin() && !$usuario->coordinador() && !$usuario->InvEditor()) {
            return redirect('/inicio')->withErrors("")->with('permisos', "Usuario no Autorizado");

        }

        return $next($request);
    }
}
