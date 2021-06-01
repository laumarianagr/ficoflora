<div id="modal_nuevafamilia" class="zoom-anim-dialog modal-block mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Nuevo Árbol Taxonómico</h2>
        </header>

        {!! Form::open(['route'=> ['taxonomia.guardar', 'familia'], 'id'=>'jv_taxonomia-familia', 'class' => 'form form-horizontal form-bordered jvalidate jv_taxonomia' ]) !!}

        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="modal-text">


                    {{--Familia Form Imput--}}
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="nueva_familia">Familia <span class="required">*</span> </label>

                        <div class="col-sm-9">
                            {!! Form::text('familia', null, ['class' => 'form-control typeahead type-complete', 'autocomplete' => 'off', 'id'=>'familia']) !!}
                        </div>
                    </div>

                    {{--Orden Form Imput--}}
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="nuevo_orden">Orden <span class="required">*</span></label>

                        <div class="col-sm-9">

                            {!! Form::text('orden', null, ['class' => 'form-control typeahead type-complete', 'autocomplete' => 'off', 'id'=>'orden']) !!}
                        </div>

                    </div>

                    {{--Subclase Form Imput--}}
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="nueva_subclase">Subclase </label>

                        <div class="col-sm-9">
                            {!! Form::text('subclase', null, ['class' => 'form-control typeahead type-complete', 'autocomplete' => 'off', 'id'=>'subclase' ]) !!}
                        </div>
                    </div>

                    {{--Clase Form Imput--}}
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="nueva_clase">Clase <span class="required">*</span></label>

                        <div class="col-sm-9">
                            {!! Form::text('clase', null, ['class' => 'form-control typeahead type-complete', 'autocomplete' => 'off', 'id'=>'clase' ]) !!}
                        </div>
                    </div>

                    {{--Phylum Form Imput--}}
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="nuevo_phylum">Phylum <span class="required">*</span></label>
                        <div class="col-sm-9">
                            {!! Form::text('phylum', null, ['class' => 'form-control typeahead type-complete', 'autocomplete' => 'off', 'id'=>'phylum' ]) !!}
                        </div>
                    </div>

                    <div>
                        <i class="text-danger pull-right">* Campos obligatorios</i>
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