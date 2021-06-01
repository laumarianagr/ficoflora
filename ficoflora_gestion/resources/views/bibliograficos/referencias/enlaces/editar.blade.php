@extends('master')

@section('css_section')
    @parent


@stop

@section('titulo-seccion')
    Editar Enlace a Sitio Web
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="{{route('registros.nuevo.index')}}"><span>Nuevo</span></a></li>
    <li><a href="#"><span>Bibliográfico</span></a></li>
    <li><a href="#"><span>Enlace a Sitio Web</span></a></li>
@stop


@section('content')

    @include('errors._listar')


    <!-- vertical -->
    <div class="row">
        <div class="col-md-12">

            <div id="tab_trabajo"  >
                <div class="row" >
                    <div class="col-xs-12 col-md-8 col-md-offset-2" >
                        {{--<div class="col-xs-12 col-md-8 col-lg-6" >--}}

                        <section class="panel form-wizard mb-xs" id="ref_enlaces">
                            <header class="panel-heading section-titulo">

                                <h2 class="panel-title">Información del Enlace a Sitio Web</h2>
                            </header>
                            {!! Form::open(['method'=> 'PATCH', 'route' => ['enlace.actualizar', $enlace->id], 'id'=>'referencia_enlace', 'class' => 'form form-bordered form_ref']) !!}

                            <div class="panel-body">
                                <div class="wizard-progress">
                                    <div class="steps-progress">
                                        <div class="progress-indicator"></div>
                                    </div>
                                    <ul class="wizard-steps">
                                        <li class="active">
                                            <a href="#enlace_paso_1" data-toggle="tab"><span>1</span>Cita</a>
                                        </li>
                                        <li>
                                            <a href="#enlace_paso_2" data-toggle="tab"><span>2</span>Datos</a>
                                        </li>
                                        <li>
                                            <a href="#enlace_paso_3" data-toggle="tab"><span>3</span>Complentaria</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="pt-md">
                                    <i class="req-leyenda">* Campos obligatorios</i>
                                </div>

                                <div class="tab-content">
                                    {{--PASO CITA--}}
                                    <div id="trabajo_paso_1" class="row tab-pane active">

                                        {{--select TIPO trabajo--}}
                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label" for="cita_autores">Tipo de trabajo <span class="required">*</span></label>
                                            {!! Form::select('tipo', $tipo_trabajos,  $trabajo->tipo, ['id'=> 'tipo_trabajo', 'class' => 'form-control select', 'style'=>'width: 100%']) !!}
                                        </div>

                                        {{--input AUTORES trabajo--}}
                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label" for="autores_trabajo">Autores <span class="required">*</span></label>
                                            {!! Form::text('autores', $trabajo->autores , [
                                            'class' => 'form-control preview autores',
                                            'id' => 'autores_trabajo',
                                            'data-toggle'=>"popover",
                                            'title'=>"Tips",
                                            'data-content'=>"El Primer autor comienza por su apellido(,) inicial del nombre(.) ejem: García, M.",
                                            'data-placement'=>"top",
                                            'placeholder'=>'Ejem: García, M., G. Gómez & N. Gil'
                                            ]) !!}
                                        </div>

                                        {{--select AÑO trabajo--}}
                                        <div class="col-sm-12 form-group ">
                                            <label class="control-label" for="fecha_trabajo">Fecha <span class="required">*</span></label>
                                            {!! Form::select('fecha', $fecha,  $trabajo->fecha, ['id'=> 'fecha_trabajo', 'class' => 'form-control select', 'style'=>'width: 100%']) !!}
                                        </div>

                                        {{--select CITA NUM AUOTRES trabajo--}}
                                        <div class="col-sm-12 form-group">
                                            <label class=" control-label" for="cita_trabajo">Cita <span class="required">*</span></label>
                                            {!! Form::text('cita', $trabajo->cita.', '.$trabajo->fecha.$trabajo->letra, ['id'=> 'cita_libro', 'class' => 'form-control cita']) !!}

                                        </div>

                                    </div>

                                    {{--PASO DATOS LIBRO--}}
                                    <div id="trabajo_paso_2" class="row tab-pane">

                                        {{--textarea TÍTULO trabajo--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="titulo_trabajo">Título del trabajo <span class="required">*</span></label>
                                            {!! Form::textarea('titulo', $trabajo->titulo , ['class' => 'form-control tinymce', 'id'=>'titulo_trabajo' ]) !!}
                                        </div>

                                        {{--input INSTITUCIÓN trabajo--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="institucion_trabajo">Institucion <span class="required">*</span></label>
                                            {!! Form::text('institucion', $trabajo->institucion , ['class' => 'form-control preview', 'id' => 'institucion_trabajo']) !!}
                                        </div>

                                        {{--input LUGAR trabajo--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="lugar_trabajo">lugar <span class="required">*</span></label>
                                            {!! Form::text('lugar', $trabajo->lugar , ['class' => 'form-control preview', 'id' => 'lugar_trabajo']) !!}
                                        </div>

                                        {{--input PAGINAS trabajo--}}
                                        <div class=" col-xs-12 form-group">
                                            <label class=" control-label" for="paginas_trabajo">Total de páginas <span class="required">*</span></label>
                                            {!! Form::text('paginas', $trabajo->paginas , ['class' => 'form-control preview', 'id' => 'paginas_trabajo']) !!}
                                        </div>


                                    </div>


                                    {{--PASO COMPLEMENTARIA--}}
                                    <div id="trabajo_paso_3" class="row tab-pane">

                                        {{--input ENLACE trabajo--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="enlace_trabajo">Enlace</label>
                                            {!! Form::text('enlace', $trabajo->enlace , ['class' => 'form-control preview', 'id' => 'enlace_trabajo']) !!}
                                        </div>

                                        {{--input ARCHIVO trabajo--}}
                                        {{--<div class="col-xs-12 form-group">--}}
                                        {{--<label class=" control-label" for="archivo_trabajo">Archivo</label>--}}
                                        {{--{!! Form::text('archivo', $trabajo-archivo , ['class' => 'form-control preview', 'id' => 'archivo_trabajo']) !!}--}}
                                        {{--</div>--}}

                                        {{--input COMENTARIO revista--}}
                                        <div class="col-xs-12 form-group">
                                            <label class=" control-label" for="comentarios_revista">Comentario</label>
                                            {!! Form::text('comentarios', $trabajo->comentarios , ['class' => 'form-control preview', 'id' => 'comentarios_revista']) !!}
                                        </div>


                                    </div>

                                </div>

                            </div>

                            <div class="panel-footer">
                                <div class="form-group">

                                    <div class="col-sm-4 col-xl-2">
                                        <button type="button" class="btn btn-default form-control" id="anterior">Anterior</button>
                                    </div>

                                    <div class="col-sm-4  col-sm-offset-4 col-xl-2 col-xl-offset-8 hidden" id="crear_trabajo">
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

                    {{--                    @include('bibliograficos.referencias._parciales._trabajo-resultado')--}}

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
                $('#ref_trabajo [data-toggle="popover"]').popover({
                    trigger: 'focus'
                })
            })


            //pasa los textos de los select a resultado
            $(".select").change(function(){

                //Obtengo el texto del select que se selecciono
                var seleccion = $('option:selected', this).text();


                //obtengo el id del elementeo seleccionado, se transforma en clase, la cual sera la que tenga el span de resultado
                // ejem select id= fecha_trabajo, span class = fecha_trabajo
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
