<?php

namespace App\Http\Controllers\Taxonomia;

use App\Ficoflora\Funcionalidades\NombresTrait;
use App\Modelos\Bibliografia\Referencias\Enlace;
use App\Modelos\Bibliografia\Referencias\Libro;
use App\Modelos\Bibliografia\Referencias\Revista;
use App\Modelos\Bibliografia\Referencias\Trabajo;
use App\Modelos\Catalogo\Registro;
use App\Modelos\Geografico\Entidad;
use App\Modelos\Geografico\Localidad;
use App\Modelos\Geografico\Lugar;
use App\Modelos\Geografico\Sitio;
use App\Modelos\Geografico\Ubicacion;
use App\Modelos\Sinonimias\Sinonimia;
use App\Modelos\Taxonomia\Autor;
use App\Modelos\Taxonomia\Clase;
use App\Modelos\Taxonomia\Epitetos\Especifico;
use App\Modelos\Taxonomia\Epitetos\Forma;
use App\Modelos\Taxonomia\Epitetos\Varietal;
use App\Modelos\Taxonomia\Especie;
use App\Modelos\Taxonomia\Familia;
use App\Modelos\Taxonomia\Genero;
use App\Modelos\Taxonomia\Orden;
use App\Modelos\Taxonomia\Phylum;
use App\Modelos\Taxonomia\Subclase;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EspeciesController extends Controller
{
    

    use NombresTrait;
    
    
    public function index($id)
    {

        $obj_especie = Especie::find($id);

//        dd($obj_especie);
        //Transformo los ids del elemento de la tabla especies en nombres
        $especie = $this->especieNombre($obj_especie, $id, true);

        //obtengo todos los registros asociados con la especie (relacion especie_id, referencia_id)
        $registros = Registro::where('especie_id', $especie['id'])->get();


        $citas_reportes = Array();
        $referencias = Array();
        $ubicaciones_ids = Array();

        foreach ($registros as $registro) {// id (registro), especie_id, referencia_id

            $obj_referencia = $this->getReferencia($registro->referencia_id, $registro->tipo_referencia);  //obtiene el obj referencia, de acuerdo al tipo
            array_push($referencias, ['referencia' => $obj_referencia, 'tipo' =>$registro->tipo_referencia]);//Guardamos en un arreglo todas las referencias de la especie


            //NIVEL A
            $cita_reporte['cita'] = $obj_referencia['cita'];
            $cita_reporte['fecha'] = $obj_referencia['fecha'];

            $reportes = Array();

            //Trae todas las filas de la tabla registro_ubicacion_sinonimia con el registro id del reporte
            $re_ub_si = DB::table('registro_ubicacion_sinonimia')->where('registro_id', $registro->id)->get();
            $col = collect($re_ub_si);


            //registro_ubicacion_sinonimia que pertenecen al reporte ordenados y agrupados por sinonimias
            $by_sinonimias = $col->sortBy('sinonimia_id')->groupBy('sinonimia_id');

            foreach ($by_sinonimias as $sinonimia_id =>$values_r_u_s) {//$values_r_u_s registro, ubicacion, sinonimia ids

                if($sinonimia_id != null){
                    //Nivel C-1
                    list($sinonimia['nombre'], $sinonimia['autor'])= $this->getSinonimia($sinonimia_id, null);
                }else{
                    $sinonimia=[];// no posee sinonimia
                }

                //NIVEL B
                $reporte['sinonimia'] = $sinonimia;

                $ubicaciones = Array();

                foreach ($values_r_u_s as $val) {

                    if($val->ubicacion_id != null) {//el registro posee ubicaciones

                        $ubicacion = Ubicacion::find($val->ubicacion_id);

                        $obj = [
                            'entidad' => $ubicacion['entidad_id'],
                            'localidad' => $ubicacion['localidad_id'],
                            'lugar' => $ubicacion['lugar_id'],
                            'sitio' => $ubicacion['sitio_id'],
                            'id' => $ubicacion['id']

                        ];
                        array_push($ubicaciones, $obj);
                        array_push($ubicaciones_ids, $ubicacion['id']);//Guardamos todos los ids de ubicaciones que se usan, para la funcionalidad de los mapas

                    }
                }

                $ubicacion_nombres = Array();

                //Ordenamos las ubicaciones por localidades
                $by_localidades = collect($ubicaciones)->groupBy('localidad');


                foreach ($by_localidades as $keyL=>$values_ubicacion) {

                    $ubicacion = Array();
                    $lugares = Array();

                    if($keyL != null){//Posee localidades

                        //Nivel C-2
                        $ubicacion['entidad'] =  Entidad::find($values_ubicacion[0]['entidad'])->nombre;
                        $ubicacion['localidad'] =  Localidad::find($keyL)->nombre;

                        //ordenamos las unicaciones por lugares
                        $by_lugares = collect($values_ubicacion->groupBy('lugar'));

                        foreach ($by_lugares as $keyLug => $valuesL) {

                            $lugar = Array();

                            if($keyLug != null) {//posee lugares

                                //Nivel D
                                $lugar['lugar'] = Lugar::find($keyLug)->nombre;
                                $sitios = Array();

                                foreach ($valuesL as $valueS) {
                                    if($valueS['sitio']!= null){//posee sitios
                                        //Nivel E
                                        $sitio['sitio'] = Sitio::find($valueS['sitio'])->nombre;
                                        $sitio['ubicacion_id'] = $valueS['id'];//id de la ubicacion
                                        array_push($sitios, $sitio);
                                    }else{
                                        //Nivel D
                                        $lugar['ubicacion_id'] = $valuesL[0]['id'];//id de la ubicacion
                                    }
                                }

                                //Nivel D
                                $lugar['sitios'] = $sitios;
                                array_push($lugares, $lugar);
                            }else{
                                //Nivel C-2
                                $ubicacion['ubicacion_id'] =  $valuesL[0]['id'];//id de la ubicacion

                            }
                        }

                        //Nivel C-2
                        $ubicacion['lugares']= $lugares;
                        array_push($ubicacion_nombres, $ubicacion);//Objeto con Entidad Localidad y [] de lugares y sitios

                    }else{

                        //Como se están agrupando por localidad todos los que solo tienen entidad quedan junto en
                        // el grupo de localidad null, por lo que hay que procesarlas a parte
                        foreach ($values_ubicacion as $val_ubi) {

                            $ubicacion['ubicacion_id'] =  $val_ubi['id'];//id de la ubicacion
                            $ubicacion['entidad'] =  Entidad::find($val_ubi['entidad'])->nombre;
                            $ubicacion['localidad'] = null;
                            $ubicacion['lugares']= [];
                            array_push($ubicacion_nombres, $ubicacion);//Objeto con Entidad Localidad y [] de lugares y sitios
                        }
                    }


                }


                //NIVEL B
                $reporte['ubicaciones'] = $ubicacion_nombres;
                array_push($reportes, $reporte);
            }

            //NIVEL A
            $cita_reporte['reportes'] = $reportes;
            array_push($citas_reportes, $cita_reporte);

        }

        $col_ref= collect($citas_reportes);
        $citas_reportes= $col_ref->sortByDesc('fecha');


        //Obtenemos las coordenadas de todas las ubicaciones que se tienen de la especie
        $coordenadas = null;
        if(!empty($ubicaciones_ids)){
            $valores = $this->getCoordenadas($ubicaciones_ids);
            $coordenadas = collect($valores);
        }

//        dd($coordenadas);
        //Listado de sinonimias de la especie
        if($obj_especie->sinonimias->all() != null){
            $sinonimias = $this->getSinonimias($obj_especie->sinonimias->all());
        }

        //Formato texto html a las referencias
        $referencias = $this->getReferenciaTexto($referencias);
        

        //para la sección de como citar la página
        $fecha = Carbon::now();
        
        return view('taxonomia.especies.ficha', compact('especie', 'citas_reportes', 'sinonimias', 'referencias', 'fecha', 'coordenadas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getReferencia($id, $tipo)
    {

        switch($tipo){
            case 'R':
                $cita = Revista::find($id);
                break;

            case 'T':
                $cita = Trabajo::find($id);
                break;

            case 'L':
                $cita = Libro::find($id);
                break;

            case 'E':
                $cita = Enlace::find($id);
                break;
        }

        return $cita;
    }


    public function getSinonimias($obj_sinonimias)
    {
        $sinonimias = array();
        
        foreach ($obj_sinonimias as $sinonimia) {
            list($nombre, $autor)= $this->getSinonimia(null, $sinonimia);
            array_push($sinonimias, ['nombre'=>$nombre, 'autor'=>$autor]);
        }
        return $sinonimias;
    }
    
    
    
    public function getSinonimia($id, $sinonimia)
    {
        if($sinonimia == null){
            $sinonimia = Sinonimia::find($id);
        }

//        dd($sinonimia);
        $genero = Genero::find($sinonimia['genero_id']);
        $especifico = Especifico::find($sinonimia['especifico_id']);

        $especie = $genero['nombre'].' '.$especifico['nombre'];

        if($sinonimia['varietal_id'] != null){
            $varietal= Varietal::find($sinonimia['varietal_id']);
            $especie = $especie.' var. '.$varietal['nombre'];
        }
        if($sinonimia['forma_id'] != null){
            $forma= Forma::find($sinonimia['forma_id']);
            $especie= $especie.' f. '.$forma['nombre'];
        }

        $autor = Autor::find($sinonimia['autor_id']);

        

        return [$especie, $autor['nombre']];

    }

    public function getReferenciaTexto($referencias)
    {
        $bibliografias = Array();
        foreach ($referencias as $referencia) {
//            dd($referencias);

            $bibliografia = $referencia['referencia'];//el objeto referencia

            switch($referencia['tipo']){
                case 'R':
                    $texto = $this->getRevistaTexto($bibliografia);
                    break;

                case 'T':
                    $texto = $this->getTrabajoTexto($bibliografia);
                    break;

                case 'L':
                    $texto = $this->getLibroTexto($bibliografia);
                    break;

                case 'E':
                    break;
            }
//            dd($bibliografia);
            array_push($bibliografias, [
                'cita'=>$bibliografia['autores'],
                'fecha'=>$bibliografia['fecha'],
                'referencia'=>$texto,
                'isbn'=>$bibliografia['isbn'],
                'issn'=>$bibliografia['issn'],
                'doi'=>$bibliografia['doi'],
                'enlace'=>$bibliografia['enlace'],
                'comentarios'=>$bibliografia['comentarios'],
            ]);
        }
        return $bibliografias;

    }


    public function getRevistaTexto($referecia)
    {

        $texto = $referecia->titulo.'. <b><em>'.$referecia->nombre.'</em> '.$referecia->volumen;

        if($referecia->numero != null){
            $texto = $texto.'('.$referecia->numero.')';
        }
        $texto = $texto.':'.$referecia->intervalo.'</b>.';

        return $texto;
    }

    public function getTrabajoTexto($referecia)
    {
        $texto = $referecia->titulo.'. <b><em>'.$referecia->tipo.'. '.$referecia->institucion.'. '.$referecia->lugar.'</em>, '.$referecia->paginas.'pp.</b>';
        return $texto;
    }

    public function getLibroTexto($referecia)
    {
        $texto = $referecia->titulo.'.';
        
        if($referecia->editor != null){
        
            $texto = $texto.' In: '.$referecia->editor.' (Ed.).';
            
            if($referecia->capitulo != null){
                $texto = $texto.' '.$referecia->capitulo.', pp. '.$referecia->intervalo;
            }
        }

        if($referecia->edicion != null){
            $texto = $texto.' <b>'.$referecia->edicion.' Ed.</b>';
        }

        if($referecia->editorial != null){
            $texto = $texto.' <b><em>'.$referecia->editorial.'</em>.</b>';
        }
        $texto = $texto.' <b><em>'.$referecia->lugar.'</em>. '.$referecia->paginas.'pp.</b>';

        return $texto;


    }





    public function getCoordenadas($ubicaciones)
    {
        $coordenadas = array();

        foreach ($ubicaciones as $id) {

            $ubicacion = Ubicacion::find($id);

            $nombre = null;
            if($ubicacion['sitio_id'] != null){
                $nombre = Sitio::find($ubicacion['sitio_id'])->nombre;
                $tipo = 'Sitio';

            }else{

                if($ubicacion['lugar_id'] != null) {
                    $nombre = Lugar::find($ubicacion['lugar_id'])->nombre;
                    $tipo = 'Lugar';

                }else{
                    if($ubicacion['localidad_id'] != null) {
                        $nombre = Localidad::find($ubicacion['localidad_id'])->nombre;
                        $tipo = 'Localidad';
                    }else{
                        $nombre =  Entidad::find($ubicacion['entidad_id'])->nombre;
                        $tipo = 'Entidad';

                    }
                }
            }

            $coordenadas[$id] = ['latitud' =>$ubicacion['latitud'], 'longitud'=>$ubicacion['longitud'], 'nombre'=>$nombre, 'tipo'=>$tipo];
        }

        return $coordenadas;
    }



    public function mapas()
    {
        $familias = Familia::lists('nombre', 'id');

        $id = 56;

        $tt[$id]=['lat' =>10.22, 'lon'=>-63.44];
//        dd($familias->toArray());
        $col = collect($tt);
//        dd($col);

        return view('mapas.mapas', compact('familias', 'col'));
    }
}
