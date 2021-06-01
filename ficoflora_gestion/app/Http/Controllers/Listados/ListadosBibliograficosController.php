<?php

namespace App\Http\Controllers\Listados;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListadosBibliograficosController extends Controller
{

    public function revistas()
    {
        $usuario = Auth::user();

        $revistas = DB::table('referencias_revistas')
            ->select(DB::raw('id, autores, cita, fecha, letra, titulo'))
            ->orderBy('cita')
            ->get();

//        dd($revistas);
        $total = count($revistas);


        return view('listados.bibliograficos.revistas-listados', compact('revistas', 'usuario', 'total'));
    }


    public function libros()
    {
        $usuario = Auth::user();

        $libros = DB::table('referencias_libros')
            ->select(DB::raw('id, autores, cita, fecha, letra, titulo'))
            ->orderBy('cita')
            ->get();

//        dd($libros);
        $total = count($libros);


        return view('listados.bibliograficos.libros-listados', compact('libros', 'usuario', 'total'));
    }


    public function catalogos()
    {
        $usuario = Auth::user();

        $catalogos = DB::table('referencias_catalogos')
            ->select(DB::raw('id, autores, cita, fecha, letra, titulo'))
            ->orderBy('cita')
            ->get();

//        dd($libros);
        $total = count($catalogos);


        return view('listados.bibliograficos.catalogos-listados', compact('catalogos', 'usuario', 'total'));
    }


    public function trabajos()
    {
        $usuario = Auth::user();

        $trabajos = DB::table('referencias_trabajos')
            ->select(DB::raw('id, autores, cita, fecha, letra, titulo'))
            ->orderBy('cita')
            ->get();

//        dd($trabajos);
        $total = count($trabajos);


        return view('listados.bibliograficos.trabajos-listados', compact('trabajos', 'usuario', 'total'));
    }


    public function enlaces()
    {
        $usuario = Auth::user();

        $enlaces = DB::table('referencias_enlaces')
            ->select(DB::raw('id, autores, cita, fecha, letra, nombre, enlace'))
            ->orderBy('cita')
            ->get();

//        dd($trabajos);
        $total = count($enlaces);


        return view('listados.bibliograficos.enlaces-listados', compact('enlaces', 'usuario', 'total'));
    }
}