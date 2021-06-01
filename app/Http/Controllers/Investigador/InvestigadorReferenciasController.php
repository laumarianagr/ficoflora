<?php

namespace App\Http\Controllers\Investigador;

use App\Modelos\Bibliografia\Referencias\Revista;
use App\Modelos\Bibliografia\Referencias\Libro;
use App\Modelos\Bibliografia\Referencias\Trabajo;
use App\Modelos\Bibliografia\Referencias\Enlace;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InvestigadorReferenciasController extends Controller
{

//---------->>>>>>>>>>
// CONSULTAS PARA UNA REFERENCIA ESPECÍFICA
//---------->>>>>>>>>>

    public function tipoTrabajoAcademico($tipo)
    {
        switch ($tipo){
            case 'Tesis (Doctorado)': $ta = 'Tesis de Doctorado'; break;
            case 'Tesis (Maestría)': $ta = 'Tesis de Maestría'; break;
            case 'Trabajo Especial de Grado (Licenciatura)': $ta = 'Trabajo Especial de Grado'; break;
            case 'Monografías de Trabajos de Ascenso': $ta = 'Trabajo de Ascenso'; break;
            default: $ta = ''; break;
        }
        return $ta;
    }


    public function reportesyReferencias($id, $tipo)
    {

        ////para la sección de como citar la página
        $fecha = Carbon::now();
        $mes = $this->getMes($fecha->month);

        if ($tipo == 'r') {//consulta para un artículo específico en Revista
            $referencia = Revista::find($id);
            $tipo = "Artículo en Revista";
            return view('listados.investigadores.investigador', compact('tipo', 'referencia', 'mes'));

        }elseif ($tipo == 'l') {//consulta para una referencia en un Libro
            $referencia = Libro::find($id);
            $tipo = "Libro";
            return view('listados.investigadores.investigador', compact('tipo', 'referencia', 'mes'));

        }elseif ($tipo == 'e') {//consulta para una referencia en un Sitio Web
            $referencia = Enlace::find($id);
            $tipo = "Sitio Web";
            return view('listados.investigadores.investigador', compact('tipo', 'referencia', 'mes'));

        }elseif ($tipo == 't') {//consulta para una referencia en un Trabajo Académico
            $referencia = Trabajo::find($id);
            $tipo = "Trabajo Académico";
            $ta = $this -> tipoTrabajoAcademico($referencia->tipo);
            return view('listados.investigadores.investigador', compact('tipo', 'referencia', 'mes', 'ta'));

        }elseif ($tipo == 'cr') {//consulta para una referencia de un Catálogo en Revista
            $referencia = Revista::find($id);
            $tipo = "Catálogo";
            return view('listados.investigadores.investigador', compact('tipo', 'referencia', 'mes'));

        }elseif ($tipo == 'cl') {//consulta para una referencia de un Catálogo en Libro
            $referencia = Libro::find($id);
            $tipo = "Catálogo";
            return view('listados.investigadores.investigador', compact('tipo', 'referencia', 'mes'));
        }
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
