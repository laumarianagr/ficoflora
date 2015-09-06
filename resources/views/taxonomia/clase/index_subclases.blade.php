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
                                    Clase: <strong class="amount"><em>{{$taxonomia['clase']}}</em></strong>

                                </div>
                            </div>
                            <div class="summary-footer">
                                <span class="text-muted">Phylum:</span> <a class="text-primary" href="{{route('phylum.clases', [$taxonomia['phylum_id']])}}">{{$taxonomia['phylum']}} </a>


                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>


        <div class="col-xs-12">


            <div class="panel">
                <div class="panel-body">

                    <h5 class="mt-md mb-xlg">Total de <b>Subclases</b> que pertenecen a la clase <em><b class="text-primary">{{$taxonomia['clase']}}</b></em>: <b>{{$total}}</b></h5>


                    <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="numeros-dataTabla">#</th>
                            <th class="th-dataTable">Nombre de la Subclase</th>
                        </tr>
                        </thead>

                        <tbody>
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
