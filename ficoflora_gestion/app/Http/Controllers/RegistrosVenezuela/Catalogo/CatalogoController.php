<?php

namespace App\Http\Controllers\RegistrosVenezuela\Catalogo;

use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Epitetos\Especifico;
use App\Modelos\Taxonomia\Epitetos\Varietal;
use App\Modelos\Taxonomia\Epitetos\Forma;
use App\Modelos\Taxonomia\Epitetos\Subespecie;
use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Genero;
use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CatalogoController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
//        $this->middleware('creador.especie', ['only'=>['editar', 'eliminar', 'actualizar']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function crear()
    {
        $familias = Familia::lists('nombre', 'id');

        //Quitando los genero que esta por sinonimia que no tienen arbol taxonómico superior
        $genero = Genero::where('familia_id', '!=', -1)->select('id', 'nombre', 'familia_id')->get();
        $especifico = Especifico::select('id', 'nombre')->get();
        $varietal = Varietal::select('id', 'nombre')->get();
        $forma = Forma::select('id','nombre')->get();
        $subespecie = Subespecie::select('id','nombre')->get();

        $autor = Autor::lists('nombre');



        $taxonomia = array( 'genero' => $genero, 'especifico' => $especifico, 'varietal' => $varietal, 'forma' => $forma, 'subespecie' => $subespecie, 'autor' => $autor);
        $taxonomia = json_encode($taxonomia);

        $cita_autores = Array(
            null => 'seleccione la cantidad de autores',
            '1'=> '1 autor',
            '2'=> '2 autores',
            '3'=> '3 o más autores',

        );

        $tipo_trabajos = Array(
            null => 'seleccione el tipo de trabajo',
            'pregrado'=> 'Trabajos Especiales de Grado (Licenciatura), ',
            'maestria'=> 'Tesis de Grado (Maestría)',
            'doctorado'=> 'Tesis (Doctorado)',
            'ascenso'=> 'Monografías de Trabajos de Ascenso',

        );

//
        //fecha referencia
        $fecha_actual = date('Y');
//        $rango = range( 1800, $fecha_actual);
        $rango = range($fecha_actual,  1800);
        $fecha = array_combine($rango, $rango);
        $fecha[null]='seleccione una fecha';
//        ksort($fecha);


        //año enlace
//        $rango = range( 1980,$fecha_actual);
        $rango = range( $fecha_actual, 1980);
        $fecha_ano = array_combine($rango, $rango);
        $fecha_ano[null]='seleccione el año';
//        ksort($fecha_ano);


        //dia enlace
        $rango = range(1,31);
        $fecha_dia = array_combine($rango, $rango);
        $fecha_dia[null]='seleccione el día';
        ksort($fecha_dia);

        //mes enlace
        $fecha_mes = Array(
            null => 'seleccione el mes',
            'Enero'=> 'Enero',
            'Febrero'=> 'Febrero',
            'Marzo'=> 'Marzo',
            'Abril'=> 'Abril',
            'Mayo'=> 'Mayo',
            'Junio'=> 'Junio',
            'Julio'=> 'Julio',
            'Agosto'=> 'Agosto',
            'Septiembre'=> 'Septiembre',
            'Octubre'=> 'Octubre',
            'Noviembre'=> 'Noviembre',
            'Diciembre'=> 'Diciembre',
        );


        $especies = DB::table('especies')
            ->join('epitetos_especificos', 'especies.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'especies.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'especies.forma_id', '=', 'epitetos_formas.id')
            ->leftJoin('epitetos_subespecies', 'especies.subespecie_id', '=', 'epitetos_subespecies.id')
            ->join('generos', 'especies.genero_id', '=', 'generos.id')
            ->join('autores', 'especies.autor_id', '=', 'autores.id')
            ->select(DB::raw('especies.id, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, epitetos_subespecies.nombre as subespecie, generos.nombre as genero, autores.nombre as autor'))
            ->orderBy('genero')->orderBy('especifico')->orderBy('forma')->orderBy('varietal')
            ->get();

//        dd($especies);
        
        $lista_especies = Array();
        foreach($especies as $especie){

            $nombre = $especie->genero.' '.$especie->especifico;

            if($especie->varietal != null){
                $nombre = $nombre .' v. '.$especie->varietal;
            }

            if($especie->forma != null){
                $nombre = $nombre .' f. '.$especie->forma;
            }

            if($especie->subespecie != null){
                $nombre = $nombre .' subsp. '.$especie->subespecie;
            }

            $nombre = $nombre.' '.$especie->autor;
            
            $lista_especies[$especie->id] = $nombre;
        }

//        dd($lista_especies);


        $entidades = Entidad::select('id', 'nombre')->get();
        $localidas = Localidad::select('id', 'nombre')->get();
        $lugares = Lugar::select('id', 'nombre')->get();
        $sitios = Sitio::select('id', 'nombre')->get();

        $geograficos = array('entidad' =>$entidades, 'localidad' =>$localidas, 'lugar' => $lugares, 'sitio' => $sitios);
        $geograficos = json_encode($geograficos);



        $sinonimias = DB::table('sinonimias')
            ->join('epitetos_especificos', 'sinonimias.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'sinonimias.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'sinonimias.forma_id', '=', 'epitetos_formas.id')
            ->leftJoin('epitetos_subespecies', 'sinonimias.subespecie_id', '=', 'epitetos_subespecies.id')
            ->join('generos', 'sinonimias.genero_id', '=', 'generos.id')
            ->join('autores', 'sinonimias.autor_id', '=', 'autores.id')
            ->select(DB::raw('sinonimias.id, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, epitetos_subespecies.nombre as subespecie, generos.nombre as genero, autores.nombre as autor'))
            ->orderBy('genero')->orderBy('especifico')->orderBy('forma')->orderBy('varietal')
            ->get();
//        dd($sinonimias);



        $lista_sinonimias = Array();
        foreach($sinonimias as $sinonimia){

            $nombre = $sinonimia->genero.' '.$sinonimia->especifico;

            if($sinonimia->varietal != null){
                $nombre = $nombre .' v. '.$sinonimia->varietal;
            }

            if($sinonimia->forma != null){
                $nombre = $nombre .' f. '.$sinonimia->forma;
            }

            if($sinonimia->subespecie != null){
                $nombre = $nombre .' subsp. '.$sinonimia->subespecie;
            }

            $nombre = $nombre.' '.$sinonimia->autor;

            $lista_sinonimias[$sinonimia->id] = $nombre;
        }

//        dd($lista_sinonimias);
        return view('catalogo.crear', compact('taxonomia', 'familias', 'fecha','fecha_ano', 'fecha_dia', 'fecha_mes', 'cita_autores', 'tipo_trabajos', 'lista_especies', 'lista_sinonimias', 'geograficos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
