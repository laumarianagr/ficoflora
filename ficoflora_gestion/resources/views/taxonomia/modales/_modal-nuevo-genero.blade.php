<div id="modal_new-genero" class="zoom-anim-dialog modal-block mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Nuevo Árbol Taxonómico</h2>
        </header>

        {!! Form::open(['route'=> ['genero.guardar'], 'id'=>'jv_genero', 'class' => 'form form-horizontal form-bordered jvalidate' ]) !!}

        <div class="panel-body">
            <div >
                <i class="req-leyenda mb-md">* Campos obligatorios</i>

            </div>

            <div class="modal-wrapper">
                <div class="modal-text">

                    {{--Familia Form Imput--}}
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="genero">Genero <span class="required">*</span> </label>

                        <div class="col-sm-9">
                            {!! Form::text('genero', null, ['class' => 'form-control typeahead type-complete', 'autocomplete' => 'off', 'id'=>'genero']) !!}
                        </div>
                    </div>

                    {{--Familia Form Imput--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="control-label col-sm-3" for="amilia">Familia <span class="required">*</span> </label>--}}

                        {{--<div class="col-sm-9">--}}
                            {{--{!! Form::text('familia', null, ['class' => 'form-control typeahead type-complete', 'autocomplete' => 'off', 'id'=>'familia']) !!}--}}

                        {{--</div>--}}
                    {{--</div>--}}

                    {{--Orden Form Imput--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="control-label col-sm-3" for="nuevo_orden">Orden <span class="required">*</span></label>--}}

                        {{--<div class="col-sm-9">--}}

                            {{--{!! Form::text('orden', null, ['class' => 'form-control typeahead type-complete', 'autocomplete' => 'off', 'id'=>'orden']) !!}--}}
                        {{--</div>--}}

                    {{--</div>--}}

                    {{--Subclase Form Imput--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="control-label col-sm-3" for="nueva_subclase">Subclase </label>--}}

                        {{--<div class="col-sm-9">--}}
                            {{--{!! Form::text('subclase', null, ['class' => 'form-control typeahead type-complete', 'autocomplete' => 'off', 'id'=>'subclase' ]) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--Clase Form Imput--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="control-label col-sm-3" for="nueva_clase">Clase <span class="required">*</span></label>--}}

                        {{--<div class="col-sm-9">--}}
                            {{--{!! Form::text('clase', null, ['class' => 'form-control typeahead type-complete', 'autocomplete' => 'off', 'id'=>'clase' ]) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--Phylum Form Imput--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="control-label col-sm-3" for="nuevo_phylum">Phylum <span class="required">*</span></label>--}}
                        {{--<div class="col-sm-9">--}}
                            {{--{!! Form::text('phylum', null, ['class' => 'form-control typeahead type-complete', 'autocomplete' => 'off', 'id'=>'phylum' ]) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}


                    {{--Phylum Form Imput--}}
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="familia">Familia <span class="required">*</span></label>
                        <div class="col-sm-9">
                            {!! Form::select('familia', $familias, null, ['id'=> 'familia_nuevo_genero','class' => 'form-control select', 'style'=>'width: 100%']) !!}
                        </div>
                    </div>



                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary', 'id'=>'nueva_taxonomia' ]) !!}
                    <button type="reset" class="btn btn-default">Limpiar</button>
                    <button class="btn btn-default modal-dismiss">Cancelar</button>

                </div>
            </div>
        </footer>
        {!! Form::close() !!}

    </section>
</div>