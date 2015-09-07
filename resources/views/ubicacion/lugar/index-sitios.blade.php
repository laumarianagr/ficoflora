@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins\DataTables-1.10.7\css\dataTables.bootstrap.css')}}">
@stop

@section('content')

@section('ubicacion-tipo')
    Lugar
@stop

@section('ubicacion-nombre')
    {{$ubicacion['lugar']}}
@stop


@section('ubicacion-superior')
    <span class="text-muted">Pais:</span> <a class="text-primary" href="{{route('pais.entidades', 'venezuela')}}">{{$ubicacion['pais']}} <i class="fa fa-angle-right text-muted"></i> </a>

    <span class="text-muted">Entidad:</span> <a class="text-primary" href="{{route('entidad.localidades', [$ubicacion['entidad_id']])}}">{{$ubicacion['entidad']}}  <i class="fa fa-angle-right text-muted"></i></a>
    <span class="text-muted">Localidad:</span> <a class="text-primary" href="{{route('localidad.lugares', [$ubicacion['localidad_id']])}}">{{$ubicacion['localidad']}}</a>

@stop


@section('listar')
    Sitios
@stop

@section('pertenece')
    a el lugar
@stop

@section('ubicacion-listar')
    del Sitio
@stop


@section('content-tabla')

    @foreach($sitios as $sitio)
        <tr>
            <td ></td>

            <td class="perfil">

                {{$sitio['nombre']}}

            </td>

            <td >
                <a class="action" href="{{route('sitio.especies', [$sitio['id']])}}"><i class="fa fa-eye"></i></a>
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
