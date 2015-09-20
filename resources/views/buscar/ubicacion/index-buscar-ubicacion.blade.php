@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins\DataTables-1.10.7\css\dataTables.bootstrap.css')}}">




@stop

@section('content')

    <div id="buscar-especie" class= "pb-xlg">

        <div class="row">
            <div class="col-xs-12">
                <h2 class="text-dark mb-xlg"><i class="fa fa-search pr-md"></i>Buscar Ubicación</h2>
            </div>

        </div>

        <div class="row mt-md mb-xlg">


                <div class="col-xs-12 col-md-4  ">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="genero">Entidad</label>
                            {!! Form::text('entidad', null, ['id'=>'entidad', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>

                <div class="col-xs-12 col-md-4 ">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="genero">Localidad</label>
                            {!! Form::text('localidad', null, ['id'=>'localidad', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>




                <div class="col-xs-12 col-md-4 ">


                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="genero">Lugar</label>
                            {!! Form::text('lugar', null, ['id'=>'lugar', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>

    </div>
    </div>






@stop

@section('script_section')
    @parent

    <script type='text/javascript' src='{{ asset('plugins\DataTables-1.10.7\js\jquery.dataTables.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins\DataTables-1.10.7\js\dataTables.bootstrap.js')}}'></script>

    <script>
        localStorage.setItem("menu", "m-buscar");
    </script>

    <script type='text/javascript' src='{{ asset('js/busquedas/typeahead_busquedas.js')}}'></script>

@stop
