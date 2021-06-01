<?php

namespace App\Http\Controllers\RegistrosVenezuela\Sinonimia;

use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Ficoflora\Registros\Sinonimia\SinonimiaRegistro;
use App\Http\Requests\Sinonimia\CrearSinonimiaRequest;
use App\Modelos\Catalogo\Registro;
use App\Modelos\Geografico\Ubicacion;
use App\Modelos\Sinonimias\Sinonimia;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Epitetos\Especifico;
use App\Modelos\Taxonomia\Epitetos\Varietal;
use App\Modelos\Taxonomia\Epitetos\Forma;
use App\Modelos\Taxonomia\Epitetos\Subespecie;
use App\Modelos\Taxonomia\Especie;
use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Genero;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SinonimiaController extends Controller
{
    use EspecieDatosTrait;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.sinonimias', ['only'=>['editar', 'eliminar', 'actualizar']]);
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
        $genero = Genero::select('id', 'nombre')->get();
        $especifico = Especifico::select('id', 'nombre')->get();
        $varietal = Varietal::select('id', 'nombre')->get();
        $forma = Forma::select('id','nombre')->get();
        $subespecie = Subespecie::select('id','nombre')->get();

        $autor = Autor::lists('nombre');

        $taxonomia = array( 'genero' => $genero, 'especifico' => $especifico, 'varietal' => $varietal, 'forma' => $forma, 'subespecie' => $subespecie, 'autor' => $autor);
        $taxonomia = json_encode($taxonomia);

        return view('sinonimia.crear', compact('taxonomia'));
    }


    public function guardar(CrearSinonimiaRequest $request)
    {
//        dd($request->all());

        $usuario = Auth::user();

        $registro = new SinonimiaRegistro($request->all(), $usuario->id);
        $respuesta = $registro->nuevaSinonimia();

        if($respuesta['error'] == true){
            if($request->ajax()) {
                $log = ['error' =>[$respuesta['log']]];
                return response()->json($log, 422);
            }
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }


        if($respuesta['existe'] == true){
            if($request->ajax()) {
                $sinonimia = $this->getNombreEspecie($request);
                $autor = $request->autor;

                $nuevo = false;
                $id = $respuesta['registro']['id'];
                return compact('sinonimia', 'autor','nuevo', 'id');
            }
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }

        $sinonimia = $respuesta['registro'];
        $sinonimia->save();

        if($request->ajax()) {
            $sinonimia = $this->getNombreEspecie($request);
            $autor = $request->autor;
            $id = $respuesta['registro']['id'];
            $nuevo =true;
            return compact('sinonimia', 'autor','nuevo', 'id');

        }

        return redirect()->route('sinonimia.mostrar',$sinonimia->id);

    }

    //MOSTRAR
    public function mostrar($id)
    {


        $sinonimia = Sinonimia::find($id);
        $especies_ids = $sinonimia->especies()->get();

        $sinonimia = $this->especieDatos($sinonimia, null, false);

        $especies = Array();
        $total = 0;

        foreach ($especies_ids as $especie) {

//            dd($especie);
            if($especie->catalogo==true){

                $nombre = $this->especieDatos($especie, null, false);
                array_push($especies, $nombre);
                $total++;
            }
        }

        $usuario = Auth::user();
        return view('sinonimia.mostrar', compact('usuario','sinonimia', 'especies', 'total'));
    }

    //EDITAR
    public function editar($id)
    {
        $especie = Sinonimia::find($id);

        $familias = Familia::lists('nombre', 'id');
        $generos = Genero::lists('nombre', 'id');
        $especificos = Especifico::lists('nombre', 'id');
        $varietales = Varietal::lists('nombre', 'id');
        $formas = Forma::lists('nombre', 'id');
        $subespecies = Subespecie::lists('nombre', 'id');
        $autores = Autor::lists('nombre', 'id');

        $genero_type = Genero::where('familia_id', '!=', -1)->select('id', 'nombre', 'familia_id')->get();
        $especifico_type = Especifico::select('id', 'nombre')->get();
        $varietal_type = Varietal::select('id', 'nombre')->get();
        $forma_type = Forma::select('id','nombre')->get();
        $subespecie_type = Subespecie::select('id','nombre')->get();

        $taxonomia = array( 'genero' => $genero_type, 'especifico' => $especifico_type, 'varietal' => $varietal_type, 'forma' => $forma_type, 'subespecie' => $subespecie_type, 'autor' => $autores);
        $taxonomia = json_encode($taxonomia);

        $formas[''] = 'Seleccione una opcción';
        $varietales[''] = 'Seleccione una opcción';
        $subespecies[''] = 'Seleccione una opcción';

        return view('sinonimia.editar', compact('taxonomia', 'familias', 'autores', 'especie', 'generos', 'especificos', 'varietales', 'formas', 'subespecies'));
    }


    public function actualizar(CrearSinonimiaRequest $request, $id)
    {
        $especie = Sinonimia::find($id);

        $this->actualizarEspecie($request, $especie);

        return redirect()->route('sinonimia.mostrar', [$especie->id]);
    }


    public function eliminar($id)
    {
        $especie = Sinonimia::find($id);

        if($especie == null){
            $errores = [
                'error'    => ['La sinonimia no existe'],
            ];
            return response()->json($errores, 422);

        }else{

            if ($especie->delete()){
//                DB::table('registro_ubicacion_sinonimia')->where('sinonimia_id', $id)->delete();

                return;
            }else{
                $errores = [
                    'error'    => ['Disculpe, no se pudo eliminar la sinonimia, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }



    public function actualizarEspecie($request, $especie)
    {
        $especie->genero_id = $request->genero;
        $especie->especifico_id = $request->especie;
        $especie->varietal_id = $request->variedad;
        $especie->forma_id = $request->forma;
        $especie->subespecie_id = $request->subespecie;
        $especie->autor_id = $request->autor;

        $especie->save();
    }

    /**
     * @param CrearSinonimiaRequest $request
     * @return string
     */
    private function getNombreEspecie(CrearSinonimiaRequest $request)
    {
        $sinonimia = $request->genero . ' ' . $request->especie;

        if ($request->has('variedad')) {
            $sinonimia = $sinonimia . ' v. ' . $request->variedad;
        }

        if ($request->has('forma')) {
            $sinonimia = $sinonimia . ' f. ' . $request->forma;
        }

        if ($request->has('subespecie')) {
            $sinonimia = $sinonimia . ' subsp. ' . $request->subespecie;
        }

        return $sinonimia;
    }


    public function especieQuitar($id, Request $request)
    {
        $sinonimia= Sinonimia::find($id);

        $sinonimia->especies()->detach($request->id);

        return $request->id;

    }

    public function listado()
    {
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

        $lista_sinonimias = Array();
        
        foreach($sinonimias as $sinonimia){

            $nombre = $this->especieObjNombre($sinonimia);
            $lista_sinonimias[$sinonimia->id] = $nombre;
        }
//        dd($lista_sinonimias);

        return $lista_sinonimias;

    }
}