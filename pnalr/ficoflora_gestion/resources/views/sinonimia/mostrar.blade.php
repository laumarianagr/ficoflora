@extends('master')


@section('titulo-seccion')
    Información de la Sinonimia
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="#"><span>Sinonimia</span></a></li>

@stop
@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">
@stop

@section('registro-quitar')
    la especie?
@stop
@section('content')
<div class="row">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <div class="col-md-12 mostrar-cabecera">
        <section class="panel panel-featured-left panel-featured-primary">
            <div class="panel-body ">
                <div class="widget-summary">

                    <div class="widget-summary-col">

                        <div class="summary mb-sm">
                            <div class="info">
                                <span class="muted">Sinonimia: </span><strong class="amount"><em>{{$sinonimia['nombre']}}</em></strong> <a href="{{route('autor.mostrar', [$sinonimia['autor_id']])}}" class="text-primary">{{$sinonimia['autor']}}</a>
                            </div>
                        </div>

                        @if($usuario->perfil_id <=3)
                            <div class="summary-footer text-right pt-xs">
                                <a class="" href="{{route('usuario.sinonimias')}}"><i class="fa fa-user pr-xs"></i>Mis sinonimias</a>
                                @if($sinonimia['creador_id'] == $usuario->id || $usuario->perfil_id <=2)
                                    | <a href="{{route('sinonimia.editar', [$sinonimia['id']])}}"><i class="fa fa-pencil pr-xs"></i>Editar </a>
                                @endif
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </section>
    </div>


    <div class="col-xs-12">

        <div class="panel">
            <div class="panel-body">

                <div class=" mb-md tabla-mostrar-datos ">
                    <h4 class="">Especies que fueron reportadas como <em class="text-primary text-normal">{{$sinonimia['nombre']}}</em></h4>

                </div>

                <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="numeros-dataTabla">N°</th>
                        <th class="th-dataTable ">id</th>
                        <th class="th-dataTable ">Nombre de la especie</th>
                        {{--<th class="th-dataTable acciones-col">Acciones</th>--}}
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($especies as $especie)
                        <tr>
                            <td></td>
                            <td>{{$especie['id']}}</td>

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
                            {{--<td  class="acciones-row"><a class="quitar-sinonimia modal-basic modal-with-zoom-anim"  href="#modal-quitar" ><i class="fa fa-close " data-toggle="tooltip" title="Quitar especie"></i></a></td>--}}

                        </tr>
                    @endforeach
                    </tbody>

                </table>






            </div>

        </div>
    </div>
</div>
{{--Modal quitar--}}
@include('registros.mis-registros._parciales._modal-quitar')

@stop

@section('script_section')
    @parent
    <script>
        var sinonimia = <?php echo $sinonimia['id']; ?>;
    </script>

    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/datatable/config.datatable.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/sinonimias/acciones_sinonimia.js')}}'></script>


@stop


