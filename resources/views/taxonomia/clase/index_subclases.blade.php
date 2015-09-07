@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins\DataTables-1.10.7\css\dataTables.bootstrap.css')}}">
@stop

@section('content')



        @section('taxo-tipo')
            Clase
        @stop

        @section('taxo-nombre')
            {{$taxonomia['clase']}}
        @stop


        @section('taxo-superior')
            <span class="text-muted">Phylum:</span> <a class="text-primary" href="{{route('phylum.clases', [$taxonomia['phylum_id']])}}">{{$taxonomia['phylum']}}</a>
        @stop


        @section('listar')
            Subclases
        @stop

        @section('pertenece')
            a la Clase
        @stop

        @section('taxo-listar')
            de la Subclase
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

            @if($subclases->count() == 0)
                <tr>
                    <td></td>
                    <td>
                        <p>La Clase no posee subclases, buscar ordenes que pertenezcan a la clase: <a class="dp-inline text-primary" href="{{route('clase.ordenes', [$taxonomia['clase_id']])}}">Buscar</a></p>
                    </td>
                </tr>
            @endif
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
