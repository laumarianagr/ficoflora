@extends('master')

@section('css_section')
    @parent
@stop


@section('titulo-seccion')
    Registro de nuevo Lugar
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="{{route('registros.nuevo.index')}}"><span>Nuevo</span></a></li>
    <li><a href="#"><span>Geográficos</span></a></li>
    <li><a href="#"><span>Lugar</span></a></li>
@stop


@section('content')

    @include('errors._listar')




    <div class="col-lg-8 col-lg-push-2 col-xl-6 col-xl-push-3">
        {!! Form::open(['route' => ['lugar.guardar'],  'id'=>'jv_lugar', 'class' => 'form  form-bordered']) !!}

        <section class="panel">
            <header class="panel-heading">


                <h2 class="panel-title">Nuevo Lugar</h2>

            </header>
            <div class="panel-body">

                <div >
                    <i class="req-leyenda">* Campos obligatorios</i>

                </div>

                <div class="row">

                    <div class="form-group col-md-12">
                        <label class=" control-label" for="lugar">Lugar <span class="required">*</span></label>
                        {!! Form::text('lugar', null, ['id'=>'lugar', 'class' => 'form-control typeahead preview to-select', 'autocomplete' => 'off']) !!}
                    </div>

                    <div class="form-group col-md-12">
                        <label class=" control-label" for="latitud">Latitud <span class="required">*</span> </label>
                        <span class="text-muted text-normal"> formato: (+/-)dd.ddddd</span>

                        {!! Form::text('latitud', null, ['id'=>'latitud', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>

                    <div class="form-group col-md-12">
                        <label class=" control-label" for="longitud">Longitud <span class="required">*</span></label>
                        <span class="text-muted text-normal"> formato: (+/-)dd.ddddd</span>

                        {!! Form::text('longitud', null, ['id'=>'longitud', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
                    </div>

                    {{--Localidad Form Imput--}}
                    <div class="form-group col-md-12">

                        <h3 class="mb-lg">Taxonomía Superior</h3>
                        <label class=" control-label" for="orden_select">Localidad <span class="required">*</span></label>
                        <div>
                            <div class="col-xs-12 col-sm-12 pl-none">
                                {!! Form::select('localidad', $lista_localidades, null, ['id'=> 'localidad','class' => 'form-control select', 'style'=>'width: 100%']) !!}
                            </div>
                        </div>
                    </div>

                </div>


            </div>
            <footer class="panel-footer">
                {{--Crear Articulo Form Imput--}}
                <div class="form-group">

                    <div class="col-sm-3 col-sm-offset-3 ">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary form-control']) !!}
                    </div>

                    <div class="col-sm-3 ">
                        <button type="reset" class="btn btn-default form-control">Borrar</button>
                    </div>
                </div>


            </footer>
        </section>
        {!! Form::close() !!}
    </div>




@stop


@section('script_section')
    @parent
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/typeahead/typeahead.bundle.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/masked-input/jquery.maskedinput.min.js')}}'></script>

    <script type="text/javascript">
        var geograficos = <?php echo $geograficos; ?>;

        $.mask.definitions['~']='[+-]';
        $("#latitud").mask("~99.99?999");
        $("#longitud").mask("~99.99?999");


        var select2 = $(".select").select2({
            placeholder: "Seleccione una localidad"
        });

        select2.val(null).trigger("change");
    </script>
    <script type='text/javascript' src='{{ asset('js/geograficos/typeahead_geografico.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/geograficos/validate_geograficos.js')}}'></script>
    <script>
        localStorage.setItem("menu", "m-registros");
    </script>
@stop
