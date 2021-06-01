<div class="row" >
    <div class="col-xs-12 col-md-8 col-lg-6" >

        <section class="panel form-wizard mb-xs" id="ref_revista">
            <header class="panel-heading section-titulo">

                <h2 class="panel-title">Información de la Revista</h2>
            </header>
            {!! Form::open(['route' => 'revista.guardar', 'id'=>'referencia_revista', 'class' => 'form  form-bordered form_ref']) !!}

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
                            <a href="#revista_paso_3" data-toggle="tab"><span>3</span>Identificador</a>
                        </li>
                        <li>
                            <a href="#revista_paso_4" data-toggle="tab"><span>4</span>Adicional</a>
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
                            {!! Form::text('autores', null, [
                            'class' => 'form-control preview autores',
                            'id' => 'autores_revista',
                            'data-toggle'=>"popover",
                            'title'=>"Tips",
                            'data-content'=>"El Primer autor comienza por su apellido(,) inicial del nombre(.) ejem: Gómez, S.",
                            'data-placement'=>"top",
                            'placeholder'=>'Ejem: Gómez, S., M. García & N. Gil'
                            ]) !!}
                        </div>

                        {{--select AÑO revista--}}
                        <div class="col-sm-12 form-group ">
                            <label class="control-label" for="fecha_revista">Fecha <span class="required">*</span></label>
                            {!! Form::select('fecha', $fecha, null, ['id'=> 'fecha_revista', 'class' => 'form-control select', 'style'=>'width: 100%']) !!}
                        </div>

                        {{--select CITA NUM AUOTRES revista--}}
                        <div class="col-sm-12 form-group">
                            <label class=" control-label" for="cita_revista">Cita <span class="required">*</span></label>
                            {!! Form::select('cita', $cita_autores, null, ['id'=> 'cita_revista', 'class' => 'form-control cita','style'=>'width: 100%' ]) !!}
                        </div>

                    </div>

                    {{--PASO DATOS LIBRO--}}
                    <div id="revista_paso_2" class="row tab-pane">

                        {{--textarea TÍTULO revista--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="titulo_revista">Título del artículo <span class="required">*</span></label>
                            {!! Form::textarea('titulo', null, ['class' => 'form-control tinymce', 'id'=>'titulo_revista' ]) !!}

                        </div>

                        {{--input NOMBRE revista--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="nombre_revista">Nombre de la revista<span class="required">*</span></label>
                            {!! Form::text('nombre', null, ['class' => 'form-control preview', 'id' => 'nombre_revista',  'ng-modell'=>'edicion_libro']) !!}
                        </div>

                        {{--input EDICIÓN revista--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="volumen_revista">Volumen <span class="required">*</span></label>
                            {!! Form::text('volumen', null, ['class' => 'form-control preview', 'id' => 'volumen_revista',  'ng-modell'=>'edicion_libro']) !!}
                        </div>

                        {{--input EDITORIAL revista--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="numero_revista">Número</label>
                            {!! Form::text('numero', null, ['class' => 'form-control preview', 'id' => 'numero_revista',  'ng-modell'=>'edicion_libro']) !!}
                        </div>

                        {{--input INTERVALO PAGINAS revista--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="intervalo_revista">Intervalo de páginas <span class="required">*</span></label>

                            <div class="input-group mb-md">
                                {!! Form::text('intervalo_1', null, ['class' => 'form-control preview', 'id' => 'intervalo_1_revista']) !!}
                                   <span class="input-group-addon">
                                        <i class="">-</i>
                                    </span>
                                {!! Form::text('intervalo_2', null, ['class' => 'form-control preview', 'id' => 'intervalo_2_revista']) !!}

                            </div>

                        </div>


                    </div>


                    {{--PASO ADICIONAL--}}
                    <div id="revista_paso_3" class="row tab-pane">
                        {{--input ISBN revista--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="isbn_revista">ISBN</label>
                            {!! Form::text('isbn', null, ['class' => 'form-control preview', 'id' => 'isbn_revista']) !!}
                        </div>

                        {{--input ISSN revista--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="isbn_revista">ISSN</label>
                            {!! Form::text('issn', null, ['class' => 'form-control preview', 'id' => 'issn_revista']) !!}
                        </div>

                        {{--input DOI revista--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="doi_revista">DOI</label>
                            {!! Form::text('doi', null, ['class' => 'form-control preview', 'id' => 'doi_revista']) !!}
                        </div>

                    </div>

                    {{--PASO COMPLEMENTARIA--}}
                    <div id="revista_paso_4" class="row tab-pane">

                        {{--input ENLACE revista--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="enlace_revista">Enlace</label>
                            {!! Form::text('enlace', null, ['class' => 'form-control preview', 'id' => 'enlace_revista']) !!}
                        </div>

                        {{--input ARCHIVO revista--}}
                        {{--<div class="col-xs-12 form-group">--}}
                            {{--<label class=" control-label" for="archivo_revista">Archivo</label>--}}
                            {{--{!! Form::text('archivo', null, ['class' => 'form-control preview', 'id' => 'archivo_revista']) !!}--}}
                        {{--</div>--}}

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

                    <div class="col-sm-4  col-sm-offset-4 col-xl-2 col-xl-offset-8 hidden" id="crear_revista">
                        {!! Form::submit('Crear', ['class' => 'btn btn-primary form-control']) !!}
                    </div>

                    <div class="col-sm-4  col-sm-offset-4 col-xl-2 col-xl-offset-8 ">
                        <button type="button" class="btn btn-default form-control" id="siguiente">Siguiente</button>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}


        </section>
    </div>

    @include('bibliograficos.referencias._parciales._revista-resultado')


</div>