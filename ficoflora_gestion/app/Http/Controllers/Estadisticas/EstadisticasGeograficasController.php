<?php

namespace App\Http\Controllers\Estadisticas;

use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;
use App\Modelos\Geografico\Ubicacion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EstadisticasGeograficasController extends Controller
{


    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor');
//        $this->middleware('creador.especie', ['only'=>['editar', 'eliminar', 'actualizar']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $elementos = [

            ['tipo' => 'Entidades Federales', 'total' => count(Entidad::all()), 'ruta' => 'entidades'],
            ['tipo' => 'Localidades', 'total' => count(Localidad::all()), 'ruta' => 'localidades'],
            ['tipo' => 'Lugares', 'total' => count(Lugar::all()), 'ruta' => 'lugares'],
            ['tipo' => 'Sitios', 'total' => count(Sitio::all()), 'ruta' => 'sitios'],
        ];

        $total = Ubicacion::all()->count();


        return view('estadisticas.geograficas.geograficas-estadisticas', compact('total', 'elementos'));
    }


    //ENTIDADES
    public function entidades()
    {
        $obj_entidades = Entidad::all();
        $entidades = [];

        $total = $obj_entidades->count();

        foreach ($obj_entidades as $entidad) {
            array_push($entidades, ['id' => $entidad->id, 'nombre' => $entidad->nombre, 'especies' => $entidad->especies()->conCatalogo(true)->count()]);
        }

        $mas_usados = collect($entidades)->sortByDesc('especies')->take(15);

        return view('estadisticas.geograficas.entidades-estadisticas', compact('total', 'entidades', 'mas_usados'));
    }



    //LOCALIDADES
    public function localidades()
    {
        $obj_localidades = Localidad::all();
        $localidades = [];

        $total = $obj_localidades->count();

        foreach ($obj_localidades as $localidad) {
            array_push($localidades, ['id' => $localidad->id, 'nombre' => $localidad->nombre, 'especies' => $localidad->especies()->conCatalogo(true)->count()]);
        }

        $mas_usados = collect($localidades)->sortByDesc('especies')->take(15);

        return view('estadisticas.geograficas.localidades-estadisticas', compact('total', 'localidades', 'mas_usados'));
    }


    //LUGARES
    public function lugares()
    {
        $obj_lugares = Lugar::all();
        $lugares = [];

        $total = $obj_lugares->count();

        foreach ($obj_lugares as $lugar) {
            array_push($lugares, ['id' => $lugar->id, 'nombre' => $lugar->nombre, 'especies' => $lugar->especies()->conCatalogo(true)->count()]);
        }

        $mas_usados = collect($lugares)->sortByDesc('especies')->take(15);

        return view('estadisticas.geograficas.lugares-estadisticas', compact('total', 'lugares', 'mas_usados'));
    }


    //LUGARES
    public function sitios()
    {
        $obj_sitios = Sitio::all();
        $sitios = [];

        $total = $obj_sitios->count();

        foreach ($obj_sitios as $sitio) {
            array_push($sitios, ['id' => $sitio->id, 'nombre' => $sitio->nombre, 'especies' => $sitio->especies()->conCatalogo(true)->count()]);
        }

        $mas_usados = collect($sitios)->sortByDesc('especies')->take(15);

        return view('estadisticas.geograficas.sitios-estadisticas', compact('total', 'sitios', 'mas_usados'));
    }

}
