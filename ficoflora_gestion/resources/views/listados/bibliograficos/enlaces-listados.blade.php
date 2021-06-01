@extends('master')

@section('css_section')
    @parent

    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">

@stop


@section('titulo-seccion')
    Enlaces webs
@stop

@section('breadcrumbs')
    <li><a href="{{route('listados.index')}}"><span>Listados</span></a></li>
    <li><a href="#"><span>Sitios web</span></a></li>
@stop

{{--modal eliminar--}}
@section('registro-eliminar')
    el enlace webs?
@stop

@section('content')
    @include('errors._listar')

    <input type="hidden" name="_token" value="{{ csrf_token() }}" />


    <div class="col-md-12 col-xl-10 col-xl-push-1">
        <section class="panel">
            <header class="panel-heading p-xs">
                <h5 class="name" ><i class="fa fa-list-ol pr-xs pl-sm"></i> Sitios web</h5>
            </header>
            <div class="panel-body">

                <div class="row">
                    <div class="col-sm-8">
                        <h5 class="mt-xs mb-xs">Número de sitios web: <b>{{$total}}</b></h5>
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
                        <th class="perfil-col">Nombre</th>
                        <th class="perfil-col">Dirección web</th>
                        <th class="acciones-col">Acciones</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($enlaces as $enlace)

                        <tr>
                            <td class="" data-type="text" >{{$enlace->id}}</td>
                            <th class="perfil-col">&nbsp;</th>
                            <td class="" data-type="text" >({{$enlace->cita}}, {{$enlace->fecha}}{{$enlace->letra}})</td>
                            <td class="" data-type="text" > {{$enlace->nombre}}</td>
                            <td class="" data-type="text" ><a href="{{$enlace->enlace}}" target="_blank">
                                    {{$enlace->enlace}}</a></td>

                            <td class="acciones-row">
                                <a href="{{route ('enlace.mostrar' ,$enlace->id )}}" data-toggle="tooltip" title="Información" ><i class="fa fa-info-circle"></i></a>
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

        var root_url = "<?php echo Request::root(); ?>/";
        console.log(root_url);
        var taxo_tabla='referencias/trabajos';

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