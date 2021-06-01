@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
    <meta http-equiv="Content-Type" content="application/pdf; charset=utf-8">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet/leaflet.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet-easyPrint-gh-pages/dist/easyPrint.css')}}">

    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/fancybox/jquery.fancybox.css')}}">

    <style>
        #map { height:400px; }
    </style>
@stop

@section('content')


@section('taxo-nombre')
    {{$ubicacion}}
@stop

@section('ruta-pdf')
    <a href="{{route('pdf.listado.sitios')}}">

    @stop



@section('listar')
    Número de <b>{{$ubicacion}}</b>:
@stop


@section('content-tabla')
    @foreach($sitios as $sitio)

        <tr>
            <td ></td>

            <td class="perfil">

                <a class="dp-in-b" href="{{route('sitio.especies', [$sitio['id']])}}">
                    {{$sitio['nombre']}}
                </a>
                <a href="#modal-mapa" id="{{$sitio['id']}}" class="modal-mapa modal-basic modal-with-zoom-anim dp-in-b text-primary"><i class="fa fa-map-marker"></i></a>

            </td>
            <td>
                @if($sitio['especies'] > 0)
                    <a class="action" href="{{route('sitio.especies', [$sitio['id']])}}">{{$sitio['especies']}}</a>
                @else
                    <a class="action not-active">-</a>
                @endif
            </td>



        </tr>
    @endforeach
    @include('mapas._modal-ubicacion-mapa')

@stop


@include('listados.ubicacion._index')

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

        <script>
            var coordenadas = <?php echo $coordenadas; ?>;
        </script>

        <script type='text/javascript' src='{{ asset('js/mapas/ubicacion-mapa.js')}}'></script>
@stop