@extends('master')

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">

@stop
@section('titulo-seccion')
    Información de la Familia
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="#"><span>Familias</span></a></li>

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
                                    <span class="muted">Familia:</span> <strong class="amount"><em>{{$familia['familia']}}</em></strong>


                                </div>
                            </div>
                            @if($usuario->perfil_id <=3)

                                <div class="summary-footer">
                                    <a class="" href="{{route('usuario.familias')}}"><i class="fa fa-user pr-xs"></i>Mis familias</a>

                                    @if($familia['creador_id'] == $usuario->id || $usuario->perfil_id <=2)
                                    | <a href="{{route('familia.editar', [$familia['familia_id']])}}"><i class="fa fa-pencil pr-xs"></i>Editar </a>
                                    @endif
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
                        Árbol Taxonómico:
                    </a>
                </h4>
            </div>
            <div id="collapse2One" class="accordion-body collapse in" aria-expanded="true" style="">
                <div class="panel-body">

                        <table class="table table-striped">
                            <tr><td><h5><b>Phylum::</b></h5> <a class="text-muted" href="{{route('phylum.mostrar', [$familia['phylum_id']])}}">{{$familia['phylum']}} </a></td></tr>
                            <tr><td><h5><b>Clase:</b></h5> <a class="text-muted" href="{{route('clase.mostrar', [$familia['clase_id']])}}">{{$familia['clase']}} </a></td></tr>

                            @if($familia['subclase'] != null)
                                <tr><td><h5><b>Sublclase:</b></h5> <a class="text-muted" href="{{route('subclase.mostrar', [$familia['subclase_id']])}}">{{$familia['subclase']}} </a></td></tr>
                            @endif

                            <tr><td><h5><b>Orden:</b></h5> <a class="text-muted" href="{{route('orden.mostrar', [$familia['orden_id']])}}">{{$familia['orden']}}  </a></td></tr>

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
                        <h4 class="">Géneros de la Familia: </h4>
                    </div>


                    <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="numeros-dataTabla">N°</th>
                            <th class="numeros-dataTabla">id</th>
                            <th class="th-dataTable ">Nombre del Género</th>
                            {{--<th class="th-dataTable acciones-col">Acciones</th>--}}
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($generos as $genero)

                            <tr>
                                <td></td>
                                <td></td>

                                <td class="perfil">
                                    <a href="{{route('genero.mostrar', [$genero->id])}}">
                                        <em>{{$genero->nombre}}</em>
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

    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/datatable/sin-acciones-datatable.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/registros/validate_taxonomia.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/registros/mis-registros/taxonomia/familias-usuario.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>

    <script>
        localStorage.setItem("menu", "m-registros");
    </script>
@stop


