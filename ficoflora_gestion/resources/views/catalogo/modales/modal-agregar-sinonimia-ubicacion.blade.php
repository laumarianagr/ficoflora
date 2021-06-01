


<div id="modal-agregar-sinonimia-ubicacion" class="modal-block  mfp-hide  zoom-anim-dialog">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Agregar Sinonimia y/o Ubicación</h2>
        </header>
        {!! Form::open(['route' => 'reporte.agregar.sin-ubi',  'id'=>'jv_sinonimia_ubicacion', 'class' => 'form  form-bordered ']) !!}

        <div class="panel-body">

            <div class="col-sm-12 form-group">
                <label class=" control-label" for="sinonimia_select">Sinonimia <span class="required">*</span></label>
                {!! Form::select('sinonimia', $sinonimias, null, ['id'=>'sinonimia_select', 'class' => 'form-control select grupo_necesario sinonimia_select', 'style'=>'width: 100%' ]) !!}
            </div>

            <div class="col-sm-12 form-group">
                <label class=" control-label" for="entidad">Entidad Federal <span class="required">*</span></label>
                {!! Form::select('entidad', $entidades, null, ['id'=>'entidad_select', 'class' => 'form-control select grupo_necesario entidad_select', 'style'=>'width: 100%' ]) !!}
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
                    <button class="btn btn-primary" id="agregar_sinonimia_ubicacion">Agregar</button>
                    <button class="btn btn-default modal-dismiss">Cancelar</button>
                </div>
            </div>
        </footer>
        {!! Form::close() !!}
    </section>
</div>