@extends('master')

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/css/toastr.css')}}">

@stop


@section('titulo-seccion')
    Edición de Especie
@stop


@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="{{route('registros.nuevo.index')}}"><span>Editar</span></a></li>
    <li><a href="#"><span>Especie</span></a></li>
@stop


@section('content')

    {{--ERRORES DESDE EL SERVIDOR--}}
    @include('errors._listar')

    <div class="row">
        {!! Form::open(['method'=> 'PATCH', 'route' => ['especie.actualizar', $especie['id']],  'id'=>'jv_especie', 'class' => 'form  form-bordered']) !!}

        <section class="panel col-xs-12 col-md-8 col-xlg-6">
            <header class="panel-heading section-titulo">
                <h2 class="panel-title">Editar Especie</h2>
            </header>

            {{--FORMULARIO DE NUEVA ESPECIE--}}
            <div class="panel-body pb-xlg">
                @include('taxonomia.especies._parciales._form-editar-especie')
            </div>

            <footer class="panel-footer">
                <div class="form-group">
                    <div class="col-sm-3 pull-right ">
                        {!! Form::submit('Guardar', ['id'=>'guardar', 'class' => 'btn btn-primary form-control']) !!}
                    </div>

                </div>
            </footer>

        </section>

        {!! Form::close() !!}

        {{--PREVIEW RESULTADO--}}
        <div class="col-xs-12 col-md-4 col-xlg-6">
            @include('taxonomia.especies._parciales._resultado_especie')
        </div>


    </div>

    {{--MODAL NUEVO GENERO--}}
    @include('taxonomia.modales._modal-nuevo-genero')
    {{--MODAL NUEVO ESPECIFICO--}}
    @include('taxonomia.modales._modal-nuevo-especifico')
    {{--MODAL NUEVO VARIETAL--}}
    @include('taxonomia.modales._modal-nuevo-varietal')
    {{--MODAL NUEVO FORMA--}}
    @include('taxonomia.modales._modal-nuevo-forma')
    {{--MODAL NUEVO AUTOR--}}
    @include('taxonomia.modales._modal-nuevo-autor')
    {{--MODAL NUEVA FAMILIA--}}
    @include('taxonomia.modales._modal-nueva-familia')

@stop


@section('script_section')
    @parent
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/typeahead/typeahead.bundle.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/select2-4.0.0/js/select2.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/toastr/js/toastr.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/registros/validate_taxonomia.js')}}'></script>


    <script type='text/javascript' src='{{ asset('js/preview.js')}}'></script>

    <script type="text/javascript">
        var root_url = "<?php echo Request::root(); ?>/";
        console.log(root_url);

        var taxonomia = <?php echo $taxonomia; ?>;
        var generos = <?php echo json_encode($generos); ?>;
        console.log(generos);
            var especie = <?php echo $especie; ?>;


        $('html').addClass('fixed sidebar-left-collapsed');

        $(".select").select2({
            placeholder: "Seleccione una opción",
            allowClear: true
        });

        //Inicializar el select2 con la lista de familias
        var select2 = $("#familia.select").select2({
            placeholder: "Seleccione una Familia"
        });


        var selectG = $("#genero.select").select2({
            data: generos,
            placeholder: "Seleccione una opción"
        }).val(especie['genero_id']).trigger("change");



        function findPurpose(id){
            for (var i = 0, len = generos.length; i < len; i++)
            {
                if (generos[i].id == id)
                {
                    return generos[i]; // Return as soon as the object is found
                }
            }
        };

        $("#genero").on("select2:select", function (e) {
           var objeto = findPurpose($(this).val());
            $("#familia.select").val(objeto['familia_id']).trigger("change");
        });




        console.log(especie);

        if(especie['varietal_id'] == null){
            console.log('var null');
            $("#variedad").val(null).trigger("change")
        }
        if(especie['forma_id'] == null){
            console.log('f null');
            $("#forma").val(null).trigger("change")

        }

            setSpanSelect($("#genero")[0]);
            setSpanSelect($("#especie")[0]);
            setSpanSelect($("#variedad")[0]);
            setSpanSelect($("#forma")[0]);
            setSpanSelect($("#autor")[0]);
            setSpanSelect($("#familia")[0]);


            setSpanText(especie['orden'],'.orden')
            if(especie['subclase']){
                setSpanText(especie['subclase'],'.subclase')
            }
            setSpanText(especie['clase'],'.clase')
            setSpanText(especie['phylum'],'.phylum')
        





    </script>
    <script type='text/javascript' src='{{ asset('js/registros/validate_taxonomia.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/componentes.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/taxonomia/nuevas_taxonomias_modal.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/registros/crear_especie.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/taxonomia/especies/especie-editar.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/registros/typeahead_taxonomia.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>
    <script>
        localStorage.setItem("menu", "m-registros");
    </script>

@stop
