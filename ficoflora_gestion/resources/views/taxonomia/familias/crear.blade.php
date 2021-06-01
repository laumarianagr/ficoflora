@extends('master')

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{ asset('plugins/select2-4.0.0/css/select2.min.css')}}">
    <style>
        .select2-rendered__match {
            /*text-decoration: underline;*/
            font-weight: bold !important;
            color: #9cbc1f !important;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            /*background: none;*/
            /*color: #000;*/
        }
    </style>
@stop


@section('titulo-seccion')
    Nuevo registro de Familia
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="{{route('registros.nuevo.index')}}"><span>Nuevo</span></a></li>
    <li><a href="#"><span>Familia</span></a></li>
@stop


@section('content')

    @include('errors._listar')

    <div class="col-lg-8 col-lg-push-2 col-xl-6 col-xl-push-3">
        {!! Form::open(['url' => 'familias',  'id'=>'jv_familia', 'class' => 'form  form-bordered']) !!}

        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Nueva Familia</h2>
                <p class="panel-subtitle"></p>
            </header>

            <div class="panel-body">
                <div><i class="req-leyenda">* Campos obligatorios</i></div>

                <div class="row">

                    <div class="form-group col-md-12">
                        <label class=" control-label" for="familia">Familia <span class="required">*</span></label>
                        {!! Form::text('familia', null, ['id'=>'familia', 'class' => 'form-control typeahead preview to-select', 'autocomplete' => 'off']) !!}
                    </div>

                    {{--Familia Form Imput--}}
                    <div class="form-group col-md-12">
                        <h3 class="mb-lg">Taxonomía Superior</h3>
                        <label class=" control-label" for="orden_select">Orden <span class="required">*</span></label>
                        <div>
                            <div class="col-xs-6 col-sm-9 pl-none">
                                {!! Form::select('orden', $ordenes, null, ['id'=> 'orden','class' => 'form-control select', 'style'=>'width: 100%']) !!}
                            </div>

                            <div class="col-xs-4 col-sm-3 pt-xs">
                                <a class="text-md modal-basic modal-with-zoom-anim  get_typeahead-datos" href="#modal_nuevoOrden" id="nuevo-orden"><span class="fa fa-plus-circle va-middle text-xl " aria-hidden="true"></span> Nuevo</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <footer class="panel-footer">
                <div class="form-group">
                    <div class="col-sm-6 ">
                        {!! Form::submit('Crear', ['class' => 'btn btn-primary form-control']) !!}
                    </div>

                    <div class="col-sm-6 ">
                        <button type="reset" class="btn btn-default form-control">Borrar</button>
                    </div>
                </div>
            </footer>

        </section>
        {!! Form::close() !!}
    </div>


    {{--MODAL NUEVO ORDEN--}}
    @include('taxonomia.modales._modal-nuevo-orden')

@stop


@section('script_section')
    @parent
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/typeahead/typeahead.bundle.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/select2-4.0.0/js/select2.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>

    <script type="text/javascript">
            var taxonomia = <?php echo $taxonomia; ?>;

            $(document).ready(function(){
                var query = {};

                function markMatch (text, term) {
                    // Find where the match is
                    var match = text.toUpperCase().indexOf(term.toUpperCase());

                    var $result = $('<span></span>');

                    // If there is no match, move on
                    if (match < 0) {
                        return $result.text(text);
                    }

                    // Put in whatever text is before the match
                    $result.text(text.substring(0, match));

                    // Mark the match
                    var $match = $('<span class="select2-rendered__match"></span>');
                    $match.text(text.substring(match, match + term.length));

                    // Append the matching text
                    $result.append($match);

                    // Put in whatever is after the match
                    $result.append(text.substring(match + term.length));

                    return $result;
                }
                var $select = $(".select").select2({
                    placeholder: "Seleccione un Orden",
                    allowClear: true,
                    templateResult: function (item) {
                        // No need to template the searching text
                        if (item.loading) {
                            return item.text;
                        }

                        var term = query.term || '';
                        var $result = markMatch(item.text, term);

                        return $result;
                    },
                    language: {
                        searching: function (params) {
                            // Intercept the query as it is happening
                            query = params;

                            // Change this to be appropriate for your application
                            return 'Buscando…';
                        },
                        noResults: function() {
                            return "No se encontraron resultados";
                        }
                    }

                });
                $select.val(null).trigger("change");
            });
    </script>
    <script type='text/javascript' src='{{ asset('js/registros/validate_taxonomia.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/taxonomia/nuevas_taxonomias_modal.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/registros/typeahead_taxonomia.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>

    <script>
        localStorage.setItem("menu", "m-registros");
    </script>

@stop
