@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins\DataTables-1.10.7\css\dataTables.bootstrap.css')}}">
@stop

@section('content')

@section('taxo-tipo')
    Sinonimia
@stop


        @section('taxo-nombre')
            {{$sinonimia['nombre']}}

        @stop
        @section('taxo-autor')
            <a href="{{route('autor.especies', [$sinonimia['autor_id']])}}" class="text-primary">{{$sinonimia['autor']}}</a>

        @stop

        @section('ruta-pdf')
            <a href="{{route('pdf.sinonimia.especies', [$sinonimia['id']])}}">
        @stop

        @section('taxo-superior')

         @stop

        @section('listar')
            Número de <b>especies</b> con nombres válidos reportadas como <em><b class="text-primary">{{$sinonimia['nombre']}}</b></em>:
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
