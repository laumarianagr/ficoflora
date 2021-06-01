<div >
    <i class="req-leyenda">* Campos obligatorios</i>

</div>

<div class="row">
    <div class="form-group col-md-12">
        <label class=" control-label" for="genero">Género <span class="required">*</span></label>

        {!! Form::text('genero', null, ['id'=>'s-genero', 'class' => 'form-control typeahead preview', 'autocomplete' => 'off']) !!}
    </div>

    <div class="form-group col-md-12">
        <label class=" control-label" for="especie">Epíteto específico <span class="required">*</span></label>

        {!! Form::text('especie', null, ['id'=>'s-especie', 'class' => 'form-control typeahead preview', 'autocomplete' => 'off']) !!}
    </div>

    <div class="form-group col-md-12">
        <label class=" control-label" for="s-variedad">Epíteto varietal </label>

        {!! Form::text('variedad', null, ['id'=>'s-variedad','class' => 'form-control  typeahead preview', 'autocomplete' => 'off']) !!}
    </div>

    <div class="form-group col-md-12">
        <label class=" control-label" for="forma">Epíteto forma</label>

        {!! Form::text('forma', null, ['id'=>'s-forma','class' => 'form-control  typeahead preview', 'autocomplete' => 'off']) !!}
    </div>



    {{--Autor Form Imput--}}
    <div class="form-group col-md-12">
        <label class=" control-label" for="autor">Autoridad <span class="required">*</span></label>

        {!! Form::text('autor', null, ['id'=>'s-autor', 'class' => 'form-control typeahead preview', 'autocomplete' => 'off']) !!}

    </div>



</div>

