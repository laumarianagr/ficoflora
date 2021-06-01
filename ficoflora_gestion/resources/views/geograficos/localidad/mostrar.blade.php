@extends('master')

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">

@stop
@section('titulo-seccion')
    Información de la Localidad
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="#"><span>Localidades</span></a></li>

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
                                    <span class="muted">localidad: </span><strong class="amount">{{$ubicacion['localidad']}}</strong>


                                </div>
                            </div>
                                @if($ubicacion['creador_id'] == $usuario->id || $usuario->perfil_id <=2)

                                <div class="summary-footer">
                                    <a href="{{route('localidad.editar', [$ubicacion['localidad_id']])}}"><i class="fa fa-pencil pr-xs"></i>Editar </a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </section>
        </div>


    </div>




    <div class="panel-group" id="accordion">

        <div class="panel panel-accordion tabla-mostrar-datos">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2One" aria-expanded="true">
                        Ubicación:
                    </a>
                </h4>
            </div>
            <div id="collapse2One" class="accordion-body collapse in" aria-expanded="true" style="">
                <div class="panel-body">

                    <table class="table table-striped">
                        <tr><td><h5><b>País:</b></h5> <a class="text-muted" href="{{route('pais.mostrar', [$ubicacion['pais_id']])}}">{{$ubicacion['pais']}} </a></td></tr>
                        <tr><td><h5><b>Entidad Federal:</b></h5> <a class="text-muted" href="{{route('entidad.mostrar', [$ubicacion['entidad_id']])}}">{{$ubicacion['entidad']}} </a></td></tr>
                        <tr><td><h5><b>Latitud:</b></h5> <a class="text-muted  " >{{$ubicacion['latitud']}} </a></td></tr>
                        <tr><td><h5><b>Longitud:</b></h5> <a class="text-muted" >{{$ubicacion['longitud']}} </a></td></tr>

                    </table>

                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-xs-12">

            <div class="panel">
                <div class="panel-body">

                    <div class=" mb-md tabla-mostrar-datos ">
                        <h4 class="">Lugares ubicados en la  localidad: </h4>
                    </div>
                    <h6 class="mt-md ">Número de lugares: <b>{{$total_lugares}}</b></h6>

                    <hr class="dotted short mb-lg mt-sm">


                    <table id="datatable_geografica"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="numeros-dataTabla">N°</th>
                            <th class="th-dataTable ">Nombre del Lugar</th>
                            <th class="th-dataTable especies-col">Especies</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($lugares as $lugar)
                            <tr>
                                <td ></td>

                                <td class="perfil">
                                    <a href="{{route('lugar.mostrar', [$lugar['id']])}}">{{$lugar['nombre']}}</a>
                                </td>

                                <td>
                                    <a class="action not-active" href="{{route('lugar.mostrar', [$lugar['id']])}}">{{$lugar['especies']}} </a>
                                </td>


                            </tr>
                        @endforeach
                        </tbody>

                    </table>


                </div>

            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-xs-12">

            <div class="panel">
                <div class="panel-body">

                    <div class=" mb-md tabla-mostrar-datos ">
                        <h4 class="">Especies reportadas en la Localidad: </h4>
                    </div>
                    <h6 class="mt-md ">Número de especies reportadas: <b>{{$total_especies}}</b></h6>

                    <hr class="dotted short mb-lg mt-sm">


                    <table id="datatable_especies"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="numeros-dataTabla">N°</th>
                            <th class="th-dataTable ">Nombre de la Especie</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($especies as $especie)
                            <tr>
                                <td ></td>

                                <td class="perfil">

                                    <a href="{{route('especie.mostrar', [$especie['id']])}}">
                                        <em>{{$especie['genero']}} {{$especie['especifico']}}</em>

                                        @if($especie['varietal'] != null)
                                            <em>var. {{$especie['varietal']}}</em>
                                        @endif

                                        @if($especie['forma'] != null)
                                            <em>f. {{$especie['forma']}}</em>
                                        @endif

                                        <span class="autores">{{$especie['autor']}}</span>

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

    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/datatable/geografica-datatable.js')}}'></script>

    <script>
        localStorage.setItem("menu", "m-registros");
    </script>
@stop


