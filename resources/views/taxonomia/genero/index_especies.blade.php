@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins\DataTables-1.10.7\css\dataTables.bootstrap.css')}}">
@stop

@section('content')

    @section('taxo-tipo')
        Género
    @stop

    @section('ruta-pdf')
        <a href="{{route('pdf.genero.especies', [$taxonomia['genero_id']])}}">
    @stop

    @section('taxo-nombre')
        {{$taxonomia['genero']}}
    @stop


    @section('taxo-superior')
        <span class="text-muted">Phylum:</span> <a class="text-primary" href="{{route('phylum.clases', [$taxonomia['phylum_id']])}}">{{$taxonomia['phylum']}} <i class="fa fa-angle-right text-muted"></i></a>
        <span class="text-muted">Clase:</span> <a class="text-primary" href="{{route('clase.subclases', [$taxonomia['clase_id']])}}">{{$taxonomia['clase']}} <i class="fa fa-angle-right text-muted"></i></a>
        @if($taxonomia['subclase'] != null)
            <span class="text-muted">Sublclase:</span> <a class="text-primary" href="{{route('subclase.ordenes', [$taxonomia['subclase_id']])}}">{{$taxonomia['subclase']}} <i class="fa fa-angle-right text-muted"></i></a>
        @endif
        <span class="text-muted">Orden:</span> <a class="text-primary" href="{{route('orden.familias', [$taxonomia['orden_id']])}}">{{$taxonomia['orden']}} <i class="fa fa-angle-right text-muted"></i></a>
        <span class="text-muted">Familia:</span> <a class="text-primary" href="{{route('familia.generos', [$taxonomia['familia_id']])}}">{{$taxonomia['familia']}}</a>
    @stop


    @section('listar')
        Número de <b>especies</b> reportadas para el género <b class="text-primary">{{$taxonomia['genero']}}</b>:
    @stop

    @section('taxo-listar')
       de la Especie
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


@include('resultados._index-resultados-especies-taxo')


@stop

@section('script_section')
    @parent


    <script type='text/javascript' src='{{ asset('plugins\DataTables-1.10.7\js\jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins\DataTables-1.10.7\js\dataTables.bootstrap.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/busquedas/dataTable_resultados.js')}}'></script>
    <script>

    </script>
@stop
