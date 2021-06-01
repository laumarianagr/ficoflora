<?php

namespace App\Http\Controllers\Imagenes;

use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Http\Requests\Taxonomia\AgregarImagenRequest;
use App\Modelos\Imagenes\Imagen;
use App\Modelos\Taxonomia\Especie;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ImagenesController extends Controller
{

    use EspecieDatosTrait;

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function agregar(AgregarImagenRequest $request, $id)
    {

        $especie = Especie::find($id);
        $datos= $this->especieDatos($especie, null, false);
        $nombre = $this->especieNombreConSeparador($datos, '_');

//        $cant = Imagen::where('especie_id', $id)->count();
//        if($cant> 0){
//            $nombre=$nombre.'_'.($cant+1);
//        }

        $nombre=$nombre.'_'.Carbon::now()->format('d-m-Y-h-m-s');
//        dd($nombre, $request->tipo);

        $pequena = $request->file('pequena');
        $extension = $pequena->getClientOriginalExtension();
        $nombreArchivo = $nombre. '.' . $extension;
        $pequena->move('../../galeria', $nombreArchivo);

        $completa = $request->file('completa');
        $extension = $completa->getClientOriginalExtension();
        $nombreArchivo = $nombre. '_z.' . $extension;
        $completa->move('../../galeria', $nombreArchivo);

        //Si la nueva imagen a agregar es principal, se revisa si ya existe una img principal para cambiarla a tipo galeria
        if($request->tipo == 'h'){
            $principal = Imagen::where('especie_id',$id)->conTipo('h')->first();
            
            if($principal != null){
                $principal->tipo='g';
                $principal->save();
            }
        }
        
        $img= Imagen::create(['imagen'=>$nombre, 'especie_id'=>$id, 'tipo'=>$request->tipo,'leyenda'=>$request->leyenda]);
        return redirect()->back()->with('exito', "Imagen agregada correctamente");
    }



    public function eliminar($id)
    {
        $imagen = Imagen::find($id);

        if($imagen == null){
            $errores = [
                'error'    => ['La imagen no existe'],
            ];
            return response()->json($errores, 422);

        }else{

            if ($imagen->delete()){

                if(File::exists('../../galeria/'. $imagen->imagen.'.jpg')){
                    File::delete('../../galeria/'. $imagen->imagen.'.jpg');
                    File::delete('../../galeria/'. $imagen->imagen.'_z.jpg');
                }
                return;
            }else{
                $errores = [
                    'error'    => ['Disculpe, no se pudo eliminar la imagen, intente de nuevo'],
                ];
                return response()->json($errores, 422);
            }
        }
    }
}
