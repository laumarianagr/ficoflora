<?php

namespace App\Http\Controllers\RegistrosVenezuela\Taxonomia\Epitetos;

use App\Ficoflora\Funcionalidades\Logs\LogsTrait;
use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Http\Requests\Taxonomia\CrearVarietalRequest;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Epitetos\Varietal;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VarietalesController extends Controller
{

    use EspecieDatosTrait;
    use LogsTrait;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor', ['except'=>['mostrar']]);
        $this->middleware('creador.varietales', ['only'=>['editar', 'eliminar', 'actualizar']]);
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
        $varietal = Varietal::select('id', 'nombre')->get();

        $taxonomia = array('varietal' => $varietal);
        $taxonomia = json_encode($taxonomia);


        return view('taxonomia.varietales.crear', compact('taxonomia'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function guardar(CrearVarietalRequest $request)
    {
        //validar que esta

        $usuario = Auth::user();

        $varietal = Varietal::where('nombre', $request->varietal)->exists();

        if($varietal == true){
            if($request->ajax()) {

                $errores = [
                    'error' => ['El epíteto varietal ya existe'],
                ];
                return response()->json($errores, 422);
            }
            return redirect()->back()->withErrors('El epíteto ya existe')->withInput();

        }

        $varietal = Varietal::create(['nombre' => $request->varietal, 'creador_id' => $usuario->id]);
        $this->LogCrear($usuario->usuario,'Epíteto varietla',$varietal->nombre,$varietal->id,'varietal.mostrar');

        if($request->ajax()) {
            return $varietal;
        }

        return redirect()->route('varietal.mostrar', [$varietal->id]);

    }



    public function mostrar($id)
    {
        $usuario = Auth::user();
        $varietal = Varietal::find($id);

        $especies_obj = $varietal->especies()->get();

        $total = $especies_obj->count();
        $especies = [];
        foreach ($especies_obj as $especie) {

            array_push($especies, ['id' => $especie->id, 'nombre'=> $this->especieDatos($especie, null, false)['nombre'],'autor'=>Autor::find($especie->autor_id)->nombre]);
        }

        return view('taxonomia.varietales.mostrar', compact( 'usuario', 'varietal', 'total', 'especies' ));

    }


    public function editar($id)
    {
        $varietal = Varietal::findOrFail($id);

        $varietales = Varietal::select('id', 'nombre')->get();

        $taxonomia = array('varietal' => $varietales);
        $taxonomia = json_encode($taxonomia);

        return view('taxonomia.varietales.editar', compact( 'varietal', 'taxonomia' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CrearVarietalRequest $request
     * @param  int $id
     * @return Response
     */
    public function actualizar(CrearVarietalRequest $request, $id)
    {        $usuario = Auth::user();


        $varietal = Varietal::find($id);

        //chequear si hay cambios en el nombre
        if($varietal->nombre != $request->varietal){

            $check = Varietal::where('nombre', $request->varietal)->first();//verficamos si no existe otro género con ese nombre

            if($check != null){
                return redirect()->back()->withErrors('Ya existe un epíteto varietal con este nombre')->withInput();
            }else{
                $ant =$varietal->nombre;

                $varietal->nombre = $request->varietal;
                $varietal->save();

                $this->LogEditar($usuario->usuario,'Epíteto varietal',$ant,$varietal->nombre ,'Editar nombre',$varietal->id,'varietal.mostrar');

            }
        }


        return redirect()->route('varietal.mostrar', [$varietal->id]);
    }




    public function eliminar($id)
    {
        $varietal = Varietal::find($id);
        $usuario = Auth::user();

        if($varietal == null){
            $errores = [
                'error'    => ['El Epíteto no existe'],
            ];
            return response()->json($errores, 422);

        }else{

            if ($varietal->delete()){
                $this->LogEliminar($usuario->usuario,'Epíteto varietal',$varietal->nombre,$varietal->id);

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
