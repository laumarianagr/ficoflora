@extends('master')

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">

@stop
@section('titulo-seccion')
    Información del Epíteto Forma
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="#"><span>Epíteto Formas</span></a></li>

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
                                    <span class="muted">Epíteto Forma:</span> <strong class="amount"><em>{{$forma['nombre']}}</em></strong>
                                </div>
                            </div>

                                @if($usuario->perfil_id <=3)
                                <div class="summary-footer">

                                    <a class="" href="{{route('usuario.formas')}}"><i class="fa fa-user pr-xs"></i>Mis formas</a>
                                @if($forma['creador_id'] == $usuario->id || $usuario->perfil_id <=2)

                                       | <a href="{{route('forma.editar', [$forma['id']])}}"><i class="fa fa-pencil pr-xs"></i>Editar </a>
                                    @endif
                                </div>
                            @endif

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
                        <h4 class="">Formas donde está presente el epíteto: </h4>
                    </div>
                    <h6 class="mt-md ">Número de formas: <b>{{$total}}</b></h6>

                    <hr class="dotted short mb-lg mt-sm">

                    <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="numeros-dataTabla">N°</th>
                            <th class="numeros-dataTabla">id</th>
                            <th class="th-dataTable ">Nombre de la Especie</th>
                            {{--<th class="th-dataTable acciones-col">Acciones</th>--}}
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($especies as $especie)

                            <tr>
                                <td></td>
                                <td></td>

                                <td class="perfil">
                                    <a href="{{route('especie.mostrar', [$especie['id']])}}">
                                        <em>{{$especie['nombre']}}</em> <span class="autores">{{$especie['autor']}}</span>
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
    <script type='text/javascript' src='{{ asset('js/datatable/sin-acciones-datatable.js')}}'></script>

    <script>
        localStorage.setItem("menu", "m-registros");
    </script>
@stop


