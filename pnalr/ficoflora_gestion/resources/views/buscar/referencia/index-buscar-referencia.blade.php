@extends('master')

@section('title')

@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">

@stop



@section('titulo-seccion')
    Buscar Referencia
@stop

@section('breadcrumbs')
    <li><a href="{{route('buscar.index')}}"><span>Buscar</span></a></li>
    <li><a><span>Referencia</span></a></li>

@stop



@section('content')

    <div id="buscar-especie" class= "pb-xlg">

        <div class="row">
            <div class="col-xs-12">
                <h2 class="text-dark mb-xlg"><i class="fa fa-search pr-md"></i>Buscar Referencia</h2>
            </div>

        </div>

        <div class="row  mb-md">

            <div class="col-xs-12 ">
                <h3 class="text-dark mb-lg">Libro</h3>
            </div>

                <div class="col-xs-12  ">

                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="genero">Autor</label>
                            {!! Form::text('autor', null, ['id'=>'autor_libro', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>


                <div class="col-xs-12  ">

                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="genero">Título</label>
                            {!! Form::text('titulo', null, ['id'=>'titulo_libro', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>
        </div>

        <div class="row  mb-md">

            <div class="col-xs-12 ">
                <h3 class="text-dark mb-lg">Revista</h3>
            </div>

                <div class="col-xs-12 ">

                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="autor">Autor</label>
                            {!! Form::text('autor', null, ['id'=>'autor_revista', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>


                <div class="col-xs-12  ">

                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="titulo">Título</label>
                            {!! Form::text('titulo', null, ['id'=>'titulo_revista', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>
        </div>


        <div class="row mb-xlg mb-md">

            <div class="col-xs-12 ">
                <h3 class="text-dark mb-lg">Trabajo Académico</h3>
            </div>

                <div class="col-xs-12  ">

                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="autor">Autor</label>
                            {!! Form::text('autor', null, ['id'=>'autor_trabajo', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>


                <div class="col-xs-12  ">

                    <section class="panel panel-featured-left panel-featured-primary">
                        <div class="panel-body">

                            <label class="control-label" for="titulo">Título</label>
                            {!! Form::text('titulo', null, ['id'=>'titulo_trabajo', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                        </div>
                    </section>
                </div>
        </div>

        <div class="mb-xlg"></div>

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
    <script type='text/javascript' src='{{ asset('plugins/typeahead/typeahead.bundle.js')}}'></script>

    <script>
        localStorage.setItem("menu", "m-buscar");
    </script>



    <script type='text/javascript' src='{{ asset('js/busquedas/typeahead_busquedas_referencias.js')}}'></script>

@stop
