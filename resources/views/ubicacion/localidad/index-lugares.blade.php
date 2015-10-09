@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins\DataTables-1.10.7\css\dataTables.bootstrap.css')}}">
@stop

@section('content')

@section('ubicacion-tipo')
    Localidad
@stop

@section('ubicacion-nombre')
    {{$ubicacion['localidad']}}
@stop


@section('ubicacion-superior')
    <span class="text-muted">Pais:</span> <a class="text-primary" href="{{route('pais.entidades', 'venezuela')}}">{{$ubicacion['pais']}} <i class="fa fa-angle-right text-muted"></i> </a>
    <span class="text-muted">Entidad federal:</span> <a class="text-primary" href="{{route('entidad.localidades', [$ubicacion['entidad_id']])}}">{{$ubicacion['entidad']}}</a>

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
    del Lugar
@stop


@section('content-tabla')

    @foreach($lugares as $lugar)
        <tr>
            <td ></td>

            <td class="perfil">

                @if($lugar['sitios'] > 0)
                    <a href="{{route('lugar.sitios', [$lugar['id']])}}">{{$lugar['nombre']}}</a>
                @else
                    <a class="not-active">{{$lugar['nombre']}}</a>
                @endif
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


@include('resultados._index-resultados-ubicacion')


@stop

@section('script_section')
    @parent


    <script type='text/javascript' src='{{ asset('plugins\DataTables-1.10.7\js\jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins\DataTables-1.10.7\js\dataTables.bootstrap.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/busquedas/dataTable_resultados.js')}}'></script>
    <script>

    </script>
@stop
