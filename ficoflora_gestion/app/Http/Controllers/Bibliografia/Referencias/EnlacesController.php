<?php

namespace App\Http\Controllers\Bibliografia\Referencias;

use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Ficoflora\Funcionalidades\Referencias\ReferenciasTextosTrait;
use App\Ficoflora\Funcionalidades\ReferenciasTrait;
use App\Ficoflora\Registros\Bibliografia\Referencias\EnlaceRegistro;
use App\Http\Requests\Bibliografia\Referencias\CrearEnlaceRequest;
use App\Modelos\Bibliografia\Cita;
use App\Modelos\Bibliografia\Referencias\Enlace;
use App\Modelos\Catalogo\Registro;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Especie;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnlacesController extends Controller
{
    
    use ReferenciasTextosTrait;

use ReferenciasTrait;
    use EspecieDatosTrait;
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.enlaces', ['only'=>['editar', 'eliminar', 'actualizar']]);
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
    public function guardar(CrearRegistroRequest $request)
    {
//        dd($request->all());
//        return $request->all();

        $registro = new EnlaceRegistro($request->all(), 'form', Auth::user()->id);
        $respuesta = $registro->nuevoEnlace();

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

        $enlace = $respuesta['registro'];
        $enlace->save();

        //Si se crea la referencia correctamente, se guarda la cita
        $cita = $respuesta['cita'];
        $cita->referencia_id = $enlace->id;
        $cita->save();

        if($request->ajax()) {
            return $enlace->id;
        }

        return redirect()->route('enlace.mostrar',$enlace->id);
    }


    public function mostrar($id)
    {
        $enlace = Enlace::find($id);

        $texto = $this->getEnlaceTexto($enlace);

        $usuario = Auth::user();
        $lista_especies = $this->listaNombresEspecies();

        $registros = Registro::where('referencia_id', $id)->conTipo('E')->get();

        $especies = [];

        foreach ($registros as $registro) {

            $especie = Especie::find($registro->especie_id);
            array_push($especies, ['id' => $registro->id, 'nombre'=> $this->especieDatos($especie, null, false)['nombre'], 'autor'=>Autor::find($especie->autor_id)->nombre]);
        }

        $total = count($especies);

        return view('bibliograficos.referencias.enlaces.mostrar', compact('usuario','enlace','texto', 'especies', 'total', 'lista_especies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editar($id)
    {
        $enlace = Enlace::find($id);

        $cita_autores = Array(
            null => 'seleccione la cantidad de autores',
            '1'=> '1 autor',
            '2'=> '2 autores',
            '3'=> '3 o más autores',
        );

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

        return view('bibliograficos.referencias.enlaces.editar', compact('enlace','fecha','fecha_ano', 'fecha_dia', 'fecha_mes', 'cita_autores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function actualizar(CrearEnlaceRequest $request, $id)
    {

        $enlace = Enlace::find($id);

        $cita = $enlace->cita.', '.$enlace->fecha.$enlace->letra;

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

            $enlace->cita = $datos['autores'];
            $enlace->cita_html = $datos['cita_html'];
            $enlace->fecha = $datos['fecha'];
            $enlace->letra = $datos['letra'];

            DB::table('citas')->where('referencia_id', $id)->where('tipo', 'E')->update(['autores' => $datos['autores'], 'fecha'=>$datos['fecha'], 'letra'=>$datos['letra']]);

        }

        $enlace->autores = $request->autores;
        $enlace->titulo = $request->titulo;
        $enlace->nombre = $request->nombre;
        $enlace->institucion = $request->institucion;
        $enlace->lugar = $request->lugar;
        $enlace->enlace = $request->enlace;
        $enlace->dia = $request->dia;
        $enlace->mes = $request->mes;
        $enlace->ano = $request->ano;

        $enlace->save();

        return redirect()->route('enlace.mostrar', $enlace->id);
    }

    public function eliminar($id)
    {
        $enlace = Enlace::find($id);

        if($enlace == null){
            $errores = [
                'error'    => ['El enlace al sitio web no existe'],
            ];
            return response()->json($errores, 422);

        }else{

            if ($enlace->delete()){
                $this->checkEspeciesRegistros($id);
                DB::table('registros')->where('referencia_id', $id)->where('tipo_referencia', 'E')->delete();
                DB::table('citas')->where('referencia_id', $id)->where('tipo', 'E')->delete();

                return;
            }else{
                $errores = [
                    'error'    => ['Disculpe, no se pudo eliminar el enlace al sitio web, intente de nuevo'],
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
