@extends('master')

@section('css_section')
    @parent

@stop

@section('titulo-seccion')
    Editar Catálogo
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="{{route('registros.nuevo.index')}}"><span>Editar</span></a></li>
    <li><a href="#"><span>Bibliográfico</span></a></li>
    <li><a href="#"><span>Catálogo</span></a></li>
@stop


@section('content')

    @include('errors._listar')


    <!-- vertical -->
    <div class="row">
        <div class="col-md-12">

            <div id="tab_libro"  >
                <div class="row" >
                    <div class="col-xs-12 col-md-8 col-md-offset-2" >
                    {{--<div class="col-xs-12 col-md-8 col-lg-6" >--}}

                        <section class="panel form-wizard mb-xs" id="ref_catalogo>
                            <header class="panel-heading section-titulo">

                                <h2 class="panel-title">Información del Catálogo</h2>
                            </header>
                            {!! Form::open(['method'=> 'PATCH', 'route' => ['catalogo.actualizar', $catalogo->id], 'id'=>'referencia_catalogo', 'class' => 'form form-bordered form_ref']) !!}

                            <div class="panel-body">
                                <div class="wizard-progress">
                                    <div class="steps-progress">
                                        <div class="progress-indicator"></div>
                                    </div>
                                    <ul class="wizard-steps">
                                        <li class="active">
                                            <a href="#catalogo_paso_1" data-toggle="tab"><span>1</span>Cita</a>
                                        </li>
                                        <li>
                                            <a href="#catalogo_paso_2" data-toggle="tab"><span>2</span>Título del Catálogo</a>
                                        </li>
                                        <li>
                                            <a href="#catalogo_paso_3" data-toggle="tab"><span>3</span>Datos Catálogo incluido en Revista</a>
                                        </li>
                                        <li>
                                            <a href="#catalogo_paso_4" data-toggle="tab"><span>3</span>Datos Catálogo incluido en Libro</a>
                                        </li>
                                        <li>
                                            <a href="#catalogo_paso_5" data-toggle="tab"><span>4</span>Adicional</a>
                                        </li>
                                        <li>
                                            <a href="#catalogo_paso_6" data-toggle="tab"><span>5</span>Complentaria</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="pt-md">
                                    <i class="req-leyenda">* Campos obligatorios</i>
                                </div>

                                <div class="tab-content">
                                    {{--PASO CITA--}}
                                    <div id="catalogo_paso_1" class="row tab-pane active">

                                        {{--input AUTORES catálogo --}}

                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label" for="autores_catalogo">Autores <span class="required">*</span></label>
                                            {!! Form::text('autores', $catalogo->autores, [
                                            'class' => 'form-control preview autores',
                                            'id' => 'autores_catalogo',
                                            'data-toggle'=>"popover",
                                            'title'=>"Tips",
                                            'data-content'=>"El Primer autor comienza por su apellido(,) inicial del nombre(.) ejem: Gómez, S.",
                                            'data-placement'=>"top",
                                            'placeholder'=>'Ejem: Gómez, S., Y. Carballo & N. Gil'
                                            ]) !!}

                                        </div>

                                        {{--select AÑO catalogo--}}
                                        <div class="col-sm-12 form-group ">
                                            <label class="control-label" for="fecha_catalogo">Fecha <span class="required">*</span></label>
                                            {!! Form::select('fecha', $fecha, $catalogo->fecha, ['id'=> 'fecha_catalogo', 'class' => 'form-control select ', 'style'=>'width: 100%']) !!}

                                        </div>

                                        {{--select CITA NUM AUTORES catalogo--}}
                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label" for="cita_catalogo">Cita <span class="required">*</span></label>
                                            {!! Form::text('cita', $catalogo->cita.', '.$catalogo->fecha.$catalogo->letra, ['id'=> 'cita_catalogo', 'class' => 'form-control cita']) !!}
                                        </div>

                                    </div>

                                    {{--PASO TÍTULO CATÁLOGO--}}
                                    <div id="catalogo_paso_2" class="row tab-pane">

                                        {{--textarea TÍTULO catálogo--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="titulo_catalogo">Título del Catálogo <span class="required">*</span></label>
                                            {!! Form::textarea('titulo', $catalogo->titulo, ['class' => 'form-control tinymce', 'id'=>'titulo_catalogo' ]) !!}
                                        </div>
                                    </div>

                                    {{--PASO DATOS CATÁLOGO EN REVISTA--}}
                                    <div id="catalogo_paso_3" class="row tab-pane">

                                        {{--input NOMBRE catálogo--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="nombre_catalogo">Nombre de la revista que incluye el catálogo</label>
                                            {!! Form::text('nombre revista', $catalogo->nombre , ['class' => 'form-control preview', 'id' => 'nombre_catalogo']) !!}
                                        </div>

                                        {{--input VOLUMEN catálogo--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="volumen_catalogo">Volumen</label>
                                            {!! Form::text('volumen', $catalogo->volumen , ['class' => 'form-control preview', 'id' => 'volumen_catalogo']) !!}
                                        </div>

                                        {{--input NÚMERO catálogo--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="numero_catalogo">Número</label>
                                            {!! Form::text('numero', $catalogo->numero , ['class' => 'form-control preview', 'id' => 'numero_catalogo']) !!}
                                        </div>

                                        {{--input INTERVALO PÁGINAS catálogo en revista--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="intervalo_catalogo">Intervalo de páginas</label>

                                            <div class="input-group mb-md">
                                                {!! Form::text('intervalo_1', $catalogo->intervalo_1 , ['class' => 'form-control preview', 'id' => 'intervalo_1_catalogo']) !!}
                                                <span class="input-group-addon">
                                                    <i class="">-</i>
                                                </span>
                                                {!! Form::text('intervalo_2', $catalogo->intervalo_2 , ['class' => 'form-control preview', 'id' => 'intervalo_2_catalogo']) !!}
                                            </div>
                                        </div>

                                    </div>

                                    {{--PASO DATOS CATÁLOGO EN LIBRO--}}
                                    <div id="catalogo_paso_4" class="row tab-pane">

                                        {{--input EDICIÓN del libro con el cátalogo--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="edicion_catalogo">Edición del libro que incluye el catálogo</label>
                                            {!! Form::text('edicion', $catalogo->edicion, ['class' => 'form-control preview', 'id' => 'edicion_catalogo']) !!}

                                        </div>

                                        {{--input EDITOR Y EDITORIAL libro que incluye el catálogo--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="editor_editorial_catalogo">Editor y Editorial</label>
                                            {!! Form::text('editor y editorial', $catalogo->editor_editorial, ['class' => 'form-control preview', 'id' => 'editor_editorial_catalogo']) !!}
                                        </div>

                                        {{--input LUGAR libro--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="lugar_catalogo">Lugar</label>
                                            {!! Form::text('lugar', $catalogo->lugar, ['class' => 'form-control preview', 'id' => 'lugar_catalogo']) !!}
                                        </div>

                                        {{--input PAGINAS libro--}}
                                        <div class=" col-xs-12 form-group">
                                            <label class=" control-label" for="paginas_catalogo">Total de páginas</label>
                                            {!! Form::text('paginas', $catalogo->paginas, ['class' => 'form-control preview', 'id' => 'paginas_catalogo', 'type'=>'number']) !!}
                                        </div>

                                    </div>


                                    {{--PASO ADICIONAL--}}
                                    <div id="libro_paso_5" class="row tab-pane">
                                        {{--input ISBN catálogo--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="isbn_catalogo">ISBN</label>
                                            {!! Form::text('isbn', $catalogo->isbn, ['class' => 'form-control preview', 'id' => 'isbn_catalogo']) !!}
                                        </div>

                                        {{--input DOI catálogo--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="doi_catalogo">DOI</label>
                                            {!! Form::text('doi', $catalogo->doi, ['class' => 'form-control preview', 'id' => 'doi_catalogo']) !!}
                                        </div>

                                    </div>

                                    {{--PASO COMPLEMENTARIA--}}
                                    <div id="libro_paso_6" class="row tab-pane">
                                       {{--input ARCHIVO libro--}}
                                        {{--<div class="col-xs-12 form-group">--}}
                                            {{--<label class=" control-label" for="archivo_libro">Archivo</label>--}}
                                            {{--{!! Form::text('archivo', null, ['class' => 'form-control preview', 'id' => 'archivo_libro']) !!}--}}
                                        {{--</div>--}}


                                        {{--input COMENTARIO catálogo--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="comentarios_catalogo>Comentario</label>
                                            {!! Form::text('comentarios', null, ['class' => 'form-control preview', 'id' => 'comentarios_catalogo']) !!}
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="panel-footer">
                                <div class="form-group">

                                    <div class="col-sm-4 col-xl-2">
                                        <button type="button" class="btn btn-default form-control" id="anterior">Anterior</button>
                                    </div>

                                    <div class="col-sm-4  col-sm-offset-4 col-xl-2 col-xl-offset-8 hidden" id="crear_catalogo">
                                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary form-control']) !!}
                                    </div>

                                    <div class="col-sm-4  col-sm-offset-4 col-xl-2 col-xl-offset-8 ">
                                        <button type="button" class="btn btn-default form-control"  id="siguiente">Siguiente</button>
                                    </div>
                                </div>
                            </div>

                            {!! Form::close() !!}


                        </section>
                    </div>

{{--                    @include('bibliograficos.referencias._parciales._catalogo-resultado')--}}

                </div>
            </div>


        </div>
    </div>

@stop


@section('script_section')
    @parent

    <script type='text/javascript' src='{{ asset('plugins/tinymce/tinymce.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/wizard/jquery.bootstrap.wizard.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/wizard/examples.wizard.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/componentes.js')}}'></script>
{{--    <script type='text/javascript' src='{{ asset('js/bibliograficos/crear_referencias.js')}}'></script>--}}


    <script type="text/javascript">

        $('html').addClass('fixed sidebar-left-collapsed');

        $(document).ready(function() {

            $(".select").select2({
                placeholder: "Seleccione una opción"
            });

      
            $(function () {
                $('#ref_catalogo [data-toggle="popover"]').popover({
                    trigger: 'focus'
                })
            })


            //pasa los textos de los select a resultado
            $(".select").change(function(){

                //Obtengo el texto del select que se selecciono
                var seleccion = $('option:selected', this).text();


                //obtengo el id del elementeo seleccionado, se transforma en clase, la cual sera la que tenga el span de resultado
                // ejem select id= fecha_libro, span class = fecha_libro
                var class_span = '.'+this.id;

                if($(this).val()){
                    $(class_span).parents(".wrap").show();
                }else{
                    $(class_span).parents(".wrap").hide();
                }

                $(class_span).html(seleccion);
            });


            $(".cita").change(function(){

                //Obtengo el value del select de la cita
                var value = $('option:selected', this).val();
                var tipo = this.id.split('_')[1];
                var id_autores = '#autores_'+tipo;
                var class_span = '.cita_'+tipo;
                var cita;

                var autores = $(id_autores).val();

                if($(id_autores).val()){

                    $(class_span).parents(".wrap").show();

                    switch(value){
                        case '1':
                            cita = autores.split(',')[0];
                            break;

                        case '2':
                            cita = autores.split(',')[0]+' & '+ autores.split(' ').pop();
                            break;

                        case '3':
                            cita = autores.split(',')[0]+' <em>et al.</em>'
                            break;

                    }
                }else{
                    $(class_span).parents(".wrap").hide();
                }

                $(class_span).html(cita);
            });



            $(".preview").on('keyup', function(){
                var class_span = '.'+this.id;

                var contenido = $(this).val();
//                    console.log(contenido);

                if($(this).val()){
                    $(class_span).parents(".wrap").show();
                }else{
                    $(class_span).parents(".wrap").hide();
                }

                $(class_span).html(contenido);
            });





            tinymce.init({
                selector: ".tinymce",
                min_height: 60,
                fontsize_formats: "18pt 24pt 36pt",
                menubar : false,
                language : 'es',
                plugins: "charmap paste code",
                valid_elements: "p,b,i,strong,em,span[style]",
                paste_word_valid_elements: "p,b,i,strong,em,span",
                forced_root_block: '',

                toolbar: [
                    "undo redo | copy paste | bold italic underline | charmap  code"
                ],
                setup: function(editor_editorial) {

                    editor_editorial.on('keyup change', function(e) {
//                            console.log( tinyMCE.activeEditor.getContent({format : 'html'}));
//                            console.log( tinyMCE.activeEditor.getContent());

                        //obtengo el contenido del texarea tinymce
                        var p = tinyMCE.activeEditor.getContent();

                        //tranformo el id en la clase que tiene el span de resultado
                        var class_span = '.'+this.id;

                        if( p != ''){
                            $(class_span).parents(".wrap").show();
                        }else{
                            $(class_span).parents(".wrap").hide();
                        }
                        //adjunto el contenido del textarea a el span de resultado
                        $(class_span).html(p);

                    });

                    editor_editorial.on('init', function()
                    {
                        this.getDoc().body.style.fontSize = '14px';
                    });
                }

            });

        });

    </script>

@stop