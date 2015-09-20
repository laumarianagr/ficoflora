@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins\DataTables-1.10.7\css\dataTables.bootstrap.css')}}">
@stop

@section('content')

    @section('ubicacion-tipo')
        Entidad federal
    @stop


    @section('ruta-pdf')
        <a href="{{route('pdf.entidad.especies', [$ubicacion['entidad_id']])}}">
    @stop

    @section('ubicacion-nombre')
        {{$ubicacion['entidad']}}
    @stop


    @section('ubicacion-superior')
        <span class="text-muted">Pais:</span> <a class="text-primary" href="{{route('pais.entidades', 'venezuela')}}">{{$ubicacion['pais']}} </a>
    @stop


    @section('pertenece')
        la entidad federal
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
