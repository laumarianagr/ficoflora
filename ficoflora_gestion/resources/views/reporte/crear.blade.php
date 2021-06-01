@extends('master')

@section('css_section')
    @parent

    <link rel="stylesheet" href="{{ asset('plugins/select2-4.0.0/css/select2.min.css')}}">

@stop

@section('content')
    <h1>Nuevo Reporte</h1>

    @include('errors._listar')


    {!! Form::open(['url' => 'clases',  'id'=>'jv_clase', 'class' => 'form']) !!}

    <div class="row">
        <div class="col-sm-12">

        {{--Especie Form Imput--}}
        <div class="form-group">
            {!! Form::label('especie', 'Seleccionar Especie:') !!}
            {!! Form::select('especie', $especies, null, ['id'=> 'select', 'class' => 'form-control']) !!}
        </div>
        </div>        <div class="col-sm-12">

        <div class="form-group">
            {!! Form::label('especie', 'Crear nueva Especie:') !!}

        </div>
        </div>

        <div class="col-sm-12">

        <button type="button" class="btn btn-primary" id="nueva_especie">Nueva Especie</button>
</div>
</div> <div class="row">
        <div class="col-sm-3">
            {{--Genero Form Imput--}}
            <div class="form-group">
                {!! Form::label('genero', 'Género:') !!}
                {!! Form::text('genero', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
            </div>
        </div>
        <div class="col-sm-3">

            {{--Especie Form Imput--}}
            <div class="form-group">
                {!! Form::label('especie', 'Epíteto Específico:') !!}
                {!! Form::text('especie', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
            </div>
        </div>

        <div class="col-sm-3">
            {{--Variedad Form Imput--}}
            <div class="form-group">
                {!! Form::label('variedad', 'Epíteto Varietal:') !!}
                {!! Form::text('variedad', null, ['class' => 'form-control  typeahead', 'autocomplete' => 'off']) !!}
            </div>
        </div>

        <div class="col-sm-3">
            {{--Forma Form Imput--}}
            <div class="form-group">
                {!! Form::label('forma', 'Epíteto Forma:') !!}
                {!! Form::text('forma', null, ['class' => 'form-control  typeahead', 'autocomplete' => 'off']) !!}
            </div>
        </div>

        <div class="col-sm-3">
            {{--Subespecie Form Imput--}}
            <div class="form-group">
                {!! Form::label('subespecie', 'Subespecie:') !!}
                {!! Form::text('subespecie', null, ['class' => 'form-control  typeahead', 'autocomplete' => 'off']) !!}
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-xs-12">
            {{--Autor Form Imput--}}
            <div class="form-group">
                {!! Form::label('autor', 'Autor:') !!}
                {!! Form::text('autor', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12">
            <h4>Taxonomía Superior</h4>

            {{--Familia Form Imput--}}
            <div class="form-group">
                {!! Form::label('familia', 'Familia:') !!}
                {!! Form::select('familia', $especies, null, ['id'=> 'select','class' => 'form-control']) !!}
            </div>
        </div>

    </div>

        <div class="row">


        <div class="col-sm-3">
            {{--Clase Form Imput--}}
            <div class="form-group">
                {!! Form::label('clase', 'Clase:') !!}
                {!! Form::text('clase', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
            </div>

        </div>
        </div>


    <div class="row">

        <div class="col-xs-12">
            <h4>Taxonomía superior</h4>

            {{--Crear Articulo Form Imput--}}
            <div class="form-group">
                {!! Form::submit('Crear', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>

    </div>

    {!! Form::close() !!}
@stop


@section('script_section')
    @parent
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/typeahead/typeahead.bundle.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/select2-4.0.0/js/select2.min.js')}}'></script>

    <script type="text/javascript">


        $(document).ready(function(){

            var select = $("#select").select2({
                placeholder: "Seleccione un Phylum",
                allowClear: true
            });

            select.val(null).trigger("change");

            $('#nueva_especie').click(function() {

//                var test = $('#select');

//                $("#select").select2('data', {id: '200', text: 'xxx'});
//            var data = $(test).select2("data");
                var data=$('#select').select2("val");
                console.log(data);

//                data.push({id:0,text:"fixed"});
//                $(test).select2("data", data, true);
//                console.log(data);
            });
        });

    </script>
    <script type='text/javascript' src='{{ asset('js/registros/validate_taxonomia.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/registros/typeahead_taxonomia.js')}}'></script>
@stop