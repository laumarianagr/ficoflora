
@extends('master')

@section('titulo-seccion')
    Enviar Registro
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href=""><span>Enviar</span></a></li>

@stop

@section('css_section')
    @parent



    <style>
        .tt-selectable{
            cursor: pointer;
        }
        a{
            display: block;
        }
    </style>

@stop

@section('content')

    @include('parciales._exito')

    @include('errors._listar')

    <div class="row">
        <div class="col-xs-12 col-xlg-8 col-xlg-offset-2">

            <section class="panel form-wizard" id="catalogo">
                <header class="panel-heading section-titulo">
                    <h2 class="panel-title">Información del registro</h2>
                </header>


                <div class="panel-footer">

                    {!! Form::open(['route' => 'temporal.guardar', 'id'=>'form_catalogo', 'class' => 'form  form-bordered']) !!}

                    <div class="form-group">
                        <div class="col-sm-3 col-md-2">
                            <button type="button" class="btn btn-default form-control hidden " id="anterior_paso">Anterior</button>
                        </div>

                        <div class="col-sm-6 col-md-8">
                            <div class="wizard-tabs b-simple">

                                <ul class="wizard-steps">

                                    <li class="active">
                                        <a href="#" data-toggle="tab" class="text-center">
                                            <span class="badge hidden-xs">1</span>
                                            Especie
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="tab" class="text-center">
                                            <span class="badge hidden-xs">2</span>
                                            Referencia
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="tab" class="text-center">
                                            <span class="badge hidden-xs">3</span>
                                            Sinonimia
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="tab" class="text-center">
                                            <span class="badge hidden-xs">4</span>
                                            Ubicación
                                        </a>
                                    </li>
                                </ul>


                            </div>
                        </div>

                        <div class="col-sm-3 col-md-2">
                            {!! Form::submit('Finalizar', ['class' => 'btn btn-primary form-control hidden', 'id' => 'finalizar']) !!}
                        </div>
                        <div class="col-sm-3 col-md-2">
                            <button type="button" class="btn btn-default form-control hidden" id="siguiente_paso">Siguiente</button>
                        </div>
                    </div>
                    {!! Form::close() !!}


                </div>


            </section>
        </div>

        <div class="col-xs-12 col-xlg-8 col-xlg-offset-2" style="margin-top: -21px;">

            <section class="panel form-wizard" id="catalogo_secciones">


                <div class="panel-body panel-body-nopadding">
                    <div class="tabs">

                        <div  id="pasos" class="tab-content">

                            {{--ESPECIE--}}
                            <div id="tab_0" class="tab-pane active pasos">

                                @include('temporales._parciales._paso-especie')

                            </div>

                            {{--REFERENCIA--}}
                            <div id="tab_1" class="tab-pane pasos">

                                @include('temporales._parciales._paso-referencia')

                            </div>

                            {{--SINONIMIA--}}
                            <div id="tab_2" class="tab-pane pasos">

                                @include('temporales._parciales._paso-sinonimia')

                            </div>

                            {{--UBICACION--}}
                            <div id="tab_3" class="tab-pane pasos">

                                @include('temporales._parciales._paso-ubicacion')

                            </div>

                        </div>
                    </div>


                </div>




            </section>
        </div>



    </div>



@stop


@section('script_section')
    @parent

    <script type='text/javascript' src='{{ asset('js/wizard/jquery.bootstrap.wizard.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/typeahead/typeahead.bundle.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/toastr/js/toastr.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/tinymce/tinymce.min.js')}}'></script>

    <script type="text/javascript">
        var taxonomia = <?php echo $taxonomia; ?>;

        var geograficos = <?php echo $geograficos; ?>;

        $('html').addClass('fixed sidebar-left-collapsed');

        //Inicializar el select2 con la lista de familias
        var select2 = $("#familia_select").select2({
            placeholder: "Seleccione una Familia"
        }).val(null).trigger("change")

        $(".select").select2({
            placeholder: "Seleccione una opción",
            allowClear: true
        }).val(null).trigger("change");

        $(".cita").select2({
            placeholder: "seleccione la cantidad de autores",
            allowClear: true
        });

    </script>
    <script type='text/javascript' src='{{ asset('js/registros/validate_taxonomia.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/componentes.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/preview.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/bibliograficos/referencias.js')}}'></script>

{{--    <script type='text/javascript' src='{{ asset('js/wizard/catalogo.wizard.js')}}'></script>--}}
    <script type='text/javascript' src='{{ asset('js/wizard/examples.wizard.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/wizard/temporales.wizard.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/registros/crear_especie.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/registros/typeahead_taxonomia.js')}}'></script>
    {{--<script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>--}}
    <script type='text/javascript' src='{{ asset('js/geograficos/typeahead_geografico.js')}}'></script>




    <script>
        localStorage.setItem("menu", "m-registros");
    </script>
@stop



