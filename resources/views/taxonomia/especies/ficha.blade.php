@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/leaflet/leaflet.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">
    <style>
        #map { height:350px; }

    </style>
@stop

@section('content')


 <div class="row">
     <div class="col-xs-3 col-xlg-2 col-xlg-offset-1">

         <section class="panel">
             <div class="panel-body">
                 <div class="thumb-info mb-md">
                     <img src="{{ asset('img/!logged-user.jpg')}}" class="rounded img-responsive" alt="John Doe">

                 </div>


                 <ul class="opciones">
                     <li><a href=""><i class="fa fa-map-marker"></i>Ubicación en Venezuela </a></li>
                     <li><a><i class="fa fa-picture-o"></i>Galería </a></li>
                     <li><a href="{{route('genero.especies', [$especie['genero_id']])}}"><i class="fa fa-list-ul"></i>Especies del género </a></li>
                 </ul>

                 <hr class="dotted short">
                 <ul class="opciones">
                     <li><a href="{{route('buscar.index')}}"><i class="fa fa-search"></i>Nueva Búsqueda</a></li>
                 </ul>

                 {{--<hr class="dotted short">--}}

                 {{--<ul class="opciones mb-md">--}}
                 {{--<li><a><i class="fa fa-info-circle"></i>Citar la página como:</a></li>--}}
                 {{--</ul>--}}

                 {{--<p><b>WebFicoflora Venezuela.</b> 2015.--}}
                 {{--<b>Consulta de <em>{{$especie['genero']}} {{$especie['especifico']}}--}}
                 {{--@if($especie['varietal'] != null) var. {{$especie['varietal']}} @endif--}}
                 {{--@if($especie['forma'] != null) f. {{$especie['forma']}}@endif--}}
                 {{--</em>.</b>--}}

                 {{--Publicación electrónica. Universidad Central de Venezuela, Caracas.--}}
                 {{--Editores: Yusneyi Carballo-Barrera, Santiago Gómez, Mayra García  & Nelson Gil.--}}
                 {{--Consultado el {{$fecha->day}} de {{$fecha->month}} de {{$fecha->year}},--}}
                 {{--de <a class="ww-bw" href="{{route('especie.index', [$especie['id']])}}"> http://www.ciens.ucv.ve/ficofloravenezuela/especie/{{$especie['id']}}</a>--}}
                 {{--</p>--}}




             </div>
         </section>

     </div>
     <div class="col-xs-9 col-xlg-8">

         <div class="row">
             <div class="col-md-12 ">
                 <section class="panel panel-featured-bottom panel-featured-primary">
                     <div class="panel-body">
                         <div class="widget-summary">

                             <div class="widget-summary-col">
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

                                         <a class="text-primary">{{$especie['autor']}}</a>

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

         </div>



         <div class="row">
             <div class="col-md-12">


                 <div class="panel-group" id="accordion">

                     <div class="panel panel-accordion">
                         <div class="panel-heading">
                             <h4 class="panel-title">
                                 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1Two">
                                     Especie reportada en
                                 </a>
                             </h4>
                         </div>
                         <div id="collapse1Two" class="accordion-body collapse in">
                             <div class="panel-body">

                                 @foreach($citas_reportes as $referencia)

                                     <section class="panel panel-featured-left panel-featured-primary ficha-reportes">

                                         <div class="panel-body reportado-en">
                                             <div class="widget-summary">

                                                 <div class="widget-summary-col">
                                                     <div class="summary">
                                                         <h4 class="m-none">{{ $referencia['cita']}}, {{$referencia['fecha']}}</h4>

                                                     </div>

                                                     <div class="summary-footer ">


                                                         @foreach($referencia['reportes'] as $reporte)

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

                                                         @endforeach




                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </section>



                                 @endforeach




                             </div>
                         </div>
                     </div>
                     <div class="panel panel-accordion">
                         <div class="panel-heading">
                             <h4 class="panel-title">
                                 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#galeria">
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
                     <div class="panel panel-accordion">
                         <div class="panel-heading">
                             <h4 class="panel-title">
                                 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1Three">
                                     Referencias bibliográficas
                                 </a>
                             </h4>
                         </div>
                         <div id="collapse1Three" class="accordion-body collapse">
                             <div class="panel-body">

                                 <ul>
                                     @foreach($referencias as $referencia)
                                         <li class="mb-xlg">
                                             <h4>{{$referencia['cita']}}, {{$referencia['fecha']}}</h4>

                                             {!! $referencia['referencia'] !!}

                                         </li>
                                     @endforeach
                                 </ul>


                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <div class="row">
             <div class="col-md-12 ">
                 <section class="panel panel-featured-bottom panel-featured-primary">
                     <div class="panel-body">

                         <ul class="opciones mb-md">
                             <li><a><i class="fa fa-info-circle"></i>Citar la página como:</a></li>
                         </ul>

                         <p><b>WebFicoflora Venezuela.</b> 2015.
                             <b>Consulta de <em>{{$especie['genero']}} {{$especie['especifico']}}
                                     @if($especie['varietal'] != null) var. {{$especie['varietal']}} @endif
                                     @if($especie['forma'] != null) f. {{$especie['forma']}}@endif
                                 </em>.</b>

                             Publicación electrónica. Universidad Central de Venezuela, Caracas.
                             Editores: Yusneyi Carballo-Barrera, Santiago Gómez, Mayra García  & Nelson Gil.
                             Consultado el {{$fecha->day}} de {{$fecha->month}} de {{$fecha->year}},
                             de <a class="ww-bw" href="{{route('especie.index', [$especie['id']])}}"> http://www.ciens.ucv.ve/ficofloravenezuela/especie/{{$especie['id']}}</a>
                         </p>

                     </div>
                 </section>
             </div>
         </div>


     </div>
 </div>





    @include('mapas._modal-mapa')

@stop

@section('script_section')
    @parent
    <script type='text/javascript' src='{{ asset('plugins/leaflet/leaflet.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>



    <script>

    var coordenadas = <?php echo $coordenadas; ?>;


    map = new L.Map('map');
    // create the tile layer with correct attribution
    var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    var osmAttrib='Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';
    var osm = new L.TileLayer(osmUrl, {minZoom: 0, maxZoom: 16, attribution: osmAttrib});
    map.addLayer(osm);


    for (coordenada in coordenadas) {
        var marker = L.marker([coordenadas[coordenada]['latitud'], coordenadas[coordenada]['longitud']]).addTo(map);
        marker.bindPopup("<b>"+coordenadas[coordenada]['tipo']+":</b> "+coordenadas[coordenada]['nombre']);

    }




    $(".modal-mapa").on('click', function(){

        var id = $(this).attr('id');
        console.log(id);
        console.log(coordenadas[id]);

        mapas(coordenadas[id]['latitud'], coordenadas[id]['longitud']);
//        mapas(10.42, -65.45);
    });

    function mapas(lat, lon){

        // start the map in South-East England
        //map.setView(new L.LatLng(51.302, 0.702),8);
         map.setView(new L.LatLng(lat, lon),14);


    }

    </script>
@stop
