

<div id="modal-agregar" class="modal-block  mfp-hide  zoom-anim-dialog">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Nuevo Usuario</h2>
        </header>
        {!! Form::open(['route'=> ['usuarios.crear'], 'id'=>'jv_usuarios', 'class' => 'form form-horizontal form-bordered' ]) !!}

        <div class="panel-body">
            <div class="modal-wrapper">
                <div>
                    <i class="text-danger pull-right">* Campos obligatorios</i>
                </div>
                <div class="modal-text">



                    {{--Familia Form Imput--}}
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="usuario">Usuario <span class="required">*</span> </label>

                        <div class="col-sm-9">
                            {!! Form::text('usuario', null, ['class' => 'form-control', 'autocomplete' => 'off',]) !!}
                        </div>
                    </div>

                    {{--Orden Form Imput--}}
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="nombre">Nombre <span class="required">*</span></label>

                        <div class="col-sm-9">
                            {!! Form::text('nombre', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>

                    </div>

                    {{--Orden Form Imput--}}
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="apellido">Apellido <span class="required">*</span></label>

                        <div class="col-sm-9">
                            {!! Form::text('apellido', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Correo <span class="required">*</span> </label>
                        <div class="col-md-9">
                            <input type="email" class="form-control" name="email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Clave <span class="required">*</span> </label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Confirmar <span class="required">*</span> </label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    {!! Form::submit('Crear', ['class' => 'btn btn-primary', 'id'=>'crear' ]) !!}
                    <button type="reset" class="btn btn-default">Limpiar</button>
                    <button class="btn btn-default modal-dismiss">Cancelar</button>

                </div>
            </div>
        </footer>
        {!! Form::close() !!}
    </section>
</div>