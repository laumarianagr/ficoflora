<?php

namespace App\Http\Controllers\RegistrosVenezuela\Taxonomia\Epitetos;

use App\Ficoflora\Funcionalidades\Logs\LogsTrait;
use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Http\Requests\Taxonomia\CrearEspecificoRequest;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Epitetos\Especifico;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EspecificosController extends Controller
{
    use EspecieDatosTrait;
    use LogsTrait;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.especificos', ['only'=>['editar', 'eliminar', 'actualizar']]);
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
        $especifico = Especifico::select('id', 'nombre')->get();

        $taxonomia = array('especifico' => $especifico);
        $taxonomia = json_encode($taxonomia);


        return view('taxonomia.especificos.crear', compact('taxonomia'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function guardar(CrearEspecificoRequest $request)
    {
        //validar que esté el campo
        
        $usuario = Auth::user();

        $especifico = Especifico::where('nombre', $request->especifico)->exists();

        if($especifico == true){

            if($request->ajax()) {
                $errores = [
                    'error'    => ['El epíteto específico ya existe'],
                ];
                return response()->json($errores, 422);
            }
            return redirect()->back()->withErrors('El epíteto ya existe')->withInput();

        }

        $especifico = Especifico::create(['nombre' => $request->especifico, 'creador_id' => $usuario->id]);

        $this->LogCrear($usuario->usuario,'Epíteto específico',$especifico->nombre,$especifico->id,'especifico.mostrar');

        if($request->ajax()) {
            return $especifico;
        }

        return redirect()->route('especifico.mostrar', [$especifico->id]);

    }

    public function mostrar($id)
    {
        $usuario = Auth::user();
        $especifico = Especifico::find($id);

        $especies_obj = $especifico->especies()->get();

        $total = $especies_obj->count();
        $especies = [];
        foreach ($especies_obj as $especie) {

            array_push($especies, ['id' => $especie->id, 'nombre'=> $this->especieDatos($especie, null, false)['nombre'],'autor'=>Autor::find($especie->autor_id)->nombre]);
        }

        return view('taxonomia.especificos.mostrar', compact( 'usuario', 'especifico', 'total', 'especies' ));

    }

    public function editar($id)
    {
        $especifico = Especifico::findOrFail($id);

        $especificos = Especifico::select('id', 'nombre')->get();

        $taxonomia = array('especifico' => $especificos);
        $taxonomia = json_encode($taxonomia);

        return view('taxonomia.especificos.editar', compact( 'especifico', 'taxonomia' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CrearEspecificoRequest $request
     * @param  int $id
     * @return Response
     */
    public function actualizar(CrearEspecificoRequest $request, $id)
    {
        $usuario = Auth::user();

        $especifico = Especifico::find($id);
        //chequear si hay cambios en el nombre



        if($especifico->nombre != $request->especifico){
            $check = Especifico::where('nombre', $request->especifico)->first();//verficamos si no existe otro género con ese nombre
            if($check != null){
                return redirect()->back()->withErrors('Ya existe un epíteto específico con este nombre')->withInput();
            }else{
                $ant =$especifico->nombre;
                $especifico->nombre = $request->especifico;
                $especifico->save();
                $this->LogEditar($usuario->usuario,'Epíteto específico',$ant,$especifico->nombre ,'Editar nombre',$especifico->id,'especifico.mostrar');

            }
        }


        return redirect()->route('especifico.mostrar', [$especifico->id]);
    }




    public function eliminar($id)
    {
        $especifico = Especifico::find($id);
        $usuario = Auth::user();

        if($especifico == null){
            $errores = [
                'error'    => ['El Epíteto no existe'],
            ];
            return response()->json($errores, 422);

        }else{

            if ($especifico->delete()){
                $this->LogEliminar($usuario->usuario,'Epíteto específico',$especifico->nombre,$especifico->id);

                return;
            }else{
                $errores = [
                    'error'    => ['Disculpe, no se pudo eliminar el epíteto, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }
}
