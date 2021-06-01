@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
@stop

@section('content')


@section('taxo-nombre')
    {{$taxonomia}}
@stop

@section('ruta-pdf')
    <a href="{{route('pdf.listado.subclases')}}">

    @stop



@section('listar')
    Número de <b>{{$taxonomia}}</b>:
@stop


@section('content-tabla')
    @foreach($subclases as $subclase)

        <tr>
            <td ></td>

            <td class="perfil">

                <a href="{{route('subclase.ordenes', [$subclase['id']])}}">
                    <em>{{$subclase['nombre']}}</em>
                </a>
            </td>



        </tr>
    @endforeach
@stop


@include('listados.taxonomias._index')

@stop

@section('script_section')
    @parent


    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/busquedas/dataTable_resultados.js')}}'></script>
    <script>

    </script>
@stop
