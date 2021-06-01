@extends('master')


@section('titulo-seccion')
    Estadísticas de los Lugares
@stop

@section('breadcrumbs')
    <li><a href="{{route('estadisticas.index')}}"><span>Estadísticas</span></a></li>
    <li><a href="{{route('estadisticas.geograficas')}}" ><span>Geográficas</span></a></li><li><a ><span>Lugares</span></a></li>

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet"  href="{{asset('plugins/c3-master/c3.min.css')}}"/>


@stop

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section class="panel panel-featured-bottom panel-featured-primary">
                <div class="panel-body">
                    <div class="widget-summary ">

                        <div class="widget-summary-col">
                            <div class="summary">
                                <div class="info">
                                    <strong class="amount fz-lg" >{{$total}}</strong>
                                    {{--<span class="text-primary">(14 unread)</span>--}}
                                </div><h3 class="text-dark mt-sm mb-none">Lugares registradas</h3>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 mt-lg">
            <h4 class="text-dark mt-none mb-lg">Lugares con  más reportes de especies</h4>

            <div id="lugares-chart"></div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-xl-10 col-xl-push-1 mt-xlg">
            <section class="panel">
                <header class="panel-heading p-xs">

                    <h5 class="name pl-md"> Lugares registrados</h5>
                </header>
                <div class="panel-body">

                    <table id="datatable_geografica"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="numeros">#</th>
                            <th class="perfil-col">Nombre de la Localidad</th>
                            <th class="perfil-col" style="width:120px;">N° de especies</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($lugares as $lugar)

                            <tr>
                                <td></td>
                                <td class="perfil"><a href="{{route('lugar.mostrar',$lugar['id'] )}}">{{$lugar['nombre']}}</a></td>
                                <td class="acciones-row">{{$lugar['especies']}}</td>
                            </tr>

                        @endforeach
                        </tbody>

                    </table>

                </div>
            </section>
        </div>
    </div>

@stop

@section('script_section')
    @parent
            <!-- Plugin para tabla y paginacion -->
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/d3-master/d3.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/c3-master/c3.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/datatable/geografica-datatable.js')}}'></script>

    <script>
        $('html').addClass('fixed sidebar-left-collapsed');



        var lugares =<?php echo json_encode($mas_usados); ?>;

        var chart = c3.generate({
            bindto: '#lugares-chart',
            data: {
                json:
                        lugares
                ,
                keys: {
                    x: 'nombre',
                    value: ['especies'],
                },
                labels: {
                    show: true
                },
                type : 'bar',
                names: {
                    especies: 'Número de especies en la lugar',
                },

            },

            padding: {
                bottom: 20,
            },
            axis: {
                x: {
                    type: 'category',
                }
            },
            tooltip: {
                format: {
                    value: function (value, ratio, id) {
                        return d3.format('')(value);
                    }
                }
            }
        });



    </script>
    <script>
        localStorage.setItem("menu", "m-estadisticas");
    </script>
@stop
