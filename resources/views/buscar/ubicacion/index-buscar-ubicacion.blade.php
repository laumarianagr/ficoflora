@extends('master')

@section('title')
@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">

@stop

@section('content')

    <div id="buscar-especie" class= "pb-xlg">

        <div class="row">
            <div class="col-xs-12">
                <h3 class="text-dark mb-xlg"><i class="fa fa-search pr-md"></i>Buscar Ubicación</h3>
            </div>

        </div>

        <div class="row mt-md mb-xlg">
                <div class="col-xs-12  ">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="genero"><b>Ubicación</b> (Entidad federal, localidad, lugar o sitio)</label>
                            {!! Form::text('ubicacion', null, ['id'=>'ubicacion', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

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
        localStorage.setItem("menu", "m-ubicacion");
    </script>

    <script type='text/javascript' src='{{ asset('js/busquedas/typeahead_busquedas.js')}}'></script>

@stop