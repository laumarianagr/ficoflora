@extends('master')

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/css/toastr.css')}}">

@stop


@section('titulo-seccion')
    Registro de nueva de Sinonimia
@stop


@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="{{route('registros.nuevo.index')}}"><span>Nuevo</span></a></li>
    <li><a href="#"><span>Sinonimia</span></a></li>
@stop


@section('content')

    {{--ERRORES DESDE EL SERVIDOR--}}
    @include('errors._listar')

    <div class="row">
        {!! Form::open(['route' => 'sinonimia.guardar',  'id'=>'jv_sinonimia', 'class' => 'form  form-bordered']) !!}

        <section class="panel col-xs-12 col-md-8 col-xlg-6">
            <header class="panel-heading section-titulo">
                <h2 class="panel-title">Nueva Sinonimia</h2>
            </header>

            {{--FORMULARIO DE NUEVA ESPECIE--}}
            <div class="panel-body pb-xlg">
                @include('sinonimia._parciales._form-nueva-sinonimia')
            </div>

            <footer class="panel-footer">
                <div class="form-group">
                    <div class="col-sm-3 col-sm-offset-3 ">
                        {!! Form::submit('Crear', ['id'=>'crear', 'class' => 'btn btn-primary form-control']) !!}
                    </div>

                    <div class="col-sm-3 ">
                        <button type="reset" class="btn btn-default form-control">Borrar</button>
                    </div>
                </div>
            </footer>

        </section>

        {!! Form::close() !!}

        {{--PREVIEW RESULTADO--}}
        <div class="col-xs-12 col-md-4 col-xlg-6">
            @include('sinonimia._parciales._resultado-sinonimia')
        </div>


    </div>


@stop


@section('script_section')
    @parent
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/typeahead/typeahead.bundle.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/toastr/js/toastr.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/registros/validate_taxonomia.js')}}'></script>

    <script type="text/javascript">
        var taxonomia = <?php echo $taxonomia; ?>;



    </script>

    <script type='text/javascript' src='{{ asset('js/preview.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/registros/typeahead_taxonomia.js')}}'></script>

@stop
