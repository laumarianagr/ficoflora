@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins\DataTables-1.10.7\css\dataTables.bootstrap.css')}}">
@stop

@section('content')


        @section('taxo-tipo')
            Subclase
        @stop

        @section('taxo-nombre')
            {{$taxonomia['subclase']}}
        @stop


        @section('taxo-superior')
            <span class="text-muted">Phylum:</span> <a class="text-primary" href="{{route('phylum.clases', [$taxonomia['phylum_id']])}}">{{$taxonomia['phylum']}} <i class="fa fa-angle-right text-muted"></i></a>
            <span class="text-muted">Clase:</span> <a class="text-primary" href="{{route('clase.subclases', [$taxonomia['clase_id']])}}">{{$taxonomia['clase']}} </a>
        @stop


        @section('listar')
            Ordenes
        @stop

        @section('pertenece')
            a la Subclase
        @stop

        @section('taxo-listar')
            del Orden
        @stop


        @section('content-tabla')
            @foreach($ordenes as $orden)
                <tr>
                    <td ></td>
                    <td class="perfil">
                        <a href="{{route('orden.familias', [$orden['id']])}}">
                            <em>{{$orden['nombre']}}</em>
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
