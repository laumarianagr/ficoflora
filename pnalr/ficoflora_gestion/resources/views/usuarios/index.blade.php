@extends('master')

@section('css_section')
    @parent

    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{ asset('plugins/toastr/css/toastr.css')}}">

    <link rel="stylesheet" href="{{ asset('plugins/x-editable/css/bootstrap-editable.css')}}">
    <style>

        .acciones-col{
            max-width: 60px !important;
            width: 60px !important;
        }

        .acciones-row{
            text-align: center;
        }

        .numeros{
            padding: 8px!important;
        }
        a{
            cursor: pointer;
        }
    </style>


@stop


@section('titulo-seccion')
    Usuarios
@stop

@section('breadcrumbs')
    <li><a href="#"><span>Usuarios</span></a></li>
@stop



@section('content')
    @include('errors._listar')
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <div class="col-md-12 col-xl-10 col-xl-push-1">
        <section class="panel">

            <header class="panel-heading  p-xs">
                <div class="profile-info dark">
                    <h5 class="name"><i class="fa fa-users pl-sm pr-xs"></i> Listado de Usuarios</h5>
                </div>
            </header>

            <div class="panel-body">

                <div class="row">
                    <div class="col-sm-8">
                        <h5 class="mt-xs mb-xs">Número de usuarios: <b>{{$total}}</b></h5>
                    </div>
                    <div class="col-sm-4 ">
                            <a class="modal-with-form btn btn-default pull-right" href="#modal-agregar"  id="crear-row" data-toggle="tooltip" title="Nuevo" ><i class="fa fa-plus text-primary"></i> Crear Usuario</a>

                    </div>
                </div>
                <hr class="dotted short">


                <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="numeros">#</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo-e</th>
                        <th>Perfil</th>
                        <th class="acciones-col">Acciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td></td>
                            <td>{{$usuario->usuario}}</td>
                            <td>{{$usuario->nombre}}</td>
                            <td>{{$usuario->apellido}}</td>
                            <td>{{$usuario->email}}</td>
                            @if($usuario->perfil_id == 1)
                                <td>{{$usuario->tipo}}</td>

                                <td class="acciones-row">
                                    <a class="perfil-row"  data-toggle="tooltip" title="Perfil" href="{{route('usuario.index', [$usuario->id])}}" ><i class="fa fa-eye"></i></a>
                                </td>
                            @else
                                <td class="perfil" data-pk="{{$usuario->id}}" data-type="select" data-value="{{$usuario->perfil_id}}">{{$usuario->tipo}}</td>
                                <td class="acciones-row">
                                    <a class="editar-row"  data-toggle="tooltip" title="Editar" ><i class="fa fa-pencil"></i></a>
                                    <a class="eliminar-row modal-basic modal-with-zoom-anim" href="#modal-eliminar"    data-toggle="tooltip" title="Eliminar" ><i class="fa fa-trash-o"></i></a>
                                    <a class="perfil-row"  data-toggle="tooltip" title="Perfil" href="{{route('usuario.index', [$usuario->usuario])}}" ><i class="fa fa-eye"></i></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>

                </table>

            </div>
        </section>
    </div>


    {{--<!-- Modal -->--}}
    {{--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
        {{--<div class="modal-dialog" role="document">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                    {{--<h4 class="modal-title" id="myModalLabel">Importante</h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<h5 class="modal-mensaje"></h5>--}}

                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-primary" id="eliminar">Eliminar</button>--}}
                    {{--<button type="button" class="btn btn-default" id="cerrar" data-dismiss="modal">Cancelar</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


    @include('usuarios.modales.modal-eliminar-usuario')
    @include('usuarios.modales.modal-nuevo-usuario')
@stop



@section('script_section')
    @parent

    <!-- Plugin para tabla y paginacion -->
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>

    <!-- Plugin de Notificacions -->
    <script type='text/javascript' src='{{ asset('plugins/toastr/js/toastr.min.js')}}'></script>

    <!-- Plugin campos editables -->
    <script type='text/javascript' src='{{ asset('plugins/x-editable/js/bootstrap-editable.min.js')}}'></script>

    <!-- Bootstrap JS-->


    <script>
            var perfiles = <?php echo $perfiles ?>;
            var urlAjax = 'usuarios';
            var paginaPerfil = false;

    </script>

    <script type='text/javascript' src='{{ asset('js/usuarios/acciones_usuario.js')}}'></script>


@stop


