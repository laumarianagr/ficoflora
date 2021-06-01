<?php namespace App\Http\Controllers;

use App\Ficoflora\Bibliografia;
use App\Ficoflora\Taxonomia;
use App\Http\Controllers\Controller;

use App\Http\Requests\RegistroRequest;
use App\Modelos\Bibliografia\Cita;
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
use App\Modelos\Taxonomia\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('investigador');
        $this->middleware('equipo.editor',['except'=>['index']]);
    }


    public function index()
    {

        $especies = null;
//        $especies = DB::table('especies')
//            ->join('epitetos_especificos', 'especies.especifico_id', '=', 'epitetos_especificos.id')
//            ->leftJoin('epitetos_varietales', 'especies.varietal_id', '=', 'epitetos_varietales.id')
//            ->leftJoin('epitetos_formas', 'especies.forma_id', '=', 'epitetos_formas.id')
//            ->join('generos', 'epitetos_especificos.genero_id', '=', 'generos.id')
//            ->join('autores', 'especies.autor_id', '=', 'autores.id')
//            ->select(DB::raw('especies.id, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, generos.nombre as genero, autores.nombre as autor'))
//            ->orderBy('genero')->orderBy('especifico')->orderBy('forma')->orderBy('varietal')
//            ->get();
        $usuario =Auth::user();

        return view('registros.index', compact('usuario'));
    }


    public function nuevos()
    {
        return view('registros.nuevo.index');

    }

    public function usuario()
    {
        $usuario = Auth::user();

        return view('registros.mis-registros.index', compact( 'usuario'));
    }



    public function crear()
    {

        $phylum = Phylum::select('id', 'nombre')->get();
        $clase = Clase::select('id', 'nombre', 'phylum_id')->get();
        $subclase = Subclase::select('id', 'nombre', 'clase_id')->get();
        $orden = Orden::select('id', 'nombre', 'subclase_id', 'clase_id')->get();
        $familia = Familia::select('id', 'nombre', 'orden_id')->get();
        $genero = Genero::select('id', 'nombre', 'familia_id')->get();
        $especifico = Especifico::select('id', 'nombre', 'genero_id')->get();
        $varietal = Varietal::select('id', 'nombre')->get();
        $forma = Forma::select('id','nombre')->get();
        $subespecie = Subespecie::select('id','nombre')->get();

        $autor = Autor::lists('nombre');
        $cita_autor = Cita::lists('autores');


        $letra = [
            '0' => '',
            'a' => 'a',
            'b' => 'b',
            'c' => 'c',
            'd' => 'd',
            'e' => 'e',
        ];

        $taxonomia = array('phylum' =>$phylum, 'clase' => $clase, 'subclase' => $subclase, 'orden' => $orden, 'familia' => $familia, 'genero' => $genero, 'especifico' => $especifico, 'varietal' => $varietal, 'forma' => $forma, 'subespecie' => $subespecie, 'autor' => $autor, 'cita_autor' => $cita_autor);
        $taxonomia = json_encode($taxonomia);
        return view('registro.crear', compact('taxonomia', 'letra'));
    }


    public function guardar(RegistroRequest $request)
    {

        $usuario = Auth::user();

        $taxonomia = new Taxonomia($request->all(), $usuario->id);
        $respuesta = $taxonomia->establecerTaxonomia();

        if($respuesta['error'] == true){
            return redirect()->back()->withErrors($respuesta['log'])->withInput();
        }

        if($respuesta['existe'] == true){
            return redirect()->back()->withErrors("La especie ya esta registrada")->withInput();
        }

        if($respuesta['error'] == false){
            $obj_especie = $respuesta['especie'];

            $cita = new Bibliografia($obj_especie->id,null);
            $cita_id = $cita->establecerCitaRegistro($request->cita_autor, $request->cita_fecha, $request->cita_letra);

        }

        return redirect()->route('registro.index');
    }



    public function editar($id)
    {
        $especie = Especie::find($id);

        if($especie == null){
            return redirect()->back()->withErrors("La especie no existe");
        }
        
        $usuario = Auth::user();

        dd($usuario->admin());
        //Valido que solo pueda editarlo la persona que lo creeo, el coordiandor o el administrador.
        if($usuario->id != $especie->creador_id && !$usuario->admin() && !$usuario->coordinador()){
            return redirect()->back()->withErrors("Usuario no Autorizado");
        }
        dd('paso');


//Arreglar a especifico
        $genero = Genero::find($especie->genero_id);
        $familia = Familia::find($genero->familia_id);
        $orden = Orden::find($familia->orden_id);
        if($orden->subclase_id != null){
            $subclase = Subclase::find($orden->subclase_id);
            $subclase = $subclase->nombre;
        }else{
            $subclase=null;
        }
        $clase = Clase::find($orden->clase_id);
        $phylum = Phylum::find($clase->phylum_id);

        $autor = Autor::find($especie->autor_id);
//        dd($autor);

        $registro = new Registro(['id'=> $especie->id,'phylum' => $phylum->nombre, 'clase' => $clase->nombre, 'subclase' => $subclase, 'orden' => $orden->nombre, 'familia' => $familia->nombre, 'genero' => $genero->nombre,'especifico' => $especie->especifico, 'varietal'=> $especie->varietal, 'forma' => $especie->forma, 'subespecie' => $especie->subespecie, 'autor' => $autor->nombre]);

//        dd($registro);

        return view('registro.editar')->with('registro', $registro);
    }

    public function actualizar($id, RegistroRequest $request)
    {
        return $request->all();
    }


    public function mostrar($id)
    {
        $especie = Especie::find($id);
        $especifico = Especifico::find($especie->especifico_id);
        if($especie->varietal_id != null){
            $varietal = Varietal::find($especie->varietal_id);
            $varietal = $varietal->nombre;
        }else{
            $varietal = null;
        }
        if($especie->forma_id != null){
            $forma = Forma::find($especie->forma_id);
            $forma = $forma->nombre;
        }else{
            $forma = null;
        }
        if($especie->subespecie_id != null){
            $subespecie = Subespecie::find($especie->subespecie_id);
            $subespecie = $subespecie->nombre;
        }else{
            $subespecie = null;
        }
        $genero = Genero::find($especifico->genero_id);
        $familia = Familia::find($genero->familia_id);
        $orden = Orden::find($familia->orden_id);
        if($orden->subclase_id != null){
            $subclase = Subclase::find($orden->subclase_id);
            $subclase = $subclase->nombre;
        }else{
            $subclase=null;
        }
        $clase = Clase::find($orden->clase_id);
        $phylum = Phylum::find($clase->phylum_id);

        $autor = Autor::find($especie->autor_id);

        $registro = new Registro(['id'=> $especie->id,'phylum' => $phylum->nombre, 'clase' => $clase->nombre, 'subclase' => $subclase, 'orden' => $orden->nombre, 'familia' => $familia->nombre, 'genero' => $genero->nombre,'especifico' => $especifico->nombre, 'varietal'=> $varietal, 'forma' => $forma, 'subespecie' => $subespecie,'autor' => $autor->nombre]);

        return view('registro.mostrar')->with('dato', $registro);
    }
}