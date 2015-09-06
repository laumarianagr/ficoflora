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
                                    Phylum: <strong class="amount"><em>{{$taxonomia['phylum']}}</em></strong>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>


        <div class="col-xs-12">


            <div class="panel">
                <div class="panel-body">

                    <h5 class="mt-md mb-xlg">Total de <b>Clases</b> que pertenecen al phylum <em><b class="text-primary">{{$taxonomia['phylum']}}</b></em>: <b>{{$total}}</b></h5>


                    <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="numeros-dataTabla">#</th>
                            <th class="th-dataTable">Nombre de la Clase</th>
                        </tr>
                        </thead>

                        <tbody>
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
