@extends('master-ficha')

@section('title')

@stop

@section('css_section')
    @parent
    <meta http-equiv="Content-Type" content="application/pdf; charset=utf-8">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet/leaflet.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet-easyPrint-gh-pages/dist/easyPrint.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/fancybox/jquery.fancybox.css')}}">
    <!--ultimos links-->
    <link rel="stylesheet" href="{{ asset('plugins/sidebar/css/leaflet-sidebar.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet-routing-machine-3.2.0/css/leaflet-routing-machine.css') }}"/>
   
    <!--<link rel="stylesheet" href="{{ asset('plugins/leaflet-routing-machine-3.2.0/examples/index.css') }}"/-->


    <style>

        #map { height:400px; }

        .formulario{
            -webkit-appearance: auto;
        }

    </style>

 @stop

     @section('especie-mapa')
    <em>{{$especie['nombre']}}</em> {{$especie['autor']}}
@stop

@section('content')

    <div class="row">

        <!-- sección izquierda con foto principal y opciones de la ficha especie -->

            <div class="col-md-3  hidden-xs hidden-sm col col-xlg-2 col-xlg-offset-1">

            <section class="panel">
                <div class="panel-body">
                    <div class="thumb-info mb-md">

                        @if($portada == null)
                            <img src="{{ asset('img/sin-imagen.png')}}" class="rounded img-responsive" alt="sin imagen disponible">

                        @else
                            <a class="galeria" rel="galeria" href="{{ asset('../../galeria/'.$portada->imagen.'_z.jpg')}}" title="{{$portada->leyenda}}">
                                <img class="img-w100"  src="{{ asset('../../galeria/'.$portada->imagen.'.jpg')}}" alt="" />
                            </a>
                        @endif

                    </div>


                    <ul class="opciones">
                        <li><a id="modal-vzla" href="#modal-mapa" class="modal-basic modal-with-zoom-anim"><i class="fa fa-map-marker"></i>Ubicación en Venezuela </a></li>
                        @if(!empty($imagenes))
                            <li><a  href="#galeria" ><i class="fa fa-picture-o"></i>Galería </a></li>
                        @endif
                        <li><a href="{{route('pdf.especie', [$especie['id']])}}"><i class="fa fa-file-pdf-o"></i>Exportar ficha </a></li>
                        <li><a href="{{route('genero.especies', [$especie['genero_id']])}}"><i class="fa fa-list-ul"></i>Especies del género </a></li>
                    </ul>

                    <hr class="dotted short">
                    <ul class="opciones">
                        <li><a  href="{{route('buscar.index')}}"><i class="fa fa-search"></i>Nueva búsqueda</a></li>
                    </ul>

                    <hr class="dotted short">

                    @if(!empty($sinonimias))

                        <section class="panel mb-sm">
                            <div class="bg-dark p-sm ">
                                <h5 class="m-none">Sinonimia</h5>
                            </div>
                        </section>

                        <ul class="pl-lg">
                            @foreach($sinonimias as $sinonimia)
                                <li class="text-dark"><a class="text-dark" href="{{route('sinonimia.index',[$sinonimia['id']])}}"><em>{{$sinonimia['nombre']}}</em></a></li>
                            @endforeach
                        </ul>
                        <hr class="dotted short">

                    @endif


                </div>
            </section>
        </div>

        <!-- sección derecha con identificación de la especie y su ficha  -->
        <div class="col-sm-12 col-md-9 col-xlg-8">

            <div class="row">
                <div class="col-xs-12 col-md-12 ">
                    <section class="panel panel-featured-bottom panel-featured-primary">
                        <div class="panel-body">
                            <div class="widget-summary">

                                <div class="widget-summary-col">

                                    <div class="hidden-xs hidden-sm pdf-img">
                                        <a href="{{route('pdf.especie', [$especie['id']])}}" title="Exportar ficha">
                                            <img src="{{ asset('img/pdf.png')}}" class="" alt="Exportar">
                                        </a>
                                    </div>

                                    <div class="summary mb-sm">
                                        <div class="info">
                                            <strong class="amount"><em>{{$especie['genero']}} {{$especie['especifico']}}</em></strong>

                                            <strong class="amount">
                                                @if($especie['subespecie'] != null)
                                                    <em>subsp. {{$especie['subespecie']}}</em>
                                                @endif
                                            </strong>

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
                                            <span class="text-muted">Subclase:</span> <a class="text-primary" href="{{route('subclase.ordenes', [$especie['subclase_id']])}}">{{$especie['subclase']}} <i class="fa fa-angle-right text-muted"></i></a>
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
                                            @if(!empty($imagenes))
                                                <li><a  href="#galeria" ><i class="fa fa-picture-o"></i>Galería </a></li>
                                            @endif
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
                                                <h6 class="m-none dp-iblock">Número de registros: <b>{{$total}}</b></h6>
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
                                                                        <h4 class="m-none">
                                                                            <a href="#" data-toggle="tooltip" title="{!!html_entity_decode(trim($referencia['referencia']))!!}">
                                                                                {!!html_entity_decode(trim($referencia['cita']))!!}, {{ $referencia['fecha']}}{{$referencia['letra']}}
                                                                            </a>
                                                                        </h4>
                                                                    </div>

                                                                    @foreach($referencia['reportes'] as $reporte)
                                                                        <div class="summary-footer">

                                                                            <div class="reportado-ubicacion">

                                                                                @if(!empty($reporte['sinonimia']))
                                                                                    <h6 class="reportado-sinonimia">Como: <em><b>{{$reporte['sinonimia']['nombre']}}</b></em> <small> {{$reporte['sinonimia']['autor']}}</small></h6>
                                                                                @endif


                                                                                @if(!empty($reporte['ubicaciones']))

                                                                                    <ul>
                                                                                        @foreach($reporte['ubicaciones'] as $ubicacion)
                                                                                            <li>
                                                                                                {{--{{$ubicacion['entidad']}},--}}
                                                                                                <a class="text-dark" href="{{route('entidad.localidades',$ubicacion['entidad_id'])}}">{{$ubicacion['entidad']}}</a>,

                                                                                                @if($ubicacion['localidad']!= null)
{{--                                                                                                    {{$ubicacion['localidad']}}--}}
                                                                                                    <a class="text-dark" href="{{route('localidad.lugares',$ubicacion['localidad_id'])}}">{{$ubicacion['localidad']}}</a>

                                                                                                    @if(!empty($ubicacion['lugares']))
                                                                                                        @foreach($ubicacion['lugares'] as $lugar)
                                                                                                            {{--<span class="reporte-lugar">{{$lugar['lugar']}}--}}
                                                                                                                <span class="reporte-lugar"><a class="text-dark" href="{{route('lugar.sitios',$lugar['lugar_id'])}}">{{$lugar['lugar']}}</a>


                                                                                                                @if(!empty($lugar['sitios']))
                                                                                                                    @foreach($lugar['sitios'] as $sitio)
                                                                                                                        {{--<span class="reporte-sitio">{{$sitio['sitio']}} <a href="#modal-mapa" id="{{$sitio['ubicacion_id']}}" class="modal-mapa modal-basic modal-with-zoom-anim"><i class="fa fa-map-marker"></i></a></span>--}}

                                                                                                                        <span class="reporte-sitio"><a class="text-dark" href="{{route('sitio.especies',$sitio['sitio_id'])}}">{{$sitio['sitio']}}</a> <a href="#modal-mapa" id="{{$sitio['ubicacion_id']}}" class="modal-mapa modal-basic modal-with-zoom-anim"><i class="fa fa-map-marker"></i></a></span>
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


                                                                    <div class="summary">
                                                                        @if(!empty($referencia['comentario']))
                                                                            <h6  class="pl-sm">Comentario: {!!$referencia['comentario']!!}</h6>
                                                                        @endif

                                                                    </div>

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


                        @if($imagenes != null)
                            <div class="panel panel-accordion">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" name="galery" href="#galeria">
                                            Galería
                                        </a>
                                    </h4>
                                </div>
                                <div id="galeria" class="accordion-body collapse in">
                                    <div class="panel-body">

                                        <div class="galeria_box">

                                            @foreach($imagenes as $imagen)
                                                <a class="galeria" rel="galeria" href="{{ asset('../../galeria/'.$imagen->imagen.'_z.jpg')}}" title="{{$imagen->leyenda}}">
                                                    <img class="img-galeria"  src="{{ asset('../../galeria/'.$imagen->imagen.'.jpg')}}" alt="" />
                                                </a>

                                            @endforeach
                                        </div>

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
                                                    <p>{!! $referencia['referencia'] !!}</p>
                                                    <p>{!! $referencia['comentarios'] !!}</p>
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
                                <li><a><i class="fa fa-info-circle"></i>¿Cómo citar esta página? &nbsp;<i id="copy" class="fa fa-pencil-square-o" style="vertical-align: middle;" onclick="copyToClipboard('#p2');" title="clic para copiar referencia"></i></a>
                                </li>
                            </ul>

                            <p><b>Web Ficoflora Venezuela.</b> {{$fecha->year}}. <b>Catálogo digital de la Ficoflora de Venezuela</b>.
                                <b>Consulta de <em>{{$especie['genero']}} {{$especie['especifico']}}
                                        @if($especie['subespecie'] != null) subsp. {{$especie['subespecie']}} @endif
                                        @if($especie['varietal'] != null) var. {{$especie['varietal']}} @endif
                                        @if($especie['forma'] != null) f. {{$especie['forma']}}@endif</em>.</b>

                                Publicación electrónica. Universidad Central de Venezuela, Caracas.
                                Editores: Santiago Gómez, Yusneyi Carballo Barrera, Mayra García & Nelson Gil.
                                Consultado el {{$fecha->day}} de {{$mes}} de {{$fecha->year}},
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
    <!--<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>-->
    <script type='text/javascript' src='{{ asset('plugins/leaflet-easyPrint-gh-pages/dist/leaflet.easyPrint.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>


    <script type='text/javascript' src='{{ asset('js/ficha-especies.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/fancybox/jquery.fancybox.js')}}'></script>

<!--ultimos scripts-->
    <script type='text/javascript' src='{{ asset('plugins/sidebar/js/leaflet-sidebar.js')}}'></script>


    <script type='text/javascript' src='{{ asset('plugins/leaflet-routing-machine-3.2.0/dist/leaflet-routing-machine.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/leaflet-routing-machine-3.2.0/examples/Control.Geocoder.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/leaflet-routing-machine-3.2.0/src/L.Routing.Mapbox.js')}}'></script>



    <script>

        var coordenadas = <?php echo $coordenadas; ?>;
        var citas_reportes = <?php echo $citas_reportes; ?>

       //console.log(coordenadas);
       //console.log(citas_reportes);

          
        $(document).ready(function() {
            $("#portada").fancybox({
                openEffect	: 'fade',
                closeEffect	: 'fade',
                helpers : {
                    title : {
                        type : 'inside'
                    }
                }
            });
            $(".galeria").fancybox({
                openEffect	: 'fade',
                closeEffect	: 'fade',
                helpers : {
                    title : {
                        type : 'inside'
                    }
                }
            });
        });


        function fn(obj, key) {
            if (_.has(obj, key)) // or just (key in obj)
                return [obj];
            // elegant:
            return _.flatten(_.map(obj, function(v) {
                return typeof v == "object" ? fn(v, key) : [];
            }), true);

            // or efficient:
            var res = [];
            _.forEach(obj, function(v) {
                if (typeof v == "object" && (v = fn(v, key)).length)
                    res.push.apply(res, v);
            });
            return res;
        }

/*------------------------------------------MAPA-----------------------------------*/

        map = new L.Map('map', {zoomControl: false});

/*------------------------------------------CAPAS----------------------------------*/
        // create the tile layer with correct attribution
        var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        var osmAttrib='Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';
        osmAttrib = osmAttrib + '&nbsp;&nbsp;&nbsp;&nbsp;<img src="../../img_publicas/ficofloraVenezuela_ico.png" style="height: 25px; vertical-align: text-bottom;" />';
        osmAttrib = osmAttrib + '&nbsp;<b style="color:#17b218;">Proyecto Ficoflora Venezuela</b>';
        osmAttrib = osmAttrib + '<span> | clic sobre el mapa para ver otras coordenadas</span>';

        var CyclmoUrl = 'https://dev.{s}.tile.openstreetmap.fr/cyclosm/{z}/{x}/{y}.png',
            SatelitalUrl = 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}';


        // src de la imagen configurado para mostrarla en el servidor web

        var osm = new L.TileLayer(osmUrl, {minZoom: 0, maxZoom: 16, attribution: osmAttrib}),
            Ciclismo = new L.TileLayer(CyclmoUrl, {minZoom: 0, maxZoom: 16, attribution: osmAttrib}),
            Satelital = new L.TileLayer(SatelitalUrl, {minZoom: 0, maxZoom: 16, attribution: osmAttrib});

             
        map.addLayer(osm);


        var baseMaps = {
            "Osm": osm,
            "Ciclismo": Ciclismo,     
            "Satelital": Satelital   
        };
/*-------------------------------CONTROL CAPAS RASTER----------------------------------------*/


        var control = L.control.layers(baseMaps, null, {collapsed:false}).addTo(map); 

        // Call the getContainer routine.
        var htmlObject = control.getContainer();
        // Get the desired parent node.
        var newdoc = document.getElementById("controlL");

        // Finally append that node to the new parent, recursively searching out and re-parenting nodes.
        function setParent(el, newParent){
            newParent.appendChild(el);
        }
        setParent(htmlObject, newdoc);

/*--------------------------CONTROL SIDEBAR------------------------------------------------------------*/
        
        var sidebar = L.control.sidebar({ container: 'sidebar' })
        .addTo(map);
            

//-------------------------------------------------------------------------------------------------------//
        var popup = L.popup(); // muestra las coordenadas al posicionarse sobre un punto

        function onMapClick(e) {
            popup
                    .setLatLng(e.latlng)
                    .setContent(e.latlng.toString())
                    .openOn(map);
        }

        map.on('click', onMapClick);

        //var marker = L.marker([-11.19705555555, -70.01973]).addTo(map);
        //var latitud,
            //longitud;

        /*for(sinonimia in sinonimias){
            alert('hola');

        }  */ 
        var citas_reportes_coord = new Object();
        //var ubicacion1 = new Object();

        var cita_fecha = "";
        for(cr in citas_reportes) {
            // var ubicacionl = citas_reportes[cr].reportes[0].ubicaciones;
            // console.log(ubicacionl);

            var ubicacionl_array = citas_reportes[cr].reportes[0].ubicaciones;
            if (ubicacionl_array.length > 0) {
                console.log("ubicaciones " + ubicacionl_array.length);
                for(u in ubicacionl_array) {
                    ubicacionl = ubicacionl_array[u];
                    console.log(ubicacionl);
                    if (typeof ubicacionl['ubicacion_id'] !== "undefined") {    
                        cita_fecha = citas_reportes[cr]['cita'] + ", " + citas_reportes[cr]['fecha']
                        citas_reportes_coord[ubicacionl['ubicacion_id']] = cita_fecha //asigno la cita a el id_ubicacion correspondiente
                    } else {
                        var ubicacionlu_array = citas_reportes[cr].reportes[0].ubicaciones[u].lugares;
                        console.log("lugares " + ubicacionlu_array.length);
                        for(lu in ubicacionlu_array) {
                            var ubicacionlu = citas_reportes[cr].reportes[0].ubicaciones[u].lugares[lu]
                            if (typeof ubicacionlu['ubicacion_id'] !== "undefined") {
                                cita_fecha = citas_reportes[cr]['cita'] + ", " + citas_reportes[cr]['fecha']
                                citas_reportes_coord[ubicacionlu['ubicacion_id']] = cita_fecha
                            } else {
                                var ubicacionsit_array = citas_reportes[cr].reportes[0].ubicaciones[u].lugares[lu].sitios;
                                console.log("sitios " + ubicacionsit_array.length);
                                for(sit in ubicacionsit_array) {
                                    var ubicacionsit = citas_reportes[cr].reportes[0].ubicaciones[u].lugares[lu].sitios[sit]
                                    if (typeof ubicacionsit['ubicacion_id'] !== "undefined") {
                                        cita_fecha = citas_reportes[cr]['cita'] + ", " + citas_reportes[cr]['fecha']
                                        citas_reportes_coord[ubicacionsit['ubicacion_id']] = cita_fecha
                                    }
                                }

                            }
                        }
                    }
                }
            }
        
            //     else {
            //         var ubicacionsit = citas_reportes[cr].reportes[0].ubicaciones[0].lugares[0].sitios[0]
            //         if (typeof ubicacionsit['ubicacion_id'] !== "undefined") {
            //             cita_fecha = citas_reportes[cr]['cita'] + ", " + citas_reportes[cr]['fecha']
            //             citas_reportes_coord[ubicacionsit['ubicacion_id']] = cita_fecha
            //             //k++;
            //         }
            //     }
            // }


        }
        console.log(citas_reportes_coord);

        for (coordenada in coordenadas) {
            //latitud = coordenadas[coordenada]['latitud'],
            //longitud = coordenadas[coordenada]['longitud'];

            var marker = L.marker([coordenadas[coordenada]['latitud'], coordenadas[coordenada]['longitud']]).addTo(map);
            var cita_fecha = citas_reportes_coord[coordenada]
            //console.log(cita_fecha)
            marker.bindPopup("<h5 style='margin-top: 5px;margin-bottom: 5px;'><b>" + coordenadas[coordenada]['tipo'] + ":</b> " + coordenadas[coordenada]['nombre'] + "</h5> <b>Latitud: </b>" + coordenadas[coordenada]['latitud'] + "<br><b>Longitud: </b>" + coordenadas[coordenada]['longitud'] + "<br><b>Autor: </b>" + cita_fecha );

            marker.on('mouseover', function (e) {
                this.openPopup();
            });
            marker.on('mouseout', function (e) {
                this.closePopup();
            });
        }

        $("#modal-vzla").on('click', function(){
            mapas(10.617, -66.966, 6);
        });


        $(".modal-mapa").on('click', function(){

            var id = $(this).attr('id');
            console.log(id);
            console.log(coordenadas[id]);

            mapas(coordenadas[id]['latitud'], coordenadas[id]['longitud'], 14);
            //mapas(10.42, -65.45, zoom);
            ruta(coordenadas[id]['latitud'], coordenadas[id]['longitud'], 14);
            
        });

        function mapas(lat, lon, zoom){

            //map.setView(new L.LatLng(51.302, 0.702),8);
            map.setView(new L.LatLng(lat, lon),zoom);
        }

        localStorage.setItem("menu", "m-especie");



        //  evento para el tooltip del pdf
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            return false;
        });


/*---------------------------------------NOTAS O COMENTARIOS------------------------------------*/
        var markerOptions = {
                title: "Notas",
                clickable: true,
                draggable: true
        }
        /*--1. SE CREA LA NOTAs--*/

        var markerC,
            note;   

        /*--2. SE AGREGA LA NOTA Y SE MANDA A GETDATA--*/
        function getdata(){

            note = document.getElementById('notes').value;//toma el valor del formulario
            longitud = document.getElementById('long').value;//toma el valor del formulario
            latitud = document.getElementById('lat').value;//toma el valor del formulario

            addNote(note);
        }
        function  addNote(note){
            //note.preventDefault();
            //alert(longitud,note);
            markerOptions= {
                draggable: true
            }
            markerC = L.marker([longitud, latitud], markerOptions).addTo(map).bindPopup("<b>Notas: " + note).openPopup();// creacion marcador

        }

//----------------------------CONTROL ZOOM----------------------------//

    var zoom = L.control.zoom().addTo(map);
    var htmlPO = zoom.getContainer();
    var newObj = document.getElementById('zoom');
    setParent(htmlPO, newObj);

//----------------------------CONTROL IMPRIMIR------------------------//
    //L.control.scale({imperial: false}).addTo(map);//sistema metrico imperial
    
    //L.easyPrint().addTo(map); // agrega el control para imprimir
    var htmlOb = L.easyPrint().addTo(map).getContainer();
    var newie = document.getElementById('print');
    setParent(htmlOb, newie);

//-----------------------------RUTAS---------------------------------//
    function ruta(lat, lon, zoom){

        //var lat2=lat+0.01,
            //long2=lon-0.01;
        //alert('hola');    
        var controlRoute = L.Routing.control({
            waypoints: [
                L.latLng(),
                L.latLng()
            ],
            language: 'es',
            geocoder: L.Control.Geocoder.nominatim(),
            routeWhileDragging: true,
            reverseWaypoints: true,
            showAlternatives: true,
          
            router: L.Routing.mapbox('pk.eyJ1IjoibGF1bWFyaWFuYWdyIiwiYSI6ImNraWRvYm92dTAzNzcycWxiZDlvMzlkdDQifQ.Bt2UCd6VpYuXHLcCqVmE7Q')
        }).addTo(map);

        L.Routing.errorControl(controlRoute).addTo(map);
        
        var ObjR = controlRoute.getContainer();
        var newr = document.getElementById('controlR');
        setParent(ObjR, newr);
       

    }    

    </script>
@stop