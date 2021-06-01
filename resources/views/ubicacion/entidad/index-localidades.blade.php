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
    <link rel="stylesheet" href="{{ asset('plugins/sidebar/css/leaflet-sidebar.css')}}">
    <!-- <link rel="stylesheet" href="{{ asset('plugins/fontaewesome5/css/all.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet-routing-machine-3.2.0/css/leaflet-routing-machine.css') }}"/>

    <style>
        #map { height:400px; }

        .formulario{
            -webkit-appearance: auto;
        }

    </style>
@stop

@section('content')

@section('ubicacion-tipo'){{"Entidad federal"}}@stop


@section('ruta-pdf')
    <a href="{{route('pdf.entidad.localidades', [$ubicacion['entidad_id']])}}">
@stop


@section('ubicacion-nombre1')
    {{$ubicacion['entidad']}}
    <a id="modal-entidad" href="#modal-mapa" class="modal-basic modal-with-zoom-anim"><i class="fa fa-map-marker"></i></a>
    <button type="button" style="font-size: medium;"><a href="{{route('entidad.especies', [$ubicacion['entidad_id']])}}"> Especies Reportadas</a></button>
@stop

@section('ubicacion-nombre2'){{$ubicacion['entidad']}}@stop


        @section('ubicacion-superior')
            <span class="text-muted">País:</span> <a class="text-primary" href="{{route('pais.entidades', 'venezuela')}}">{{$ubicacion['pais']}}</a>
            <a id="modal-vzla" href="#modal-mapa" class="modal-basic modal-with-zoom-anim"><i class="fa fa-map-marker"></i></a>
        @stop


        @section('listar')
            localidades
        @stop

        @section('pertenece')
            a la entidad federal
        @stop

        @section('ubicacion-listar')
            de la localidad
        @stop


        @section('content-tabla')

            @foreach($localidades as $localidad)
                <tr>
                    <td ></td>

                    <td class="perfil">
                        @if($localidad['lugares'] > 0)
                            <a class="dp-in-b" href="{{route('localidad.lugares', [$localidad['id']])}}">{{$localidad['nombre']}}</a>
                        @else
                            <a class="not-active dp-in-b" >{{$localidad['nombre']}}</a>
                        @endif
                            <a href="#modal-mapa" id="{{$localidad['id']}}" class="modal-mapa modal-basic modal-with-zoom-anim dp-in-b text-primary"><i class="fa fa-map-marker"></i></a>



                    </td>

                    <td >
                        @if($localidad['especies'] > 0)
                            <a class="action" href="{{route('localidad.especies', [$localidad['id']])}}">{{$localidad['especies']}} </a>
                        @else
                            <a class="action not-active">-</a>
                        @endif
                    </td>


                </tr>
            @endforeach 


        @stop

@include('mapas._modal-ubicacion-mapa')

@include('resultados._index-resultados-ubicacion')

@include('resultados._index-resultados-especies-ubicacion')

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
<!--     <script type='text/javascript' src='{{ asset('plugins/fontawesome5/js/all.js')}}'></script> -->

    <script type='text/javascript' src='{{ asset('plugins/leaflet-routing-machine-3.2.0/dist/leaflet-routing-machine.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/leaflet-routing-machine-3.2.0/examples/Control.Geocoder.js')}}'></script>
    <script>

        var coordenadas = <?php echo $coordenadas; ?>;
        var coordenadasUbicacion = <?php echo $coordenadasUbicacion; ?>;
        //var localidades = <?php $localidades; ?>
        //var especies = <?php  $especies; ?>

        //console.log(localidades);
        //console.log(especies);



    </script>
    <script type='text/javascript' src='{{ asset('js/mapas/ubicacion-mapa.js')}}'></script>

@stop
