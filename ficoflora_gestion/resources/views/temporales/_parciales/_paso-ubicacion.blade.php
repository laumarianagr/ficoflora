<div class="row">
    {!! Form::open(['route' => 'ubicacion.guardar',  'id'=>'jv_ubicacion', 'class' => 'form  form-bordered']) !!}
    <section class="panel col-xs-12 col-md-8 col-xlg-6 form-wizard" id="ubicacion">
        <header class="panel-heading p-sm">
            <h2 class="panel-title">Nueva Ubicación</h2>
        </header>



        @include('geograficos.ubicacion._parciales._form-nueva-ubicacion')

        <div class="panel-footer">

            <div class="form-group">
                <div class="col-sm-4 col-lg-2">
                    <button type="button" class="btn btn-default form-control" id="anterior">Anterior</button>
                </div>

                <div class="col-sm-4 col-lg-4 col-lg-offset-2">
                    {!! Form::submit('Agregar', ['id'=>'crear', 'class' => 'btn btn-primary form-control ', 'id' => 'crear']) !!}
                </div>
                <div class="col-sm-4 col-lg-2 col-lg-offset-2">
                    <button type="button" class="btn btn-default form-control" id="siguiente">Siguiente</button>
                </div>
            </div>


        </div>

    </section>
    {!! Form::close() !!}

    {{--PREVIEW RESULTADO SINONIMIA--}}
    <div class="col-xs-12 col-md-4 col-xlg-6">

        <div class="panel-group" id="accordion">
            <div class="panel panel-accordion ">


                <div class="panel-heading ">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse"  href="#panel_ubicacion">
                            <i class="fa fa-list-ol"></i> Ubicaciones Agregadas
                        </a>
                    </h4>
                </div>
                <div id="panel_ubicacion" class="accordion-body collapse in">
                    <div class="panel-body text-md ">

                        <ol id="lista_ubicacion">
                        </ol>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>