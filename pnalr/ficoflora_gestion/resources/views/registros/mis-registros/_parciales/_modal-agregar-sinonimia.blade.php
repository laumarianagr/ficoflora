


<div id="modal-agregar-sinonimia" class="modal-block  mfp-hide  zoom-anim-dialog">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Agregar Sinonimia</h2>
        </header>
        {!! Form::open(['rout' => 'especie.sinonimia.agregar',  'id'=>'jv_sinonimia_select', 'class' => 'form  form-bordered']) !!}
        <div class="panel-body">

            <div class="col-sm-12 form-group">
                <label class=" control-label" for="select_sinonimia">Sinonimia <span class="required">*</span></label>
                {!! Form::select('select_sinonimia', $lista_sinonimias, null, ['id'=>'select_sinonimia', 'class' => 'form-control select', 'style'=>'width: 100%' ]) !!}
            </div>


        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary" id="agregar_sinonimia">Agregar</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
        {!! Form::close() !!}
    </section>
</div>