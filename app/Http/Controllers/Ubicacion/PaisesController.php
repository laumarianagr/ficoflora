<?php

namespace App\Http\Controllers\Ubicacion;

use App\Modelos\Geografico\Entidad;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaisesController extends Controller
{

    public function entidades()
    {
        $entidades = Entidad::all();

        $ubicacion['pais'] = 'Venezuela';

        $total = count($entidades);

        foreach ($entidades as $entidad) {
            $entidad['especies'] = count($entidad->especies()->conCatalogo(true)->get());
            $entidad['localidades'] = count($entidad->localidades()->get());
        }


        return view('ubicacion.pais.index-entidades', compact('entidades', 'ubicacion', 'total'));
    }
}
