@extends('master')

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/css/toastr.css')}}">

@stop


@section('titulo-seccion')
    Edición de Sinonimia
@stop


@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="{{route('registros.nuevo.index')}}"><span>Editar</span></a></li>
    <li><a href="#"><span>Sinonimia</span></a></li>
@stop


@section('content')

    {{--ERRORES DESDE EL SERVIDOR--}}
    @include('errors._listar')

    <div class="row">
        {!! Form::open(['method'=> 'PATCH', 'route' => ['sinonimia.actualizar', $especie['id']],  'id'=>'jv_sinonimia', 'class' => 'form  form-bordered']) !!}

        <section class="panel col-xs-12 col-md-8 col-md-offset-2 col-xlg-6 col-xlg-offset-3">
            <header class="panel-heading section-titulo">
                <h2 class="panel-title">Editar Sinonimia</h2>
            </header>

            {{--FORMULARIO DE NUEVA ESPECIE--}}
            <div class="panel-body pb-xlg">
                @include('sinonimia._parciales._form-editar-sinonimia')
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


    </div>

    {{--MODAL NUEVO GENERO--}}
    @include('taxonomia.modales._modal-nuevo-genero')
    {{--MODAL NUEVO ESPECIFICO--}}
    @include('taxonomia.modales._modal-nuevo-especifico')
    {{--MODAL NUEVO VARIETAL--}}
    @include('taxonomia.modales._modal-nuevo-varietal')
    {{--MODAL NUEVO FORMA--}}
    @include('taxonomia.modales._modal-nuevo-forma')
    {{--MODAL NUEVO SUBESPECIE--}}
    @include('taxonomia.modales._modal-nuevo-subespecie')
    {{--MODAL NUEVO AUTOR--}}
    @include('taxonomia.modales._modal-nuevo-autor')

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
        var root_url = "<?php echo Request::root(); ?>/";
        console.log(root_url);

        var taxonomia = <?php echo $taxonomia; ?>;

        var especie = <?php echo $especie; ?>;


        $('html').addClass('fixed sidebar-left-collapsed');

        $(".select").select2({
            placeholder: "Seleccione una opción",
            allowClear: true
        });

        setSpanSelect($("#genero")[0]);
        setSpanSelect($("#especie")[0]);
        setSpanSelect($("#variedad")[0]);
        setSpanSelect($("#forma")[0]);
        setSpanSelect($("#subespecie")[0]);
        setSpanSelect($("#autor")[0]);


    </script>
    <script type='text/javascript' src='{{ asset('js/registros/validate_taxonomia.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/componentes.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/taxonomia/nuevas_taxonomias_modal.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/registros/crear_especie.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/taxonomia/especies/especie-editar.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/registros/typeahead_taxonomia.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>

@stop