<?php

namespace App\Http\Controllers\RegistrosVenezuela\Taxonomia;


use App\Ficoflora\Bibliografia;
use App\Ficoflora\Funcionalidades\Logs\LogsTrait;
use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Ficoflora\Registros\Taxonomia\EspecieRegistro;
use App\Ficoflora\Taxonomia;
use App\Http\Controllers\Controller;

use App\Http\Requests\Taxonomia\EspecieRequest;
use App\Modelos\Bibliografia\Cita;
use App\Modelos\Bibliografia\Referencias\Libro;
use App\Modelos\Bibliografia\Referencias\Revista;
use App\Modelos\Bibliografia\Referencias\Trabajo;
use App\Modelos\Bibliografia\Referencias\Catalogo;
use App\Modelos\Bibliografia\Referencias\Enlace;
use App\Modelos\Catalogo\Registro;
use App\Modelos\Cuentas\Usuario;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Especie;
use App\Modelos\Taxonomia\Epitetos\Especifico;
use App\Modelos\Taxonomia\Epitetos\Varietal;
use App\Modelos\Taxonomia\Epitetos\Forma;
use App\Modelos\Taxonomia\Epitetos\Subespecie;
use App\Modelos\Taxonomia\Genero;
use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Orden;
use App\Modelos\Taxonomia\Subclase;
use App\Modelos\Taxonomia\Clase;
use App\Modelos\Taxonomia\Phylum;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EspeciesController extends Controller
{

    use EspecieDatosTrait;
    use LogsTrait;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.especies', ['only'=>['editar', 'eliminar', 'actualizar']]);
    }

    /**
     * Muestra el formulario para la creación de una nueva especie
     *
     * @return Response
     */
    public function crear()
    {
        $familias = Familia::lists('nombre', 'id');
//        $familias[null] = 'Seleccione una familia';

        //Quitando los genero que esta por sinonimia que no tienen arbol taxonómico superior
        $genero = Genero::where('familia_id', '!=', -1)->select('id', 'nombre', 'familia_id')->get();
        $especifico = Especifico::select('id', 'nombre')->get();
        $varietal = Varietal::select('id', 'nombre')->get();
        $forma = Forma::select('id','nombre')->get();
        $subespecie = Subespecie::select('id','nombre')->get();

        $autor = Autor::lists('nombre');

        $taxonomia = array( 'genero' => $genero, 'especifico' => $especifico, 'varietal' => $varietal, 'forma' => $forma, 'subespecie' => $subespecie, 'autor' => $autor);
        $taxonomia = json_encode($taxonomia);
//        dd($taxonomia.'genero');

        return view('taxonomia.especies.crear', compact('taxonomia', 'familias'));
    }

    /**
     * Guarda en la BDD una nueva especie creada a traves del formulario
     *
     * @return Response
     */
    public function guardar(EspecieRequest $request)
    {

        $usuario = Auth::user();
//        dd($request->all());

            //posible error de familia ID
        $familia = Familia::find($request->familia);
        if($familia == null){
            if($request->ajax()) {
                return response()->json("La Familia no existe", 422);
            }
            return redirect()->back()->withErrors("La Familia no existe")->withInput();
        }

        //Obtengo el objeto Clase ya sea de la BDD o una nueva instancia
        $registro = new EspecieRegistro($request->all(), $familia->id, $usuario->id);
        $respuesta = $registro->nuevaEspecie();



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

        $especie = $respuesta['registro'];
        $especie->save();

        $datos = $this->especieDatos($especie, null, false);
        $this->LogCrear($usuario->usuario,'Especie',$datos['nombre'],$especie->id,'especie.mostrar');


        if($request->ajax()) {
            $especie = $especie->id;
            return compact('especie');
        }

        return redirect()->route('especie.mostrar',$especie->id);
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
        $especie_obj= Especie::find($id);


        $sinonimias_obj = $especie_obj->sinonimias()->get();

        $especie = $this->especieDatos($especie_obj, null, true);

        $sinonimias = collect();

        foreach($sinonimias_obj as $sinonima){
            $datos = $this->especieDatos($sinonima, null, false);
            $sinonimias->push($datos);
        }


        $lista_sinonimias = $this->listaNombreSinonimia();
        
        
        $registros = Registro::where('especie_id', $id)->get();

        foreach ($registros as $registro) {

            switch ($registro->tipo_referencia) {

                case 'R':
                    $referencia = Revista::where('id', $registro->referencia_id)->select('cita', 'fecha', 'letra', 'autores', 'titulo')->first();
                    $referencia->tipo= 'Revista';
                    break;

                case 'L':
                    $referencia = Libro::where('id', $registro->referencia_id)->select('cita', 'fecha', 'letra', 'autores', 'titulo')->first();
                    $referencia->tipo= 'Libro';
                    break;

                case 'T':
                    $referencia = Trabajo::where('id', $registro->referencia_id)->select('cita', 'fecha', 'letra', 'autores', 'titulo')->first();
                    $referencia->tipo= 'Trabajo';
                    break;

                case 'C':
                    $referencia = Catalogo::where('id', $registro->referencia_id)->select('cita', 'fecha', 'letra', 'autores', 'titulo')->first();
                    $referencia->tipo= 'Catálogo';
                    break;

                case 'E':
                    $referencia = Enlace::where('id', $registro->referencia_id)->select('cita', 'fecha', 'letra', 'autores', 'nombre')->first();
                    // en los enlaces web se usa el campo nombre en lugar de título
                    $referencia->tipo= 'Enlace';
                    break;
            }
            
            $registro->referencia = $referencia;
        }


//        dd( $registros);
        $imagenes = $this->getImagenes($id);


        return view('taxonomia.especies.mostrar', compact('imagenes','usuario','especie', 'sinonimias', 'lista_sinonimias', 'registros'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     *
     * @param  int  $id
     * @return Response
     */
    public function editar($id)
    {

        //redireccionar si no existe
        $especie = Especie::findOrFail($id);

        $familias = Familia::lists('nombre', 'id');

        $generos = Genero::where('familia_id', '!=', -1)->select('id', 'nombre as text', 'familia_id')->get();

//        dd($generos);
        $especificos = Especifico::lists('nombre', 'id');
        $varietales = Varietal::lists('nombre', 'id');
        $formas = Forma::lists('nombre', 'id');
        $subespecies = Subespecie::lists('nombre', 'id');
        $autores = Autor::lists('nombre', 'id');

        $especie->familia_id = Genero::find($especie->genero_id)->familia_id;
        $id = Familia::find($especie->familia_id)->orden_id;

        $orden = Orden::find($id);
        $especie->orden = $orden->nombre;

        if($orden->subclase_id != null){
            $sublcase = Subclase::find($orden->subclase_id);
            $especie->subclase = $sublcase->nombre;
        }

        $clase = Clase::find($orden->clase_id);
        $especie->clase = $clase->nombre;

        $phylum = Phylum::find($clase->phylum_id);
        $especie->phylum = $phylum->nombre;
//        dd($especie);

        //formularios de nuevos elementos
        $genero_type = Genero::where('familia_id', '!=', -1)->select('id', 'nombre', 'familia_id')->get();
        $especifico_type = Especifico::select('id', 'nombre')->get();
        $varietal_type = Varietal::select('id', 'nombre')->get();
        $forma_type = Forma::select('id','nombre')->get();
        $subespecie_type = Subespecie::select('id','nombre')->get();

        $taxonomia = array( 'genero' => $genero_type, 'especifico' => $especifico_type, 'varietal' => $varietal_type, 'forma' => $forma_type, 'subespecie' => $subespecie_type, 'autor' => $autores);
        $taxonomia = json_encode($taxonomia);

        return view('taxonomia.especies.editar', compact('taxonomia', 'familias', 'autores', 'especie', 'generos', 'especificos', 'varietales', 'formas', 'subespecies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function actualizar(EspecieRequest $request, $id)
    {
//        dd($request->all());
        $usuario = Auth::user();

        $especie = Especie::find($id);

        $respuesta = $this->validarGeneroFamilia($request, $id);

//        if (get_class($respuesta) === 'Illuminate\Http\RedirectResponse') { return $respuesta; }
        if(is_a($respuesta, 'Illuminate\Http\RedirectResponse')) {
            return $respuesta;
        }

        $this->actualizarEspecie($request, $especie);

//        dd($especie);

        return redirect()->route('especie.mostrar', [$especie->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function eliminar($id)
    {
        $especie = Especie::find($id);
        $usuario = Auth::user();

        if($especie == null){
            $errores = [
                'error'    => ['La especie no existe'],
            ];
            return response()->json($errores, 422);

        }else{

            if ($especie->delete()){
                $datos = $this->especieDatos($especie, $especie->id,false);
                $this->LogEliminar($usuario->usuario,'Especie',$datos['nombre'],$especie->id);

                return;
            }else{
                $errores = [
                    'error'    => ['Disculpe, no se pudo eliminar la especie, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }


    public function actualizarEspecie($request, $especie)
    {
        $log_g =  $log_e =  $log_v =  $log_f =  $log_a =  $log_s = false;
        $usuario = Auth::user();


        if($especie->genero_id != $request->genero) {
            $log_g = true;
            $ant_g=Genero::find($especie->genero_id)->nombre;
            $nuevo_g=Genero::find($request->genero)->nombre;
            $especie->genero_id = $request->genero;
        }

        if($especie->especifico_id != $request->especie) {
            $log_e = true;
            $ant_e = Especifico::find($especie->especifico_id)->nombre;
            $nuevo_e = Especifico::find($request->especie)->nombre;
            $especie->especifico_id = $request->especie;
        }

        if($especie->varietal_id != $request->variedad) {
            $log_v = true;
            if($especie->varietal_id !=  null){
                $ant_v = Varietal::find($especie->varietal_id)->nombre;
            }else{
                $ant_v=null;
            }
            if($request->variedad !=  null){
                $nuevo_v = Varietal::find($request->variedad)->nombre;
            }else{
                $nuevo_v=null;
            }
            $especie->varietal_id = $request->variedad;
        }

        if($especie->forma_id != $request->forma) {
            $log_f = true;
            if($especie->forma_id !=  null){
                $ant_f = Forma::find($especie->forma_id)->nombre;
            }else{
                $ant_f=null;
            }
            if($request->forma !=  null){
                $nuevo_f = Forma::find($request->forma)->nombre;
            }else{
                $nuevo_f=null;
            }
            $especie->forma_id = $request->forma;
        }

        if($especie->subespecie_id != $request->subespecie) {
            $log_s = true;
            if($especie->subespecie_id !=  null){
                $ant_s = Subespecie::find($especie->subespecie_id)->nombre;
            }else{
                $ant_s = null;
            }
            if($request->subespecie !=  null){
                $nuevo_s = Subespecie::find($request->subespecie)->nombre;
            }else{
                $nuevo_s = null;
            }
            $especie->subespecie_id = $request->subespecie;
        }

        if($especie->autor_id != $request->autor) {
            $log_a = true;
            $ant_a = Autor::find($especie->autor_id)->nombre;
            $nuevo_a = Autor::find($request->autor)->nombre;
            $especie->autor_id = $request->autor;
        }

        $especie->save();

        if($log_g) {
            $this->LogEditar($usuario->usuario,'Especie',$ant_g,$nuevo_g ,'Editar género',$especie->id,'especie.mostrar');
        }
        if($log_e) {
            $this->LogEditar($usuario->usuario,'Especie',$ant_e,$nuevo_e ,'Editar e. específico',$especie->id,'especie.mostrar');
        }
        if($log_v) {
            $this->LogEditar($usuario->usuario,'Especie',$ant_v,$nuevo_v ,'Editar e. varietal',$especie->id,'especie.mostrar');
        }
        if($log_f) {
            $this->LogEditar($usuario->usuario,'Especie',$ant_f,$nuevo_f ,'Editar e. de forma',$especie->id,'especie.mostrar');
        }
        if($log_s) {
            $this->LogEditar($usuario->usuario,'Especie',$ant_s,$nuevo_s ,'Editar subespecie',$especie->id,'especie.mostrar');
        }
        if($log_a) {
            $this->LogEditar($usuario->usuario,'Especie',$ant_a,$nuevo_a ,'Editar autoridad',$especie->id,'especie.mostrar');
        }
    }

    public function validarGeneroFamilia($request, $id)
    {

        $genero = Genero::find($request->genero);
        
        if($genero->familia_id != $request->familia){

//            dd('diferente');
            $familia = Familia::find($genero->familia_id);
            $error = "El Genero " . $genero->nombre . " pertenece a la Familia \"" . $familia->nombre . "\"";

            return redirect()->back()->withErrors($error)->withInput($request->all());
        }
    }


    public function sinonimiaQuitar($id, Request $request)
    {
        $especie= Especie::find($id);

        $especie->sinonimias()->detach($request->id);

        return $request->id;

    }

    public function sinonimiaAgregar($id, Request $request)
    {
        $especie= Especie::find($id);

        if($especie->sinonimias->contains($request->id)){
            $errores = [
                'error'    => ['La sinonimia ya está relacionada con la especie.'],
            ];
            return response()->json($errores, 422);;
        }else{
            $especie->sinonimias()->attach($request->id);
            return;
        }
    }


    public function getImagenes($id)
    {
        $imagenes = DB::table('imagenes_especies')
            ->where('especie_id', $id)
//            ->where('tipo', 'g')
            ->get();

        return $imagenes;
    }
}