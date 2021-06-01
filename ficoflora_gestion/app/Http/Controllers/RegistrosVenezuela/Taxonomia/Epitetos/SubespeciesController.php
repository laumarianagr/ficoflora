<?php

namespace App\Http\Controllers\RegistrosVenezuela\Taxonomia\Epitetos;

use App\Ficoflora\Funcionalidades\Logs\LogsTrait;
use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Http\Requests\Taxonomia\CrearSubespecieRequest;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Epitetos\Subespecie;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubespeciesController extends Controller
{

    use EspecieDatosTrait;
    use LogsTrait;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.subespecies', ['only'=>['editar', 'eliminar', 'actualizar']]);
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

    public function crear()
    {
        $subespecie = Subespecie::select('id', 'nombre')->get();

        $taxonomia = array('subespecie' => $subespecie);
        $taxonomia = json_encode($taxonomia);

        return view('taxonomia.subespecies.crear', compact('taxonomia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function guardar(CrearSubespecieRequest $request)
    {
        //validar que esta

        $usuario = Auth::user();

        $subespecie = Subespecie::where('nombre', $request->subespecie)->exists();

        if($subespecie == true){
            if($request->ajax()) {

                $errores = [
                    'error' => ['La subespecie ya existe'],
                ];
                return response()->json($errores, 422);
            }
            return redirect()->back()->withErrors('La subespecie ya existe')->withInput();

        }

        $subespecie = Subespecie::create(['nombre' => $request->subespecie, 'creador_id' => $usuario->id]);
        $this->LogCrear($usuario->usuario,'Subespecie',$subespecie->nombre,$subespecie->id,'subespecie.mostrar');

        if($request->ajax()) {
            return $subespecie;
        }

        return redirect()->route('subespecie.mostrar', [$subespecie->id]);
    }



    public function mostrar($id)
    {
        $usuario = Auth::user();
        $subespecie = Subespecie::find($id);

        $especies_obj = $subespecie->especies()->get();

        $total = $especies_obj->count();
        $especies = [];
        foreach ($especies_obj as $especie) {

            array_push($especies, ['id' => $especie->id, 'nombre'=> $this->especieDatos($especie, null, false)['nombre'],'autor'=>Autor::find($especie->autor_id)->nombre]);
        }

        return view('taxonomia.subespecies.mostrar', compact( 'usuario', 'subespecie', 'total', 'especies' ));

    }


    public function editar($id)
    {
        $subespecie = Subespecie::findOrFail($id);

        $subespecies = Subespecie::select('id', 'nombre')->get();

        $taxonomia = array('subespecie' => $subespecies);
        $taxonomia = json_encode($taxonomia);

        return view('taxonomia.subespecies.editar', compact( 'subespecie', 'taxonomia' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CrearSubespecieRequest $request
     * @param  int $id
     * @return Response
     */
    public function actualizar(CrearSubespecieRequest $request, $id)
    {        $usuario = Auth::user();


        $subespecie = Subespecie::find($id);

        //chequear si hay cambios en el nombre
        if($subespecie->nombre != $request->subespecie){

            $check = Subespecie::where('nombre', $request->subespecie)->first();//verficamos si no existe otra subespecie con ese nombre

            if($check != null){
                return redirect()->back()->withErrors('Ya existe una subespecie con este nombre')->withInput();
            }else{
                $ant =$subespecie->nombre;

                $subespecie->nombre = $request->subespecie;
                $subespecie->save();

                $this->LogEditar($usuario->usuario,'Subespecie',$ant,$subespecie->nombre ,'Editar nombre',$subespecie->id,'subespecie.mostrar');

            }
        }
        return redirect()->route('subespecie.mostrar', [$subespecie->id]);
    }


    public function eliminar($id)
    {
        $subespecie = Subespecie::find($id);
        $usuario = Auth::user();

        if($subespecie == null){
            $errores = [
                'error'    => ['La Subespecie no existe'],
            ];
            return response()->json($errores, 422);

        }else{

            if ($subespecie->delete()){
                $this->LogEliminar($usuario->usuario,'Subespecie',$subespecie->nombre,$subespecie->id);

                return;
            }else{
                $errores = [
                    'error'    => ['Disculpe, no se pudo eliminar la subespecie, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }
}