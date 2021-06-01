@extends('master')

@section('css_section')
    @parent

    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">

@stop


@section('titulo-seccion')
    LOG de actividades del módulo
@stop

@section('breadcrumbs')
    <li><a href="{{route('log.index')}}"><span>LOG</span></a></li>
@stop



@section('content')
    @include('errors._listar')


    <input type="hidden" name="_token" value="{{ csrf_token() }}" />



    <div class="col-md-12 col-xl-10 col-xl-push-1">
        <section class="panel">
            <header class="panel-heading p-xs">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-up"></a>
                </div>
                <h5 class="name" ><i class="fa fa-list pr-xs pl-sm"></i> Actividades registradas</h5>
            </header>
            <div class="panel-body">


                <hr class="dotted short">

                <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="numeros">#</th>
                        <th class="perfil-col">Act.</th>
                        <th class="perfil-col">Usuario</th>
                        <th class="perfil-col">Elemento</th>
                        <th class="perfil-col">Proceso</th>
                        <th class="perfil-col">Edo. Anterior</th>
                        <th class="perfil-col">Edo. Nuevo</th>
                        <th class="perfil-col">Fecha</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($logs as $log)

                        <tr>
                            <td></td>
                            @if($log->actividad == 'c')
                                <td class="text-center" data-type="text" > <i class="fa fa-plus-circle text-primary"></i></td>
                            @endif
                            @if($log->actividad == 'd')
                                <td class="text-center" data-type="text" ><i class="fa fa-trash text-danger"></i></td>
                            @endif
                            @if($log->actividad == 'e')
                                <td class="text-center" data-type="text" > <i class="fa fa-pencil text-warning"></i> </td>
                            @endif


                            <td class="" data-type="text" >{{$log->usuario}}</td>
                            @if($log->actividad == 'd')
                             <td class="" data-type="text" >{{$log->elemento}}</td>
                            @else
                                <td class="" data-type="text" ><a href={{route($log->ruta,$log->id_elem )}}>{{$log->elemento}}</a></td>
                            @endif

                            @if($log->actividad == 'c')
                                <td class="" data-type="text" >Nuevo elemento</td>
                            @endif

                        @if($log->actividad == 'd')
                                <td class="" data-type="text" >Eliminar elemento</td>
                                @endif

                            @if($log->actividad == 'e')
                                    <td class="" data-type="text" >{{$log->proceso}}</td>
                            @endif
                            <td class="" data-type="text" >{{$log->anterior}}</td>
                            <td class="" data-type="text" >{{$log->nuevo}}</td>
                            <td class="" data-type="text" >{{$log->created_at}}</td>

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
        var root_url = "<?php echo Request::root(); ?>/";
        console.log(root_url);
        var taxo_tabla='autores';

    </script>

    <!-- Plugin para tabla y paginacion -->
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>


    <script type='text/javascript' src='{{ asset('js/datatable/log-datatable.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/componentes.js')}}'></script>
    <script>
        localStorage.setItem("menu", "m-log");
    </script>

@stop


