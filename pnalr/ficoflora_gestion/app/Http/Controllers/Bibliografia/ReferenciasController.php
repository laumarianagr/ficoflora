<?php

namespace App\Http\Controllers\Bibliografia;

use App\Ficoflora\Registros\Formulario;
use App\Modelos\Bibliografia\Cita;
use App\Modelos\Taxonomia\Especie;
use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Phylum;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReferenciasController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function crear()
    {
//        $cita_autores = DB::table('citas')
//            ->select(DB::raw('citas.autores'))
//            ->groupBy('autores')
//            ->lists('autores');

        
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



        return view('bibliograficos.referencias.crear', compact( 'fecha','fecha_ano', 'fecha_dia', 'fecha_mes', 'cita_autores', 'tipo_trabajos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function guardar(Request $request)
    {

        
        dd($request->all());
        $messages = [
            'cita_autor.required' => 'No se especificó el campo Autor',
            'cita_fecha.required' => 'No se especificó el campo Año',
        ];
        $this->validate($request, [
            'cita_autor' => 'required',
            'cita_fecha' => 'required',
        ], $messages);

        $usuario = Auth::user();

        $formulario = new Formulario();
        $respuesta =  $formulario->nuevaCita($request->cita_autor, $request->cita_fecha, $request->cita_letra, $usuario->id);



        if($respuesta['error'] == true){
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }

        if($respuesta['existe'] == true){
            return redirect()->back()->withErrors("La cita ya esta registrada")->withInput();
        }

        $obj_cita = $respuesta['registro'];

        return redirect()->route('cita.mostrar',$obj_cita->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function mostrar($id)
    {
        $cita = Cita::find($id);

        return view('bibliografia.citas.mostrar', compact('cita'));
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
     * @param  int  $id
     * @return Response
     */
    public function update($id)
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

    public function reporte()
    {
        $cita = Cita::find(3);

        $especie = Especie::find(1);
//        dd($cita->especies()->conEspecieId(1)->get());
        dd($especie->citas()->get());
    }
    

}
