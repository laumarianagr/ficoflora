<div class="row" >
    <div class="col-xs-12 col-md-8 col-lg-6" >

        <section class="panel form-wizard mb-xs" id="ref_trabajos">
            <header class="panel-heading section-titulo">

                <h2 class="panel-title">Información del Trabajo Académico</h2>
            </header>
            {!! Form::open(['route' => 'trabajo.guardar', 'id'=>'referencia_trabajo', 'class' => 'form  form-bordered form_ref']) !!}

            <div class="panel-body">
                <div class="wizard-progress">
                    <div class="steps-progress">
                        <div class="progress-indicator"></div>
                    </div>
                    <ul class="wizard-steps">
                        <li class="active">
                            <a href="#trabajo_paso_1" data-toggle="tab"><span>1</span>Cita</a>
                        </li>
                        <li>
                            <a href="#trabajo_paso_2" data-toggle="tab"><span>2</span>Datos</a>
                        </li>
                        <li>
                            <a href="#trabajo_paso_3" data-toggle="tab"><span>3</span>Adicional</a>
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
                            {!! Form::select('tipo', $tipo_trabajos, null, ['id'=> 'tipo_trabajo', 'class' => 'form-control select', 'style'=>'width: 100%']) !!}
                        </div>

                        {{--input AUTORES trabajo--}}
                        <div class="col-sm-12 form-group">
                            <label class=" control-label" for="autores_trabajo">Autores <span class="required">*</span></label>
                            {!! Form::text('autores', null, [
                            'class' => 'form-control preview autores',
                            'id' => 'autores_trabajo',
                            'data-toggle'=>"popover",
                            'title'=>"Tips",
                            'data-content'=>"El Primer autor comienza por su apellido(,) inicial del nombre(.) ejem: Gómez, S.",
                            'data-placement'=>"top",
                            'placeholder'=>'Ejem: Gómez, S., Y. Carballo & N. Gil'
                            ]) !!}
                        </div>

                        {{--select AÑO trabajo--}}
                        <div class="col-sm-12 form-group ">
                            <label class="control-label" for="fecha_trabajo">Fecha <span class="required">*</span></label>
                            {!! Form::select('fecha', $fecha, null, ['id'=> 'fecha_trabajo', 'class' => 'form-control select', 'style'=>'width: 100%']) !!}
                        </div>

                        {{--select CITA NUM AUOTRES trabajo--}}
                        <div class="col-sm-12 form-group">
                            <label class=" control-label" for="cita_trabajo">Cita <span class="required">*</span></label>
                            {!! Form::select('cita', $cita_autores, null, ['id'=> 'cita_trabajo', 'class' => 'form-control cita','style'=>'width: 100%' ]) !!}
                        </div>

                    </div>

                    {{--PASO DATOS LIBRO--}}
                    <div id="trabajo_paso_2" class="row tab-pane">

                        {{--textarea TÍTULO trabajo--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="titulo_trabajo">Título del trabajo <span class="required">*</span></label>
                            {!! Form::textarea('titulo', null, ['class' => 'form-control tinymce', 'id'=>'titulo_trabajo' ]) !!}
                        </div>

                        {{--input INSTITUCIÓN trabajo--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="institucion_trabajo">Institución <span class="required">*</span></label>
                            {!! Form::text('institucion', null, ['class' => 'form-control preview', 'id' => 'institucion_trabajo']) !!}
                        </div>

                        {{--input LUGAR trabajo--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="lugar_trabajo">Lugar <span class="required">*</span></label>
                            {!! Form::text('lugar', null, ['class' => 'form-control preview', 'id' => 'lugar_trabajo']) !!}
                        </div>

                        {{--input PAGINAS trabajo--}}
                        <div class=" col-xs-12 form-group">
                            <label class=" control-label" for="paginas_trabajo">Total de páginas <span class="required">*</span></label>
                            {!! Form::text('paginas', null, ['class' => 'form-control preview', 'id' => 'paginas_trabajo']) !!}
                        </div>


                    </div>


                    {{--PASO COMPLEMENTARIA--}}
                    <div id="trabajo_paso_3" class="row tab-pane">

                        {{--input ENLACE trabajo--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="enlace_trabajo">Enlace</label>
                            {!! Form::text('enlace', null, ['class' => 'form-control preview', 'id' => 'enlace_trabajo']) !!}
                        </div>

                        {{--input ARCHIVO trabajo--}}
                        {{--<div class="col-xs-12 form-group">--}}
                            {{--<label class=" control-label" for="archivo_trabajo">Archivo</label>--}}
                            {{--{!! Form::text('archivo', null, ['class' => 'form-control preview', 'id' => 'archivo_trabajo']) !!}--}}
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

                    <div class="col-sm-4  col-sm-offset-4 col-xl-2 col-xl-offset-8 hidden" id="crear_trabajo">
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

    @include('bibliograficos.referencias._parciales._trabajos-resultado')


</div>