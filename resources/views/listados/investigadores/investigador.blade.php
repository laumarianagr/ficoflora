@extends('master-investigadores')

@section('title')

@stop

@section('css_section')
    @parent
    <meta http-equiv="Content-Type" content="application/pdf; charset=utf-8">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet/leaflet.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/fancybox/jquery.fancybox.css')}}">

    <style>
        #map { height:400px; }
    </style>
 @stop

@section('content')


    <!-- sección izquierda con opciones de la ficha investigador -->
    <div class="col-md-3  hidden-xs hidden-sm col col-xlg-2 col-xlg-offset-1">

        <section class="panel">
        <div class="panel-body">


            <ul class="opciones">
                <li><a href="{{route('pdf.investigador', [$referencia->id])}}"><i class="fa fa-file-pdf-o"></i>Exportar ficha </a></li>
                <li><a  href="#referencias" ><i class="fa fa-list-ul"></i>Lista de referencias</a></li>
            </ul>

            <hr class="dotted short">
            <ul class="opciones">
                <li><a  href="{{route('buscar.index')}}"><i class="fa fa-search"></i>Nueva búsqueda</a></li>
            </ul>

        </div>
    </section>
    </div>


    <!-- sección derecha con autores de la referencia, información de la referencia
        reportes y otros trabajos del investigador -->

    <div class="col-sm-12 col-md-9 col-xlg-8">

        <!-- sección de superior, identificando al investigador(es) y la referencia consultada -->
        <div class="row">
            <div class="col-md-12">
                <section class="panel panel-featured-bottom panel-featured-primary">
                    <div class="panel-body">
                        <div class="widget-summary">

                            <div class="widget-summary-col">

                                <div class="hidden-xs hidden-sm pdf-img">
                                    <a href="{{route('pdf.investigador', [$referencia->id])}}" title="Exportar ficha">
                                        <img src="{{ asset('img/pdf.png')}}" class="" alt="Exportar">
                                    </a>
                                </div>

                                <div class="summary mb-sm">
                                    <div class="info">
                                        <strong class="amount">
                                            {!!html_entity_decode(trim($referencia->autores))!!}, {{$referencia->fecha}}{{$referencia->letra}}
                                        </strong>
                                    </div>
                                </div>

                                <div class="summary-footer">
                                    <!-- se construye la referencia bibliográfica según formato la bibliografía -->
                                    @include('listados.investigadores._parciales._referencia')
                                    <br />
                                </div>
                        </div>
                    </div>
                </section>
            </div>
    </div>
    </div>

    <li><a  href="#referencias" ><i class="fa fa-picture-o"></i>Lista de Referencias del Investigador(a) </a></li>


    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    @include('mapas._modal-mapa')

@stop

@section('script_section')
    @parent

    <script type='text/javascript' src='{{ asset('plugins/leaflet/leaflet.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/ficha-especies.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/fancybox/jquery.fancybox.js')}}'></script>



    <script>

        //var coordenadas = <?php //echo $coordenadas; ?>;

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

        map = new L.Map('map');
        // create the tile layer with correct attribution
        var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        var osmAttrib='Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';
        var osm = new L.TileLayer(osmUrl, {minZoom: 0, maxZoom: 16, attribution: osmAttrib});
        map.addLayer(osm);

        //    var marker = L.marker([-11.19705555555, -70.01973]).addTo(map);
        for (coordenada in coordenadas) {
            var marker = L.marker([coordenadas[coordenada]['latitud'], coordenadas[coordenada]['longitud']]).addTo(map);
            marker.bindPopup("<h5 style='margin-top: 5px;margin-bottom: 5px;'><b>" + coordenadas[coordenada]['tipo'] + ":</b> " + coordenadas[coordenada]['nombre'] + "</h5> <b>Latitud: </b>" + coordenadas[coordenada]['latitud'] + "<br><b>Longitud: </b>" + coordenadas[coordenada]['longitud']);


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
//        mapas(10.42, -65.45);
        });

        function mapas(lat, lon, zoom){

            // start the map in South-East England
            //map.setView(new L.LatLng(51.302, 0.702),8);
            map.setView(new L.LatLng(lat, lon),zoom);

        }

        localStorage.setItem("menu", "m-referencia");
    </script>
@stop
