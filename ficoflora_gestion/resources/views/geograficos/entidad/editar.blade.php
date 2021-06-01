@extends('master')

@section('css_section')
    @parent
@stop


@section('titulo-seccion')
    Editar Entidad Federal
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="{{route('usuario.registros')}}"><span>Editar</span></a></li>
    <li><a href="#"><span>Geográficos</span></a></li>
    <li><a href="#"><span>Entidad Federal</span></a></li>
@stop


@section('content')

    @include('errors._listar')



    <div class="col-lg-8 col-lg-push-2 col-xl-6 col-xl-push-3">
        {!! Form::open(['method'=> 'PATCH', 'route' => ['entidad.actualizar', $entidad['id']],  'id'=>'jv_entidad', 'class' => 'form  form-bordered']) !!}

        <section class="panel">
            <header class="panel-heading">


                <h2 class="panel-title">Editar Entidad Federal</h2>

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
                        <label class=" control-label" for="entidad">Entidad Federal<span class="required">*</span></label>

                        {!! Form::text('entidad', $entidad['nombre'], ['id'=>'entidad', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
                    </div>

                    <div class="form-group col-md-12">
                        <label class=" control-label" for="latitud">Latitud <span class="required">*</span> </label>
                        <span class="text-muted text-normal"> formato: (+/-)dd.ddddd</span>

                        {!! Form::text('latitud', $entidad['latitud'], ['id'=>'latitud', 'class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>

                    <div class="form-group col-md-12">
                        <label class=" control-label" for="longitud">Longitud <span class="required">*</span></label>
                        <span class="text-muted text-normal"> formato: (+/-)dd.ddddd</span>

                        {!! Form::text('longitud', $entidad['longitud'], ['id'=>'longitud', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
                    </div>


                </div>



            </div>
            <footer class="panel-footer">
                {{--Crear Articulo Form Imput--}}
                <div class="form-group">

                    <div class="col-sm-3 col-sm-offset-3">
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
    </script>

    <script type='text/javascript' src='{{ asset('js/geograficos/validate_geograficos.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/geograficos/typeahead_geografico.js')}}'></script>
    <script>
        localStorage.setItem("menu", "m-registros");
    </script>

@stop
