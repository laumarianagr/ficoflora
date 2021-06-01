@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet/leaflet.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet-easyPrint-gh-pages/dist/easyPrint.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/fancybox/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/sidebar/css/leaflet-sidebar.css')}}">
   <!--  <link rel="stylesheet" href="{{ asset('plugins/fontaewesome5/css/all.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet-routing-machine-3.2.0/css/leaflet-routing-machine.css') }}"/>
@stop

@section('content')



@section('ubicacion-tipo', 'Entidad Federal')

@section('ruta-pdf')
    <a href="{{route('pdf.entidad.especies', [$ubicacion['entidad_id']])}}">
@stop


@section('ubicacion-nombre1')
    {{$ubicacion['entidad']}}
   <!--  <a id="modal-entidad" href="#modal-mapa" class="modal-basic modal-with-zoom-anim"><i class="fa fa-map-marker"></i></a> -->
@stop

@section('ubicacion-nombre2'){{$ubicacion['entidad']}}@stop


@section('ubicacion-superior')
            <span class="text-muted">País:</span> <a class="text-primary" href="{{route('pais.entidades', 'venezuela')}}">{{$ubicacion['pais']}} </a>
@stop

@section('pertenece', 'la entidad federal')


@section('content-tabla')

    @foreach($especies as $especie)
        <tr>
            <td ></td>

            <td class="perfil">

                <a href="{{route('especie.index', [$especie['id']])}}">
                    <em>{{$especie['genero']}} {{$especie['especifico']}}</em>

                    @if($especie['varietal'] != null)
                        <em>var. {{$especie['varietal']}}</em>
                    @endif

                    @if($especie['forma'] != null)
                        <em>f. {{$especie['forma']}}</em>
                    @endif

                    <span class="autores">{{$especie['autor']}}</span>

                </a>
            </td>

        </tr>
    @endforeach
@stop


@include('resultados._index-resultados-especies-ubicacion')


@stop

@section('script_section')
    @parent


    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/busquedas/dataTable_resultados.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/leaflet-easyPrint-gh-pages/dist/leaflet.easyPrint.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>


    <script type='text/javascript' src='{{ asset('js/ficha-especies.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/fancybox/jquery.fancybox.js')}}'></script>

<!--ultimos scripts-->
    <script type='text/javascript' src='{{ asset('plugins/sidebar/js/leaflet-sidebar.js')}}'></script>
    <!-- <script type='text/javascript' src='{{ asset('plugins/fontawesome5/js/all.js')}}'></script> -->

    <script type='text/javascript' src='{{ asset('plugins/leaflet-routing-machine-3.2.0/dist/leaflet-routing-machine.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/leaflet-routing-machine-3.2.0/examples/Control.Geocoder.js')}}'></script>
    
    <script type='text/javascript' src='{{ asset('js/mapas/ubicacion-mapa.js')}}'></script>
@stop
