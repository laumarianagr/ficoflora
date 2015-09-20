<?php

namespace App\Http\Controllers\Taxonomia;

use App\Ficoflora\Especies\EspecieDatosTrait;
use App\Ficoflora\Especies\ReportesReferenciasTrait;
use App\Ficoflora\Ubicacion\CoordenadasTrait;


use App\Modelos\Taxonomia\Especie;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class EspeciesController extends Controller
{
    use EspecieDatosTrait;
    use ReportesReferenciasTrait;
    use CoordenadasTrait;

    public function index($id)
    {

        $obj_especie = Especie::find($id);

        //Transformo los ids del elemento de la tabla especies en nombres
        $especie = $this->especieDatos($obj_especie, $id, true);



        list($citas_reportes, $referencias, $ubicaciones_ids) = $this->getReportesReferenciasEspecie($id);

        //Obtenemos las coordenadas de todas las ubicaciones que se tienen de la especie
        $coordenadas = null;
        if(!empty($ubicaciones_ids)){
            $valores = $this->getCoordenadas($ubicaciones_ids);
            $coordenadas = collect($valores);
        }
//        dd($coordenadas);
        //Listado de sinonimias de la especie
        $sinonimias = null;
        if($obj_especie->sinonimias->all() != null){
            $sinonimias = $this->getSinonimias($obj_especie->sinonimias->all());
        }

        //Formato texto html a las referencias
        $referencias = $this->getReferenciaTexto($referencias);
        

        //para la sección de como citar la página
        $fecha = Carbon::now();

        return view('taxonomia.especies.ficha', compact('especie', 'citas_reportes', 'sinonimias', 'referencias', 'fecha', 'coordenadas'));
    }







}
