@extends('master')

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">

@stop
@section('titulo-seccion')
    Información del Registro
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="#"><span>Registros del Catálogo</span></a></li>

@stop

{{--modal eliminar--}}
@section('registro-eliminar')
    el reporte?
@stop
@section('content')
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <div class="row">
        <div class="col-md-12 ">
            <section class="panel panel-featured-left panel-featured-primary">
                <div class="panel-body pt-xs pb-xs">
                    <div class="widget-summary">

                        <div class="widget-summary-col">

                            {{--<h4>Reporte</h4>--}}
                            {{--<div class="summary-footer">--}}
                            {{--<a href="{{route('especie.editar', [$especie['id']])}}"><i class="fa fa-pencil pr-xs"></i>Editar </a>--}}
                            {{--</div>--}}
                            <div class="summary mb-sm">

                                <div class="info">
                                    <span class="muted">Especie:</span>
                                    <strong class="amount"><em>{{$especie['nombre']}}</em></strong> <a href="{{route('autor.mostrar', [$especie['autor_id']])}}" class="text-primary">{{$especie['autor']}}</a>
                                    <br/>
                                    <span class="muted pt-md dp-iblock ">Cita:</span>
                                    <strong class="amount  pt-md dp-iblock">{{$referencia->cita}}, {{$referencia->fecha}}{{$referencia->letra}}</strong>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </section>
        </div>


        <div class="col-xs-12">
            <div class="panel-group" id="accordion">
                <div class="panel panel-accordion tabla-mostrar-datos">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse1One" aria-expanded="true">
                                Información de la Especie:
                            </a>
                        </h4>
                    </div>
                    <div id="collapse1One" class="accordion-body collapse" aria-expanded="true" style="">
                        <div class="panel-body">

                            <h6>Consultar especie <a href="{{route('especie.mostrar', [$especie['id']])}}"><i class="fa fa-info-circle"></i></a> </h6>

                            <table class="table table-striped">
                                <tr><td><h5><b>Phylum:</b></h5> <a class="text-muted" href="{{route('phylum.mostrar', [$especie['phylum_id']])}}">{{$especie['phylum']}} </a></td></tr>
                                <tr><td><h5><b>Clase:</b></h5> <a class="text-muted" href="{{route('clase.mostrar', [$especie['clase_id']])}}">{{$especie['clase']}} </a></td></tr>

                                @if($especie['subclase'] != null)
                                    <tr><td><h5><b>Sublclase:</b></h5> <a class="text-muted" href="{{route('subclase.mostrar', [$especie['subclase_id']])}}">{{$especie['subclase']}} </a></td></tr>
                                @endif

                                <tr><td><h5><b>Orden:</b></h5> <a class="text-muted" href="{{route('orden.mostrar', [$especie['orden_id']])}}">{{$especie['orden']}}  </a></td></tr>


                                <tr><td><h5><b>Familia:</b></h5> <a class="text-muted" href="{{route('familia.mostrar', [$especie['familia_id']])}}">{{$especie['familia']}}</a> </td></tr>

                                <tr><td><h5><b>Género:</b></h5> <a class="text-muted" href="{{route('genero.mostrar', [$especie['genero_id']])}}">{{$especie['genero']}}</a></td></tr>
                                <tr><td><h5><b>Epíteto Específico:</b></h5> <a class="text-muted">{{$especie['especifico']}}</a></td></tr>

                                @if($especie['varietal'] != null)
                                    <tr><td><h5><b>Epíteto Varietal:</b></h5> <a class="text-muted" >{{$especie['varietal']}}</a></td></tr>
                                @endif

                                @if($especie['forma'] != null)
                                    <tr><td><h5><b>Epíteto Forma:</b></h5> <a class="text-muted">{{$especie['forma']}} </a> </td></tr>
                                @endif

                                @if($especie['subespecie'] != null)
                                    <tr><td><h5><b>Subespecie:</b></h5> <a class="text-muted">{{$especie['subespecie']}} </a> </td></tr>
                                @endif

                                <tr><td><h5><b>Autoridad:</b></h5> <a class="text-muted" href="{{route('autor.mostrar', [$especie['autor_id']])}}">{{$especie['autor']}}</a></td></tr>


                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel panel-accordion tabla-mostrar-datos">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2One" aria-expanded="true">
                                Información de la Referencia:
                            </a>
                        </h4>
                    </div>
                    <div id="collapse2One" class="accordion-body collapse" aria-expanded="true" style="">
                        <div class="panel-body">

                        @if($tipo == 'R')
                                <h6>Consultar referencia <a href="{{route('revista.mostrar', [$referencia->id])}}"><i class="fa fa-info-circle"></i></a> </h6>
                                <p class="text-md"><b>{{$referencia->autores}}. {{$referencia->fecha}}</b> {!! $texto !!}</p>


                                {{--<table class="table table-striped">--}}
                                    {{--<tr><td><h5><b>Tipo:</b></h5> REVISTA</td></tr>--}}
                                    {{--<tr><td><h5><b>Cita:</b></h5> {{$referencia->cita}}, {{$referencia->fecha}}{{$referencia->letra}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Autores:</b></h5> {{$referencia->autores}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Año:</b></h5> {{$referencia->fecha}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Título:</b></h5> {{$referencia->titulo}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Nombre:</b></h5> {{$referencia->nombre}}</td></tr>--}}

                                    {{--<tr><td><h5><b>Volumen:</b></h5> {{$referencia->volumen}}</td></tr>--}}

                                    {{--<tr><td><h5><b>Número:</b></h5> {{$referencia->numero}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Páginas:</b></h5> {{$referencia->intervalo}}</td></tr>--}}

                                    {{--<tr><td><h5><b>ISBN:</b></h5> {{$referencia->isbn}}</td></tr>--}}
                                    {{--<tr><td><h5><b>ISSN:</b></h5> {{$referencia->issn}}</td></tr>--}}
                                    {{--<tr><td><h5><b>DOI:</b></h5> {{$referencia->enlace}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Enlace:</b></h5> {{$referencia->archivo}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Archivo:</b></h5> {{$referencia->archivo}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Comentarios:</b></h5> {{$referencia->comentarios}}</td></tr>--}}
                                {{--</table>--}}
                            @endif

                            @if($tipo == 'L')
                                <h6>Consultar referencia <a href="{{route('libro.mostrar', [$referencia->id])}}"><i class="fa fa-info-circle"></i></a> </h6>
                                <p class="text-md"><b>{{$referencia->autores}}. {{$referencia->fecha}}</b> {!! $texto !!}</p>



                                {{--<table class="table table-striped">--}}
                                    {{--<tr><td><h5><b>Tipo:</b></h5> LIBRO</td></tr>--}}
                                    {{--<tr><td><h5><b>Cita:</b></h5> {{$referencia->cita}}, {{$referencia->fecha}}{{$referencia->letra}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Autores:</b></h5> {{$referencia->autores}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Año:</b></h5> {{$referencia->fecha}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Título:</b></h5> {{$referencia->titulo}}</td></tr>--}}

                                    {{--@if($referencia->editor != null)--}}
                                        {{--<tr><td><h5><b>Editor:</b></h5> {{$referencia->editor}}</td></tr>--}}
                                        {{--@if($referencia->capitulo != null)--}}
                                            {{--<tr><td><h5><b>Capítulo:</b></h5> {{$referencia->capitulo}}</td></tr>--}}
                                            {{--<tr><td><h5><b>Intervalo de páginas:</b></h5> {{$referencia->intervalo}}</td></tr>--}}
                                        {{--@endif--}}
                                    {{--@endif--}}

                                    {{--@if($referencia->edicion != null)--}}
                                    {{--<tr><td><h5><b>Edición:</b></h5> {{$referencia->editorial}}</td></tr>--}}
                                    {{--@endif--}}

                                    {{--@if($referencia->editorial != null)--}}
                                    {{--<tr><td><h5><b>Editorial:</b></h5> {{$referencia->editorial}}</td></tr>--}}
                                    {{--@endif--}}

                                    {{--<tr><td><h5><b>Lugar:</b></h5> {{$referencia->lugar}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Páginas:</b></h5> {{$referencia->paginas}}</td></tr>--}}
                                    {{--<tr><td><h5><b>ISBN:</b></h5> {{$referencia->isbn}}</td></tr>--}}
                                    {{--<tr><td><h5><b>DOI:</b></h5> {{$referencia->enlace}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Enlace:</b></h5> {{$referencia->archivo}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Archivo:</b></h5> {{$referencia->archivo}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Comentarios:</b></h5> {{$referencia->comentarios}}</td></tr>--}}


                                {{--</table>--}}
                            @endif

                            @if($tipo == 'T')
                                <h6>Consultar referencia <a href="{{route('trabajo.mostrar', [$referencia->id])}}"><i class="fa fa-info-circle"></i></a> </h6>
                                <p class="text-md"><b>{{$referencia->autores}}. {{$referencia->fecha}}</b> {!! $texto !!}</p>

                                {{--<table class="table table-striped">--}}

                                    {{--<tr><td><h5><b>Tipo:</b></h5> TRABAJO ACADÉMICO</td></tr>--}}

                                    {{--<tr><td><h5><b>Trabajo:</b></h5> {{$referencia->tipo}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Cita:</b></h5> {{$referencia->cita}}, {{$referencia->fecha}}{{$referencia->letra}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Autores:</b></h5> {{$referencia->autores}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Año:</b></h5> {{$referencia->fecha}}</td></tr>--}}

                                    {{--<tr><td><h5><b>Título:</b></h5> {{$referencia->titulo}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Institución:</b></h5> {{$referencia->institucion}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Lugar:</b></h5> {{$referencia->lugar}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Páginas:</b></h5> {{$referencia->paginas}}</td></tr>--}}

                                    {{--<tr><td><h5><b>Enlace:</b></h5> {{$referencia->archivo}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Archivo:</b></h5> {{$referencia->archivo}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Comentarios:</b></h5> {{$referencia->comentarios}}</td></tr>--}}
                                {{--</table>--}}
                            @endif


                            @if($tipo == 'E')
                                <h6>Consultar referencia <a href="{{route('enlace.mostrar', [$referencia->id])}}"><i class="fa fa-info-circle"></i></a> </h6>
                                <p class="text-md"><b></b> {!! $texto !!}</p>

                                {{--<table class="table table-striped">--}}

                                    {{--<tr><td><h5><b>Tipo:</b></h5> TRABAJO ACADÉMICO</td></tr>--}}

                                    {{--<tr><td><h5><b>Trabajo:</b></h5> {{$referencia->tipo}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Cita:</b></h5> {{$referencia->cita}}, {{$referencia->fecha}}{{$referencia->letra}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Autores:</b></h5> {{$referencia->autores}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Año:</b></h5> {{$referencia->fecha}}</td></tr>--}}

                                    {{--<tr><td><h5><b>Título:</b></h5> {{$referencia->titulo}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Institución:</b></h5> {{$referencia->institucion}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Lugar:</b></h5> {{$referencia->lugar}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Páginas:</b></h5> {{$referencia->paginas}}</td></tr>--}}

                                    {{--<tr><td><h5><b>Enlace:</b></h5> {{$referencia->archivo}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Archivo:</b></h5> {{$referencia->archivo}}</td></tr>--}}
                                    {{--<tr><td><h5><b>Comentarios:</b></h5> {{$referencia->comentarios}}</td></tr>--}}
                                {{--</table>--}}
                            @endif

                            @if($tipo == 'C')
                                <h6>Consultar referencia <a href="{{route('enlace.mostrar', [$referencia->id])}}"><i class="fa fa-info-circle"></i></a> </h6>
                                <p class="text-md"><b></b> {!! $texto !!}</p>

                                {{--<table class="table table-striped">--}}

                                {{--<tr><td><h5><b>Tipo:</b></h5> TRABAJO ACADÉMICO</td></tr>--}}

                                {{--<tr><td><h5><b>Trabajo:</b></h5> {{$referencia->tipo}}</td></tr>--}}
                                {{--<tr><td><h5><b>Cita:</b></h5> {{$referencia->cita}}, {{$referencia->fecha}}{{$referencia->letra}}</td></tr>--}}
                                {{--<tr><td><h5><b>Autores:</b></h5> {{$referencia->autores}}</td></tr>--}}
                                {{--<tr><td><h5><b>Año:</b></h5> {{$referencia->fecha}}</td></tr>--}}

                                {{--<tr><td><h5><b>Título:</b></h5> {{$referencia->titulo}}</td></tr>--}}
                                {{--<tr><td><h5><b>Institución:</b></h5> {{$referencia->institucion}}</td></tr>--}}
                                {{--<tr><td><h5><b>Lugar:</b></h5> {{$referencia->lugar}}</td></tr>--}}
                                {{--<tr><td><h5><b>Páginas:</b></h5> {{$referencia->paginas}}</td></tr>--}}

                                {{--<tr><td><h5><b>Enlace:</b></h5> {{$referencia->archivo}}</td></tr>--}}
                                {{--<tr><td><h5><b>Archivo:</b></h5> {{$referencia->archivo}}</td></tr>--}}
                                {{--<tr><td><h5><b>Comentarios:</b></h5> {{$referencia->comentarios}}</td></tr>--}}
                                {{--</table>--}}
                            @endif

                        </div>
                    </div>
                </div>

            </div>

        </div>
        @if(!@empty($registro->comentario))


        <div class="col-xs-12">

            <div class="panel">
                <div class="panel-body">

                    <div class=" mb-md tabla-mostrar-datos ">
                        <h4 class="">Comentario</h4>
                    </div>
                    
                    <p>{!!$registro->comentario!!}</p>
                </div>
            </div>
        </div>
        @endif

        <div class="col-xs-12">

            <div class="panel">
                <div class="panel-body">

                    <div class=" mb-md tabla-mostrar-datos ">
                        <h4 class="">Reportado en: </h4>
                    </div>
                    @if($permisos)
                    <a class="agregar modal-with-form btn btn-default" href="#modal-agregar-sinonimia-ubicacion"  id="crear-row" data-toggle="tooltip" title="Agregar" ><i class="fa fa-plus-circle"></i> Sinonimia y/o Ubicación</a>
                    <hr class="dotted short">
                    @endif
                    <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="numeros-dataTabla">N°</th>
                            <th class="numeros-dataTabla">id</th>
                            <th class="th-dataTable ">Reportado como</th>
                            <th class="th-dataTable ">Entidad Federal</th>
                            <th class="th-dataTable ">Localidad</th>
                            <th class="th-dataTable ">Lugar</th>
                            <th class="th-dataTable ">Sitio</th>
                            @if($permisos)
                             <th class="th-dataTable acciones-col">Acciones</th>
                                @endif
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($reportes_datos as $reporte)

                            <tr>
                                <td></td>
                                <td>{{$reporte->id}}</td>

                                <td class="perfil">
                                    @if($reporte->sinonimia_id != null)
                                    <a href="{{route('sinonimia.mostrar', [$reporte->sinonimia_id])}}">
                                        <span>{{$reporte->sinonimia}}</span>
                                    </a>
                                        @endif
                                </td>
                                <td>{{$reporte->entidad}}</td>
                                <td>{{$reporte->localidad}}</td>
                                <td>{{$reporte->lugar}}</td>
                                <td>{{$reporte->sitio}}</td>

                                @if($permisos)


                                <td id="{{$reporte->id}}" class="acciones-row">
                                    {{--<a class="actualizar dp-iblock" href="#modal-actualizar-sinonimia-ubicacion"  data-toggle="tooltip" title="Editar" ><i class="fa fa-pencil"></i></a>--}}

                                    <a class="eliminar-row  modal-with-zoom-anim dp-iblock" href="#modal-eliminar"  data-toggle="tooltip" title="Eliminar reporte" ><i class="fa fa-trash-o"></i></a>
                                </td>
                                    @endif

                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </div>


    {{--Modal Eliminar--}}
    @include('registros.mis-registros._parciales._modal-eliminar')

    {{--Modal nueva Sinonimia/Ubicación--}}
    @include('catalogo.modales.modal-agregar-sinonimia-ubicacion')

    {{--Modal nueva Sinonimia/Ubicación--}}
    {{--@include('catalogo.modales.modal-actualizar-sinonimia-ubicacion')--}}


@stop

@section('script_section')
    @parent
    <script>
        var taxo_tabla='reportes/sinonimia-ubicacion';

        var registro_id = <?php echo $registro->id ?>;
        var localidades = <?php echo json_encode($localidades) ?>;
        var lugares = <?php echo json_encode($lugares) ?>;
        var sitios = <?php echo json_encode($sitios) ?>;

    </script>
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/additional-methods.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/datatable/config.datatable.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/registros/mis-registros/taxonomia/listados-taxonomia-usuario.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/catalogo/reportes.js')}}'></script>
    <script>
        localStorage.setItem("menu", "m-registros");
    </script>
@stop