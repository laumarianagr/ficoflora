@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins\DataTables-1.10.7\css\dataTables.bootstrap.css')}}">




@stop

@section('content')


    <div class="row">
        <div class="col-md-12 ">
            <section class="panel panel-featured-left panel-featured-primary">
                <div class="panel-body">
                    <form action="{{route('buscar.buscar')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <label class="control-label" for="genero">Buscar Especie</label>
                        {!! Form::text('especie', null, ['id'=>'especie', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
                    </form>
                </div>
            </section>
        </div>

        <div class="col-md-12 ">
            <section class="panel panel-featured-left panel-featured-primary">
                <div class="panel-body">

                        <label class="control-label" for="genero">Especies por Genero</label>
                        {!! Form::text('genero', null, ['id'=>'genero', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                </div>
            </section>
        </div>

        <div class="col-md-12 ">
            <section class="panel panel-featured-left panel-featured-primary">
                <div class="panel-body">

                        <label class="control-label" for="genero">Especies por Familia</label>
                        {!! Form::text('familia', null, ['id'=>'familia', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                </div>
            </section>
        </div>



        <div class="col-md-12 ">

            <h4 class="mb-md">Especies por Ubicación</h4>

            <section class="panel panel-featured-left panel-featured-primary">
                <div class="panel-body">

                    <label class="control-label" for="genero">Especies por Entidad</label>
                    {!! Form::text('entidad', null, ['id'=>'entidad', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                </div>
            </section>
        </div>

        <div class="col-md-12 ">

            <section class="panel panel-featured-left panel-featured-primary">
                <div class="panel-body">

                    <label class="control-label" for="genero">Especies por Localidad</label>
                    {!! Form::text('localidad', null, ['id'=>'localidad', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                </div>
            </section>
        </div>

        <div class="col-md-12 ">

            <section class="panel panel-featured-left panel-featured-primary">
                <div class="panel-body">

                    <label class="control-label" for="genero">Especies por Lugar</label>
                    {!! Form::text('lugar', null, ['id'=>'lugar', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                </div>
            </section>
        </div>






@stop

@section('script_section')
    @parent

    <script type='text/javascript' src='{{ asset('plugins/typeahead/typeahead.bundle.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins\DataTables-1.10.7\js\jquery.dataTables.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins\DataTables-1.10.7\js\dataTables.bootstrap.js')}}'></script>


    <script>



    </script>

    <script type='text/javascript' src='{{ asset('js/busquedas/typeahead_busquedas.js')}}'></script>

@stop
