<?php

namespace App\Http\Controllers\RegistrosVenezuela\Taxonomia;

use App\Ficoflora\Registros\Taxonomia\TaxonomiaRegistro;
use App\Http\Requests\Taxonomia\CrearTaxonomiaRequest;
use App\Modelos\Taxonomia\Clase;
use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Genero;
use App\Modelos\Taxonomia\Orden;
use App\Modelos\Taxonomia\Phylum;
use App\Modelos\Taxonomia\Subclase;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TaxonomiasController extends Controller
{



    public function guardar(CrearTaxonomiaRequest $request, $taxo)
    {
        $usuario = Auth::user();

        $registro = new TaxonomiaRegistro($request->all(), $taxo, $usuario->id );
        $respuesta = $registro->newTaxonomia();

        $log = ['error' =>[$respuesta['log']]];

        if($respuesta['error'] == true){
//            return redirect()->back()->withErrors($respuesta['log']);
            return response()->json($log, 422);
        }
        //Ya existe
        if($respuesta['existe'] == true){
//            return redirect()->back()->withErrors("Error: La ".$respuesta['log']);
            $log = ['error' =>['Ya existe']];

            return response()->json($log, 422);
        }

        $taxonomia = $this->getRespuesta($respuesta['registro'], $taxo);

        return $taxonomia;

    }


    public function getRespuesta($repuesta, $taxo)
    {
        switch ($taxo) {
            case 'phylum':
                return $repuesta['obj_phylum'];
                break;

            case 'clase':
                return $repuesta['obj_clase'];
                break;

            case 'subclase':
                return $repuesta['obj_subclase'];
                break;

            case 'orden':
                return $repuesta['obj_orden'];

                break;
            case 'familia':
                return $repuesta['obj_familia'];
                break;

            case 'genero':
                return $repuesta['obj_genero'];
                break;
        }
    }

    public function getTaxonomiaPylum()
    {
        $phylum = Phylum::select('id', 'nombre')->get();

        return compact('orden', 'subclase', 'clase', 'phylum');
    }
    public function getTaxonomiaClase()
    {
        $clase = Clase::select('id', 'nombre', 'phylum_id')->get();
        $phylum = Phylum::select('id', 'nombre')->get();

        return compact('orden', 'subclase', 'clase', 'phylum');
    }
    public function getTaxonomiaSubclase()
    {
        $subclase = Subclase::select('id', 'nombre', 'clase_id')->get();
        $clase = Clase::select('id', 'nombre', 'phylum_id')->get();
        $phylum = Phylum::select('id', 'nombre')->get();

        return compact('orden', 'subclase', 'clase', 'phylum');
    }
    public function getTaxonomiaOrden()
    {
        $orden = Orden::select('id', 'nombre', 'subclase_id', 'clase_id')->get();
        $subclase = Subclase::select('id', 'nombre', 'clase_id')->get();
        $clase = Clase::select('id', 'nombre', 'phylum_id')->get();
        $phylum = Phylum::select('id', 'nombre')->get();

        return compact('orden', 'subclase', 'clase', 'phylum');
    }

    public function getTaxonomiaFamilia()
    {
        $familia = Familia::select('id', 'nombre', 'orden_id')->get();
        $orden = Orden::select('id', 'nombre', 'subclase_id', 'clase_id')->get();
        $subclase = Subclase::select('id', 'nombre', 'clase_id')->get();
        $clase = Clase::select('id', 'nombre', 'phylum_id')->get();
        $phylum = Phylum::select('id', 'nombre')->get();

        return compact('familia', 'orden', 'subclase', 'clase', 'phylum');
    }

    public function getTaxonomiaGenero()
    {
        $genero = Genero::where('familia_id', '!=', -1)->select('id', 'nombre', 'familia_id')->get();
        $familia = Familia::select('id', 'nombre', 'orden_id')->get();
        $orden = Orden::select('id', 'nombre', 'subclase_id', 'clase_id')->get();
        $subclase = Subclase::select('id', 'nombre', 'clase_id')->get();
        $clase = Clase::select('id', 'nombre', 'phylum_id')->get();
        $phylum = Phylum::select('id', 'nombre')->get();

        return compact('genero','familia', 'orden', 'subclase', 'clase', 'phylum');
    }


}
