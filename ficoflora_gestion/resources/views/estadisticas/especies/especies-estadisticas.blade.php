@extends('master')

@section('titulo-seccion')
    Estadísticas de las especies
@stop

@section('breadcrumbs')
    <li><a href="{{route('estadisticas.index')}}"><span>Estadísticas</span></a></li>
    <li><a ><span>Especies</span></a></li>

@stop

@section('css_section')
    @parent
    <link rel="stylesheet"  href="{{asset('plugins/c3-master/c3.min.css')}}"/>


    <style>
        #especies_chart .c3-tooltip-container{
            left: 0px !important;
        }
    </style>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">

            <section class="panel panel-featured-bottom panel-featured-primary">
                <div class="panel-body">
                    <div class="widget-summary widget-summary-xlg">

                        <div class="widget-summary-col">
                            <div class="summary">
                                <div class="info">
                                    <strong class="amount fz-lg">{{$especies['total']}}</strong>
                                </div>
                                <h3 class="text-dark mt-sm mb-none">Especies registradas</h3>

                            </div>

                            <hr class="solid"/>

                        </div>
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="" id="especies_chart">

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="row">

            <div class="col-md-12">
                <section class="panel panel-featured-left panel-featured-primary">
                    <div class="panel-body">
                        <div class="widget-summary">

                            <div class="widget-summary-col">
                                <div class="summary mh-auto">
                                    <div class="info">
                                        <strong class="amount">{{$totales_catalogo['total']}}</strong> <h4 class="title dp-inline">{{$totales_catalogo['tipo']}}</h4>
                                    </div>
                                </div>

                                <div class="summary-footer">
                                    <a class="" href="{{route('estadisticas.'.$totales_catalogo['ruta'])}}"><i class="fa fa-bar-chart pr-xs"></i> Datos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        @foreach($totales as $elemento)
            <div class="col-sm-6 col-md-4">
                <section class="panel panel-featured-left panel-featured-primary">
                    <div class="panel-body">
                        <div class="widget-summary">

                            <div class="widget-summary-col">
                                <div class="summary mh-auto">
                                    <div class="info">
                                        <strong class="amount">{{$elemento['total']}}</strong> <h4 class="title dp-inline">{{$elemento['tipo']}}</h4>
                                    </div>
                                </div>

                                <div class="summary-footer">
                                    <a class="" href="{{route('estadisticas.'.$elemento['ruta'])}}"><i class="fa fa-bar-chart pr-xs"></i> Datos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        @endforeach

        @foreach($totales_epitetos as $elemento)
            <div class="col-sm-4 col-md-3">
                <section class="panel panel-featured-left panel-featured-primary">
                    <div class="panel-body">
                        <div class="widget-summary">

                            <div class="widget-summary-col">
                                <div class="summary mh-auto">
                                    <div class="info">
                                        <strong class="amount">{{$elemento['total']}}</strong> <h4 class="title dp-inline">{{$elemento['tipo']}}</h4>
                                    </div>


                                </div>
                                <div class="summary-footer">
                                    <a class="" href="{{route('estadisticas.'.$elemento['ruta'])}}"><i class="fa fa-bar-chart pr-xs"></i> Datos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        @endforeach
    </div>
@stop

@section('script_section')
    @parent

    <script type='text/javascript' src='{{ asset('plugins/d3-master/d3.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/c3-master/c3.min.js')}}'></script>

    <script>
        $('html').addClass('fixed sidebar-left-collapsed');

        var especies =<?php echo json_encode($especies); ?>;

        var especies_chart = c3.generate({
            bindto: '#especies_chart',
            data: {
                // iris data from R
                columns: [
                    ['c', especies['catalogo']],
                    ['nc', especies['no_catalogo']],
                ],
                type : 'bar',
                labels: {
                    show: true
                },
                names: {
                    c: 'Especies catalogadas',
                    nc: 'Especies sin catalogar',
                }
            },

            bar: {
                label: {
                    show:false
//                    format: function (value, ratio, id) {
//                        return d3.format()(value);
//                    }
                }
            },
            tooltip: {
//                format: {
//                    value: function (value, ratio, id) {
//                        return d3.format('')(value);
//                    }
//                }
                show:false
            },
            size: {
                height: 100,
                width: 350
            },
            legend: {
                position: 'right'
            },


        });


    </script>
    <script>
        localStorage.setItem("menu", "m-estadisticas");
    </script>
@stop
