<?php

namespace App\Http\Controllers\Bibliografia\Referencias;

use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Ficoflora\Funcionalidades\Referencias;
use App\Ficoflora\Funcionalidades\Referencias\ReferenciasTextosTrait;
use App\Ficoflora\Funcionalidades\ReferenciasTrait;
use App\Ficoflora\Registros\Bibliografia\Referencias\LibroRegistro;
use App\Http\Requests\Bibliografia\Referencias\CrearLibroRequest;
use App\Modelos\Bibliografia\Cita;
use App\Modelos\Bibliografia\Referencias\Libro;
use App\Modelos\Catalogo\Registro;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Especie;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LibrosController extends Controller
{
    
    use ReferenciasTextosTrait;

    use ReferenciasTrait;

    use EspecieDatosTrait;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.libros', ['only'=>['editar', 'eliminar', 'actualizar']]);
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
//        $registro = new LibroRegistro('Gomez et al');
//        $respuesta = $registro->nuevoLibro();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function guardar(CrearLibroRequest $request)
    {
//        dd($request->all());



        $registro = new LibroRegistro($request->all(), 'form', Auth::user()->id);
        $respuesta = $registro->nuevoLibro();


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

        $libro = $respuesta['registro'];
        $libro->save();
//        dd($libro->id);
//        Si se crea la referencia correctamente, se guarda la cita
        $cita = $respuesta['cita'];
        $cita->referencia_id = $libro->id;
        $cita->save();
//        dd($cita);

        if($request->ajax()) {
            return $libro->id;
        }

        return redirect()->route('libro.mostrar',$libro->id);

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
        $libro = Libro::find($id);
        
        $texto = $this->getLibroTexto($libro);
        $lista_especies = $this->listaNombresEspecies();



        $registros = Registro::where('referencia_id', $id)->conTipo('L')->get();


//        dd($registros);


        $especies = [];

        foreach ($registros as $registro) {

            $especie = Especie::find($registro->especie_id);

                array_push($especies, ['id' => $registro->id, 'nombre'=> $this->especieDatos($especie, null, false)['nombre'], 'autor'=>Autor::find($especie->autor_id)->nombre]);
        }

//        dd($especies);
        $total = count($especies);

        return view('bibliograficos.referencias.libros.mostrar', compact('usuario','libro','texto', 'especies', 'total', 'lista_especies'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editar($id)
    {
        $libro = Libro::find($id);

        if($libro->intervalo != null){
            $intevalos = explode('-', $libro->intervalo);
            $libro->intervalo_1= $intevalos[0];
            $libro->intervalo_2= $intevalos[1];
        }


        $cita_autores = Array(
            null => 'seleccione la cantidad de autores',
            '1'=> '1 autor',
            '2'=> '2 autores',
            '3'=> '3 o más autores',

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


        return view('bibliograficos.referencias.libros.editar', compact('libro','fecha','fecha_ano', 'fecha_dia', 'fecha_mes', 'cita_autores'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function actualizar(CrearLibroRequest $request, $id)
    {
//        dd($request->all());

        $libro = Libro::find($id);
        
        $cita = $libro->cita.', '.$libro->fecha.$libro->letra;
        
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
//            dd($datos);
            $libro->cita = $datos['autores'];
            $libro->cita_html = $datos['cita_html'];
            $libro->fecha = $datos['fecha'];
            $libro->letra = $datos['letra'];

            DB::table('citas')->where('referencia_id', $id)->where('tipo', 'L')->update(['autores' => $datos['autores'], 'fecha'=>$datos['fecha'], 'letra'=>$datos['letra']]);

//            dd($cita, $libro);
        }

        if($request->intervalo_1 != null){
            $libro->intervalo = $request->intervalo_1.'-'.$request->intervalo_2;
        }

        $libro->autores = $request->autores;
        $libro->titulo = $request->titulo;
        $libro->edicion = $request->edicion;
        $libro->editorial = $request->editorial;
        $libro->lugar = $request->lugar;
        $libro->paginas = $request->paginas;
        $libro->capitulo = $request->capitulo;
        $libro->editor = $request->editor;
        $libro->isbn = $request->isbn;
        $libro->doi = $request->doi;
        $libro->enlace = $request->enlace;
        $libro->comentarios = $request->comentarios;

        $libro->save();

        return redirect()->route('libro.mostrar', $libro->id);

    }

    public function eliminar($id)
    {
        $libro = Libro::find($id);



        if($libro == null){
            $errores = [
                'error'    => ['El Libro no existe'],
            ];
            return response()->json($errores, 422);

        }else{

            if ($libro->delete()){
                $this->checkEspeciesRegistros($id);
                DB::table('registros')->where('referencia_id', $id)->where('tipo_referencia', 'L')->delete();
                DB::table('citas')->where('referencia_id', $id)->where('tipo', 'L')->delete();
                return;
            }else{
                $errores = [
                    'error'    => ['Disculpe, no se pudo eliminar el libro, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }


    public function checkEspeciesRegistros($id)
    {
        $registro = Registro::where('referencia_id', $id)->where('tipo_referencia', 'L')->get();

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
