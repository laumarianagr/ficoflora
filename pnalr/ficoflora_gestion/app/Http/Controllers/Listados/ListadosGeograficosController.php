<?php

namespace App\Http\Controllers\Listados;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListadosGeograficosController extends Controller
{

    public function entidades()
    {
        $usuario = Auth::user();

        $entidades = DB::table('entidades')
            ->orderBy('nombre')
            ->get();

        $total = count($entidades);

        return view('listados.geograficos.entidades-listados', compact('entidades', 'usuario', 'total'));
    }

    public function localidades()
    {
        $usuario = Auth::user();

        $localidades = DB::table('localidades')
            ->leftJoin('entidades', 'localidades.entidad_id', '=', 'entidades.id')
            ->select(DB::raw('localidades.id, localidades.nombre, entidades.nombre as entidad'))
            ->orderBy('nombre')
            ->get();
        $total = count($localidades);

        return view('listados.geograficos.localidades-listados', compact('localidades', 'usuario', 'total'));
    }


    public function lugares()
    {
        $usuario = Auth::user();

        $lugares = DB::table('lugares')
            ->leftJoin('localidades', 'lugares.localidad_id', '=', 'localidades.id')
            ->select(DB::raw('lugares.id, lugares.nombre, localidades.nombre as localidad'))
            ->orderBy('nombre')
            ->get();
        $total = count($lugares);


        return view('listados.geograficos.lugares-listados', compact('lugares', 'usuario', 'total'));
    }


    public function sitios()
    {
        $usuario = Auth::user();

        $sitios = DB::table('sitios')
            ->leftJoin('lugares', 'sitios.lugar_id', '=', 'lugares.id')
            ->select(DB::raw('sitios.id, sitios.nombre, lugares.nombre as lugar'))
            ->orderBy('nombre')
            ->get();
        $total = count($sitios);

        return view('listados.geograficos.sitios-listados', compact('usuario','sitios', 'total'));
    }


//    public function ubicaciones()
//    {
//
//
//        $ubicaciones = DB::table('ubicaciones')
//            ->join('entidades', 'ubicaciones.entidad_id', '=', 'entidades.id')
//            ->leftJoin('localidades', 'ubicaciones.localidad_id', '=', 'localidades.id')
//            ->leftJoin('lugares', 'ubicaciones.lugar_id', '=', 'lugares.id')
//            ->leftJoin('sitios', 'ubicaciones.sitio_id', '=', 'sitios.id')
//            ->select(DB::raw('ubicaciones.id, entidades.nombre as entidad, localidades.nombre as localidad, lugares.nombre as lugar, sitios.nombre as sitio'))
//            ->orderBy('entidad')->orderBy('localidad')->orderBy('lugar')->orderBy('sitio')
//            ->get();
//
////        dd($ubicaciones);
//
//        return view('registros.mis-registros.geograficos.ubicaciones-listados-usuario', compact('ubicaciones'));
//
//    }
}
