@extends('master')

@section('css_section')
    @parent

    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">

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
Perfil <b>{{$perfil->tipo}}</b>
@stop

@section('breadcrumbs')
    <li><a href="{{route('perfiles.index')}}"><span>Perfiles</span></a></li>
    <li><a href="#"><span>{{$perfil->tipo}}</span></a></li>
@stop


@section('content')
    @include('errors._listar')
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <div class="col-md-12 col-xl-10 col-xl-push-1">
        <section class="panel panel-group perfil">
            <header class="panel-heading bg-light tipo">
                <div class="widget-profile-info">
                    <div class="profile-picture">
                        <img src="{{ asset('img/!logged-user.jpg')}}">
                    </div>
                    <div class="profile-info">
                        <h3 class="name text-semibold">{{$perfil->tipo}}</h3>
                        {{--<h5 class="role">Perfil</h5>--}}
                        <div class="profile-footer light">
                            <a href="#">(editar perfil)</a>
                        </div>
                    </div>
                </div>

            </header>
            <div id="accordion">
                <div class="panel panel-accordion panel-accordion-first">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1One">
                                <i class="fa fa-info-circle"></i> Información
                            </a>
                        </h4>
                    </div>
                    <div id="collapse1One" class="accordion-body collapse">
                        <div class="panel-body">
                            @if($perfil->descripcion != null)
                                <p>{{$perfil->descripcion}}</p>
                                {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis vulputate quam. Interdum et malesuada</p>--}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="col-md-12 col-xl-10 col-xl-push-1">
        <section class="panel">
            <header class="panel-heading bg-dark p-sm">
                <div class="profile-info dark">
                    <h5 class="name"><i class="fa fa-users  pr-xs"></i> Usuarios con el perfil {{$perfil->tipo}}</h5>
                </div>
            </header>
            <div class="panel-body">

                <table id="datatable"  class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="numeros">#</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
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
                                <td>{{$perfil->tipo}}</td>
                                <td class="acciones-row">
                                    <a class="perfil-row"  data-toggle="tooltip" title="Perfil" href="{{route('usuario.index', [$usuario->usuario])}}" ><i class="fa fa-eye"></i></a>
                                </td>
                            @else
                                <td class="perfil" data-pk="{{$usuario->id}}" data-type="select" data-value="{{$usuario->perfil_id}}">{{$perfil->tipo}}</td>
                                <td class="acciones-row">
                                    <a  class="editar-row"  data-toggle="tooltip" title="Editar" ><i class="fa fa-pencil"></i></a>
                                    <a  class="eliminar-row"  data-toggle="tooltip" title="Eliminar" ><i class="fa fa-trash-o"></i></a>
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





    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Importante</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="eliminar">Eliminar</button>
                    <button type="button" class="btn btn-default" id="cerrar" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>





@stop

@section('script_section')
    @parent

            <!-- Plugin para tabla y paginacion -->
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>

    <!-- Plugin de Notificacions -->
    <script type='text/javascript' src='{{ asset('plugins/toastr/js/toastr.min.js')}}'></script>

    <!-- Plugin campos editables -->
    <script type='text/javascript' src='{{ asset('plugins/x-editable/js/bootstrap-editable.min.js')}}'></script>

    <!-- Bootstrap JS-->
    <script type='text/javascript' src='{{ asset('plugins/bootstrap_v3.3_xxs/js/bootstrap.min.js')}}'></script>


    <script>
        var perfiles = <?php echo $perfiles ?>;
        var urlAjax ='../usuarios';
        var paginaPerfil = true;

    </script>

    <script type='text/javascript' src='{{ asset('js/usuarios/acciones_usuario.js')}}'></script>


@stop



