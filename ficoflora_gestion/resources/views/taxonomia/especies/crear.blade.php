@extends('master')

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/css/toastr.css')}}">

@stop


@section('titulo-seccion')
    Registro de nueva de Especie
@stop


@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="{{route('registros.nuevo.index')}}"><span>Nuevo</span></a></li>
    <li><a href="#"><span>Especie</span></a></li>
@stop


@section('content')

    {{--ERRORES DESDE EL SERVIDOR--}}
    @include('errors._listar')

    <div class="row">
        {!! Form::open(['url' => 'especies',  'id'=>'jv_especie', 'class' => 'form  form-bordered']) !!}

        <section class="panel col-xs-12 col-md-8 col-xlg-6">
            <header class="panel-heading section-titulo">
                   <h2 class="panel-title">Nueva Especie</h2>
            </header>

            {{--FORMULARIO DE NUEVA ESPECIE--}}
            <div class="panel-body pb-xlg">
                @include('taxonomia.especies._parciales._form_nueva_especie')
            </div>

            <footer class="panel-footer">
                <div class="form-group">
                    <div class="col-sm-3 col-sm-offset-3 ">
                        {!! Form::submit('Guardar', ['id'=>'guardar', 'class' => 'btn btn-primary form-control']) !!}
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
            @include('taxonomia.especies._parciales._resultado_especie')
        </div>


    </div>

    {{--MODAL NUEVA FAMILIA--}}
    @include('taxonomia.modales._modal-nueva-familia')

@stop


@section('script_section')
    @parent
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/typeahead/typeahead.bundle.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/select2-4.0.0/js/select2.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/toastr/js/toastr.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/registros/validate_taxonomia.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/preview.js')}}'></script>

    <script type="text/javascript">

        var taxonomia = <?php echo $taxonomia; ?>;
        var datos = false;


        var select2 = $(".select").select2({
            placeholder: "Seleccione una Familia"
        }).val(null).trigger("change");


    </script>

    <script type='text/javascript' src='{{ asset('js/componentes.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/registros/typeahead_taxonomia.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/taxonomia/nuevas_taxonomias_modal.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/registros/crear_especie.js')}}'></script>


    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>
    <script>
        localStorage.setItem("menu", "m-registros");
    </script>
@stop
