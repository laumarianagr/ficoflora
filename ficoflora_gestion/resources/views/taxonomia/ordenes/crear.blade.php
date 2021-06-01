@extends('master')

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/select2-4.0.0/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">



@stop

@section('titulo-seccion')
    Nuevo registro de Orden
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="{{route('registros.nuevo.index')}}"><span>Nuevo</span></a></li>
    <li><a href="#"><span>Orden</span></a></li>
@stop

@section('content')

    @include('errors._listar')



    <div class="col-lg-8 col-lg-push-2 col-xl-6 col-xl-push-3">
        {!! Form::open(['url' => 'ordenes',  'id'=>'jv_taxonomia', 'class' => 'form  form-bordered']) !!}

        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Nuevo Orden</h2>
                <p class="panel-subtitle"></p>
            </header>

            <div class="panel-body">
                <div><i class="req-leyenda">* Campos obligatorios</i></div>

                <div class="row">

                    <div class="form-group col-md-12">
                        <label class=" control-label" for="genero">Orden <span class="required">*</span></label>
                        {!! Form::text('orden', null, ['id'=>'orden', 'class' => 'form-control typeahead preview to-select', 'autocomplete' => 'off']) !!}
                    </div>

                    <div class="form-group col-md-12">
                        <div class="">
                            <div class="checkbox-custom checkbox-primary ">
                                {!! Form::checkbox('check', 1, null, ['id' => 'check']) !!}
                                <label for="check">Posee Subclase</label>
                            </div>
                        </div>
                    </div>

                    {{--Familia Form Imput--}}
                    <div class="form-group col-md-12">
                        <h3 class="mb-lg">Taxonomía Superior</h3>
                        <label class=" control-label" for="subclase_select">Subclase <span class="required">*</span></label>
                        <div>
                            <div class="col-xs-6 col-sm-9 pl-none">
                                {!! Form::select('subclase', $subclases, null, ['id'=> 'subclase','class' => 'form-control select', 'style'=>'width: 100%']) !!}
                            </div>

                            <div class="col-xs-4 col-sm-3 pt-xs">
                                <a class="text-md modal-basic modal-with-zoom-anim  get_typeahead-datos" href="#modal_nuevaSubclase" id="nueva-subclase"><span class="fa fa-plus-circle va-middle text-xl " aria-hidden="true"></span> Nueva</a>
                            </div>
                        </div>
                    </div>
                    {{--Familia Form Imput--}}
                    <div class="form-group col-md-12">
                        <label class=" control-label" for="clase_select">Clase <span class="required">*</span></label>
                        <div>
                            <div class="col-xs-6 col-sm-9 pl-none">
                                {!! Form::select('clase', $clases, null, ['id'=> 'clase', 'class' => 'form-control select', 'style'=>'width: 100%']) !!}
                            </div>

                            <div class="col-xs-4 col-sm-3 pt-xs">
                                <a class="text-md modal-basic modal-with-zoom-anim  get_typeahead-datos" href="#modal_nuevaClase" id="nueva-clase" style="display: none;"><span class="fa fa-plus-circle va-middle text-xl " aria-hidden="true"></span> Nueva</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <footer class="panel-footer">
                <div class="form-group">
                    <div class="col-sm-6 ">
                        {!! Form::submit('Crear', ['class' => 'btn btn-primary form-control']) !!}
                    </div>

                    <div class="col-sm-6 ">
                        <button type="reset" class="btn btn-default form-control">Borrar</button>
                    </div>
                </div>
            </footer>

        </section>
        {!! Form::close() !!}
    </div>


    {{--MODAL NUEVA SUBCLASE--}}
    @include('taxonomia.modales._modal-nueva-subclase')


    {{--MODAL NUEVA CLASE--}}
    @include('taxonomia.modales._modal-nueva-clase')








@stop


@section('script_section')
    @parent
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/additional-methods.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/typeahead/typeahead.bundle.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/select2-4.0.0/js/select2.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>

    <script type="text/javascript">
            var taxonomia = <?php echo $taxonomia; ?>;
            $('#nueva-clase').hide();

            $(document).ready(function(){


                $( "#check" ).prop("checked",true);

                var selectClase = $("#clase").select2({
                    placeholder: "Seleccione una Clase",
                    allowClear: true

                }).prop("disabled", true).val(null).trigger("change");




                var selectSubclase = $("#subclase").select2({
                    placeholder: "Seleccione una subclase",
                    allowClear: true
                }).val(null).trigger("change");


                $( "#check" ).change(function() {
                    var $input = $( this );

                    if($input.prop("checked")){
                        selectClase.prop("disabled", true);
                        selectSubclase.prop("disabled", false);
                        selectClase.val(null).trigger("change");
                        $('#nueva-subclase').show();
                        $('#nueva-clase').hide();


//                        $( "#gClase" ).hide();
//                        $( "#gSubclase" ).show();


                    }else{
                        selectClase.prop("disabled", false);
                        selectSubclase.prop("disabled", true);
                        selectSubclase.val(null).trigger("change");
                        $('#nueva-clase').show();
                        $('#nueva-subclase').hide();


//                        $( "#gClase" ).show();
//                        $( "#gSubclase" ).hide();
                    }

                })
            });
    </script>
    <script type='text/javascript' src='{{ asset('js/taxonomia/nuevas_taxonomias_modal.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/registros/validate_taxonomia.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/registros/typeahead_taxonomia.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>
    <script>
        localStorage.setItem("menu", "m-registros");
    </script>

@stop
