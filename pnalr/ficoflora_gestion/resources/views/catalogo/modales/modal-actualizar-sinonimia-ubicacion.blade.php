


<div id="modal-actualizar-sinonimia-ubicacion" class="modal-block  mfp-hide  zoom-anim-dialog">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Actualizar Sinonimia y/o Ubicación</h2>
        </header>
        {!! Form::open(['route' => 'reporte.actualizar.sin-ubi',  'id'=>'jv_actualizar_sinonimia_ubicacion', 'class' => 'form  form-bordered ']) !!}

        <div class="panel-body">

            <div class="col-sm-12 form-group">
                <label class=" control-label" for="sinonimia_select">Sinonimia <span class="required">*</span></label>
                {!! Form::select('sinonimia', $sinonimias, null, [ 'class' => 'form-control select grupo_necesarios sinonimia_select', 'style'=>'width: 100%' ]) !!}
            </div>

            <div class="col-sm-12 form-group">
                <label class=" control-label" for="entidad">Entidad Federal<span class="required">*</span></label>
                {!! Form::select('entidad', $entidades, null, [ 'class' => 'form-control select grupo_necesarios entidad_select', 'style'=>'width: 100%' ]) !!}
            </div>

            <div class="col-sm-12 form-group">
                <label class=" control-label" for="localidad">Localidad <span class="required">*</span></label>
                {!! Form::select('localidad', [], null, ['id'=>'localidad_select', 'class' => 'form-control select localidad_select', 'style'=>'width: 100%' ]) !!}
            </div>

            <div class="col-sm-12 form-group">
                <label class=" control-label" for="lugares">Lugar <span class="required">*</span></label>
                {!! Form::select('lugar', [], null, ['id'=>'lugar_select', 'class' => 'form-control select lugar_select', 'style'=>'width: 100%' ]) !!}
            </div>

            <div class="col-sm-12 form-group">
                <label class=" control-label" for="sitios">Sitio <span class="required">*</span></label>
                {!! Form::select('sitio', [], null, ['id'=>'sitio_select', 'class' => 'form-control select sitio_select', 'style'=>'width: 100%' ]) !!}
            </div>


        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary" id="actualizar_sinonimia_ubicacion">Actualizar</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
        {!! Form::close() !!}
    </section>
</div>