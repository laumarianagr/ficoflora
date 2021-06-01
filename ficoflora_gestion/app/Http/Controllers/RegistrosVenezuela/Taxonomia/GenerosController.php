<?php

namespace App\Http\Controllers\RegistrosVenezuela\Taxonomia;

use App\Ficoflora\Funcionalidades\Logs\LogsTrait;
use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Ficoflora\Funcionalidades\Nombres\TaxonomiaSuperiorTrait;
use App\Ficoflora\Registro;
use App\Ficoflora\Registros\Taxonomia\GeneroRegistro;
use App\Ficoflora\Taxonomia;
use App\Http\Requests\Taxonomia\CrearGeneroRequest;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Clase;
use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Genero;
use App\Modelos\Taxonomia\Orden;
use App\Modelos\Taxonomia\Phylum;
use App\Modelos\Taxonomia\Subclase;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GenerosController extends Controller
{
    
    use TaxonomiaSuperiorTrait;
    use EspecieDatosTrait;
    use LogsTrait;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.generos', ['only'=>['editar', 'eliminar', 'actualizar']]);
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
        $familias = Familia::lists('nombre', 'id');
        $genero = Genero::select('id', 'nombre', 'familia_id')->get();

        $taxonomia = array('genero' => $genero);
        $taxonomia = json_encode($taxonomia);


        return view('taxonomia.generos.crear', compact('taxonomia', 'familias'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function guardar(CrearGeneroRequest $request)
    {
        $usuario = Auth::user();

        //posible error de familia ID
        $familia = Familia::find($request->familia);
        if($familia == null){
            return redirect()->back()->withErrors("La Familia no existe")->withInput();
        }

        //Obtengo el objeto Clase ya sea de la BDD o una nueva instancia
        $registro = new GeneroRegistro($request->genero, $familia->id, $usuario->id);
        $respuesta = $registro->nuevoGenero();


        if($respuesta['error'] == true){
            if($request->ajax()) {
                $log = ['error' =>[$respuesta['log']]];

                return response()->json($log, 422);
            }
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }


        if($respuesta['existe'] == true){
            if($request->ajax()) {
                $errores = [
                    'error'    => ['El epíteto específico ya existe'],
                ];
                return response()->json($errores, 422);
            }
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }


        $genero = $respuesta['registro'];
        $genero->save();
        $this->LogCrear($usuario->usuario,'Género',$genero->nombre,$genero->id,'genero.mostrar');

        if($request->ajax()) {
            return $genero;
        }

        return redirect()->route('genero.mostrar',$genero->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function mostrar($id)
    {
        $genero_obj = Genero::find($id);
        if($genero_obj->familia_id != -1){
            $genero = $this->taxoGenero($id);
            $genero['sinonimia'] = false;
            
            $especies_obj = $genero_obj->especies()->get();
            $total = $especies_obj->count();

            $especies = [];
            foreach ($especies_obj as $especie) {

                array_push($especies, ['id' => $especie->id, 'nombre'=> $this->especieDatos($especie, null, false)['nombre'], 'autor'=>Autor::find($especie->autor_id)->nombre]);
            }

//            dd($especies);

        }else{
            $genero['genero'] = $genero_obj->nombre;
            $genero['genero_id'] = $genero_obj->id;
            $genero['sinonimia'] = true;
            $genero['creador_id'] = $genero_obj->creador_id;
            $especies = [];
            $total =0;
        }

        $usuario = Auth::user();


//        dd($genero);



        return view('taxonomia.generos.mostrar', compact('usuario','genero', 'especies', 'total'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editar($id)
    {
        $genero = Genero::findOrFail($id);

        $familias = Familia::lists('nombre', 'id');

        $generos = Genero::select('id', 'nombre', 'familia_id')->get();

        $taxonomia = array('genero' => $generos);
        $taxonomia = json_encode($taxonomia);

        return view('taxonomia.generos.editar', compact('familias', 'genero', 'taxonomia' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function actualizar(CrearGeneroRequest $request, $id)
    {
        $usuario = Auth::user();

        $genero = Genero::find($id);

        $log_f = $log_g= false;
        //chequear si hay cambios en el nombre
        if($genero->nombre != $request->genero){
            $check = Genero::where('nombre', $request->genero)->first();//verficamos si no existe otro género con ese nombre
            if($check != null){
               return redirect()->back()->withErrors('Ya existe un género con este nombre')->withInput();
           }else{
                $ant_g=$genero->nombre;
                $nuevo_g=$request->genero;
                $genero->nombre = $request->genero;
                $log_g=true;

            }
        }

        if($genero->familia_id != $request->familia){
            $ant_f=Familia::find($genero->familia_id)->nombre;
            $nuevo_f=Familia::find($request->familia)->nombre;
            $genero->familia_id = $request->familia;
            $log_f=true;
        }
        
        $genero->save();

        if($log_g) {
               $this->LogEditar($usuario->usuario,'Género',$ant_g,$nuevo_g ,'Editar nombre',$genero->id,'genero.mostrar');
        }
        if($log_f) {
               $this->LogEditar($usuario->usuario,'Género',$ant_f,$nuevo_f ,'Editar familia',$genero->id,'genero.mostrar');
        }


       return redirect()->route('genero.mostrar', [$genero->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function eliminar($id)
    {
        $usuario = Auth::user();

        $genero = Genero::find($id);

        if($genero == null){
            $errores = [
                'error'    => ['El Genero no existe'],
            ];
            return response()->json($errores, 422);

        }else{

            if ($genero->delete()){
                $this->LogEliminar($usuario->usuario,'Género',$genero->nombre,$genero->id);

                return;
            }else{
                $errores = [
                    'error'    => ['Disculpe, no se pudo eliminar el género, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }
}
