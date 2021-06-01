@extends('master')

@section('css_section')
    @parent

    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">

    <link rel="stylesheet" href="{{ asset('plugins/toastr/css/toastr.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">


    <link rel="stylesheet" href="{{ asset('plugins/x-editable/css/bootstrap-editable.css')}}">



@stop


@section('titulo-seccion')
    Perfiles
@stop

@section('breadcrumbs')
    <li><a href="#"><span>Perfiles</span></a></li>
@stop



@section('content')
    @include('errors._listar')


    <input type="hidden" name="_token" value="{{ csrf_token() }}" />



    <div class="col-md-12 col-xl-10 col-xl-push-1">
        <section class="panel">
            <header class="panel-heading p-xs">

                    <h5 class="name" ><i class="fa fa-sitemap pr-xs pl-sm"></i> Perfiles registrados</h5>
            </header>
            <div class="panel-body">

                {{--<a href="#" id="crear-row" data-toggle="tooltip" title="Nuevo" ><i class="fa fa-plus-circle"></i> Nuevo Perfil</a>--}}
                {{--<hr class="dotted short">--}}


                <div class="row">
                    <div class="col-sm-8">
                        <h5 class="mt-xs mb-xs">Número de perfiles: <b>{{$total}}</b></h5>
                    </div>
                    <div class="col-sm-4 ">
                        <a class="modal-with-form btn btn-default pull-right" href="#modal-agregar"  id="crear-row" data-toggle="tooltip" title="Nuevo" ><i class="fa fa-plus text-primary "></i> Crear Perfil</a>

                    </div>
                </div>
                <hr class="dotted short">

                <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="numeros">#</th>
                        <th class="perfil-col">Perfil</th>
                        <th class="acciones-col">Acciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($perfiles as $perfil)

                        {{--            <a href="{{url ('/perfiles',$perfil->tipo )}}">{{$perfil->tipo}}</a>--}}
                        <tr>
                            <td></td>

                            {{--Perfiles Admin, coordinador y visitante no se pueden cambiar o eliminar--}}
                            @if($perfil->id == 1 || $perfil->id == 2 || $perfil->id == 4)
                                <td>{{$perfil->tipo}}</td>
                                <td class="acciones-row">
                                    <a href="{{url ('/perfiles',$perfil->tipo )}}" data-toggle="tooltip" title="Informacióm" ><i class="fa fa-info-circle"></i></a>
                                </td>
                            @else


                                <td class="perfil" data-pk="{{$perfil->id}}" data-type="text" >{{$perfil->tipo}}</td>
                                <td class="acciones-row">
                                    <a class="editar-row" data-toggle="tooltip" title="Editar" ><i class="fa fa-pencil"></i></a>
                                    <a class="eliminar-row modal-basic modal-with-zoom-anim" href="#modal-eliminar"  data-toggle="tooltip" title="Eliminar" ><i class="fa fa-trash-o"></i></a>
                                    <a href="{{url ('/perfiles',$perfil->tipo )}}" data-toggle="tooltip" title="Información" ><i class="fa fa-info-circle"></i></a>

                                </td>
                            @endif


                        </tr>
                    @endforeach
                    </tbody>

                </table>



            </div>
        </section>
    </div>



    <div id="modal-eliminar" class="modal-block modal-header-color modal-block-danger mfp-hide  zoom-anim-dialog">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Eliminar</h2>
            </header>
            <div class="panel-body">
                <div class="modal-wrapper">
                    <div class="modal-icon">
                        <i class="fa fa-warning"></i>
                    </div>
                    <div class="modal-text ">


                        <div class="modal-mensaje mt-md mb-lg"></div>

                        <p class="bg-danger p-md">
                        <b>¡Importante!</b> <br/>
                        Al eliminar el perfil se eliminaran todos los usuarios que esten asociados a este perfil.
                        </p>
                    </div>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-danger modal-confirm" id="eliminar">Eliminar</button>
                        <button class="btn btn-default modal-dismiss" id="cerrar" >Cancel</button>
                    </div>
                </div>
            </footer>
        </section>
    </div>

    <div id="modal-agregar" class="modal-block  mfp-hide  zoom-anim-dialog">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Nuevo Perfil de Usuario</h2>
            </header>
            <div class="panel-body">
                <div class="modal-wrapper">

                    <div class="modal-text ">
                        <div >
                            <i class="req-leyenda">* Campos obligatorios</i>

                        </div>
                        {{--Tipo Form Imput--}}
                        <div class="form-group">
                            <label class=" control-label" for="tipo">Nombre del Perfil <span class="required">*</span></label>
                            {!! Form::text('tipo', null, ['id'=> 'tipo','class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary modal-confirm" id="crear">Crear</button>
                        <button class="btn btn-default modal-dismiss" id="cerrar" >Cancel</button>
                    </div>
                </div>
            </footer>
        </section>
    </div>




@stop

@section('script_section')
    @parenta

        <!-- Plugin para tabla y paginacion -->
        <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
        <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>

        <!-- Plugin de Notificacions -->
        <script type='text/javascript' src='{{ asset('plugins/toastr/js/toastr.min.js')}}'></script>

        <!-- Plugin campos editables -->
        <script type='text/javascript' src='{{ asset('plugins/x-editable/js/bootstrap-editable.min.js')}}'></script>

        <!-- Bootstrap JS-->

        <script type='text/javascript' src='{{ asset('js/perfiles/index-perfiles.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/componentes.js')}}'></script>


@stop


