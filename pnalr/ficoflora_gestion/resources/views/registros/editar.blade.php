@extends('master')

@section('css_section')
    @parent
    <style>
        .tt-selectable{
            cursor: pointer;
        }
        .twitter-typeahead{
            position: inherit;
            display: inherit;


        }
    </style>

@stop

@section('content')
    <h1>Editar Registro</h1>

    @include('errors._listar')


    {!! Form::model($registro, ['method' => 'PATCH', 'action' => ['RegistroController@update', $registro->id]]) !!}


    {{--phylum Form Imput--}}
    <div class="form-group">
        {!! Form::label('phylum', 'Phylum:') !!}
        {!! Form::text('phylum', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
    </div>

    {{--Clase Form Imput--}}
    <div class="form-group">
        {!! Form::label('clase', 'Clase:') !!}
        {!! Form::text('clase', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
    </div>

    {{--Subclase Form Imput--}}
    <div class="form-group">
        {!! Form::label('subclase', 'Subclase:') !!}
        {!! Form::text('subclase', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
    </div>

    {{--Orden Form Imput--}}
    <div class="form-group">
        {!! Form::label('orden', 'Orden:') !!}
        {!! Form::text('orden', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
    </div>

    {{--Familia Form Imput--}}
    <div class="form-group">
        {!! Form::label('familia', 'Familia:') !!}
        {!! Form::text('familia', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
    </div>

    {{--Genero Form Imput--}}
    <div class="form-group">
        {!! Form::label('genero', 'Genero:') !!}
        {!! Form::text('genero', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
    </div>

    {{--Especie Form Imput--}}
    <div class="form-group">
        {!! Form::label('especifico', 'Epíteto Especifico:') !!}
        {!! Form::text('especifico', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
    </div>

    {{--Variedad Form Imput--}}
    <div class="form-group">
        {!! Form::label('varietal', 'Epíteto Varietal:') !!}
        {!! Form::text('varietal', null, ['class' => 'form-control  typeahead', 'autocomplete' => 'off']) !!}
    </div>

    {{--Forma Form Imput--}}
    <div class="form-group">
        {!! Form::label('forma', 'Epíteto Forma:') !!}
        {!! Form::text('forma', null, ['class' => 'form-control  typeahead', 'autocomplete' => 'off']) !!}
    </div>

    {{--Autor Form Imput--}}
    <div class="form-group">
        {!! Form::label('autor', 'Autor:') !!}
        {!! Form::text('autor', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
    </div>

    {{--Crear Articulo Form Imput--}}
    <div class="form-group">
        {!! Form::submit('Crear', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}


@stop


@section('script_section')
    @parent
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/additional-methods.min.js')}}'></script>


@stop
