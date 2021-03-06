@extends('master')

@section('title')
@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
@stop

@section('content')

    <div id="buscar-especie" class= "pb-md">

        <div class="row">
            <div class="col-xs-12">
                <h3 class="text-dark mb-xlg"><i class="fa fa-search pr-md"></i>Buscar Clasificación Taxonómica</h3>
            </div>

        </div>

        <div class="row mt-md ">

            <div class="col-xs-12 col-md-6">

                <div class="col-xs-12  ">

                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="genero">Phylum</label>
                            {!! Form::text('phylum', null, ['id'=>'phylum', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>

                <div class="col-xs-12 ">

                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="genero">Clase</label>
                            {!! Form::text('clase', null, ['id'=>'clase', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>

                <div class="col-xs-12 ">

                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="genero">Subclase</label>
                            {!! Form::text('subclase', null, ['id'=>'subclase', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>
            </div>


            <div class="col-xs-12 col-md-6 ">

                <div class="col-xs-12 ">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="orden">Orden</label>
                            {!! Form::text('orden', null, ['id'=>'orden', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>

                <div class="col-xs-12 ">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="genero">Familia</label>
                            {!! Form::text('familia', null, ['id'=>'familia', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>

                <div class="col-xs-12  ">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="genero">Género</label>
                            {!! Form::text('genero', null, ['id'=>'genero-especies', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>

            </div>

        </div>

    </div>

@stop

@section('script_section')
    @parent

    <script>
        localStorage.setItem("menu", "m-taxonomia");
    </script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/busquedas/typeahead_busquedas.js')}}'></script>

@stop