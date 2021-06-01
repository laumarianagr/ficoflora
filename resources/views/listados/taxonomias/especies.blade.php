@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
@stop

@section('content')


@section('taxo-nombre'){{$taxonomia}}@stop


@section('listar')
    Número de <b>{{$taxonomia}}</b>:
@stop

    <div class="row">

        <div class="col-md-12 ">
            <section class="panel panel-featured-bottom panel-featured-primary">
                <div class="panel-body">
                    <div class="widget-summary">

                        <div class="widget-summary-col">
                            <div class="pdf-img">
                                <a href="{{route('pdf.listado.especies')}}">

                                <img src="{{ asset('img/pdf.png')}}" class="" alt="Exportar">
                                </a>
                            </div>
                            <div class="summary mb-sm">
                                <div class="info">
                                    <b class="amount">@yield('taxo-nombre')</b>
                                </div>
                            </div>
                            <div class="summary-footer">
                                @yield('taxo-superior')
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-xs-12">


            <div class="panel">
                <div class="panel-body">
                    <div class="row mb-sm">
                        <div class="col-md-8">
                            <h5 class="">Número de <b>especies, subespecies, variedades y formas</b> encontrados: <b>{{$total}}</b></h5>
                        </div>
                        <div class="col-md-4 nueva-busqueda">
                            <a class="dp-in-b" href="{{route('buscar.index')}}"><i class="fa fa-search"></i>Nueva búsqueda</a>
                        </div>
                    </div>
                    <hr class="dotted short mb-lg">

                    <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="numeros-dataTabla">N°</th>
                            <th class="th-dataTable ">Nombre</th>
                            <th class="estatus th-dataTable">Estatus nombre</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($especies as $especie)

                            <tr>
                                <td ></td>

                                <td class="perfil">

                                    <a href="{{route($especie->tipo.'.index',[$especie->id])}}">
                                        <em>{{$especie->genero}} {{$especie->especifico}}</em>

                                        @if($especie->subespecie != null)
                                            <em>subsp. {{$especie->subespecie}}</em>
                                        @endif

                                        @if($especie->varietal != null)
                                            <em>var. {{$especie->varietal}}</em>
                                        @endif

                                        @if($especie->forma != null)
                                            <em>f. {{$especie->forma}}</em>
                                        @endif

                                        <span class="autores">{{$especie->autor}}</span>

                                    </a>
                                </td>

                                <td class="perfil ">
                                    @if($especie->tipo == "especie")
                                        Válido
                                    @else
                                        Sinónimo
                                    @endif
                                </td>



                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>

            </div>
        </div>
    </div>

@stop


        @section('script_section')
            @parent


            <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
            <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>

            <script type='text/javascript' src='{{ asset('js/busquedas/dataTable_resultados.js')}}'></script>
            <script>

            </script>
@stop
