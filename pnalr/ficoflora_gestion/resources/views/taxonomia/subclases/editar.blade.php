@extends('master')

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{ asset('plugins/select2-4.0.0/css/select2.min.css')}}">
@stop


@section('titulo-seccion')
    Editar Subclase
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href=""><span>Editar</span></a></li>
    <li><a href="#"><span>Subclase</span></a></li>
@stop


@section('content')

    @include('errors._listar')

    <div class="col-lg-8 col-lg-push-2 col-xl-6 col-xl-push-3">
        {!! Form::open(['method'=> 'PATCH', 'route' => ['subclase.actualizar', $subclase['id']],  'id'=>'jv_subclase', 'class' => 'form  form-bordered']) !!}

        <section class="panel">
            <header class="panel-heading">


                <h2 class="panel-title">Editar Subclase</h2>

                <p class="panel-subtitle">
                    {{--Use <code>.form-bordered</code> class to style horizontal fields with borders.--}}
                </p>
            </header>
            <div class="panel-body">

                <div >
                    <i class="req-leyenda">* Campos obligatorios</i>

                </div>

                <div class="row">

                    <div class="form-group col-md-12">
                        <label class=" control-label" for="subclase">Subclase <span class="required">*</span></label>

                        {!! Form::text('subclase', $subclase['nombre'], ['id'=>'subclase', 'class' => 'form-control typeahead preview to-select', 'autocomplete' => 'off']) !!}
                    </div>

                    {{--Subclase Form Imput--}}
                    <div class="form-group col-md-12">

                        <h3 class="mb-lg">Taxonomía Superior</h3>

                        <label class=" control-label" for="clase_select">Clase <span class="required">*</span></label>
                        <div>
                            <div class="col-xs-6 col-sm-9 pl-none">

                                {!! Form::select('clase', $clases, $subclase['clase_id'], ['id'=> 'clase','class' => 'form-control select', 'style'=>'width: 100%']) !!}
                            </div>
                            <div class="col-xs-4 col-sm-3 pt-xs">
                                <a class="text-md modal-basic modal-with-zoom-anim  get_typeahead-datos" href="#modal_nuevaClase" id="nueva-clase"><span class="fa fa-plus-circle va-middle text-xl " aria-hidden="true"></span> Nueva</a>

                            </div>
                        </div>


                    </div>


                </div>



            </div>
            <footer class="panel-footer">
                {{--Crear Articulo Form Imput--}}
                <div class="form-group">

                    <div class="col-sm-6 ">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary form-control']) !!}
                    </div>

                    <div class="col-sm-6 ">
                        <button type="reset" class="btn btn-default form-control">Borrar</button>
                    </div>
                </div>


            </footer>
        </section>
        {!! Form::close() !!}
    </div>


    {{--MODAL NUEVO ORDEN--}}
    @include('taxonomia.modales._modal-nueva-clase')


@stop


@section('script_section')
    @parent
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/typeahead/typeahead.bundle.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/select2-4.0.0/js/select2.min.js')}}'></script>




    <script type="text/javascript">
        var taxonomia = <?php echo $taxonomia; ?>;

        $(document).ready(function(){


            var $select = $(".select").select2({
                placeholder: "Seleccione una Clase",
                allowClear: true
            });

        });
    </script>
    <script type='text/javascript' src='{{ asset('js/registros/validate_taxonomia.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/taxonomia/nuevas_taxonomias_modal.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/registros/typeahead_taxonomia.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>
    <script>
        localStorage.setItem("menu", "m-registros");
    </script>
@stop
