<div class="row">

    <div class="col-xs-12">
        <div class="panel-group" id="accordion_paso_especie">

            {{-- BUSCAR ESPECIE--}}
            <div class="panel panel-accordion ">
                <div class="panel-heading dark">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-parent="#accordion_paso_especie" data-toggle="collapse"  href="#especie_busqueda">
                            <i class="fa fa-search"></i> Seleccionar Especie
                        </a>
                    </h4>
                </div>
                <div id="especie_busqueda" class="accordion-body collapse">
                    <div class="panel-body ">

                        {{--select lista de especies --}}
                        {!! Form::open(['url' => 'especies',  'id'=>'jv_especie_select', 'class' => 'form  form-bordered']) !!}

                        <div class="col-sm-12 form-group">
                            <label class=" control-label" for="select_especie">Especie <span class="required">*</span></label>
                            {!! Form::select('select_especie', $lista_especies, null, ['id'=>'select_especie', 'class' => 'form-control select', 'style'=>'width: 100%' ]) !!}
                        </div>

                        <div class="form-group">
                            <div class="col-sm-3 col-lg-2  pull-right">
                                <button id= 'seleccionar_especie' class="btn btn-primary form-control">Seleccionar</button>
                            </div>
                        </div>

                        {!! Form::close() !!}




                    </div>
                </div>
            </div>

            {{-- CREAR ESPECIE --}}
            <div class="panel panel-accordion ">
                <div class="panel-heading dark">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-parent="#accordion_paso_especie" data-toggle="collapse"  href="#especie_crear">
                            <i class="fa fa-plus"></i> Crear Especie
                        </a>
                    </h4>
                </div>
                <div id="especie_crear" class="accordion-body collapse in">
                    <div class="panel-body ">

                        {!! Form::open(['url' => 'especies',  'id'=>'jv_especie', 'class' => 'form  form-bordered']) !!}

                        <section class="panel col-xs-12 col-md-8 col-xlg-6">
                            <header class="panel-heading p-sm">
                                <h2 class="panel-title" >Nueva Especie</h2>
                            </header>

                            {{--FORMULARIO DE NUEVA ESPECIE--}}
                            <div class="panel-body pb-xlg">
                                @include('taxonomia.especies._parciales._form_nueva_especie')
                            </div>

                            <footer class="panel-footer">
                                <div class="form-group">
                                    <div class="col-sm-3 col-sm-offset-3 ">
                                        {!! Form::submit('Crear', ['id'=>'crear', 'class' => 'btn btn-primary form-control']) !!}
                                    </div>

                                    <div class="col-sm-3 ">
                                        <button type="reset" class="btn btn-default form-control">Borrar</button>
                                    </div>
                                </div>
                            </footer>

                        </section>

                        {!! Form::close() !!}

                        {{--PREVIEW RESULTADO ESPECIE--}}
                        <div class="col-xs-12 col-md-4 col-xlg-6">
                            @include('taxonomia.especies._parciales._resultado_especie')
                        </div>


                    </div>
                </div>
            </div>



        </div>

    </div>

</div>