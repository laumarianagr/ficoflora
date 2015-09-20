@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins\DataTables-1.10.7\css\dataTables.bootstrap.css')}}">
@stop

@section('content')

@section('ubicacion-tipo')
    Sitio
@stop

@section('ruta-pdf')
    <a href="{{route('pdf.sitio.especies', [$ubicacion['sitio_id']])}}">
@stop

@section('ubicacion-nombre')
    {{$ubicacion['sitio']}}
@stop


@section('ubicacion-superior')
    <span class="text-muted">Pais:</span> <a class="text-primary" href="{{route('pais.entidades', 'venezuela')}}">{{$ubicacion['pais']}} <i class="fa fa-angle-right text-muted"></i> </a>
    <span class="text-muted">Entidad:</span> <a class="text-primary" href="{{route('entidad.localidades', [$ubicacion['entidad_id']])}}">{{$ubicacion['entidad']}} <i class="fa fa-angle-right text-muted"></i></a>
    <span class="text-muted">Localidad:</span> <a class="text-primary" href="{{route('localidad.lugares', [$ubicacion['localidad_id']])}}">{{$ubicacion['localidad']}} <i class="fa fa-angle-right text-muted"></i></a>
    <span class="text-muted">Lugar:</span> <a class="text-primary" href="{{route('lugar.sitios', [$ubicacion['lugar_id']])}}">{{$ubicacion['lugar']}}</a>

@stop


@section('pertenece')
    el sitio
@stop


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


    <script type='text/javascript' src='{{ asset('plugins\DataTables-1.10.7\js\jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins\DataTables-1.10.7\js\dataTables.bootstrap.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/busquedas/dataTable_resultados.js')}}'></script>
    <script>

    </script>
@stop
