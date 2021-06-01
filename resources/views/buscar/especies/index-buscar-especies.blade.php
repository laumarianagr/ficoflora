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
              <h3 class="text-dark mb-xlg"><i class="fa fa-search pr-md"></i>Buscar Especies</h3>
          </div>

          <div class="col-xs-12 ">
              <section class="panel panel-featured-left panel-featured-primary">
                  <div class="panel-body">
                      <form action="{{route('buscar.especies')}}" method="POST">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">

                          <label class="control-label" for="genero">Buscar Especie</label>
                          {!! Form::text('especie', null, ['id'=>'especie', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
                      </form>
                  </div>
              </section>
          </div>
      </div>

      <div class="row mt-md mb-xlg">

          <div class="col-xs-12 ">
              <h3 class="mb-xlg text-dark">Especies por Categoría Taxonómica</h3>
          </div>

          <div class="col-xs-12 col-sm-4 ">
              <section class="panel panel-featured-left panel-featured-primary">
                  <div class="panel-body">

                      <label class="control-label" for="genero">Especies del Género</label>
                      {!! Form::text('genero', null, ['id'=>'genero-especies', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                  </div>
              </section>
          </div>

          <div class="col-xs-12 col-sm-4 ">
              <section class="panel panel-featured-left panel-featured-primary">
                  <div class="panel-body">

                      <label class="control-label" for="genero">Especies de la Familia</label>
                      {!! Form::text('familia', null, ['id'=>'familia-especies', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                  </div>
              </section>
          </div>
          <div class="col-xs-12 col-sm-4">
              <section class="panel panel-featured-left panel-featured-primary">
                  <div class="panel-body">

                      <label class="control-label" for="autor">Especies de la Autoridad</label>
                      {!! Form::text('autor', null, ['id'=>'autor-especies', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

                  </div>
              </section>
          </div>

          <div class="col-xs-12">
              <h3 class="mb-xlg text-dark">Especies por Ubicación</h3>

          </div>

          <div class="col-xs-12 ">
              <section class="panel panel-featured-left panel-featured-primary">
                  <div class="panel-body">

                      <label class="control-label" for="genero">Especies por entidad federal, localidad, lugar o sitio</label>
                      {!! Form::text('entidad', null, ['id'=>'ubicacion-especie', 'class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}

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
        var autores = <?php echo json_encode($autores); ?>;

        localStorage.setItem("menu", "m-especie");

    </script>


    <script type='text/javascript' src='{{ asset('js/busquedas/typeahead_busquedas.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/busquedas/typeahead_busqueda_autores.js')}}'></script>

@stop
