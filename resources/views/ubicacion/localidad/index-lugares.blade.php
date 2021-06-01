@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">

    <meta http-equiv="Content-Type" content="application/pdf; charset=utf-8">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet/leaflet.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet-easyPrint-gh-pages/dist/easyPrint.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/sidebar/css/leaflet-sidebar.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/fancybox/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('plugins/fontaewesome5/css/all.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('plugins/leaflet-routing-machine-3.2.0/css/leaflet-routing-machine.css') }}"/>

    <style>
        #map { height:400px; }

    </style>
@stop

@section('content')

@section('ubicacion-tipo'){{"Localidad"}}@stop

@section('ubicacion-nombre1')
    {{$ubicacion['localidad']}}
    <a id="modal-localidad" href="#modal-mapa" class="modal-basic modal-with-zoom-anim"><i class="fa fa-map-marker"></i></a>
@stop

@section('ubicacion-nombre2'){{$ubicacion['localidad']}}@stop


@section('ubicacion-superior')
    <span class="text-muted">Pais:</span> <a class="text-primary" href="{{route('pais.entidades', 'venezuela')}}">{{$ubicacion['pais']}}</a>
    <a id="modal-vzla" href="#modal-mapa" class="modal-basic modal-with-zoom-anim"><i class="fa fa-map-marker"></i></a>
    <i class="fa fa-angle-right text-muted"></i>

    <span class="text-muted">Entidad federal:</span> <a class="text-primary" href="{{route('entidad.localidades', [$ubicacion['entidad_id']])}}">{{$ubicacion['entidad']}}</a>
    <a id="modal-entidad" href="#modal-mapa" class="modal-basic modal-with-zoom-anim"><i class="fa fa-map-marker"></i></a>

@stop


@section('listar')
    lugares
@stop

@section('ruta-pdf')
    <a href="{{route('pdf.localidad.lugares', [$ubicacion['localidad_id']])}}">
@stop

@section('pertenece')
    a la localidad
@stop

@section('ubicacion-listar')
    del lugar
@stop


@section('content-tabla')

    @foreach($lugares as $lugar)
        <tr>
            <td ></td>

            <td class="perfil">

                @if($lugar['sitios'] > 0)
                    <a class="dp-in-b" href="{{route('lugar.sitios', [$lugar['id']])}}">{{$lugar['nombre']}}</a>
                @else
                    <a class="not-active dp-in-b">{{$lugar['nombre']}}</a>
                @endif
                    <a href="#modal-mapa" id="{{$lugar['id']}}" class="modal-mapa modal-basic modal-with-zoom-anim dp-in-b text-primary"><i class="fa fa-map-marker"></i></a>

            </td>

            <td>
                @if($lugar['especies'] > 0)
                    <a class="action" href="{{route('lugar.especies', [$lugar['id']])}}">{{$lugar['especies']}}</a>
                @else
                    <a class="action not-active">-</a>
                @endif
            </td>


        </tr>
    @endforeach
@stop

@include('mapas._modal-ubicacion-mapa')

@include('resultados._index-resultados-ubicacion')


@stop

@section('script_section')
    @parent


    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/busquedas/dataTable_resultados.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/leaflet/leaflet.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/leaflet-easyPrint-gh-pages/dist/leaflet.easyPrint.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/fancybox/jquery.fancybox.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/sidebar/js/leaflet-sidebar.js')}}'></script>
    <!-- <script type='text/javascript' src='{{ asset('plugins/fontawesome5/js/all.js')}}'></script> -->

    <script type='text/javascript' src='{{ asset('plugins/leaflet-routing-machine-3.2.0/dist/leaflet-routing-machine.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/leaflet-routing-machine-3.2.0/examples/Control.Geocoder.js')}}'></script>
    <script>

    <script>

        var coordenadas = <?php echo $coordenadas; ?>;
        var coordenadasUbicacion = <?php echo $coordenadasUbicacion; ?>;

    </script>
    <script type='text/javascript' src='{{ asset('js/mapas/ubicacion-mapa.js')}}'></script>
@stop
