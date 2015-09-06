@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins\DataTables-1.10.7\css\dataTables.bootstrap.css')}}">
@stop

@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <section class="panel panel-featured-bottom panel-featured-primary">
                <div class="panel-body">
                    <div class="widget-summary">

                        <div class="widget-summary-col">
                            <div class="summary mb-sm">
                                <div class="info">
                                    Familia: <strong class="amount"><em>{{$taxonomia['familia']}}</em></strong>

                                </div>
                            </div>
                            <div class="summary-footer">
                                <span class="text-muted">Phylum:</span> <a class="text-primary" href="{{route('phylum.clases', [$taxonomia['phylum_id']])}}">{{$taxonomia['phylum']}} <i class="fa fa-angle-right text-muted"></i></a>
                                <span class="text-muted">Clase:</span> <a class="text-primary" href="{{route('clase.subclases', [$taxonomia['clase_id']])}}">{{$taxonomia['clase']}} <i class="fa fa-angle-right text-muted"></i></a>
                                @if($taxonomia['subclase'] != null)
                                    <span class="text-muted">Sublclase:</span> <a class="text-primary" href="{{route('subclase.ordenes', [$taxonomia['subclase_id']])}}">{{$taxonomia['subclase']}} <i class="fa fa-angle-right text-muted"></i></a>
                                @endif
                                <span class="text-muted">Orden:</span> <a class="text-primary" href="{{route('orden.familias', [$taxonomia['orden_id']])}}">{{$taxonomia['orden']}}</a>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>


        <div class="col-xs-12">


            <div class="panel">
                <div class="panel-body">

                    <h5 class="mt-md mb-xlg">Total de <b>Géneros</b> que pertenecen a la familia <em><b class="text-primary">{{$taxonomia['familia']}}</b></em>: <b>{{$total}}</b></h5>


                    <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="numeros-dataTabla">#</th>
                            <th class="th-dataTable">Nombre del Género</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($generos as $genero)

                            <tr>
                                <td ></td>

                                <td class="perfil">

                                    <a href="{{route('genero.especies', [$genero['id']])}}">
                                        <em>{{$genero['nombre']}}</em>
                                    </a>
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


    <script type='text/javascript' src='{{ asset('plugins\DataTables-1.10.7\js\jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins\DataTables-1.10.7\js\dataTables.bootstrap.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/busquedas/dataTable_resultados.js')}}'></script>
    <script>

    </script>
@stop
