@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins\DataTables-1.10.7\css\dataTables.bootstrap.css')}}">
@stop

@section('content')

@section('ubicacion-tipo')
    Pais
@stop

@section('ubicacion-nombre')
    {{$ubicacion['pais']}}
@stop


@section('ubicacion-superior')
@stop


@section('listar')
    Entidades
@stop

@section('pertenece')
    a el pais
@stop

@section('ubicacion-listar')
    de la Entidad
@stop


@section('content-tabla')

    @foreach($entidades as $entidad)
        <tr>
            <td ></td>

            <td class="perfil">
                <a href="{{route('entidad.localidades', [$entidad['id']])}}">{{$entidad['nombre']}}</a>
            </td>

            <td >
                <a class="action" href="{{route('entidad.especies', [$entidad['id']])}}"><i class="fa fa-eye"></i></a>
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
