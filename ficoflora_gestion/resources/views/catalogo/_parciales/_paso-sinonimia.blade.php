<div class="row">

    <div class="col-xs-12 col-md-8 col-xlg-6">
        <div class="panel-group" id="accordion_paso_referencia">

            <div class="panel panel-accordion ">
                <div class="panel-heading dark">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-parent="#accordion_paso_referencia" data-toggle="collapse"  href="#sinonimia_busqueda">
                            <i class="fa fa-search"></i> Buscar Sinonimia
                        </a>
                    </h4>
                </div>
                <div id="sinonimia_busqueda" class="accordion-body collapse">
                    <div class="panel-body">


                        {{--select lista de sinonimias --}}
                        {!! Form::open(['url' => 'sinonimias',  'id'=>'jv_sinonimia_select', 'class' => 'form  form-bordered']) !!}

                        <div class="col-sm-12 form-group">
                            <label class=" control-label" for="select_sinonimia">Sinonimia <span class="required">*</span></label>
                            {!! Form::select('select_sinonimia', $lista_sinonimias, null, ['id'=>'select_sinonimia', 'class' => 'form-control select', 'style'=>'width: 100%' ]) !!}
                        </div>

                        <div class="form-group">
                            <div class="col-sm-3 col-lg-2  pull-right">
                                <button id='seleccionar_sinonimia' class="btn btn-primary form-control">Agregar</button>
                            </div>
                        </div>

                        {!! Form::close() !!}


                    </div>
                </div>
            </div>

            <div class="panel panel-accordion ">
                <div class="panel-heading dark">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-parent="#accordion_paso_referencia" data-toggle="collapse"  href="#sinonimia_crear">
                            <i class="fa fa-plus"></i> Crear Sinonimia
                        </a>
                    </h4>
                </div>
                <div id="sinonimia_crear" class="accordion-body collapse in">
                    <div class="panel-body">

                        {!! Form::open(['route' => 'sinonimia.guardar',  'id'=>'jv_sinonimia', 'class' => 'form  form-bordered']) !!}

                        <section class="panel col-xs-12 col-md-8 col-xlg-6">
                            <header class="panel-heading p-sm">
                                <h2 class="panel-title">Nueva Sinonimia</h2>
                            </header>

                            {{--FORMULARIO DE NUEVA ESPECIE--}}
                            <div class="panel-body pb-xlg">
                                @include('sinonimia._parciales._form-nueva-sinonimia')
                            </div>

                            <footer class="panel-footer">
                                <div class="form-group">
                                    <div class="col-sm-3 col-sm-offset-3 ">
                                        {!! Form::submit('Agregar', ['id'=>'crear', 'class' => 'btn btn-primary form-control']) !!}
                                    </div>

                                    <div class="col-sm-3 ">
                                        <button type="reset" class="btn btn-default form-control">Borrar</button>
                                    </div>
                                </div>
                            </footer>

                        </section>

                        {!! Form::close() !!}
                        <div class="col-xs-12 col-md-4 col-xlg-6">

                            @include('sinonimia._parciales._resultado-sinonimia')


                        </div>
                    </div>
                </div>
            </div>



        </div>

    </div>


    {{--PREVIEW RESULTADO SINONIMIA--}}
    <div class="col-xs-12 col-md-4 col-xlg-6">


        <div class="panel-group" id="accordion">
            <div class="panel panel-accordion ">
                <div class="panel-heading ">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse"  href="#listado_sinonimia">
                            <i class="fa fa-list-ol"></i> Sinonimias Agregadas
                        </a>
                    </h4>
                </div>
                <div id="listado_sinonimia" class="accordion-body collapse in">
                    <div class="panel-body text-md ">

                        <ol id="lista_sinonimia">
                        </ol>

                    </div>
                </div>
            </div>

        </div>
    </div>


</div>
