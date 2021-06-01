@extends('master')

@section('css_section')
    @parent

    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">

@stop


@section('titulo-seccion')
    Catálogos
@stop

@section('breadcrumbs')
    <li><a href="{{route('listados.index')}}"><span>Listados</span></a></li>
    <li><a href="#"><span>Catálogos</span></a></li>
@stop



@section('content')



    <div class="col-md-12 col-xl-10 col-xl-push-1">
        <section class="panel">
            <header class="panel-heading  p-xs">
                <h5 class="name" ><i class="fa fa-list-ol pr-xs pl-sm"></i> Catálogos registrados</h5>
            </header>
            <div class="panel-body">



                <div class="row">
                    <div class="col-sm-8">
                        <h5 class="mt-xs mb-xs">Número de catálogos: <b>{{$total}}</b></h5>
                    </div>
                    <div class="col-sm-4 ">
                        @if($usuario->perfil_id <=3)
                            <a class="btn btn-default pull-right" href="{{route('referencias.crear')}}" id="crear-row" data-toggle="tooltip" title="Nuevo" ><i class="fa fa-plus text-primary"></i> Nueva referencia</a>

                        @endif

                    </div>
                </div>

                <hr class="dotted short">

                <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="perfil-col">id</th>
                        <th class="perfil-col">&nbsp;</th>
                        <th class="perfil-col">Cita</th>
                        <th class="perfil-col">Título</th>
                        <th class="acciones-col">Acciones</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($catalogos as $catalogo)

                        <tr>
                            <td class="" data-type="text" >{{$catalogo->id}}</td>
                            <td class="" data-type="text" >&nbsp;</td>
                            <td class="" data-type="text" >({{$catalogo->cita}}, {{$catalogo->fecha}}{{$catalogo->letra}})</td>
                            <td class="" data-type="text" > {!!html_entity_decode($catalogo->titulo)!!}</td>

                            <td class="acciones-row">
                                <a href="{{route ('catalogo.mostrar' ,$catalogo->id )}}" data-toggle="tooltip" title="Información" ><i class="fa fa-info-circle"></i></a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>

                </table>

            </div>
        </section>
    </div>

@stop

@section('script_section')
    @parent

    <script>
        $('html').addClass('fixed sidebar-left-collapsed');

    </script>

    <!-- Plugin para tabla y paginacion -->
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>


    <script type='text/javascript' src='{{ asset('js/datatable/config.datatable.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>

    <script>
        localStorage.setItem("menu", "m-listados");
    </script>

@stop