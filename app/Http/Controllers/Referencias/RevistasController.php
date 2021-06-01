<?php

namespace App\Http\Controllers\Referencias;

use App\Ficoflora\Referencias\ReferenciasTrait;
use App\Modelos\Bibliografia\Referencias\Revista;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RevistasController extends Controller
{
    use ReferenciasTrait;

    public function referencias()
    {
        $revistas = Revista::all();
        $tipo = "Revistas";
        $total = count($revistas);
        $info = null;

        foreach ($revistas as $revista) {
            $info[$revista['id']] = ['autores' =>$revista['autores'], 'fecha'=>$revista['fecha'], 'titulo'=>$revista['titulo']];
        }

        $referencias = collect($info);
        return view('listado.referencias.referencias', compact('revistas', 'tipo', 'total', 'referencias'));
    }

}
