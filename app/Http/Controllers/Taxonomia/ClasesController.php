<?php

namespace App\Http\Controllers\Taxonomia;

use App\Ficoflora\Funcionalidades\TaxonomiaSuperiorTrait;
use App\Modelos\Taxonomia\Clase;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClasesController extends Controller
{
    use TaxonomiaSuperiorTrait;


    public function ordenes($id)
    {
        $clase = Clase::find($id);

        $taxonomia = $this->taxoClase($id);

        $ordenes = $clase->ordenes()->get();


        $total = count($ordenes);


        return view('taxonomia.clase.index_ordenes', compact('taxonomia', 'total', 'ordenes'));
    }


    public function subclases($id)
    {
        $clase = Clase::find($id);

        $taxonomia = $this->taxoClase($id);

        $subclases = $clase->subclases()->get();

        $total = count($subclases);

//        dd($subclases);


        return view('taxonomia.clase.index_subclases', compact('taxonomia', 'total', 'subclases'));
    }
}
