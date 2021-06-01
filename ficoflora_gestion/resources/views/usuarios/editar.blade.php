@extends('master')

@section('title')

@stop

@section('css_section')
    @parent

@stop


@section('titulo-seccion')
    Editar información de usuario
@stop

@section('breadcrumbs')
    <li><a href="#"><span>Usuario</span></a></li>
    <li><a href="#"><span>Perfil</span></a></li>
@stop


@section('content')

    @include('errors._listar')
    @include('parciales._exito')



    <section class="panel">

        <form class="form-horizontal" role="form" method="POST" action="{{ route('actualizar.clave') }}">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <header class="panel-heading p-xs pl-md">
                <h5 class="name" >Cambiar Clave</h5>
            </header>

            <div class="panel-body">
                <div class="col-md-12 ">

                    <div class="form-group ">
                        <label class="col-md-4 control-label">Actual</label>
                        <div class="col-md-5">
                            <input type="password" class="form-control" name="clave_actual">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Nueva</label>
                        <div class="col-md-5">
                            <input type="password" class="form-control" name="clave_nueva">
                        </div>
                    </div>

                </div>
            </div>

            <footer class="panel-footer">
                {{--Guardar Form Imput--}}
                <div class="form-group">
                    <div class="col-sm-3 pull-right ">
                        {!! Form::submit('Guardar', ['id'=>'guardar', 'class' => 'btn btn-primary form-control']) !!}
                    </div>

                </div>

            </footer>
        </form>

    </section>



    <section class="panel">

        {!! Form::open(['route' => 'actualizar.info',   'id'=>'jv_info',  'class' => 'form  form-horizontal']) !!}


        <header class="panel-heading p-xs pl-md">
            <h5 class="name" >Actualizar Información</h5>
        </header>

        <div class="panel-body">
            <div class="col-md-12 ">

                <div class="form-group ">
                    <label class="col-md-4 control-label">Nombre</label>
                    <div class="col-md-5">
                        {!! Form::text('nombre', $usuario->nombre, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-md-4 control-label">Apellido</label>
                    <div class="col-md-5">
                        {!! Form::text('apellido', $usuario->apellido, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-md-4 control-label">Correo-e</label>
                    <div class="col-md-5">
                        {!! Form::text('email', $usuario->email, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-md-4 control-label">Descripción</label>
                    <div class="col-md-5">
                        {!! Form::textarea('descripcion', $usuario->descripcion, ['class' => 'form-control']) !!}
                    </div>
                </div>



            </div>
        </div>

        <footer class="panel-footer">
            {{--Guardar Form Imput--}}
            <div class="form-group">
                <div class="col-sm-3 pull-right ">
                    {!! Form::submit('Guardar', ['id'=>'guardar', 'class' => 'btn btn-primary form-control']) !!}
                </div>

            </div>

        </footer>
        {!! Form::close() !!}

    </section>




    <section class="panel">

        {!! Form::open(['route' => 'actualizar.imagen',   'id'=>'jv_archivo', 'files' => true, 'class' => 'form  form-bordered']) !!}

        <header class="panel-heading p-xs pl-md">

            <h5 class="name" >Cambiar Imagen </h5>
        </header>
        <div class="panel-body">

            {{--select CITA NUM AUOTRES libro--}}
            <div class="col-sm-3 form-group">
                <div class="form-group ">
                    <div class="thumb-info mb-md">
                        <img src="{{ asset($foto)}}" class="rounded img-responsive" >
                    </div>

                </div>
            </div>
            <div class="col-sm-9 form-group">
                <div class="form-group ">

                    {!! Form::file('imagen',  ['id'=>'archivo', 'class' => 'form-control']) !!}


                </div>
            </div>





        </div>

        <footer class="panel-footer">
            {{--Guardar Form Imput--}}
            <div class="form-group">
                <div class="col-sm-3 pull-right ">
                    {!! Form::submit('Guardar', ['id'=>'importar', 'class' => 'btn btn-primary form-control',  'accept'=>"image/jpeg"]) !!}
                </div>

            </div>

        </footer>

        {!! Form::close() !!}


    </section>

@stop

@section('script_section')
    @parent
    <script>

    </script>
@stop
