@extends('master')

@section('title')

@stop


@section('titulo-seccion')
    Estadísticas de los epítetos varietales
@stop

@section('breadcrumbs')
    <li><a href="{{route('estadisticas.index')}}"><span>Estadísticas</span></a></li>
    <li><a href="{{route('estadisticas.especies')}}" ><span>Especies</span></a></li>
    <li><a ><span>Epítetos varietales</span></a></li>

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
                                <h3 class="text-dark mt-sm mb-none">Epítetos varietales registrados</h3>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 mt-lg">

            <h4 class="text-dark mt-none mb-lg">Epítetos varietales en más especies</h4>

            <div id="generos-chart"></div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-xl-10 col-xl-push-1 mt-xlg">
            <section class="panel">
                <header class="panel-heading  p-xs">


                    <h5 class="name pl-md"> Epítetos varietales registrados</h5>
                </header>
                <div class="panel-body">


                    <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="numeros">#</th>
                            <th class="perfil-col">Nombre del Epíteto Varietal</th>
                            <th class="perfil-col" style="width:120px;">N° de especies</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($varietales as $varietal)

                            <tr>
                                <td></td>
                                <td class="perfil"><a href="{{route('varietal.mostrar',$varietal['id'] )}}">{{$varietal['nombre']}}</a></td>
                                <td class="acciones-row">{{$varietal['especies']}}</td>

                                {{--<td class="acciones-row">--}}
                                {{--<a class="editar-row" data-toggle="tooltip" title="Editar" ><i class="fa fa-pencil"></i></a>--}}
                                {{--<a class="eliminar-row" data-toggle="tooltip" title="Eliminar" ><i class="fa fa-trash-o"></i></a>--}}
                                {{--<a href="{{url ('/perfiles',$perfil->tipo )}}" data-toggle="tooltip" title="Información" ><i class="fa fa-info-circle"></i></a>--}}
                                {{--</td>--}}



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
    <script>
        $('html').addClass('fixed sidebar-left-collapsed');


        var table = $('#datatable').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ filas por página",
                "search": "Buscar",
                "zeroRecords": "Disculpe, no se encontró ninguno.",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Siguiente"
                }
            },
            "columnDefs": [
                //{ "width": "50%", "targets": 5 },

                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                },

            ],
            "order": [[ 1, 'asc' ]]
        });

        //Numeracion de filas de la tabla
        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

        var generos =<?php echo json_encode($mas_usados); ?>;



        var chart = c3.generate({
            bindto: '#generos-chart',
            data: {
                json:
                        generos
                ,
                keys: {
                    x: 'nombre',
                    value: ['especies']
                },
                labels: {
                    show: true
                },
                type : 'bar',
                names: {
                    especies: 'Número de especies'
                }

            },
            padding: {
                bottom: 20
            },
            axis: {
                x: {
                    type: 'category'
                },
                y: {
                    padding:{
                        top:1000

                    }

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
