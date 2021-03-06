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
use Illuminate\Support\Facades\DB;

use App\Modelos\Taxonomia\Prueba;


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
        $mes = $this->getMes($fecha->month);

        $total = count($citas_reportes);

        $portada = $this->getPortada($id);

        $imagenes = $this->getImagenes($id);

//        dd($citas_reportes);

        //Prueba para informacion extra
        $pruebas = DB::table('pruebas')->get();

        return view('taxonomia.especies.ficha', compact('especie', 'citas_reportes', 'sinonimias', 'referencias', 'fecha', 'coordenadas', 'portada', 'imagenes', 'total', 'mes', 'pruebas'));
         
    }


    public function getPortada($id)
    {

        $imagen = DB::table('imagenes_especies')
            ->where('especie_id', $id)
            ->where('tipo', 'h')
            ->first();
        return $imagen;
    }


    public function getImagenes($id)
    {
        $imagenes = DB::table('imagenes_especies')
            ->where('especie_id', $id)
            ->where('tipo', 'g')
            ->get();


        return $imagenes;
    }

    public function getMes($val)
    {
        switch ($val){

            case 1: $mes ='Enero';break;
            case 2: $mes ='Febrero';break;
            case 3: $mes ='Marzo';break;
            case 4: $mes ='Abril';break;
            case 5: $mes ='Mayo';break;
            case 6: $mes ='Junio';break;
            case 7: $mes ='Julio';break;
            case 8: $mes ='Agosto';break;
            case 9: $mes ='Septiembre';break;
            case 10: $mes ='Octubre';break;
            case 11: $mes ='Noviembre';break;
            case 12: $mes ='Diciembre';break;

        }
        return $mes;
    }  

}
