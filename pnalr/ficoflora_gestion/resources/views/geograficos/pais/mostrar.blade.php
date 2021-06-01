@extends('master')

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">

@stop
@section('titulo-seccion')
    Información de la País
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="#"><span>País</span></a></li>

@stop


@section('content')

    <div class="row">
        <div class="col-md-12 mostrar-cabecera">
            <section class="panel panel-featured-left panel-featured-primary">
                <div class="panel-body">
                    <div class="widget-summary">

                        <div class="widget-summary-col">


                            <div class="summary mb-sm">

                                <div class="info">
                                    <span class="muted">país: </span><strong class="amount">{{$ubicacion['pais']}}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>


    </div>




    <div class="row">
        <div class="col-xs-12">

            <div class="panel">
                <div class="panel-body">

                    <div class=" mb-md tabla-mostrar-datos ">
                        <h4 class="">Entidades Federales de la país: </h4>
                    </div>
                    <h6 class="mt-md ">Número de Entidades Federales: <b>{{$total}}</b></h6>

                    <hr class="dotted short mb-lg mt-sm">


                    <table id="datatable_geografica"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="numeros-dataTabla">N°</th>
                            <th class="th-dataTable ">Nombre de la Entidad Federal</th>
                            <th class="th-dataTable especies-col">Especies</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($entidades as $entidad)
                            <tr>
                                <td ></td>

                                <td class="perfil">
                                    <a href="{{route('entidad.mostrar', [$entidad['id']])}}">{{$entidad['nombre']}}</a>
                                </td>

                                <td>
                                    <a class="action not-active" href="{{route('entidad.mostrar', [$entidad['id']])}}">{{$entidad['especies']}} </a>
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
    <script type='text/javascript' src='{{ asset('js/datatable/geografica-datatable.js')}}'></script>

    <script>
        localStorage.setItem("menu", "m-registros");
    </script>
@stop


