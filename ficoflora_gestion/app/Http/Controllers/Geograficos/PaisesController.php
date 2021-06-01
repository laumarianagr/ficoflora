<?php

namespace App\Http\Controllers\Geograficos;

use App\Modelos\Geografico\Entidad;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaisesController extends Controller
{

    public function mostrar()
    {
        $entidades = Entidad::all();

        $ubicacion['pais'] = 'Venezuela';

        $total = count($entidades);

        foreach ($entidades as $entidad) {
            $entidad['especies'] = count($entidad->especies()->conCatalogo(true)->get());
        }


        return view('geograficos.pais.mostrar', compact('entidades', 'ubicacion', 'total'));
    }
}
