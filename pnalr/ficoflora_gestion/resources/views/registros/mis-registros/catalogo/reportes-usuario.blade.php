@extends('master')

@section('css_section')
    @parent

    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/css/toastr.css')}}">

@stop


@section('titulo-seccion')
    Registros del catálogo
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="{{route('usuario.registros')}}"><span>Mis Registros</span></a></li>
    <li><a href="#"><span>Reportes</span></a></li>
@stop

{{--modal eliminar--}}
@section('registro-eliminar')
    el registro?
@stop

@section('content')
    @include('errors._listar')

    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <div class="col-md-12 col-xl-10 col-xl-push-1">
        <section class="panel">
            <header class="panel-heading  p-xs">
                <h5 class="name" ><i class="fa fa-list-ol pr-xs pl-sm"></i> Registros del catálogo incorporados por el usuario</h5>
            </header>
            <div class="panel-body">

                <div class="row">
                    <div class="col-sm-8">
                        <h5 class="mt-xs mb-xs">Número de registros: <b>{{$total}}</b></h5>
                    </div>
                    <div class="col-sm-4 ">


                    </div>
                </div>
                <hr class="dotted short">

                <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados " cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="numeros">#</th>
                        <th class="perfil-col">id</th>
                        <th class="perfil-col">Especie</th>
                        <th class="perfil-col">Cita</th>
                        <th class="perfil-col">Año</th>
                        <th class="acciones-col">Tipo</th>
                        {{--<th class="perfil-col">Autores</th>--}}
                        {{--<th class="perfil-col">Sitio</th>--}}
                        <th class="acciones-col">Acciones</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($reportes as $reporte)

                        <tr>
                            <td></td>
                            <td class="" data-type="text" >{{$reporte['id']}}</td>
                            <td class="" data-type="text" ><em>{{$reporte['especie']}}</em> {{$reporte['autor']}}</td>
                            <td class="" data-type="text" >{{$reporte['cita']}}</td>
                            <td class="" data-type="text" >{{$reporte['fecha']}}</td>
                            <td class="" data-type="text" >{{$reporte['tipo']}}</td>
                            {{--<td class="" data-type="text" >{{$reporte->lugar}}</td>--}}
                            {{--<td class="" data-type="text" >{{$reporte->sitio}}</td>--}}

                            <td class="acciones-row">
                                {{--<a href="{{route ('reporte.editar' ,$reporte['id'] )}}" class="editar-row" data-toggle="tooltip" title="Editar" ><i class="fa fa-pencil"></i></a>--}}
                                <a class="eliminar-row modal-basic modal-with-zoom-anim" href="#modal-eliminar"  data-toggle="tooltip" title="Eliminar" ><i class="fa fa-trash-o"></i></a>
                                <a href="{{route ('reporte.mostrar' ,$reporte['id'] )}}" data-toggle="tooltip" title="Información" ><i class="fa fa-info-circle"></i></a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>

                </table>



            </div>
        </section>
    </div>


    {{--Modal Eliminar--}}
    @include('registros.mis-registros._parciales._modal-eliminar')



@stop

@section('script_section')
    @parent

    <script>
        var root_url = "<?php echo Request::root(); ?>/";
        console.log(root_url);
        var taxo_tabla='reportes';

    </script>

    <!-- Plugin para tabla y paginacion -->
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>

    <!-- Plugin de Notificacions -->
    <script type='text/javascript' src='{{ asset('plugins/toastr/js/toastr.min.js')}}'></script>


    <script type='text/javascript' src='{{ asset('js/datatable/config.datatable.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/registros/mis-registros/taxonomia/listados-taxonomia-usuario.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/componentes.js')}}'></script>
    <script>
        localStorage.setItem("menu", "m-registros");



    </script>

@stop


