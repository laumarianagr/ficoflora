<?php

namespace App\Http\Controllers\Listados;

use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Modelos\Catalogo\Registro;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListadosRegistrosController extends Controller
{
    use EspecieDatosTrait;

    public function registros()
    {
        $usuario = Auth::user();

//        $reportes_ids = Registro::where('creador_id', $usuario->id)->get();
        $reportes_ids = Registro::all();

        $libros = DB::table('registros')
//            ->where('registros.creador_id', $usuario->id)
            ->where('registros.tipo_referencia', 'L')
            ->leftJoin('referencias_libros', 'registros.referencia_id', '=', 'referencias_libros.id')
            ->groupBy('registros.referencia_id')
            ->select(DB::raw('referencias_libros.id, referencias_libros.cita,  referencias_libros.fecha, referencias_libros.letra'))
            ->get();

        $libros = collect($libros);

        $revistas = DB::table('registros')
//            ->where('registros.creador_id', $usuario->id)
            ->where('registros.tipo_referencia', 'R')
            ->leftJoin('referencias_revistas', 'registros.referencia_id', '=', 'referencias_revistas.id')
            ->groupBy('registros.referencia_id')
            ->select(DB::raw('referencias_revistas.id, referencias_revistas.cita,  referencias_revistas.fecha, referencias_revistas.letra'))
            ->get();

        $revistas = collect($revistas);

        $trabajos = DB::table('registros')
//            ->where('registros.creador_id', $usuario->id)
            ->where('registros.tipo_referencia', 'T')
            ->leftJoin('referencias_trabajos', 'registros.referencia_id', '=', 'referencias_trabajos.id')
            ->groupBy('registros.referencia_id')
            ->select(DB::raw('referencias_trabajos.id, referencias_trabajos.cita, referencias_trabajos.fecha, referencias_trabajos.letra'))
            ->get();

        $trabajos = collect($trabajos);

        $especies_id = DB::table('registros')
//            ->where('registros.creador_id', $usuario->id)
            ->groupBy('registros.especie_id')
            ->select(DB::raw('registros.especie_id as id'))
            ->get();


        $especies = collect();

        foreach ($especies_id as $especie) {
            $datos = $this->especieDatos(null, $especie->id, false);
            $especies->push($datos);
        }

//        dd($especies->where('id', 1)->first()['nombre']);

        $reportes = collect();

        foreach ($reportes_ids as $reporte) {

            $especie = $especies->where('id', $reporte->especie_id)->first();

            switch($reporte->tipo_referencia){

                case 'L':
                    $referencia = $libros->where('id', $reporte->referencia_id)->first();
                    $tipo = 'Libro';
                    break;

                case 'R':
                    $referencia = $revistas->where('id', $reporte->referencia_id)->first();
                    $tipo = 'Revista';
                    break;

                case 'T':
                    $referencia = $trabajos->where('id', $reporte->referencia_id)->first();
                    $tipo = 'Trabajo A.';
                    break;
            }

            $datos = ['especie' => $especie['nombre'], 'autor' =>$especie['autor'], 'cita' => $referencia->cita.', '.$referencia->fecha.$referencia->letra, 'fecha'=>$referencia->fecha,  'tipo' =>$tipo, 'id'=>$reporte->id];
            $reportes->push($datos);
        }
        
        $total = $reportes->count();

        return view('listados.catalogo.registros-listados', compact('reportes', 'total'));

    }
}
