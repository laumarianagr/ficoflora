@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins\DataTables-1.10.7\css\dataTables.bootstrap.css')}}">
@stop

@section('content')

@section('ubicacion-tipo')
    País
@stop


@section('ruta-pdf')
    <a href="{{route('pdf.pais.entidades')}}">
@stop


@section('ubicacion-nombre')
    {{$ubicacion['pais']}}
@stop


@section('ubicacion-superior')
@stop


@section('listar')
    entidades federales
@stop

@section('pertenece')
    el país
@stop

@section('ubicacion-listar')
    de la Entidad federal
@stop


@section('content-tabla')

    @foreach($entidades as $entidad)
        <tr>
            <td ></td>

            <td class="perfil">
                @if($entidad['localidades'] > 0)
                    <a href="{{route('entidad.localidades', [$entidad['id']])}}">{{$entidad['nombre']}}</a>
                @else
                    <a class="not-active">{{$entidad['nombre']}}</a>
                @endif
            </td>

            <td >
                @if($entidad['especies'] > 0)
                    <a class="action" href="{{route('entidad.especies', [$entidad['id']])}}">{{$entidad['especies']}} </a>
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
