<?php

namespace App\Http\Controllers\Listados;

use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ListadosUbicacionController extends Controller

{
    //Listado con todas las Entidades registrados
    public function entidades()
    {
        $entidades = Entidad::all();
        $ubicacion = 'Entidades Federales';
        $total = count($entidades);

        $info_coordenadas = null;

        foreach ($entidades as $entidad) {
            $entidad['especies'] = count($entidad->especies()->conCatalogo(true)->get());
            $entidad['localidades'] = count($entidad->localidades()->get());
            $info_coordenadas[$entidad['id']] = ['latitud' =>$entidad['latitud'], 'longitud'=>$entidad['longitud'], 'nombre'=>$entidad['nombre']];
        }

        $coordenadas = collect($info_coordenadas);
        return view('listados.ubicacion.entidades', compact('ubicacion', 'total', 'entidades', 'coordenadas'));
    }

    //Listado con todas las Entidades registrados
    public function localidades()
    {
        $localidades = Localidad::all();
        $ubicacion = 'Localidades';
        $total = count($localidades);

        $info_coordenadas = null;

        foreach ($localidades as $localidad) {
            $localidad['lugares'] = count($localidad->lugares()->get());
            $localidad['especies'] = count($localidad->especies()->conCatalogo(true)->get());
            $info_coordenadas[$localidad['id']] = ['latitud' =>$localidad['latitud'], 'longitud'=>$localidad['longitud'], 'nombre'=>$localidad['nombre']];
        }
        $coordenadas = collect($info_coordenadas);


        return view('listados.ubicacion.localidades', compact('ubicacion', 'total', 'localidades', 'coordenadas'));
    }

    //Listado con todas las Entidades registrados
    public function lugares()
    {
        $lugares = Lugar::all();
        $ubicacion = 'Lugares';
        $total = count($lugares);

        $info_coordenadas = null;

        foreach ($lugares as $lugar) {
            $lugar['sitios'] = count($lugar->sitios()->get());
            $lugar['especies'] = count($lugar->especies()->conCatalogo(true)->get());
            $info_coordenadas[$lugar['id']] = ['latitud' =>$lugar['latitud'], 'longitud'=>$lugar['longitud'], 'nombre'=>$lugar['nombre']];
        }
        $coordenadas = collect($info_coordenadas)->sortBy('nombre');

        return view('listados.ubicacion.lugares', compact('ubicacion', 'total', 'lugares', 'coordenadas'));
    }

    //Listado con todas las Entidades registrados
    public function sitios()
    {
        $sitios = Sitio::all();
        $ubicacion = 'Sitios';
        $total = count($sitios);

        $info_coordenadas = null;

        foreach ($sitios as $sitio) {
            $sitio['especies'] = count($sitio->especies()->conCatalogo(true)->get());
            $info_coordenadas[$sitio['id']] = ['latitud' =>$sitio['latitud'], 'longitud'=>$sitio['longitud'], 'nombre'=>$sitio['nombre']];
        }
        $coordenadas = collect($info_coordenadas);

        return view('listados.ubicacion.sitios', compact('ubicacion', 'total', 'sitios', 'coordenadas'));
    }

}