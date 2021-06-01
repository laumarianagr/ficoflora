@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
@stop

@section('content')

    @section('referencia-tipo')
        Referencias Bibliográficas
    @stop

    @section('ruta-pdf')
        <a href="{{route('pdf.listado.referencias')}}">
    @stop

    @section('listar')
        <h5 class="">
            Número de <b>Referencias Bibliográficas</b> encontradas:  <b>{{$total}}</b> <br /><br />
            @if($totalR>0) Artículos en revistas: <b>{{$totalR}}</b>, @endif
            @if($totalL>0) Libros: <b>{{$totalL}}</b>, @endif
            @if($totalC>0) Catálogos: <b>{{$totalC}}</b>, @endif
            @if($totalT>0) Trabajos Académicos <b>{{$totalT}}</b>, @endif
            @if($totalE>0) Sitios Web: <b>{{$totalE}}</b>@endif
        </h5>
    @stop

    @section('content-tabla')

        <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th class="numeros-dataTabla">N°</th>
                <th class="th-dataTable ">Referencia @yield('referencia-listar')</th>
                <th class="th-dataTable ">Tipo</th>
            </tr>
            </thead>

            <tbody>

            @foreach($referencias as $referencia)
                <tr>
                    <td ></td>
                    <td class="perfil">

                        <!-- se construye el listado de todas las referencias bibliográficas -->
                        @include('listados.referencias._parciales._referenciasListados')

                    </td>
                    <td >{{$referencia->c12}}</td>  <!-- comentario -->
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
