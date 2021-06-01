@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
@stop

@section('content')

    @section('referencia-tipo')
        Referencias Bibliográficas - {{$tipo}}
    @stop

    @section('ruta-pdf')
        <a href="{{route('pdf.listado.libros')}}">
    @stop

    @section('listar')
        <h5 class="">Número de <b> {{$tipo}}</b> encontrados: <b>{{$total}}</b></h5>
    @stop

    @section('content-tabla')

        <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th class="numeros-dataTabla">N°</th>
                <th class="th-dataTable ">Referencia @yield('referencia-listar')</th>
            </tr>
            </thead>

            <tbody>
            @foreach($referencias as $referencia)
                <tr>
                    <td ></td>

                    <td class="perfil">
                        <!-- se construye la referencia bibliográfica según formato de Libro -->
                        @include('listados.referencias._parciales._referenciasListados')
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    @stop

    @include('listados.referencias._index')
@stop

@section('script_section')
    @parent

    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/busquedas/dataTable_resultados.js')}}'></script>

@stop
