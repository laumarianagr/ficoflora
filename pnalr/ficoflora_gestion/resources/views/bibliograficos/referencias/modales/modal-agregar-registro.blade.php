


<div id="modal-agregar-registro" class="modal-block  mfp-hide  zoom-anim-dialog">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Asociar una Especie a la Referencia</h2>
        </header>
        {!! Form::open(['route' => 'reporte.crear',  'id'=>'jv_especie_select', 'class' => 'form  form-bordered ']) !!}

        <div class="panel-body">

            <div class="col-sm-12 form-group">
                <label class=" control-label" for="select_especie">Especie <span class="required">*</span></label>
                {!! Form::select('especie', $lista_especies, null, ['id'=>'select_especie', 'class' => 'form-control select', 'style'=>'width: 100%' ]) !!}
            </div>
        </div>

        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary" id="crear_registro">Agregar</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>

        {!! Form::close() !!}
    </section>
</div>