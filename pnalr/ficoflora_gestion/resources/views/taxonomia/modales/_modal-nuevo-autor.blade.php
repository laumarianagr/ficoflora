<div id="modal_nuevo-autor" class="zoom-anim-dialog modal-block mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Nuevo epíteto forma</h2>
        </header>

        {!! Form::open(['route'=> ['autor.guardar'], 'id'=>'jv_autor', 'class' => 'form form-horizontal form-bordered jvalidate']) !!}

        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="modal-text">


                    {{--ESPECIFICO Form Imput--}}
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="autor">Autoridad <span class="required">*</span> </label>

                        <div class="col-sm-8">
                            {!! Form::text('autor', null, ['class' => 'form-control typeahead type-complete', 'autocomplete' => 'off', 'id'=>'autor']) !!}
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