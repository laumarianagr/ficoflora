<div class="panel-body panel-body-nopadding">
    <div class="wizard-tabs">
        <ul class="wizard-steps">
            <li class="active">
                <a href="#paso-entidad" data-toggle="tab" class="text-center">
                    <span class="badge hidden-xs">1</span>
                    Entidad Federal
                </a>
            </li>
            <li>
                <a href="#paso-localidad" data-toggle="tab" class="text-center">
                    <span class="badge hidden-xs">2</span>
                    Localidad
                </a>
            </li>
            <li>
                <a href="#paso-lugar" data-toggle="tab" class="text-center">
                    <span class="badge hidden-xs">3</span>
                    Lugar
                </a>
            </li>
            <li>
                <a href="#paso-sitio" data-toggle="tab" class="text-center">
                    <span class="badge hidden-xs">3</span>
                    Sitio
                </a>
            </li>
        </ul>
        {{--</div>--}}

        <div class="tab-content">

            {{--ENTIDAD--}}

            <div id="paso-entidad" class="tab-pane active">
                <div class="row">

                    {{--Entidad Form Imput--}}
                    <div class="form-group col-sm-12">
                        {!! Form::label('entidad', 'Entidad:',['class' => ' control-label']) !!}
                        {!! Form::text('entidad', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
                    </div>

                    {{--Latitud Form Imput--}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('latitud_entidad', 'Latitud:',['class' => 'control-label']) !!}
                        {!! Form::text('latitud_entidad', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
                    </div>
                    {{--Longitud Form Imput--}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('longitud_entidad', 'Longitud:',['class' => 'control-label']) !!}
                        {!! Form::text('longitud_entidad', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
                    </div>

                </div>
            </div>

            {{--LOCALIDAD--}}
            <div id="paso-localidad" class="tab-pane">
                <div class="row">

                    {{--Localidad Form Imput--}}
                    <div class="form-group col-md-12">
                        {!! Form::label('localidad', 'Localidad:',['class' => 'control-label']) !!}
                        {!! Form::text('localidad', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
                    </div>

                    {{--Latitud Form Imput--}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('latitud_localidad', 'Latitud:',['class' => 'control-label']) !!}
                        {!! Form::text('latitud_localidad', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
                    </div>
                    {{--Longitud Form Imput--}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('longitud_localidad', 'Longitud:',['class' => 'control-label']) !!}
                        {!! Form::text('longitud_localidad', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
                    </div>

                </div>
            </div>

            {{--LUGAR--}}
            <div id="paso-lugar" class="tab-pane">
                <div class="row">

                    {{--Lugar Form Imput--}}
                    <div class="form-group col-md-12">
                        {!! Form::label('lugar', 'Lugar:',['class' => 'control-label']) !!}
                        {!! Form::text('lugar', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
                    </div>

                    {{--Latitud Form Imput--}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('latitud_lugar', 'Latitud:',['class' => 'control-label']) !!}
                        {!! Form::text('latitud_lugar', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
                    </div>
                    {{--Longitud Form Imput--}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('longitud_lugar', 'Longitud:',['class' => 'control-label']) !!}
                        {!! Form::text('longitud_lugar', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
                    </div>

                </div>
            </div>

            {{--SITIO--}}
            <div id="paso-sitio" class="tab-pane">
                <div class="row">

                    {{--Sitio Form Imput--}}
                    <div class="form-group col-md-12">
                        {!! Form::label('sitio', 'Sitio:',['class' => 'control-label']) !!}
                        {!! Form::text('sitio', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
                    </div>

                    {{--Latitud Form Imput--}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('latitud_sitio', 'Latitud:',['class' => 'control-label']) !!}
                        {!! Form::text('latitud_sitio', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
                    </div>
                    {{--Longitud Form Imput--}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('longitud_sitio', 'Longitud:',['class' => 'control-label']) !!}
                        {!! Form::text('longitud_sitio', null, ['class' => 'form-control typeahead', 'autocomplete' => 'off']) !!}
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>