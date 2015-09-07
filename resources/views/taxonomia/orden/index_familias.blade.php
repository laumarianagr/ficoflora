@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins\DataTables-1.10.7\css\dataTables.bootstrap.css')}}">
@stop

@section('content')


        @section('taxo-tipo')
            Orden
        @stop

        @section('taxo-nombre')
            {{$taxonomia['orden']}}
        @stop


        @section('taxo-superior')
            <span class="text-muted">Phylum:</span> <a class="text-primary" href="{{route('phylum.clases', [$taxonomia['phylum_id']])}}">{{$taxonomia['phylum']}} <i class="fa fa-angle-right text-muted"></i></a>
            <span class="text-muted">Clase:</span> <a class="text-primary" href="{{route('clase.subclases', [$taxonomia['clase_id']])}}">{{$taxonomia['clase']}}</a>
            @if($taxonomia['subclase'] != null)
                <i class="fa fa-angle-right text-muted"></i> <span class="text-muted">Sublclase:</span> <a class="text-primary" href="{{route('subclase.ordenes', [$taxonomia['subclase_id']])}}">{{$taxonomia['subclase']}}</a>
            @endif
        @stop


        @section('listar')
            Familias
        @stop

        @section('pertenece')
            al Orden
        @stop

        @section('taxo-listar')
            de la Familia
        @stop


        @section('content-tabla')
            @foreach($familias as $familia)
                <tr>
                    <td ></td>
                    <td class="perfil">
                        <a href="{{route('familia.generos', [$familia['id']])}}">
                            <em>{{$familia['nombre']}}</em>
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
