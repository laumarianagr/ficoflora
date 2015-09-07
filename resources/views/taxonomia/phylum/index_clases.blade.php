@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins\DataTables-1.10.7\css\dataTables.bootstrap.css')}}">
@stop

@section('content')


        @section('taxo-tipo')
            Phylum
        @stop

        @section('taxo-nombre')
            {{$taxonomia['phylum']}}
        @stop


        @section('listar')
            Clases
        @stop

        @section('pertenece')
            al Phylum
        @stop

        @section('taxo-listar')
            de la Clase
        @stop


        @section('content-tabla')
            @foreach($clases as $clase)
                <tr>
                    <td ></td>
                    <td class="perfil">
                        <a href="{{route('clase.subclases', [$clase['id']])}}">
                            <em>{{$clase['nombre']}}</em>
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
