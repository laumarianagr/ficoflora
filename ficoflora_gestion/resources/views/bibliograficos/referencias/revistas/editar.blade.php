@extends('master')

@section('css_section')
    @parent


@stop

@section('titulo-seccion')
    Editar Revista
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="{{route('registros.nuevo.index')}}"><span>Nuevo</span></a></li>
    <li><a href="#"><span>Bibliográfico</span></a></li>
    <li><a href="#"><span>Revista</span></a></li>
@stop


@section('content')

    @include('errors._listar')


    <!-- vertical -->
    <div class="row">
        <div class="col-md-12">

            <div id="tab_revista"  >
                <div class="row" >
                    <div class="col-xs-12 col-md-8 col-md-offset-2" >
                        {{--<div class="col-xs-12 col-md-8 col-lg-6" >--}}

                        <section class="panel form-wizard mb-xs" id="ref_revista">
                            <header class="panel-heading section-titulo">

                                <h2 class="panel-title">Información de la Revista</h2>
                            </header>
                            {!! Form::open(['method'=> 'PATCH', 'route' => ['revista.actualizar', $revista->id], 'id'=>'referencia_revista', 'class' => 'form form-bordered form_ref']) !!}

                            <div class="panel-body">
                                <div class="wizard-progress">
                                    <div class="steps-progress">
                                        <div class="progress-indicator"></div>
                                    </div>
                                    <ul class="wizard-steps">
                                        <li class="active">
                                            <a href="#revista_paso_1" data-toggle="tab"><span>1</span>Cita</a>
                                        </li>
                                        <li>
                                            <a href="#revista_paso_2" data-toggle="tab"><span>2</span>Datos Revista</a>
                                        </li>
                                        <li>
                                            <a href="#revista_paso_3" data-toggle="tab"><span>3</span>Adicional</a>
                                        </li>
                                        <li>
                                            <a href="#revista_paso_4" data-toggle="tab"><span>4</span>Complentaria</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="pt-md">
                                    <i class="req-leyenda">* Campos obligatorios</i>
                                </div>

                                <div class="tab-content">
                                    {{--PASO CITA--}}
                                    <div id="revista_paso_1" class="row tab-pane active">

                                        {{--input AUTORES revista--}}

                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label" for="autores_revista">Autores <span class="required">*</span></label>
                                            {!! Form::text('autores', $revista->autores , [
                                            'class' => 'form-control preview autores',
                                            'id' => 'autores_revista',
                                            'data-toggle'=>"popover",
                                            'title'=>"Tips",
                                            'data-content'=>"El Primer autor comienza por su apellido(,) inicial del nombre(.) ejem: García, M.",
                                            'data-placement'=>"top",
                                            'placeholder'=>'Ejem: García, M., G. Gómez & N. Gil'
                                            ]) !!}
                                        </div>

                                        {{--select AÑO revista--}}
                                        <div class="col-sm-12 form-group ">
                                            <label class="control-label" for="fecha_revista">Fecha <span class="required">*</span></label>
                                            {!! Form::select('fecha', $fecha,  $revista->fecha, ['id'=> 'fecha_revista', 'class' => 'form-control select', 'style'=>'width: 100%']) !!}
                                        </div>

                                        {{--select CITA NUM AUOTRES revista--}}
                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label" for="cita_revista">Cita <span class="required">*</span></label>
                                            {!! Form::text('cita', $revista->cita.', '.$revista->fecha.$revista->letra, ['id'=> 'cita_libro', 'class' => 'form-control cita']) !!}

                                        </div>

                                    </div>

                                    {{--PASO DATOS LIBRO--}}
                                    <div id="revista_paso_2" class="row tab-pane">

                                        {{--textarea TÍTULO revista--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="titulo_revista">Título del artículo <span class="required">*</span></label>
                                            {!! Form::textarea('titulo', $revista->titulo , ['class' => 'form-control tinymce', 'id'=>'titulo_revista' ]) !!}

                                        </div>

                                        {{--input NOMBRE revista--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="nombre_revista">Nombre de la revista<span class="required">*</span></label>
                                            {!! Form::text('nombre', $revista->nombre , ['class' => 'form-control preview', 'id' => 'nombre_revista']) !!}
                                        </div>

                                        {{--input EDICIÓN revista--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="volumen_revista">Volumen <span class="required">*</span></label>
                                            {!! Form::text('volumen', $revista->volumen , ['class' => 'form-control preview', 'id' => 'volumen_revista']) !!}
                                        </div>

                                        {{--input EDITORIAL revista--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="numero_revista">Número</label>
                                            {!! Form::text('numero', $revista->numero , ['class' => 'form-control preview', 'id' => 'numero_revista']) !!}
                                        </div>

                                        {{--input INTERVALO PAGINAS revista--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="intervalo_revista">Intervalo de páginas <span class="required">*</span></label>

                                            <div class="input-group mb-md">
                                                {!! Form::text('intervalo_1', $revista->intervalo_1 , ['class' => 'form-control preview', 'id' => 'intervalo_1_revista']) !!}
                                                <span class="input-group-addon">
                                                    <i class="">-</i>
                                                </span>
                                                {!! Form::text('intervalo_2', $revista->intervalo_2 , ['class' => 'form-control preview', 'id' => 'intervalo_2_revista']) !!}

                                            </div>

                                        </div>


                                    </div>


                                    {{--PASO ADICIONAL--}}
                                    <div id="revista_paso_3" class="row tab-pane">
                                        {{--input ISBN revista--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="isbn_revista">ISBN</label>
                                            {!! Form::text('isbn', $revista->isbn , ['class' => 'form-control preview', 'id' => 'isbn_revista']) !!}
                                        </div>

                                        {{--input ISSN revista--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="isbn_revista">ISSN</label>
                                            {!! Form::text('issn', $revista->issn , ['class' => 'form-control preview', 'id' => 'issn_revista']) !!}
                                        </div>

                                        {{--input DOI revista--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="doi_revista">DOI</label>
                                            {!! Form::text('doi', $revista->doi , ['class' => 'form-control preview', 'id' => 'doi_revista']) !!}
                                        </div>

                                    </div>

                                    {{--PASO COMPLEMENTARIA--}}
                                    <div id="revista_paso_4" class="row tab-pane">

                                        {{--input ENLACE revista--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="enlace_revista">Enlace</label>
                                            {!! Form::text('enlace', $revista->enlace , ['class' => 'form-control preview', 'id' => 'enlace_revista']) !!}
                                        </div>

                                        {{--input ARCHIVO revista--}}
                                        {{--<div class="col-xs-12 form-group">--}}
                                        {{--<label class=" control-label" for="archivo_revista">Archivo</label>--}}
                                        {{--{!! Form::text('archivo', $revista-archivo , ['class' => 'form-control preview', 'id' => 'archivo_revista']) !!}--}}
                                        {{--</div>--}}

                                        {{--input COMENTARIO revista--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="comentarios_revista">Comentario</label>
                                            {!! Form::text('comentarios', $revista->comentarios , ['class' => 'form-control preview', 'id' => 'comentarios_revista']) !!}
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="panel-footer">
                                <div class="form-group">
                                    <div class="col-sm-4 col-xl-2">
                                        <button type="button" class="btn btn-default form-control" id="anterior">Anterior</button>
                                    </div>

                                    <div class="col-sm-4  col-sm-offset-4 col-xl-2 col-xl-offset-8 hidden" id="crear_revista">
                                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary form-control']) !!}
                                    </div>

                                    <div class="col-sm-4  col-sm-offset-4 col-xl-2 col-xl-offset-8 ">
                                        <button type="button" class="btn btn-default form-control" id="siguiente">Siguiente</button>
                                    </div>
                                </div>
                            </div>


                            {!! Form::close() !!}


                        </section>
                    </div>

                    {{--                    @include('bibliograficos.referencias._parciales._revista-resultado')--}}

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
                $('#ref_revista [data-toggle="popover"]').popover({
                    trigger: 'focus'
                })
            })


            //pasa los textos de los select a resultado
            $(".select").change(function(){

                //Obtengo el texto del select que se selecciono
                var seleccion = $('option:selected', this).text();


                //obtengo el id del elementeo seleccionado, se transforma en clase, la cual sera la que tenga el span de resultado
                // ejem select id= fecha_revista, span class = fecha_revista
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
                setup: function(editor) {

                    editor.on('keyup change', function(e) {
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

                    editor.on('init', function()
                    {
                        this.getDoc().body.style.fontSize = '14px';
                    });
                }

            });



        });



    </script>




@stop
