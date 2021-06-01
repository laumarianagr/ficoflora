@extends('master')

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">

@stop
@section('titulo-seccion')
    Información del Género
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="#"><span>Géneros</span></a></li>

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
                                    <span class="muted">Género:</span> <strong class="amount"><em>{{$genero['genero']}}</em></strong>


                                </div>
                            </div>
                                <div class="summary-footer">
                                    <a class="" href="{{route('usuario.generos')}}"><i class="fa fa-user pr-xs"></i>Mis géneros</a>

                                    @if($genero['creador_id'] == $usuario->id || $usuario->perfil_id <=2)
                                        | <a href="{{route('genero.editar', [$genero['genero_id']])}}"><i class="fa fa-pencil pr-xs"></i>Editar </a>
                                    @endif
                                </div>

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


                    @if(!$genero['sinonimia'])
                    <table class="table table-striped">
                        <tr><td><h5><b>Phylum::</b></h5> <a class="text-muted" href="{{route('phylum.mostrar', [$genero['phylum_id']])}}">{{$genero['phylum']}} </a></td></tr>
                        <tr><td><h5><b>Clase:</b></h5> <a class="text-muted" href="{{route('clase.mostrar', [$genero['clase_id']])}}">{{$genero['clase']}} </a></td></tr>

                        @if($genero['subclase'] != null)
                            <tr><td><h5><b>Sublclase:</b></h5> <a class="text-muted" href="{{route('subclase.mostrar', [$genero['subclase_id']])}}">{{$genero['subclase']}} </a></td></tr>
                        @endif

                        <tr><td><h5><b>Orden:</b></h5> <a class="text-muted" href="{{route('orden.mostrar', [$genero['orden_id']])}}">{{$genero['orden']}}  </a></td></tr>


                        <tr><td><h5><b>Familia:</b></h5> <a class="text-muted" href="{{route('familia.mostrar', [$genero['familia_id']])}}">{{$genero['familia']}}</a> </td></tr>


                    </table>
                        @else
                    <h5>El género fue registrado por el ingreso de una sinonimia, no se tiene información de su árbol taxonómico</h5>

                    @endif
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12">

            <div class="panel">
                <div class="panel-body">

                    <div class=" mb-md tabla-mostrar-datos ">
                        <h4 class="">Especies del Género: </h4>
                    </div>
                    <h6 class="mt-md ">Número de especies: <b>{{$total}}</b></h6>

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

    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/datatable/sin-acciones-datatable.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/registros/validate_taxonomia.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/registros/mis-registros/taxonomia/generos-usuario.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>
    <script>
        localStorage.setItem("menu", "m-registros");
    </script>
    <script>

        var select = $("#select_sinonimia").select2({
            placeholder: "Seleccione una opción",
            allowClear: true
        });

        $('.agregar-sinonimia').on('click', function(){
            select.val(null).trigger("change")

        });




    </script>
@stop


