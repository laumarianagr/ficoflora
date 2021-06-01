<?php

namespace App\Http\Controllers\Estadisticas;

use App\Modelos\Bibliografia\Referencias\Revista;
use App\Modelos\Bibliografia\Referencias\Libro;
use App\Modelos\Bibliografia\Referencias\Catalogo;
use App\Modelos\Bibliografia\Referencias\Trabajo;
use App\Modelos\Bibliografia\Referencias\Enlace;

use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;

use App\Modelos\Catalogo\Registro;

use App\Modelos\Taxonomia\Especie;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EstadisticasTotalesController extends Controller

{
    //consultas de referencias bibliográficas   ******************    *******************

    public function total_revistas()
    {
        return Revista::select('id')->get()->count();
    }

    public function total_libros()
    {
        return Libro::select('id')->get()->count();
    }

    public function total_catalogos()
    {
        return Catalogo::select('id')->get()->count();
    }

    public function total_enlaces()
    {
        return Enlace::select('id')->get()->count();
    }

    public function total_trabajos()
    {
        return Trabajo::select('id')->get()->count();
    }


    // consultas de ubicaciones   ******************    *******************

    public function total_entidades()
    {
        return Entidad::select('id')->get()->count();
    }

    public function total_localidades()
    {
        return Localidad::select('id')->get()->count();
    }

    public function total_lugares()
    {
        return Lugar::select('id')->get()->count();
    }

    public function total_sitios()
    {
        return Sitio::select('id')->get()->count();
    }


    // consultas de registros   ******************    *******************

    public function total_registros()
    {
        return Registro::select('id')->get()->count();
    }

    public function total_especies()
    {
        return Especie::select('id')->get()->count();
    }


//---------->>>>>>>>>>
// ESTADÍSTICAS PARA LAS PÁGINAS PÚBLICAS
//---------->>>>>>>>>>

    //consulta utilizada en la página Catálogo
    public function totalesCatalogo()
    {
        $totalReferencias = number_format($this->total_revistas() + $this->total_libros() + $this->total_catalogos() + $this->total_enlaces() + $this->total_trabajos(), 0, ',', '.');
        $totalEntidades = number_format($this->total_entidades(), 0, ',', '.');
        $totalLocalidades = number_format($this->total_entidades() + $this->total_localidades() + $this->total_lugares() + $this->total_sitios(), 0, ',', '.');
        $totalRegistros = number_format($this->total_registros(), 0, ',', '.');
        $totalEspecies = number_format($this->total_especies(), 0, ',', '.');
        return view('publicas.catalogo', compact('totalReferencias', 'totalEntidades', 'totalLocalidades', 'totalRegistros', 'totalEspecies'));
    }

    public function totalesIndex()
    {
        $totalReferencias = number_format($this->total_revistas() + $this->total_libros() + $this->total_catalogos() + $this->total_enlaces() + $this->total_trabajos(), 0, ',', '.');
        $totalEntidades = number_format($this->total_entidades(), 0, ',', '.');
        $totalLocalidades = number_format($this->total_entidades() + $this->total_localidades() + $this->total_lugares() + $this->total_sitios(), 0, ',', '.');
        $totalRegistros = number_format($this->total_registros(), 0, ',', '.');
        $totalEspecies = number_format($this->total_especies(), 0, ',', '.');
        return view('publicas.index', compact('totalReferencias', 'totalEntidades', 'totalLocalidades', 'totalRegistros', 'totalEspecies'));
    }
}
