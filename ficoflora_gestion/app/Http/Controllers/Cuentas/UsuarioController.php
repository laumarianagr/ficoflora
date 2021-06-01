<?php

namespace App\Http\Controllers\Cuentas;

use App\Ficoflora\Funcionalidades\Nombres\EspecieDatosTrait;
use App\Modelos\Catalogo\Registro;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Epitetos\Especifico;
use App\Modelos\Taxonomia\Epitetos\Varietal;
use App\Modelos\Taxonomia\Epitetos\Forma;
use App\Modelos\Taxonomia\Epitetos\Subespecie;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    use EspecieDatosTrait;


    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('equipo.editor');
//        $this->middleware('creador.especie', ['only'=>['editar', 'eliminar', 'actualizar']]);
    }


    public function registros()
    {
        $usuario = Auth::user();

        return view('registros.mis-registros.index', compact( 'usuario'));
    }

    public function especies()
    {
        $usuario = Auth::user();

//        $especies = Especie::where('creador_id', $usuario->id)->get();

        $especies = DB::table('especies')
            ->where('especies.creador_id', $usuario->id)
            ->join('epitetos_especificos', 'especies.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'especies.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'especies.forma_id', '=', 'epitetos_formas.id')
            ->leftJoin('epitetos_subespecies', 'especies.subespecie_id', '=', 'epitetos_subespecies.id')
            ->join('generos', 'especies.genero_id', '=', 'generos.id')
            ->join('autores', 'especies.autor_id', '=', 'autores.id')
            ->select(DB::raw('especies.id, especies.catalogo, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, epitetos_subespecies.nombre as subespecie, generos.nombre as genero, autores.nombre as autor'))
            ->orderBy('genero')->orderBy('especifico')->orderBy('varietal')->orderBy('forma')->orderBy('subespecie')
            ->get();

        $total = count($especies);

        return view('registros.mis-registros.taxonomia.especies-usuario', compact('especies', 'usuario', 'especies', 'total'));
    }

    public function autores()
    {
        $usuario = Auth::user();

        $autores = Autor::where('creador_id', $usuario->id)->get();


        $total = count($autores);

        return view('registros.mis-registros.taxonomia.autores-usuario', compact('autores', 'usuario', 'total'));

    }
    public function especificos()
    {
        $usuario = Auth::user();

        $especificos = Especifico::where('creador_id', $usuario->id)->get();

        $total = count($especificos);


        return view('registros.mis-registros.taxonomia.especificos-usuario', compact('especificos', 'usuario','total'));

    }
    public function varietales()
    {
        $usuario = Auth::user();

        $varietales = Varietal::where('creador_id', $usuario->id)->get();

        $total = count($varietales);

        return view('registros.mis-registros.taxonomia.varietales-usuario', compact('varietales', 'usuario', 'total'));

    }
    public function formas()
    {
        $usuario = Auth::user();

        $formas = Forma::where('creador_id', $usuario->id)->get();

        $total = count($formas);

        return view('registros.mis-registros.taxonomia.formas-usuario', compact('formas', 'usuario', 'total'));

    }
    public function subespecies()
    {
        $usuario = Auth::user();

        $subespecies = Subespecie::where('creador_id', $usuario->id)->get();

        $total = count($subespecies);

        return view('registros.mis-registros.taxonomia.subespecies-usuario', compact('subespecies', 'usuario', 'total'));
    }

    public function generos()
    {
        $usuario = Auth::user();

        $generos = DB::table('generos')
            ->where('generos.creador_id', $usuario->id)
            ->orderBy('nombre')
            ->get();
        $total = count($generos);

        return view('registros.mis-registros.taxonomia.generos-usuario', compact('generos', 'usuario', 'total'));
    }


    //FAMILIAS del usuario
    public function familias()
    {
        $usuario = Auth::user();

        $familias = DB::table('familias')
            ->where('familias.creador_id', $usuario->id)
            ->orderBy('nombre')
            ->get();

        $total = count($familias);

        return view('registros.mis-registros.taxonomia.familias-usuario', compact('familias', 'usuario', 'total'));
    }


    //FAMILIAS del usuario
    public function ordenes()
    {
        $usuario = Auth::user();

        $ordenes = DB::table('ordenes')
            ->where('ordenes.creador_id', $usuario->id)
            ->orderBy('nombre')
            ->get();

        $total = count($ordenes);

        return view('registros.mis-registros.taxonomia.ordenes-usuario', compact('ordenes', 'usuario', 'total'));
    }


    //SUBCLASES del usuario
    public function subclases()
    {
        $usuario = Auth::user();

        $subclases = DB::table('subclases')
            ->where('subclases.creador_id', $usuario->id)
            ->orderBy('nombre')
            ->get();

           $total = count($subclases);

        return view('registros.mis-registros.taxonomia.subclases-usuario', compact('subclases', 'usuario', 'total'));
    }

    //CLASES del usuario
    public function clases()
    {
        $usuario = Auth::user();

        $clases = DB::table('clases')
            ->where('clases.creador_id', $usuario->id)
            ->orderBy('nombre')
            ->get();

//        dd($clases);
        $usuario =Auth::user();
        $total = count($clases);

        return view('registros.mis-registros.taxonomia.clases-usuario', compact('clases', 'usuario', 'total'));
    }

    //PHYLUMS del usuario
    public function phylums()
    {
        $usuario = Auth::user();

        $phylums = DB::table('phylums')
            ->where('phylums.creador_id', $usuario->id)
            ->orderBy('nombre')
            ->get();

        $total = count($phylums);

        return view('registros.mis-registros.taxonomia.phylums-usuario', compact('phylums', 'usuario', 'total'));
    }

    public function sinonimias()
    {
        $usuario = Auth::user();

//        $especies = Especie::where('creador_id', $usuario->id)->get();

        $especies = DB::table('sinonimias')
            ->where('sinonimias.creador_id', $usuario->id)
            ->join('epitetos_especificos', 'sinonimias.especifico_id', '=', 'epitetos_especificos.id')
            ->leftJoin('epitetos_varietales', 'sinonimias.varietal_id', '=', 'epitetos_varietales.id')
            ->leftJoin('epitetos_formas', 'sinonimias.forma_id', '=', 'epitetos_formas.id')
            ->leftJoin('epitetos_subespecies', 'sinonimias.subespecie_id', '=', 'epitetos_subespecie.id')
            ->join('generos', 'sinonimias.genero_id', '=', 'generos.id')
            ->join('autores', 'sinonimias.autor_id', '=', 'autores.id')
            ->select(DB::raw('sinonimias.id, epitetos_especificos.nombre as especifico, epitetos_varietales.nombre as varietal, epitetos_formas.nombre as forma, epitetos_subespecies.nombre as subespecie, generos.nombre as genero, autores.nombre as autor'))
            ->orderBy('genero')->orderBy('especifico')->orderBy('varietal')->orderBy('forma')->orderBy('subespecie')
            ->get();

        $total = count($especies);

        return view('registros.mis-registros.taxonomia.sinonimias-usuario', compact('especies', 'usuario', 'total'));
    }


    public function revistas()
    {
        $usuario = Auth::user();

        $revistas = DB::table('referencias_revistas')
            ->where('referencias_revistas.creador_id', $usuario->id)
            ->select(DB::raw('id, autores, cita, fecha, letra, titulo'))
            ->orderBy('cita')
            ->get();

//        dd($revistas);
        $total = count($revistas);

        return view('registros.mis-registros.bibliografico.revistas-usuario', compact('revistas', 'usuario', 'total'));
    }

    public function libros()
    {
        $usuario = Auth::user();

        $libros = DB::table('referencias_libros')
            ->where('referencias_libros.creador_id', $usuario->id)
            ->select(DB::raw('id, autores, cita, fecha, letra, titulo'))
            ->orderBy('cita')
            ->get();

//        dd($libros);
        $total = count($libros);

        return view('registros.mis-registros.bibliografico.libros-usuario', compact('libros', 'usuario', 'total'));
    }

    public function catalogos()
    {
        $usuario = Auth::user();

        $catalogos = DB::table('referencias_catalogos')
            ->where('referencias_catalogos.creador_id', $usuario->id)
            ->select(DB::raw('id, autores, cita, fecha, letra, titulo'))
            ->orderBy('cita')
            ->get();

//        dd($libros);
        $total = count($catalogos);

        return view('registros.mis-registros.bibliografico.catalogos-usuario', compact('catalogos', 'usuario', 'total'));
    }

    public function trabajos()
    {
        $usuario = Auth::user();

        $trabajos = DB::table('referencias_trabajos')
            ->where('referencias_trabajos.creador_id', $usuario->id)
            ->select(DB::raw('id, autores, cita, fecha, letra, titulo'))
            ->orderBy('cita')
            ->get();

//        dd($trabajos);
        $total = count($trabajos);

        return view('registros.mis-registros.bibliografico.trabajos-usuario', compact('trabajos', 'usuario', 'total'));
    }

    public function enlaces()
    {
        $usuario = Auth::user();

        $enlaces = DB::table('referencias_enlaces')
            ->where('referencias_enlaces.creador_id', $usuario->id)
            ->select(DB::raw('id, autores, cita, fecha, letra, enlace'))
            ->orderBy('cita')
            ->get();

//        dd($enlaces);
        $total = count($enlaces);

        return view('registros.mis-registros.bibliografico.enlaces-usuario', compact('enlaces', 'usuario', 'total'));
    }


    public function entidades()
    {
        $usuario = Auth::user();

        $entidades = DB::table('entidades')
            ->where('entidades.creador_id', $usuario->id)
            ->orderBy('nombre')
            ->get();

        $total = count($entidades);
//        dd($entidades);

        return view('registros.mis-registros.geograficos.entidades-usuario', compact('entidades', 'usuario', 'total'));
    }

    public function localidades()
    {
        $usuario = Auth::user();

        $localidades = DB::table('localidades')
            ->where('localidades.creador_id', $usuario->id)
            ->leftJoin('entidades', 'localidades.entidad_id', '=', 'entidades.id')
            ->select(DB::raw('localidades.id, localidades.nombre, entidades.nombre as entidad'))
            ->orderBy('nombre')
            ->get();
        $total = count($localidades);

//        dd($localidades);

        return view('registros.mis-registros.geograficos.localidades-usuario', compact('localidades', 'usuario', 'total'));
    }


    public function lugares()
    {
        $usuario = Auth::user();

        $lugares = DB::table('lugares')
            ->where('lugares.creador_id', $usuario->id)
            ->leftJoin('localidades', 'lugares.localidad_id', '=', 'localidades.id')
            ->select(DB::raw('lugares.id, lugares.nombre, localidades.nombre as localidad'))
            ->orderBy('nombre')
            ->get();
        $total = count($lugares);

//        dd($lugares);

        return view('registros.mis-registros.geograficos.lugares-usuario', compact('lugares', 'usuario', 'total'));
    }


    public function sitios()
    {
        $usuario = Auth::user();

        $sitios = DB::table('sitios')
            ->where('sitios.creador_id', $usuario->id)
            ->leftJoin('lugares', 'sitios.lugar_id', '=', 'lugares.id')
            ->select(DB::raw('sitios.id, sitios.nombre, lugares.nombre as lugar'))
            ->orderBy('nombre')
            ->get();
        $total = count($sitios);

//        dd($sitios);

        return view('registros.mis-registros.geograficos.sitios-usuario', compact('sitios', 'total'));
    }


    public function ubicaciones()
    {

        $ubicaciones = DB::table('ubicaciones')
//            ->where('ubicaciones.creador_id', $usuario->id)
            ->join('entidades', 'ubicaciones.entidad_id', '=', 'entidades.id')
            ->leftJoin('localidades', 'ubicaciones.localidad_id', '=', 'localidades.id')
            ->leftJoin('lugares', 'ubicaciones.lugar_id', '=', 'lugares.id')
            ->leftJoin('sitios', 'ubicaciones.sitio_id', '=', 'sitios.id')
            ->select(DB::raw('ubicaciones.id, entidades.nombre as entidad, localidades.nombre as localidad, lugares.nombre as lugar, sitios.nombre as sitio'))
            ->orderBy('entidad')->orderBy('localidad')->orderBy('lugar')->orderBy('sitio')
            ->get();

//        dd($ubicaciones);

        return view('registros.mis-registros.geograficos.ubicaciones-usuario', compact('ubicaciones'));
    }

    public function reportes()
    {
        $usuario = Auth::user();

        $reportes_ids = Registro::where('creador_id', $usuario->id)->get();

        $revistas = DB::table('registros')
            ->where('registros.creador_id', $usuario->id)
            ->where('registros.tipo_referencia', 'R')
            ->leftJoin('referencias_revistas', 'registros.referencia_id', '=', 'referencias_revistas.id')
            ->groupBy('registros.referencia_id')
            ->select(DB::raw('referencias_revistas.id, referencias_revistas.cita,  referencias_revistas.fecha, referencias_revistas.letra'))
            ->get();

            $revistas = collect($revistas);

        $libros = DB::table('registros')
            ->where('registros.creador_id', $usuario->id)
            ->where('registros.tipo_referencia', 'L')
            ->leftJoin('referencias_libros', 'registros.referencia_id', '=', 'referencias_libros.id')
            ->groupBy('registros.referencia_id')
            ->select(DB::raw('referencias_libros.id, referencias_libros.cita,  referencias_libros.fecha, referencias_libros.letra'))
            ->get();

            $libros = collect($libros);


        $catalogos = DB::table('registros')
            ->where('registros.creador_id', $usuario->id)
            ->where('registros.tipo_referencia', 'C')
            ->leftJoin('referencias_catalogos', 'registros.referencia_id', '=', 'referencias_catalogos.id')
            ->groupBy('registros.referencia_id')
            ->select(DB::raw('referencias_catalogos.id, referencias_catalogos.cita, referencias_catalogos.fecha, referencias_catalogos.letra'))
            ->get();

            $catalogos = collect($catalogos);


        $trabajos = DB::table('registros')
            ->where('registros.creador_id', $usuario->id)
            ->where('registros.tipo_referencia', 'T')
            ->leftJoin('referencias_trabajos', 'registros.referencia_id', '=', 'referencias_trabajos.id')
            ->groupBy('registros.referencia_id')
            ->select(DB::raw('referencias_trabajos.id, referencias_trabajos.cita, referencias_trabajos.fecha, referencias_trabajos.letra'))
            ->get();

            $trabajos = collect($trabajos);

        $enlaces = DB::table('registros')
            ->where('registros.creador_id', $usuario->id)
            ->where('registros.tipo_referencia', 'E')
            ->leftJoin('referencias_enlaces', 'registros.referencia_id', '=', 'referencias_enlaces.id')
            ->groupBy('registros.referencia_id')
            ->select(DB::raw('referencias_enlaces.id, referencias_enlaces.cita, referencias_enlaces.fecha, referencias_enlaces.letra'))
            ->get();

        $enlaces = collect($enlaces);


        $especies_id = DB::table('registros')
            ->where('registros.creador_id', $usuario->id)
            ->groupBy('registros.especie_id')
            ->select(DB::raw('registros.especie_id as id'))
            ->get();


        $especies = collect();

        foreach ($especies_id as $especie) {
            $datos = $this->especieDatos(null, $especie->id, false);
            $especies->push($datos);
        }

//        dd($especies->where('id', 1)->first()['nombre']);

        $reportes = collect();

        foreach ($reportes_ids as $reporte) {

            $especie = $especies->where('id', $reporte->especie_id)->first();

            switch($reporte->tipo_referencia){

                case 'R':
                    $referencia = $revistas->where('id', $reporte->referencia_id)->first();
                    $tipo = 'Revista';
                    break;

                case 'L':
                    $referencia = $libros->where('id', $reporte->referencia_id)->first();
                    $tipo = 'Libro';
                    break;

                case 'C':
                    $referencia = $catalogos->where('id', $reporte->referencia_id)->first();
                    $tipo = 'Catalogo';
                    break;

                case 'T':
                    $referencia = $trabajos->where('id', $reporte->referencia_id)->first();
                    $tipo = 'Trabajo A.';
                    break;

                case 'E':
                    $referencia = $enlaces->where('id', $reporte->referencia_id)->first();
                    $tipo = 'Sitios Web';
                    break;
            }

            $datos = ['especie' => $especie['nombre'], 'autor' =>$especie['autor'], 'cita' => $referencia->cita.', '.$referencia->fecha.$referencia->letra, 'fecha'=>$referencia->fecha,  'tipo' =>$tipo, 'id'=>$reporte->id];
            $reportes->push($datos);
        }
        $total = count($reportes);

        return view('registros.mis-registros.catalogo.reportes-usuario', compact('reportes', 'total'));
    }
}