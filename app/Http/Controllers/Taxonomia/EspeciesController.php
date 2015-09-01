<?php

namespace App\Http\Controllers\Taxonomia;

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
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EspeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        $mi_especie = Especie::find($id);

        $especifico = Especifico::find($mi_especie->especifico_id);
        if($mi_especie->varietal_id != null){
            $varietal = Varietal::find($mi_especie->varietal_id);
            $varietal = $varietal->nombre;
        }else{
            $varietal = null;
        }
        if($mi_especie->forma_id != null){
            $forma = Forma::find($mi_especie->forma_id);
            $forma = $forma->nombre;
        }else{
            $forma = null;
        }
        $genero = Genero::find($mi_especie->genero_id);
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

        $autor = Autor::find($mi_especie->autor_id);

        $especie = ['id'=> $mi_especie->id,'phylum' => $phylum->nombre, 'clase' => $clase->nombre, 'subclase' => $subclase, 'orden' => $orden->nombre, 'familia' => $familia->nombre, 'genero' => $genero->nombre,'especifico' => $especifico->nombre, 'varietal'=> $varietal, 'forma' => $forma, 'autor' => $autor->nombre];

        $registros = Registro::where('especie_id', $mi_especie->id)->get();

//        dd($registros);



        $referencias = Array();
        $bibliografias = Array();

        foreach ($registros as $registro) {//6,7

            $biblio = $this->getCita($registro->referencia_id, $registro->tipo_referencia);

            $referencia['cita'] = $biblio['cita'];
            $referencia['fecha'] = $biblio['fecha'];

            array_push($bibliografias, ['referencia' => $biblio, 'tipo' =>$registro->tipo_referencia]);


            $reportes = Array();

            $re_ub_si = DB::table('registro_ubicacion_sinonimia')
                ->where('registro_id', $registro->id)
                ->get();

            $col = collect($re_ub_si);

            //registro_ubicacion_sinonimia que pertenecen al reporte ordenados por sinonimias
            $by_sinonimias = $col->sortBy('sinonimia_id')->groupBy('sinonimia_id');


            foreach ($by_sinonimias as $key =>$values) {

                if($key != null){
                    list($nombre, $autor)= $this->getSinonimia($key, null);
                    $sinonimia['nombre']=$nombre;
                    $sinonimia['autor'] = $autor;
                }else{
                    $sinonimia=[];
                }

                $reporte['sinonimia'] = $sinonimia;
//                dd($reporte);
                $ubicaciones = Array();


                foreach ($values as $val) {

                    if($val->ubicacion_id != null) {

                        $ubicacion = Ubicacion::find($val->ubicacion_id);

                        $obj = [
                            'entidad' => $ubicacion['entidad_id'],
                            'localidad' => $ubicacion['localidad_id'],
                            'lugar' => $ubicacion['lugar_id'],
                            'sitio' => $ubicacion['sitio_id']
                        ];
                        array_push($ubicaciones, $obj);

                    }
                }

                $ubicacion_nombres = Array();

                $by_localidades = collect($ubicaciones)->groupBy('localidad');


                foreach ($by_localidades as $keyL=>$valuesE) {

                    $ubicacion = Array();

                    $lugares = Array();

                    if($keyL != null){

                        $ubicacion['entidad'] =  Entidad::find($valuesE[0]['entidad'])->nombre;
                        $ubicacion['localidad'] =  Localidad::find($keyL)->nombre;


                        $by_lugares = collect($valuesE->groupBy('lugar'));

                        foreach ($by_lugares as $keyLug => $valuesL) {

                            $lugar = Array();

                            if($keyLug != null) {

                                $sitios = Array();

                                $lugar['lugar'] = Lugar::find($keyLug)->nombre;
//                                dd($valuesE);
                                foreach ($valuesL as $valueS) {

                                    if($valueS['sitio']!= null){
                                        $sitio = Sitio::find($valueS['sitio'])->nombre;
                                        array_push($sitios, $sitio);
                                    }
                                }


                                $lugar['sitios'] = $sitios;


                                array_push($lugares, $lugar);
                            }
                        }


                        $ubicacion['lugares']= $lugares;
                        array_push($ubicacion_nombres, $ubicacion);//Objeto con Entidad Localidad y [] de lugares y sitios

                    }else{

                        //Como se están agrupando por localidad todos los que solo tienen entidad quedan junto en
                        // el grupo de localidad null, por lo que hay que procesarlas a parte
                        foreach ($valuesE as $entidad) {
                            $ubicacion['entidad'] =  Entidad::find($entidad['entidad'])->nombre;
                            $ubicacion['localidad'] = null;
                            $ubicacion['lugares']= [];
                            array_push($ubicacion_nombres, $ubicacion);//Objeto con Entidad Localidad y [] de lugares y sitios
                        }
                    }


                }


                $reporte['ubicaciones'] = $ubicacion_nombres;
//                $reporte['ubicaciones'] = $ubicaciones;

                array_push($reportes, $reporte);
            }


//            dd($by_sinonimias);

            $referencia['reportes'] = $reportes;
            array_push($referencias, $referencia);

        }

//        dd($referencias);
        $col_ref= collect($referencias);
        $referencias= $col_ref->sortByDesc('fecha');

//                dd($referencias);



        $sinonimias_especie = $mi_especie->sinonimias->all();
//        dd($sinonimias_especie);

        $sinonimias = Array();

        if($sinonimias_especie != null) {

            foreach ($sinonimias_especie as $sinonimia) {

                list($nombre, $autor)= $this->getSinonimia(null, $sinonimia);

                array_push($sinonimias, ['nombre'=>$nombre, 'autor'=>$autor]);
            }
        }

//        dd($referencias);

        $bibliografias = $this->getReferenciaTexto($bibliografias);

//        dd($sinonimias);
//        dd($bibliografias);

        return view('taxonomia.especies.ficha', compact('mi_especie','especie', 'referencias', 'sinonimias', 'bibliografias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCita($id, $tipo)
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
            $especie = ' var.'.$varietal['nombre'];
        }
        if($sinonimia['forma_id'] != null){
            $forma= Forma::find($sinonimia['forma_id']);
            $especie= ' f. '.$forma['nombre'];
        }

        $autor = Autor::find($sinonimia['autor_id']);

        

        return [$especie, $autor['nombre']];

    }

    public function getReferenciaTexto($referencias)
    {
        $bibliografias = Array();

        foreach ($referencias as $referencia) {


            $bibliografia = $referencia['referencia'];//el objeto referencia

            switch($referencia['tipo']){
                case 'R':

                    $texto = $this->getRevistaTexto($bibliografia);
                    break;

                case 'T':
                    break;

                case 'L':
                    break;

                case 'E':
                    break;
            }
            array_push($bibliografias, [
                'cita'=>$bibliografia['cita'],
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

        $texto = '<b>'.$referecia->autores.'</b>. '.$referecia->fecha.'. '.$referecia->titulo.'. <b><em>'.$referecia->nombre.'</em> '.$referecia->volumen;

        if($referecia->numero != null){
            $texto = $texto.'('.$referecia->numero.')';
        }
        $texto = $texto.':'.$referecia->intervalo.'</b>.';

        return $texto;
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
