<div >
    <i class="req-leyenda">* Campos obligatorios</i>

</div>

<div class="row">
    <div class="form-group col-md-12">
        <label class=" control-label" for="genero">Género <span class="required">*</span></label>

        {!! Form::text('genero', null, ['id'=>'genero', 'class' => 'form-control typeahead preview to-select', 'autocomplete' => 'off']) !!}
    </div>

    <div class="form-group col-md-12">
        <label class=" control-label" for="especie">Epíteto específico <span class="required">*</span></label>

        {!! Form::text('especie', null, ['id'=>'especie', 'class' => 'form-control typeahead preview', 'autocomplete' => 'off']) !!}
    </div>

    <div class="form-group col-md-12">
        <label class=" control-label" for="variedad">Epíteto varietal </label>

        {!! Form::text('variedad', null, ['id'=>'variedad','class' => 'form-control  typeahead preview', 'autocomplete' => 'off']) !!}
    </div>

    <div class="form-group col-md-12">
        <label class=" control-label" for="forma">Epíteto forma</label>

        {!! Form::text('forma', null, ['id'=>'forma','class' => 'form-control  typeahead preview', 'autocomplete' => 'off']) !!}
    </div>

    <div class="form-group col-md-12">
        <label class=" control-label" for="forma">Subespecie</label>

        {!! Form::text('subespecie', null, ['id'=>'subespecie','class' => 'form-control  typeahead preview', 'autocomplete' => 'off']) !!}
    </div>



    {{--Autor Form Imput--}}
    <div class="form-group col-md-12">
        <label class=" control-label" for="autor">Autoridad <span class="required">*</span></label>

        {!! Form::text('autor', null, ['id'=>'autor', 'class' => 'form-control typeahead preview', 'autocomplete' => 'off']) !!}

    </div>


    {{--Familia Form Imput--}}
    <div class="form-group col-md-12">

        <h3 class="mb-lg">Taxonomía Superior</h3>

        <label class=" control-label" for="familia_select">Familia <span class="required">*</span></label>
        <div>
            <div class="col-xs-6 col-sm-9 pl-none">

                {!! Form::select('familia', $familias, null, ['id'=> 'familia','class' => 'form-control select', 'style'=>'width: 100%']) !!}
            </div>
            <div class="col-xs-4 col-sm-3 pt-xs">
                <a class="text-md modal-basic modal-with-zoom-anim get_typeahead-datos" href="#modal_nuevafamilia" id="nueva-familia"><span class="fa fa-plus-circle va-middle text-xl " aria-hidden="true"></span> Nueva</a>

            </div>
        </div>

    </div>
</div>