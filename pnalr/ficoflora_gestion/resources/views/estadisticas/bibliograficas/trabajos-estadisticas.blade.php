@extends('master')


@section('titulo-seccion')
    Estadísticas de los Trabajos Académicos
@stop

@section('breadcrumbs')
    <li><a href="{{route('estadisticas.index')}}"><span>Estadísticas</span></a></li>
    <li><a href="{{route('estadisticas.bibliograficas')}}" ><span>Bibliográficas</span></a></li>
    <li><a ><span>Trabajos académicos</span></a></li>

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
                                </div>
                                <h3 class="text-dark mt-sm mb-none">Trabajos académicos registrados</h3>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 mt-lg">

            <h4 class="text-dark mt-none mb-lg">Trabajos académicos con más registros</h4>

            <div id="trabajos-chart"></div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-xl-10 col-xl-push-1 mt-xlg">
            <section class="panel">
                <header class="panel-heading  p-xs">


                    <h5 class="name pl-md"> Trabajos registrados</h5>
                </header>
                <div class="panel-body">

                    <table id="datatable_geografica"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="numeros">#</th>
                            <th class="perfil-col">Cita</th>
                            <th class="perfil-col">Autores</th>
                            <th class="perfil-col">Título</th>
                            <th class="perfil-col">Año</th>
                            <th class="perfil-col" style="width:120px;">N° de registros</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($trabajos as $trabajo)

                            <tr>
                                <td></td>
                                <td class="perfil"><a href="{{route('trabajo.mostrar',$trabajo['id'] )}}">({{$trabajo['cita']}})</a></td>
                                <td class="perfil">{{$trabajo['autores']}}</td>
                                <td class="perfil">{{$trabajo['titulo']}}</td>
                                <td class="perfil">{{$trabajo['fecha']}}</td>
                                <td class="acciones-row">{{$trabajo['registros']}}</td>
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



        var trabajos =<?php echo json_encode($mas_usados); ?>;

        var chart = c3.generate({
            bindto: '#trabajos-chart',
            data: {
                json:
                        trabajos
                ,
                keys: {
                    x: 'cita',
                    value: ['registros'],
                },
                labels: {
                    show: true
                },
                type : 'bar',
                names: {
                    registros: 'Número de registros',
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
