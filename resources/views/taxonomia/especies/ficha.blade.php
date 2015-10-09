@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <meta http-equiv="Content-Type" content="application/pdf; charset=utf-8">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet/leaflet.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins\DataTables-1.10.7\css\dataTables.bootstrap.css')}}">

    <style>
        #map { height:400px; }

    </style>
@stop

@section('especie-mapa')
    <em>{{$especie['nombre']}}</em> {{$especie['autor']}}
@stop

@section('content')


 <div class="row">
     <div class="col-md-3  hidden-xs hidden-sm col col-xlg-2 col-xlg-offset-1">

         <section class="panel">
             <div class="panel-body">
                 <div class="thumb-info mb-md">
                     <img src="{{ asset('img/sin-imagen.png')}}" class="rounded img-responsive" alt="John Doe">

                 </div>


                 <ul class="opciones">
                     <li><a id="modal-vzla" href="#modal-mapa" class=" modal-basic modal-with-zoom-anim"><i class="fa fa-map-marker"></i>Ubicación en Venezuela </a></li>
                     @if(false)
                     <li><a><i class="fa fa-picture-o"></i>Galería </a></li>
                     @endif
                     <li><a href="{{route('pdf.especie', [$especie['id']])}}"><i class="fa fa-file-pdf-o"></i>Exportar ficha </a></li>
                     <li><a href="{{route('genero.especies', [$especie['genero_id']])}}"><i class="fa fa-list-ul"></i>Especies del género </a></li>
                 </ul>

                 <hr class="dotted short">
                 <ul class="opciones">
                     <li><a  href="{{route('buscar.index')}}"><i class="fa fa-search"></i>Nueva Búsqueda</a></li>
                 </ul>

                 <hr class="dotted short">

                 @if(!empty($sinonimias))

                     <section class="panel mb-sm">
                         <div class="bg-dark p-sm ">
                             <h5 class="m-none">Sinonimias</h5>
                         </div>
                     </section>

                     <ul class="pl-lg">
                         @foreach($sinonimias as $sinonimia)
                             <li class="text-dark"><a class="text-dark" href="{{route('sinonimia.index',[$sinonimia['id']])}}">{{$sinonimia['nombre']}}</a></li>
                         @endforeach
                     </ul>
                     <hr class="dotted short">

                 @endif


             </div>
         </section>

     </div>
     <div class="col-sm-12 col-md-9 col-xlg-8">

         <div class="row">
             <div class="col-xs-12 col-md-12 ">
                 <section class="panel panel-featured-bottom panel-featured-primary">
                     <div class="panel-body">
                         <div class="widget-summary">

                             <div class="widget-summary-col">

                                 <div class="hidden-xs hidden-sm pdf-img">
                                     <a href="{{route('pdf.especie', [$especie['id']])}}">
                                         <img src="{{ asset('img/pdf.png')}}" class="" alt="Exportar">
                                     </a>
                                 </div>

                                 <div class="summary mb-sm">
                                     <div class="info">
                                         <strong class="amount"><em>{{$especie['genero']}} {{$especie['especifico']}}</em></strong>

                                         <strong class="amount">
                                             @if($especie['varietal'] != null)
                                                 <em>var. {{$especie['varietal']}}</em>
                                             @endif
                                         </strong>

                                         <strong class="amount">
                                             @if($especie['forma'] != null)
                                                 <em> f. {{$especie['forma']}}</em>
                                             @endif
                                         </strong>

                                         <a href="{{route('autor.especies', [$especie['autor_id']])}}" class="text-primary">{{$especie['autor']}}</a>

                                     </div>
                                 </div>
                                 <div class="summary-footer">
                                     <span class="text-muted">Phylum:</span> <a class="text-primary" href="{{route('phylum.clases', [$especie['phylum_id']])}}">{{$especie['phylum']}} <i class="fa fa-angle-right text-muted"></i></a>
                                     <span class="text-muted">Clase:</span> <a class="text-primary" href="{{route('clase.subclases', [$especie['clase_id']])}}">{{$especie['clase']}} <i class="fa fa-angle-right text-muted"></i></a>
                                     @if($especie['subclase'] != null)
                                         <span class="text-muted">Sublclase:</span> <a class="text-primary" href="{{route('subclase.ordenes', [$especie['subclase_id']])}}">{{$especie['subclase']}} <i class="fa fa-angle-right text-muted"></i></a>
                                     @endif
                                     <span class="text-muted">Orden:</span> <a class="text-primary" href="{{route('orden.familias', [$especie['orden_id']])}}">{{$especie['orden']}}  <i class="fa fa-angle-right text-muted"></i></a>
                                     <span class="text-muted">Familia:</span> <a class="text-primary" href="{{route('familia.generos', [$especie['familia_id']])}}">{{$especie['familia']}}</a>

                                 </div>
                             </div>
                         </div>
                     </div>
                 </section>
             </div>

           <div class="col-xs-12 visible-xs visible-sm">
               <section class="panel panel-featured-left panel-featured-primary">
                   <div class="panel-body">
                       <div class="widget-summary widget-summary-xs">
                           <div class="widget-summary-col">
                               <div class="summary">
                                   <ul class="opciones">
                                       <li><a id="modal-vzla" href="#modal-mapa" class=" modal-basic modal-with-zoom-anim"><i class="fa fa-map-marker"></i>Ubicación en Venezuela </a></li>
                                       <li><a href="{{route('pdf.especie', [$especie['id']])}}"><i class="fa fa-file-pdf-o"></i>Exportar ficha </a></li>
                                       <li><a href="{{route('genero.especies', [$especie['genero_id']])}}"><i class="fa fa-list-ul"></i>Especies del género </a></li>
                                   </ul>

                               </div>

                           </div>
                       </div>
                   </div>
               </section>
           </div>
         </div>



         <div class="row">
             <div class="col-md-12">

                 <div class="panel-group" id="accordion">

                     <div class="panel panel-accordion">
                         <div class="panel-heading">
                             <h4 class="panel-title">
                                 <a class="accordion-toggle" data-toggle="collapse" href="#collapse1Two">
                                     Especie reportada en
                                 </a>
                             </h4>
                         </div>
                         <div id="collapse1Two" class="accordion-body collapse in">
                             <div class="panel-body pl-none pr-none">


                                <table id="datatable-reportes"  class="tabla-reportes table table-hover" cellspacing="0" width="100%">
                                     <thead>
                                     <tr>
                                         <th class="th-dataTable no-sort pr-md">
                                             <a id="sort-autor" class="pull-right pl-md sort">Autor <i class="fa "></i></a>
                                             <a id="sort-fecha" class="pull-right sort dt-sorting">Fecha <i class="fa fa-sort-amount-desc"></i></a>
                                             <h6 class="sort pull-right mb-none mr-sm mt-xs">ordenar por: </h6>

                                         </th>
                                         <th>Autor</th>
                                         <th>Fecha</th>
                                     </tr>
                                     </thead>

                                     <tbody>

                                     @foreach($citas_reportes as $referencia)

                                         <tr><td>
                                         <section id="ficha-reportes" class="panel panel-featured-left panel-featured-primary ">

                                             <div class="panel-body reportado-en">
                                                 <div class="widget-summary">

                                                     <div class="widget-summary-col">
                                                         <div class="summary">
                                                             <h4 class="m-none">{{ $referencia['cita']}}, {{$referencia['fecha']}}</h4>

                                                         </div>



                                                             @foreach($referencia['reportes'] as $reporte)
                                                             <div class="summary-footer">

                                                                 <div class="reportado-ubicacion">

                                                                     @if(!empty($reporte['sinonimia']))
                                                                         <h6 class="reportado-sinonimia">como: <em><b>{{$reporte['sinonimia']['nombre']}}</b></em> <small> {{$reporte['sinonimia']['autor']}}</small></h6>
                                                                     @endif


                                                                     @if(!empty($reporte['ubicaciones']))

                                                                         <ul>
                                                                             @foreach($reporte['ubicaciones'] as $ubicacion)
                                                                                 <li>
                                                                                     {{$ubicacion['entidad']}},

                                                                                     @if($ubicacion['localidad']!= null)
                                                                                         {{$ubicacion['localidad']}}

                                                                                         @if(!empty($ubicacion['lugares']))
                                                                                             @foreach($ubicacion['lugares'] as $lugar)
                                                                                                 <span class="reporte-lugar">{{$lugar['lugar']}}

                                                                                                     @if(!empty($lugar['sitios']))
                                                                                                         @foreach($lugar['sitios'] as $sitio)
                                                                                                             <span class="reporte-sitio">{{$sitio['sitio']}} <a href="#modal-mapa" id="{{$sitio['ubicacion_id']}}" class="modal-mapa modal-basic modal-with-zoom-anim"><i class="fa fa-map-marker"></i></a></span>

                                                                                                         @endforeach

                                                                                                     @else
                                                                                                         <a href="#modal-mapa" id="{{$lugar['ubicacion_id']}}" class="modal-mapa modal-basic modal-with-zoom-anim"><i class="fa fa-map-marker"></i></a>
                                                                                                     @endif

                                                                                                        </span>
                                                                                             @endforeach
                                                                                         @else
                                                                                             <a href="#modal-mapa" id="{{$ubicacion['ubicacion_id']}}" class="modal-mapa modal-basic modal-with-zoom-anim"><i class="fa fa-map-marker"></i></a>
                                                                                         @endif

                                                                                     @else
                                                                                         <a href="#modal-mapa" id="{{$ubicacion['ubicacion_id']}}" class="modal-mapa modal-basic modal-with-zoom-anim"><i class="fa fa-map-marker"></i></a>
                                                                                     @endif

                                                                                 </li>
                                                                             @endforeach
                                                                         </ul>

                                                                     @endif
                                                                 </div>
                                                             </div>

                                                             @endforeach




                                                     </div>
                                                 </div>
                                             </div>
                                         </section>

                                         </td>
                                         <td>{{ $referencia['cita']}}</td>
                                         <td>{{$referencia['fecha']}}</td>
                                         </tr>

                                     @endforeach


                                     </tbody>

                                 </table>
                             </div>
                         </div>
                     </div>


                     @if(false)
                     <div class="panel panel-accordion">
                         <div class="panel-heading">
                             <h4 class="panel-title">
                                 <a class="accordion-toggle" data-toggle="collapse"  href="#galeria">
                                     Galería
                                 </a>
                             </h4>
                         </div>
                         <div id="galeria" class="accordion-body collapse">
                             <div class="panel-body">
                                 Donec tellus massa, tristique sit amet condimentum vel, facilisis quis sapien.
                             </div>
                         </div>
                     </div>

                     @endif


                     <div class="panel panel-accordion">
                         <div class="panel-heading">
                             <h4 class="panel-title">
                                 <a class="accordion-toggle" data-toggle="collapse"  href="#collapse1Three">
                                     Referencias bibliográficas
                                 </a>
                             </h4>
                         </div>
                         <div id="collapse1Three" class="accordion-body collapse in">
                             <div class="panel-body ficha-referencias  pl-none pr-none">


                                 <table id="datatable-referencias" class="tabla-referencias table table-hover " cellspacing="0" width="100%">
                                     <thead>
                                     <tr>
                                         <th class="th-dataTable no-sort pr-md">
                                             <a id="sort-autor-ref" class="pull-right pl-md sort">Autor <i class="fa "></i></a>
                                             <a id="sort-fecha-ref" class="pull-right sort dt-sorting">Fecha <i class="fa fa-sort-amount-desc"></i></a>
                                             <h6 class="sort pull-right mb-none mr-sm mt-xs">ordenar por: </h6>
                                         </th>
                                         <th>Autor</th>
                                         <th>Fecha</th>
                                     </tr>
                                     </thead>

                                     <tbody>
                                         @foreach($referencias as $referencia)
                                            <tr>
                                                <td>
                                                    <h4>{{$referencia['cita']}}, {{$referencia['fecha']}}</h4>
                                                    <p>{!! $referencia['referencia'] !!} {{$referencia['comentarios']}}</p>
                                                </td>
                                                <td>{{$referencia['cita']}}</td>
                                                <td>{{$referencia['fecha']}}</td>

                                            </tr>
                                         @endforeach

                                     </tbody>

                                 </table>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <div class="row">
             <div class="col-md-12 ">
                 <section class="panel panel-featured-bottom panel-featured-primary">
                     <div class="panel-body ">

                         <ul class="opciones mb-md">
                             <li><a><i class="fa fa-info-circle"></i>¿Cómo citar esta página?</a></li>
                         </ul>

                         <p><b>WebFicoflora Venezuela.</b> 2015.
                             <b>Consulta de <em>{{$especie['genero']}} {{$especie['especifico']}}
                                     @if($especie['varietal'] != null) var. {{$especie['varietal']}} @endif
                                     @if($especie['forma'] != null) f. {{$especie['forma']}}@endif
                                 </em>.</b>

                             Publicación electrónica. Universidad Central de Venezuela, Caracas.
                             Editores: Yusneyi Carballo-Barrera, Santiago Gómez, Mayra García  & Nelson Gil.
                             Consultado el {{$fecha->day}} de {{$fecha->format('M.')}} de {{$fecha->year}},
                             de <a class="ww-bw" href="{{route('especie.index', [$especie['id']])}}"> http://www.ciens.ucv.ve/ficofloravenezuela/especie/{{$especie['id']}}</a>
                         </p>

                     </div>
                 </section>
             </div>
         </div>


     </div>
 </div>

 <input type="hidden" name="_token" value="{{ csrf_token() }}">




    @include('mapas._modal-mapa')

@stop

@section('script_section')
    @parent
    <script type='text/javascript' src='{{ asset('plugins/leaflet/leaflet.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins\DataTables-1.10.7\js\jquery.dataTables.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins\DataTables-1.10.7\js\dataTables.bootstrap.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/ficha-especies.js')}}'></script>



    <script>

    var coordenadas = <?php echo $coordenadas; ?>;


    map = new L.Map('map');
    // create the tile layer with correct attribution
    var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    var osmAttrib='Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';
    var osm = new L.TileLayer(osmUrl, {minZoom: 0, maxZoom: 16, attribution: osmAttrib});
    map.addLayer(osm);

//    var marker = L.marker([-11.19705555555, -70.01973]).addTo(map);
    for (coordenada in coordenadas) {
        var marker = L.marker([coordenadas[coordenada]['latitud'], coordenadas[coordenada]['longitud']]).addTo(map);
        marker.bindPopup("<h5 style='margin-top: 5px;margin-bottom: 5px;'><b>"+coordenadas[coordenada]['tipo']+":</b> "+coordenadas[coordenada]['nombre']+"</h5> <b>Latitud: </b>"+coordenadas[coordenada]['latitud']+"<br><b>Longitud: </b>"+coordenadas[coordenada]['longitud']);

    }

    $("#modal-vzla").on('click', function(){
        mapas(10.617, -66.966, 6);
    });



    $(".modal-mapa").on('click', function(){

        var id = $(this).attr('id');
        console.log(id);
        console.log(coordenadas[id]);

        mapas(coordenadas[id]['latitud'], coordenadas[id]['longitud'], 14);
//        mapas(10.42, -65.45);
    });

    function mapas(lat, lon, zoom){

        // start the map in South-East England
        //map.setView(new L.LatLng(51.302, 0.702),8);
         map.setView(new L.LatLng(lat, lon),zoom);


    }



    </script>
@stop
