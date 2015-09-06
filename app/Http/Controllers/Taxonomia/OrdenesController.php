<?php

namespace App\Http\Controllers\Taxonomia;

use App\Ficoflora\Funcionalidades\TaxonomiaSuperiorTrait;
use App\Modelos\Taxonomia\Orden;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrdenesController extends Controller
{

    use TaxonomiaSuperiorTrait;


    public function familias($id)
    {
        $ordenes = Orden::find($id);

        $taxonomia = $this->taxoOrden($id);

        $familias = $ordenes->familias()->get();

//        dd($taxonomia);


        $total = count($familias);


        return view('taxonomia.orden.index_familias', compact('taxonomia', 'total', 'familias'));
    }

}
