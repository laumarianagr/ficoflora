@extends('master')

@section('css_section')
    @parent
@stop

@section('titulo-seccion')
    Editar Epíteto Varietal
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="{{route('registros.nuevo.index')}}"><span>Editar</span></a></li>
    <li><a href="#"><span>Epíteto Varietal</span></a></li>
@stop

@section('content')

    @include('errors._listar')


    <div class="col-lg-8 col-lg-push-2 col-xl-6 col-xl-push-3">
        {!! Form::open(['method'=> 'PATCH','route'=> ['varietal.actualizar', $varietal['id']],   'id'=>'jv_varietal', 'class' => 'form  form-bordered']) !!}

        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title"> Editar Epíteto Varietal</h2>
                <p class="panel-subtitle"></p>
            </header>

            <div class="panel-body">
                <div><i class="req-leyenda">* Campos obligatorios</i></div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label class=" control-label" for="especie">Epíteto varietal <span class="required">*</span></label>

                        {!! Form::text('varietal', $varietal['nombre'], ['id'=>'variedad', 'class' => 'form-control typeahead preview', 'autocomplete' => 'off']) !!}
                    </div>


                </div>
            </div>

            <footer class="panel-footer">
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


@stop


@section('script_section')
    @parent

    <script type="text/javascript">

        var taxonomia = <?php echo $taxonomia; ?>;

        localStorage.setItem("menu", "m-registros");
    </script>
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/additional-methods.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/typeahead/typeahead.bundle.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/registros/validate_taxonomia.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/registros/typeahead_taxonomia.js')}}'></script>



@stop
