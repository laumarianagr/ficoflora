@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">

@stop

@section('titulo-seccion')
    Buscar Especies
@stop

@section('breadcrumbs')
    <li><a href="{{route('buscar.index')}}"><span>Buscar</span></a></li>
    <li><a><span>Especies</span></a></li>

@stop




@section('content')

    <div id="buscar-especie" class= "pb-xlg">

        <div class="row">
            <div class="col-xs-12">
                <h2 class="text-dark mb-xlg"><i class="fa fa-search pr-md"></i>Buscar Especie, Sinonimia, Autoridad o Epítetos</h2>
            </div>


            <div class="col-xs-12 ">
                <section class="panel panel-featured-left panel-featured-primary">
                    <div class="panel-body">
                        <form action="{{route('buscar.especies')}}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <label class="control-label" for="genero">Buscar Especie/Sinonimia</label>
                            {!! Form::text('especie', null, ['id'=>'especie', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
                        </form>
                    </div>
                </section>
            </div>

                <div class="col-xs-12 ">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="autor">Autoridad</label>
                            {!! Form::text('autor', null, ['id'=>'autor', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>


                <div class="col-xs-12 ">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="especifico">Epíteto Específico</label>
                            {!! Form::text('especifico', null, ['id'=>'especifico', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>

                <div class="col-xs-12 ">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="varietal">Epíteto Varietal</label>
                            {!! Form::text('varietal', null, ['id'=>'varietal', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>

                <div class="col-xs-12 ">
                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="forma">Epíteto de Forma</label>
                            {!! Form::text('forma', null, ['id'=>'forma', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>


        </div>
    </div>
    </div>






@stop

@section('script_section')
    @parent

    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/typeahead/typeahead.bundle.js')}}'></script>

    <script>
        var autores = <?php echo json_encode($autores); ?>;

        localStorage.setItem("menu", "m-buscar");

    </script>
    <script type='text/javascript' src='{{ asset('js/busquedas/typeahead_busqueda_especies.js')}}'></script>


@stop
