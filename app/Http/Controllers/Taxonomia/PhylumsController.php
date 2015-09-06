<?php

namespace App\Http\Controllers\Taxonomia;

use App\Ficoflora\Funcionalidades\TaxonomiaSuperiorTrait;
use App\Modelos\Taxonomia\Phylum;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PhylumsController extends Controller
{
    use TaxonomiaSuperiorTrait;


    public function clases($id)
    {
        $phylum = Phylum::find($id);

        $taxonomia = $this->taxoPhylum($id);

        $clases = $phylum->clases()->get();


        $total = count($clases);


        return view('taxonomia.phylum.index_clases', compact('taxonomia', 'total', 'clases'));
    }

}
