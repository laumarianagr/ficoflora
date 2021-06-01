<div class="row" >
    <div class="col-xs-12 col-md-8 col-lg-6" >

        <section class="panel form-wizard mb-xs" id="ref_libro">
            <header class="panel-heading section-titulo">

                <h2 class="panel-title">Información del Libro</h2>
            </header>
            {!! Form::open(['route' => 'libro.guardar', 'id'=>'referencia_libro', 'class' => 'form form-bordered form_ref']) !!}

            <div class="panel-body">
                <div class="wizard-progress">
                    <div class="steps-progress">
                        <div class="progress-indicator"></div>
                    </div>
                    <ul class="wizard-steps">
                        <li class="active">
                            <a href="#libro_paso_1" data-toggle="tab"><span>1</span>Cita</a>
                        </li>
                        <li>
                            <a href="#libro_paso_2" data-toggle="tab"><span>2</span>Datos Libro</a>
                        </li>
                        <li>
                            <a href="#libro_paso_3" data-toggle="tab"><span>3</span>Capítulo</a>
                        </li>
                        <li>
                            <a href="#libro_paso_4" data-toggle="tab"><span>4</span>Identificador</a>
                        </li>
                        <li>
                            <a href="#libro_paso_5" data-toggle="tab"><span>5</span>Adicional</a>
                        </li>
                    </ul>
                </div>

                <div class="pt-md">
                    <i class="req-leyenda">* Campos obligatorios</i>
                </div>

                <div class="tab-content">
                    {{--PASO CITA--}}
                    <div id="libro_paso_1" class="row tab-pane active">

                        {{--input AUTORES libro--}}

                        <div class="col-sm-12 form-group">
                            <label class=" control-label" for="autores_libro">Autores <span class="required">*</span></label>
                            {!! Form::text('autores', null, [
                            'class' => 'form-control preview autores',
                            'id' => 'autores_libro',
                            'data-toggle'=>"popover",
                            'title'=>"Tips",
                            'data-content'=>"El Primer autor comienza por su apellido(,) inicial del nombre(.) ejem: Gómez, S.",
                            'data-placement'=>"top",
                            'placeholder'=>'Ejem: Gómez, S., M. García & N. Gil'
                            ]) !!}

                        </div>

                        {{--select AÑO libro--}}
                        <div class="col-sm-12 form-group ">
                            <label class="control-label" for="fecha_libro">Fecha <span class="required">*</span></label>
                            {!! Form::select('fecha', $fecha, null, ['id'=> 'fecha_libro', 'class' => 'form-control select ', 'style'=>'width: 100%']) !!}

                        </div>

                        {{--select CITA NUM AUOTRES libro--}}
                        <div class="col-sm-12 form-group">
                            <label class=" control-label" for="cita_libro">Cita <span class="required">*</span></label>
                            {!! Form::select('cita', $cita_autores, null, ['id'=> 'cita_libro', 'class' => 'form-control cita', 'style'=>'width: 100%' ]) !!}
                        </div>

                    </div>

                    {{--PASO DATOS LIBRO--}}
                    <div id="libro_paso_2" class="row tab-pane">

                        {{--textarea TÍTULO libro--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="titulo_libro">Título del Libro <span class="required">*</span></label>
                                {!! Form::textarea('titulo', null, ['class' => 'form-control tinymce', 'id'=>'titulo_libro' ]) !!}

                        </div>

                        {{--input EDICIÓN libro--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="edicion_libro">Edición</label>
                            {!! Form::text('edicion', null, ['class' => 'form-control preview', 'id' => 'edicion_libro']) !!}

                        </div>

                        {{--input EDITORIAL libro--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="editorial_libro">Editorial</label>
                            {!! Form::text('editorial', null, ['class' => 'form-control preview', 'id' => 'editorial_libro']) !!}
                        </div>

                        {{--input LUGAR libro--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="lugar_libro">Lugar <span class="required">*</span></label>
                            {!! Form::text('lugar', null, ['class' => 'form-control preview', 'id' => 'lugar_libro']) !!}
                        </div>

                        {{--input PAGINAS libro--}}
                        <div class=" col-xs-12 form-group">
                            <label class=" control-label" for="paginas_libro">Total de páginas <span class="required">*</span></label>
                            {!! Form::text('paginas', null, ['class' => 'form-control preview', 'id' => 'paginas_libro', 'type'=>'number']) !!}
                        </div>

                    </div>

                    {{--PASO CAPÍTULO--}}
                    <div id="libro_paso_3" class="row tab-pane">

                        {{--textarea CAPITULO libro--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="capitulo_libro">Título (Capítulo o Sección)</label>
                            {!! Form::textarea('capitulo', null, ['class' => 'form-control tinymce', 'id'=>'capitulo_libro' ]) !!}

                        </div>

                        {{--input EDITOR libro--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="editor_libro">Editor</label>
                            {!! Form::text('editor', null, ['class' => 'form-control preview', 'id' => 'editor_libro']) !!}
                        </div>

                        {{--input INTERVALO PAGINAS libro--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="intervalo_libro">Intérvalo de páginas</label>

                               <div class="input-group mb-md">
                                   {!! Form::text('intervalo_1', null, ['class' => 'form-control preview', 'id' => 'intervalo_1_libro']) !!}
                                   <span class="input-group-addon">
                                        <i class="">-</i>
                                    </span>
                                   {!! Form::text('intervalo_2', null, ['class' => 'form-control preview', 'id' => 'intervalo_2_libro']) !!}

                               </div>

                        </div>

                    </div>

                    {{--PASO ADICIONAL--}}
                    <div id="libro_paso_4" class="row tab-pane">
                        {{--input ISBN libro--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="isbn_libro">ISBN</label>
                            {!! Form::text('isbn', null, ['class' => 'form-control preview', 'id' => 'isbn_libro']) !!}
                        </div>

                        {{--input ISSN libro--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="isbn_libro">ISSN</label>
                            {!! Form::text('issn', null, ['class' => 'form-control preview', 'id' => 'issn_libro']) !!}
                        </div>

                        {{--input DOI libro--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="doi_libro">DOI</label>
                            {!! Form::text('doi', null, ['class' => 'form-control preview', 'id' => 'doi_libro']) !!}
                        </div>

                    </div>

                    {{--PASO COMPLEMENTARIA--}}
                    <div id="libro_paso_5" class="row tab-pane">

                        {{--input ENLACE libro--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="enlace_libro">Enlace</label>
                            {!! Form::text('enlace', null, ['class' => 'form-control preview', 'id' => 'enlace_libro']) !!}
                        </div>

                        {{--input ARCHIVO libro--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="archivo_libro">Archivo</label>
                            {!! Form::text('archivo', null, ['class' => 'form-control preview', 'id' => 'archivo_libro']) !!}
                        </div>


                        {{--input COMENTARIO revista--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="comentarios_revista">Comentario</label>
                            {!! Form::text('comentarios', null, ['class' => 'form-control preview', 'id' => 'comentarios_revista']) !!}
                        </div>

                    </div>

                </div>


            </div>

            <div class="panel-footer">
                <div class="form-group">

                    <div class="col-sm-4 col-xl-2">
                        <button type="button" class="btn btn-default form-control" id="anterior">Anterior</button>
                    </div>

                    <div class="col-sm-4  col-sm-offset-4 col-xl-2 col-xl-offset-8 hidden" id="crear_libro">
                        {!! Form::submit('Crear', ['class' => 'btn btn-primary form-control']) !!}
                    </div>

                    <div class="col-sm-4  col-sm-offset-4 col-xl-2 col-xl-offset-8 ">
                        <button type="button" class="btn btn-default form-control"  id="siguiente">Siguiente</button>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}


        </section>
    </div>

    @include('bibliograficos.referencias._parciales._libro-resultado')

</div>