@extends('master')

@section('css_section')
    @parent


@stop


@section('titulo-seccion')
    Registro de nueva Ubicación
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="{{route('registros.nuevo.index')}}"><span>Nuevo</span></a></li>
    <li><a href="#"><span>Geográficos</span></a></li>
    <li><a href="#"><span>Ubicación</span></a></li>
@stop


@section('content')

    @include('errors._listar')


    <div class="row">
        <div class="col-lg-12 col-xl-10 col-xl-offset-1">

            <section class="panel form-wizard" id="ubicacion">
                <header class="panel-heading">
                            <h2 class="panel-title">Nueva Ubicación</h2>
                </header>

                {!! Form::open(['route' => 'ubicacion.guardar',  'id'=>'jv_ubicacion', 'class' => 'form  form-bordered']) !!}


                @include('geograficos.ubicacion._parciales._form-nueva-ubicacion')

                <div class="panel-footer">

                    <div class="form-group">
                        <div class="col-sm-4 col-lg-2">
                            <button type="button" class="btn btn-default form-control" id="anterior">Anterior</button>
                        </div>

                        <div class="col-sm-4 col-lg-4 col-lg-offset-2">
                            {!! Form::submit('Crear', ['class' => 'btn btn-primary form-control ', 'id' => 'crear']) !!}
                        </div>
                        <div class="col-sm-4 col-lg-2 col-lg-offset-2">
                            <button type="button" class="btn btn-default form-control" id="siguiente">Siguiente</button>
                        </div>
                    </div>


                </div>


                {!! Form::close() !!}

            </section>
        </div>
    </div>

@stop


@section('script_section')
    @parent

    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/wizard/jquery.bootstrap.wizard.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/wizard/examples.wizard.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/typeahead/typeahead.bundle.js')}}'></script>
    <script type="text/javascript">
        var geograficos = <?php echo $geograficos; ?>;
    </script>

    <script type='text/javascript' src='{{ asset('js/geograficos/typeahead_geografico.js')}}'></script>

    {{--<script type='text/javascript' src='{{ asset('js/registros/validate_taxonomia.js')}}'></script>--}}
    {{--<script type='text/javascript' src='{{ asset('js/registros/typeahead_taxonomia.js')}}'></script>--}}


@stop
