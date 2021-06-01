<?php

namespace App\Http\Controllers\Bibliografia\Referencias;

use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Ficoflora\Funcionalidades\Referencias\ReferenciasTextosTrait;
use App\Ficoflora\Funcionalidades\ReferenciasTrait;
use App\Ficoflora\Registros\Bibliografia\Referencias\RevistaRegistro;
use App\Http\Requests\Bibliografia\Referencias\CrearRevistaRequest;
use App\Modelos\Bibliografia\Cita;
use App\Modelos\Bibliografia\Referencias\Revista;
use App\Modelos\Catalogo\Registro;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Especie;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RevistasController extends Controller
{
    use ReferenciasTextosTrait;
    use EspecieDatosTrait;

    use ReferenciasTrait;


    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.revistas', ['only'=>['editar', 'eliminar', 'actualizar']]);
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
    public function guardar(CrearRevistaRequest $request)
    {
        $registro = new RevistaRegistro($request->all(), 'form', Auth::user()->id);
        $respuesta = $registro->nuevaRevista();

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

        $revista = $respuesta['registro'];
        $revista->save();

        //Si se crea la referencia correctamente, se guarda la cita
        $cita = $respuesta['cita'];
        $cita->referencia_id = $revista->id;
        $cita->save();


        if($request->ajax()) {

            return $revista->id;
        }


        return redirect()->route('revista.mostrar',$revista->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function mostrar($id)
    {

        $usuario = Auth::user();
        $revista = Revista::find($id);

        $texto = $this->getRevistaTexto($revista);
        $lista_especies = $this->listaNombresEspecies();

        $registros = Registro::where('referencia_id', $id)->conTipo('R')->get();


        $especies = [];

        foreach ($registros as $registro) {

            $especie = Especie::find($registro->especie_id);
            array_push($especies, ['id' => $registro->id, 'nombre'=> $this->especieDatos($especie, null, false)['nombre'], 'autor'=>Autor::find($especie->autor_id)->nombre]);
        }

        $total = count($especies);
        return view('bibliograficos.referencias.revistas.mostrar', compact('usuario','revista','texto', 'especies', 'total', 'lista_especies'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editar($id)
    {

        $revista = Revista::find($id);


        if($revista->intervalo != null){
            $intevalos = explode('-', $revista->intervalo);
            $revista->intervalo_1= $intevalos[0];
            $revista->intervalo_2= $intevalos[1];
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

        return view('bibliograficos.referencias.revistas.editar', compact('revista','fecha','fecha_ano', 'fecha_dia', 'fecha_mes', 'cita_autores'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function actualizar(CrearRevistaRequest $request, $id)
    {

        $revista = Revista::find($id);

        

        $cita = $revista->cita.', '.$revista->fecha.$revista->letra;

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

            $revista->cita = $datos['autores'];
            $revista->cita_html = $datos['cita_html'];
            $revista->fecha = $datos['fecha'];
            $revista->letra = $datos['letra'];

            DB::table('citas')->where('referencia_id', $id)->where('tipo', 'R')->update(['autores' => $datos['autores'], 'fecha'=>$datos['fecha'], 'letra'=>$datos['letra']]);

//            dd($cita, $revista);
        }

        if($request->intervalo_1 != null){
            $request->intervalo = $request->intervalo_1.'-'.$request->intervalo_2;
        }

        $revista->autores = $request->autores;
        $revista->titulo = $request->titulo;
        $revista->nombre = $request->nombre;
        $revista->volumen = $request->volumen;
        $revista->numero = $request->numero;
        $revista->intervalo = $request->intervalo;
        $revista->isbn = $request->isbn;
        $revista->issn = $request->issn;
        $revista->doi = $request->doi;
        $revista->enlace = $request->enlace;
        $revista->archivo = $request->archivo;
        $revista->comentarios = $request->comentarios;


        $revista->save();

        return redirect()->route('revista.mostrar', $revista->id);

    }

    public function eliminar($id)
    {
        $revista = Revista::find($id);

        if($revista == null){
            $errores = [
                'error'    => ['La Revista no existe'],
            ];
            return response()->json($errores, 422);

        }else{

            if ($revista->delete()){
                $this->checkEspeciesRegistros($id);

                DB::table('registros')->where('referencia_id', $id)->where('tipo_referencia', 'R')->delete();
                DB::table('citas')->where('referencia_id', $id)->where('tipo', 'R')->delete();


                return;
            }else{
                $errores = [
                    'error'    => ['Disculpe, no se pudo eliminar la revista, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }

    public function checkEspeciesRegistros($id)
    {
        $registro = Registro::where('referencia_id', $id)->where('tipo_referencia', 'R')->get();

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
