<div class="row" >
    <div class="col-xs-12 col-md-8 col-lg-6" >

        <section class="panel form-wizard mb-xs" id="w6">
            <header class="panel-heading section-titulo">

                <h2 class="panel-title">Información del Enlace</h2>
            </header>
            {!! Form::open(['route' => 'enlace.guardar',  'class' => 'form  form-bordered']) !!}

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

                <div class="tab-content">
                    {{--PASO CITA--}}
                    <div id="enlace_paso_1" class="row tab-pane active">

                        {{--input AUTORES enlace--}}
                        <div class="col-sm-12 form-group">
                            <label class=" control-label" for="autores_enlace">Autores <span class="required">*</span></label>
                            {!! Form::text('autores', null, ['class' => 'form-control preview autores', 'id' => 'autores_enlace']) !!}

                        </div>

                        {{--select AÑO enlace--}}
                        <div class="col-sm-12 form-group ">
                            <label class="control-label" for="fecha_enlace">Fecha <span class="required">*</span></label>
                            {!! Form::select('fecha', $fecha, null, ['id'=> 'fecha_enlace', 'class' => 'form-control select', 'style'=>'width: 100%']) !!}
                        </div>

                        {{--select CITA NUM AUOTRES enlace--}}
                        <div class="col-sm-12 form-group">
                            <label class=" control-label" for="cita_enlace">Cita <span class="required">*</span></label>
                            {!! Form::select('cita', $cita_autores, null, ['id'=> 'cita_enlace', 'class' => 'form-control cita', 'style'=>'width: 100%']) !!}
                        </div>

                    </div>

                    {{--PASO DATOS LIBRO--}}
                    <div id="enlace_paso_2" class="row tab-pane">

                        {{--input nombre enlace--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="nombre_enlace">Nombre de la página web</label>
                            {!! Form::text('nombre', null, ['class' => 'form-control preview', 'id' => 'nombre_enlace']) !!}
                        </div>

                        {{--input TITULO enlace--}}
                        <div class=" col-xs-12 form-group">
                            <label class=" control-label" for="titulo_enlace">Título</label>
                            {!! Form::text('titulo', null, ['class' => 'form-control preview', 'id' => 'titulo_enlace']) !!}
                        </div>

                        {{--input INSTITUCION enlace--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="institucion_enlace">Institución</label>
                            {!! Form::text('institucion', null, ['class' => 'form-control preview', 'id' => 'institucion_enlace']) !!}
                        </div>

                        {{--input LUGAR enlace--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="lugar_enlace">Lugar</label>
                            {!! Form::text('lugar', null, ['class' => 'form-control preview', 'id' => 'lugar_enlace']) !!}
                        </div>

                        {{--input ENLACE enlace--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="enlace_enlace">Dirección web <span class="required">*</span></label>
                            {!! Form::text('enlace', null, ['class' => 'form-control preview', 'id' => 'enlace_enlace']) !!}
                        </div>

                    </div>


                    {{--PASO COMPLEMENTARIA--}}
                    <div id="enlace_paso_3" class="row tab-pane">


                        {{--input DIA enlace--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="dia_enlace">Día de consulta <span class="required">*</span></label>
                            {!! Form::select('dia', $fecha_dia, null, ['id'=> 'dia_enlace', 'class' => 'form-control select', 'style'=>'width: 100%']) !!}
                        </div>

                        {{--input MES enlace--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="mes_enlace">Mes de consulta <span class="required">*</span></label>
                            {!! Form::select('mes', $fecha_mes, '-', ['id'=> 'mes_enlace', 'class' => 'form-control select', 'style'=>'width: 100%']) !!}

                        </div>

                        {{--input AÑO enlace--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="ano_enlace">Año de consulta <span class="required">*</span></label>
                            {!! Form::select('ano', $fecha_ano, null, ['id'=> 'ano_enlace', 'class' => 'form-control select', 'style'=>'width: 100%']) !!}

                        </div>


                    </div>

                </div>
                <div class="pt-md">
                    <i class="req-leyenda">* Campos obligatorios</i>
                </div>
            </div>

            <div class="panel-footer">
                <div class="form-group">

                    <div class="col-sm-4 col-xl-2">
                        <button type="button" class="btn btn-default form-control" id="anterior">Anterior</button>
                    </div>

                    <div class="col-sm-4  col-sm-offset-4 col-xl-2 col-xl-offset-8 hidden" id="crear_enlace">
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

    @include('bibliograficos.referencias._parciales._enlace-resultado')



</div>