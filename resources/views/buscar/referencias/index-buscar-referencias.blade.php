@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">

@stop

@section('content')

    <div id="buscar-referencia" class= "pb-xlg">

        <div class="row">
            <div class="col-xs-12">
                <h3 class="text-dark mb-xlg"><i class="fa fa-search pr-md"></i>Buscar Referencias Bibliográficas</h3>
            </div>

        </div>

        <div class="row mt-md mb-xlg">

            <div class="col-xs-12  ">
                <section class="panel panel-featured-left panel-featured-primary">
                    <div class="panel-body">

                        <label class="control-label" for="referencia"><b>Indique el nombre del Autor o el título de la Referencia</b></label>
                        {!! Form::text('referencia', null, ['id'=>'referencia', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                    </div>
                </section>
            </div>
        </div>

    </div>

@stop

@section('script_section')
    @parent

    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>

    <script>
        localStorage.setItem("menu", "m-referencia");
    </script>

    <script type='text/javascript' src='{{ asset('js/busquedas/typeahead_busquedas.js')}}'></script>

@stop
