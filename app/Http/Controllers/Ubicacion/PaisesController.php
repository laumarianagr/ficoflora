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
        $info_coordenadas = null;

        foreach ($entidades as $entidad) {
            $entidad['especies'] = count($entidad->especies()->conCatalogo(true)->get());
            $entidad['localidades'] = count($entidad->localidades()->get());
            $info_coordenadas[$entidad['id']] = ['latitud' =>$entidad['latitud'], 'longitud'=>$entidad['longitud'], 'nombre'=>$entidad['nombre']];

        }

        $coordenadas = collect($info_coordenadas);
        return view('ubicacion.pais.index-entidades', compact('entidades', 'ubicacion', 'total', 'coordenadas'));
    }
}
