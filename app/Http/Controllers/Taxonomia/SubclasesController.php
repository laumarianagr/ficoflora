<?php

namespace App\Http\Controllers\Taxonomia;

use App\Ficoflora\Funcionalidades\TaxonomiaSuperiorTrait;
use App\Modelos\Taxonomia\Subclase;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SubclasesController extends Controller
{

    use TaxonomiaSuperiorTrait;


    public function ordenes($id)
    {
        $subclase = Subclase::find($id);

        $taxonomia = $this->taxoSubclase($id);

        $ordenes = $subclase->ordenes()->get();

//        dd($taxonomia);


        $total = count($ordenes);


        return view('taxonomia.subclase.index_ordenes', compact('taxonomia', 'total', 'ordenes'));
    }
}
