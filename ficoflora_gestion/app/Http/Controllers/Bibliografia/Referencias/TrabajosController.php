<?php

namespace App\Http\Controllers\Bibliografia\Referencias;

use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Ficoflora\Funcionalidades\Referencias\ReferenciasTextosTrait;
use App\Ficoflora\Funcionalidades\ReferenciasTrait;
use App\Ficoflora\Registros\Bibliografia\Referencias\TrabajoRegistro;
use App\Http\Requests\Bibliografia\Referencias\CrearTrabajoRequest;
use App\Modelos\Bibliografia\Cita;
use App\Modelos\Bibliografia\Referencias\Trabajo;
use App\Modelos\Catalogo\Registro;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Especie;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrabajosController extends Controller
{
    
    use ReferenciasTextosTrait;

use ReferenciasTrait;
    use EspecieDatosTrait;
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.trabajos', ['only'=>['editar', 'eliminar', 'actualizar']]);
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function guardar(CrearTrabajoRequest $request)
    {
//        dd($request->all());
//        return $request->all();

        $registro = new TrabajoRegistro($request->all(), 'form', Auth::user()->id);
        $respuesta = $registro->nuevoTrabajo();

        if($respuesta['error'] == true){

            if($request->ajax()) {
                $log = ['error' =>[$respuesta['log']]];
                return response()->json($log, 422);
            }
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }

        if($respuesta['existe'] == true){

            if($request->ajax()) {
                $log = ['error' =>[$respuesta['log']]];
                return response()->json($log, 422);
            }
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }

        $trabajo = $respuesta['registro'];
        $trabajo->save();

        //Si se crea la referencia correctamente, se guarda la cita
        $cita = $respuesta['cita'];
        $cita->referencia_id = $trabajo->id;
        $cita->save();

        if($request->ajax()) {
            return $trabajo->id;
        }


        return redirect()->route('trabajo.mostrar',$trabajo->id);

    }


    public function mostrar($id)
    {
        $trabajo = Trabajo::find($id);

        $texto = $this->getTrabajoTexto($trabajo);

        $usuario = Auth::user();
        $lista_especies = $this->listaNombresEspecies();

        $registros = Registro::where('referencia_id', $id)->conTipo('T')->get();


        $especies = [];

        foreach ($registros as $registro) {

            $especie = Especie::find($registro->especie_id);
            array_push($especies, ['id' => $registro->id, 'nombre'=> $this->especieDatos($especie, null, false)['nombre'], 'autor'=>Autor::find($especie->autor_id)->nombre]);
        }

        $total = count($especies);


        return view('bibliograficos.referencias.trabajos.mostrar', compact('usuario','trabajo','texto', 'especies', 'total', 'lista_especies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editar($id)
    {
        $trabajo = Trabajo::find($id);


        $tipo_trabajos = Array(
            null => 'seleccione el tipo de trabajo',
            'pregrado'=> 'Trabajo Especial de Grado (Licenciatura)',
            'maestria'=> 'Tesis de Grado (Maestría)',
            'doctorado'=> 'Tesis (Doctorado)',
            'ascenso'=> 'Monografías de Trabajos de Ascenso',

        );

        switch ($trabajo->tipo){

            case 'Trabajo Especial de Grado (Licenciatura)':
                $trabajo->tipo= 'pregrado';
                break;
            case 'Tesis de Grado (Maestría)':
                $trabajo->tipo= 'maestria';
                break;
            case 'Tesis (Doctorado)':
                $trabajo->tipo= 'doctorado';
                break;
            case 'Monografías de Trabajos de Ascenso':
                $trabajo->tipo= 'ascenso';
                break;

        }

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

        return view('bibliograficos.referencias.trabajos.editar', compact('trabajo','fecha','fecha_ano', 'fecha_dia', 'fecha_mes', 'tipo_trabajos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function actualizar(CrearTrabajoRequest $request, $id)
    {

        $trabajo = Trabajo::find($id);

        $cita = $trabajo->cita.', '.$trabajo->fecha.$trabajo->letra;

        if(strcmp($cita, $request->cita) != 0){

            //Validar cita
            $datos= $this->getCitaArchivo($request->cita);

//            dd($datos);

            if($datos['error'] != null){
                return redirect()->back()->withErrors('estructura de la cita incorrecta')->withInput();
            }

            $cita = Cita::where('autores', $datos['autores'])->conFecha($datos['fecha'])->conLetra($datos['letra'])->first();

            if($cita != null){
                return redirect()->back()->withErrors('La cita ya está registra, agregue o cambie la letra')->withInput();
            }

            $trabajo->cita = $datos['autores'];
            $trabajo->cita_html = $datos['cita_html'];
            $trabajo->fecha = $datos['fecha'];
            $trabajo->letra = $datos['letra'];

            DB::table('citas')->where('referencia_id', $id)->where('tipo', 'T')->update(['autores' => $datos['autores'], 'fecha'=>$datos['fecha'], 'letra'=>$datos['letra']]);

        }



        switch ($trabajo->tipo){

            case 'pregrado':
                $trabajo->tipo= 'Trabajo Especial de Grado (Licenciatura)';
                break;
            case 'maestria':
                $trabajo->tipo= 'Tesis de Grado (Maestría)';
                break;
            case 'doctorado':
                $trabajo->tipo= 'Tesis (Doctorado)';
                break;
            case 'ascenso':
                $trabajo->tipo= 'Monografías de Trabajos de Ascenso';
                break;

        }


        $trabajo->autores = $request->autores;
        $trabajo->titulo = $request->titulo;
        $trabajo->institucion = $request->institucion;
        $trabajo->lugar = $request->lugar;
        $trabajo->paginas = $request->paginas;
        $trabajo->enlace = $request->enlace;
        $trabajo->archivo = $request->archivo;
        $trabajo->comentarios = $request->comentarios;



        $trabajo->save();

        return redirect()->route('trabajo.mostrar', $trabajo->id);


    }



    public function eliminar($id)
    {
        $trabajo = Trabajo::find($id);



        if($trabajo == null){
            $errores = [
                'error'    => ['El Trabajo no existe'],
            ];
            return response()->json($errores, 422);

        }else{

            if ($trabajo->delete()){
                $this->checkEspeciesRegistros($id);
                DB::table('registros')->where('referencia_id', $id)->where('tipo_referencia', 'T')->delete();
                DB::table('citas')->where('referencia_id', $id)->where('tipo', 'T')->delete();

                return;
            }else{
                $errores = [
                    'error'    => ['Disculpe, no se pudo eliminar el trabajo, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }

    public function checkEspeciesRegistros($id)
    {
        $registro = Registro::where('referencia_id', $id)->where('tipo_referencia', 'T')->get();

        foreach ($registro as $registro) {

            $cant_reg = Registro::where('especie_id', $registro['especie_id'])->get();

            if(count($cant_reg) == 1){// es el último registro de la especie hay que sacarla del catalogo
                $especie = Especie::find($registro['especie_id']);
                $especie->catalogo = 0;
                $especie->save();
            }
        }
    }
}
