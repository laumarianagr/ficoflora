<div class="row" >
    <div class="col-xs-12 col-md-8 col-lg-6" >

        <section class="panel form-wizard mb-xs" id="ref_catalogo">
            <header class="panel-heading section-titulo">

                <h2 class="panel-title">Información del Catálogo</h2>
            </header>
            {!! Form::open(['route' => 'catalogo.guardar', 'id'=>'referencia_catalogo', 'class' => 'form  form-bordered form_ref']) !!}

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
                            <a href="#catalogo_paso_2" data-toggle="tab"><span>2</span>Título</a>
                        </li>
                        <li>
                            <a href="#catalogo_paso_3" data-toggle="tab"><span>3</span>Cat. en Revista</a>
                        </li>
                        <li>
                            <a href="#catalogo_paso_4" data-toggle="tab"><span>4</span>Cat. en Libro</a>
                        </li>
                        <li>
                            <a href="#catalogo_paso_5" data-toggle="tab"><span>5</span>Adicional</a>
                        </li>
                        <li>
                            <a href="#catalogo_paso_6" data-toggle="tab"><span>6</span>Complement.</a>
                        </li>
                    </ul>
                </div>

                <div class="pt-md">
                    <i class="req-leyenda">* Campos obligatorios</i>
                </div>

                <div class="tab-content">
                    {{--DATOS CITA--}}
                    <div id="catalogo_paso_1" class="row tab-pane active">

                        {{--input AUTORES catalogo--}}

                        <div class="col-sm-12 form-group">
                            <label class=" control-label" for="autores_catalogo">Autores <span class="required">*</span></label>
                            {!! Form::text('autores', null, [
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
                            {!! Form::select('fecha', $fecha, null, ['id'=> 'fecha_catalogo', 'class' => 'form-control select', 'style'=>'width: 100%']) !!}
                        </div>

                        {{--select CITA NUM AUTORES catálogo--}}
                        <div class="col-sm-12 form-group">
                            <label class=" control-label" for="cita_catalogo">Cita <span class="required">*</span></label>
                            {!! Form::select('cita', $cita_autores, null, ['id'=> 'cita_catalogo', 'class' => 'form-control cita','style'=>'width: 100%' ]) !!}
                        </div>

                    </div>


                    {{--PASO TÍTULO --}}
                    <div id="catalogo_paso_2" class="row tab-pane">

                        {{--textarea TÍTULO catalogo--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="titulo_catalogo">Título del catálogo <span class="required">*</span></label>
                            {!! Form::textarea('titulo', null, ['class' => 'form-control tinymce', 'id'=>'titulo_catalogo' ]) !!}
                        </div>

                    </div>


                    {{--PASO DATOS CATÁLOGO EN REVISTA--}}
                    <div id="catalogo_paso_3" class="row tab-pane">

                        {{--input NOMBRE catálogo--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="nombre_catalogo">Nombre de la revista que incluye el catálogo</label>
                            {!! Form::text('nombre', null, ['class' => 'form-control preview', 'id' => 'nombre_catalogo',  'ng-modell'=>'edicion_libro']) !!}
                        </div>

                        {{--input VOLUMEN catálogo--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="volumen_catalogo">Volumen</label>
                            {!! Form::text('volumen', null, ['class' => 'form-control preview', 'id' => 'volumen_catalogo',  'ng-modell'=>'edicion_libro']) !!}
                        </div>

                        {{--input NÚMERO catálogo--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="numero_catalogo">Número</label>
                            {!! Form::text('numero', null, ['class' => 'form-control preview', 'id' => 'numero_catalogo',  'ng-modell'=>'edicion_libro']) !!}
                        </div>

                        {{--input INTERVALO PAGINAS revista--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="intervalo_catalogo">Intervalo de páginas<span class="required">*</span></label>

                            <div class="input-group mb-md">
                                {!! Form::text('intervalo_1', null, ['class' => 'form-control preview', 'id' => 'intervalo_1_revista']) !!}
                                <span class="input-group-addon">
                                        <i class="">-</i>
                                    </span>
                                {!! Form::text('intervalo_2', null, ['class' => 'form-control preview', 'id' => 'intervalo_2_revista']) !!}

                            </div>
                        </div>

                    </div>


                    {{--PASO DATOS CATÁLOGO EN LIBRO--}}
                    <div id="catalogo_paso_4" class="row tab-pane">

                        {{--input EDICIÓN libro--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="edicion_catalogo">Edición</label>
                            {!! Form::text('edicion', null, ['class' => 'form-control preview', 'id' => 'edicion_catalogo']) !!}

                        </div>

                        {{--input EDITOR Y EDITORIAL libro--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="editor_editorial_catalogo">Editor y Editorial</label>
                            {!! Form::text('editor_editorial', null, ['class' => 'form-control preview', 'id' => 'editor_editorial_catalogo']) !!}
                        </div>

                        {{--input LUGAR libro--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="lugar_catalogo">Lugar<span class="required">*</span></label>
                            {!! Form::text('lugar', null, ['class' => 'form-control preview', 'id' => 'lugar_catalogo']) !!}
                        </div>

                        {{--input PAGINAS libro--}}
                        <div class=" col-xs-12 form-group">
                            <label class=" control-label" for="paginas_catalogo">Total de páginas<span class="required">*</span></label>
                            {!! Form::text('paginas', null, ['class' => 'form-control preview', 'id' => 'paginas_catalogo', 'type'=>'number']) !!}
                        </div>

                    </div>


                    {{--PASO ADICIONAL--}}
                    <div id="catalogo_paso_5" class="row tab-pane">
                        {{--input ISBN --}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="isbn_catalogo">ISBN</label>
                            {!! Form::text('isbn', null, ['class' => 'form-control preview', 'id' => 'isbn_catalogo']) !!}
                        </div>

                        {{--input DOI --}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="doi_catalogo">DOI</label>
                            {!! Form::text('doi', null, ['class' => 'form-control preview', 'id' => 'doi_catalogo']) !!}
                        </div>

                    </div>

                    {{--PASO COMPLEMENTARIA--}}
                    <div id="catalogo_paso_6" class="row tab-pane">

                        {{--input ARCHIVO libro--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="archivo_catalogo">Archivo</label>
                            {!! Form::text('archivo', null, ['class' => 'form-control preview', 'id' => 'archivo_catalogo']) !!}
                        </div>

                        {{--input COMENTARIO revista--}}
                        <div class="col-xs-12 form-group">
                            <label class=" control-label" for="comentarios_catalogo">Comentario</label>
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

    @include('bibliograficos.referencias._parciales._catalogo-resultado')

</div>