<div >
    <i class="req-leyenda">* Campos obligatorios</i>

</div>

<div class="row">

    {{--GENERO--}}
    <div class="form-group col-md-12">
        <label class=" control-label" for="genero">Género <span class="required">*</span></label>

        <div>
            <div class="col-xs-6 col-sm-9 pl-none">
                {!! Form::select('genero', [], $especie['genero_id'],['id'=>'genero', 'class' => 'form-control select preview',  'style'=>'width: 100%']) !!}
            </div>
            <div class="col-xs-4 col-sm-3 pt-xs">
                <a class="text-md modal-basic modal-with-zoom-anim get_typeahead-datos" href="#modal_new-genero" id="nuevo-genero"><span class="fa fa-plus-circle va-middle text-xl" aria-hidden="true"></span> Nueva</a>
            </div>
        </div>

    </div>

    {{--ESPECIFICO--}}
    <div class="form-group col-md-12">
        <label class=" control-label" for="especie">Epíteto específico <span class="required">*</span></label>

        <div>
            <div class="col-xs-6 col-sm-9 pl-none">
                {!! Form::select('especie', $especificos, $especie['especifico_id'], ['id'=>'especie', 'class' => 'form-control select preview', 'style'=>'width: 100%']) !!}
            </div>
            <div class="col-xs-4 col-sm-3 pt-xs">
                <a class="text-md modal-basic modal-with-zoom-anim " href="#modal_nuevo-especifico" id="nuevo"><span class="fa fa-plus-circle va-middle text-xl " aria-hidden="true"></span> Nuevo</a>
            </div>
        </div>

    </div>

    {{--VARIETAL--}}
    <div class="form-group col-md-12">
        <label class=" control-label" for="variedad">Epíteto varietal </label>

        <div>
            <div class="col-xs-6 col-sm-9 pl-none">
                {!! Form::select('variedad', $varietales, $especie['varietal_id'],['id'=>'variedad','class' => 'form-control  select preview', 'style'=>'width: 100%']) !!}
            </div>
            <div class="col-xs-4 col-sm-3 pt-xs">
                <a class="text-md modal-basic modal-with-zoom-anim " href="#modal_nuevo-varietal" id="nuevo"><span class="fa fa-plus-circle va-middle text-xl " aria-hidden="true"></span> Nuevo</a>
            </div>
        </div>

    </div>

    {{--FORMA--}}
    <div class="form-group col-md-12">
        <label class=" control-label" for="forma">Epíteto forma</label>

        <div>
            <div class="col-xs-6 col-sm-9 pl-none">
                {!! Form::select('forma', $formas, $especie['forma_id'], ['id'=>'forma','class' => 'form-control  select preview',  'style'=>'width: 100%']) !!}
            </div>
            <div class="col-xs-4 col-sm-3 pt-xs">
                <a class="text-md modal-basic modal-with-zoom-anim " href="#modal_nuevo-forma" id="nuevo"><span class="fa fa-plus-circle va-middle text-xl " aria-hidden="true"></span> Nuevo</a>
            </div>
        </div>

    </div>

    {{--SUBESPECIE--}}
    <div class="form-group col-md-12">
        <label class=" control-label" for="subespecie">Subespecie</label>

        <div>
            <div class="col-xs-6 col-sm-9 pl-none">
                {!! Form::select('subespecie', $subespecies, $especie['subespecie_id'], ['id'=>'subespecie','class' => 'form-control  select preview',  'style'=>'width: 100%']) !!}
            </div>
            <div class="col-xs-4 col-sm-3 pt-xs">
                <a class="text-md modal-basic modal-with-zoom-anim " href="#modal_nuevo-subespecie" id="nuevo"><span class="fa fa-plus-circle va-middle text-xl " aria-hidden="true"></span> Nuevo</a>
            </div>
        </div>

    </div>



    {{--AUTORIDAD--}}
    <div class="form-group col-md-12">
        <label class=" control-label" for="autor">Autoridad <span class="required">*</span></label>

        <div>
            <div class="col-xs-6 col-sm-9 pl-none">
                {!! Form::select('autor',$autores,  $especie['autor_id'], ['id'=>'autor', 'class' => 'form-control select preview', 'style'=>'width: 100%']) !!}
            </div>
            <div class="col-xs-4 col-sm-3 pt-xs">
                <a class="text-md modal-basic modal-with-zoom-anim " href="#modal_nuevo-autor" id="nuevo"><span class="fa fa-plus-circle va-middle text-xl " aria-hidden="true"></span> Nuevo</a>

            </div>
        </div>

    </div>


    {{--FAMILIA--}}
    <div class="form-group col-md-12">

        <h3 class="mb-lg">Taxonomía Superior</h3>

        <label class=" control-label" for="familia_select">Familia <span class="required">*</span></label>
        <div>
            <div class="col-xs-6 col-sm-9 pl-none">

                {!! Form::select('familia', $familias, $especie['familia_id'], ['id'=> 'familia','class' => 'form-control select', 'style'=>'width: 100%']) !!}
            </div>
            <div class="col-xs-4 col-sm-3 pt-xs">
                <a class="text-md modal-basic modal-with-zoom-anim get_typeahead-datos" href="#modal_nuevafamilia" id="nueva-familia"><span class="fa fa-plus-circle va-middle text-xl " aria-hidden="true"></span> Nuevo</a>

            </div>
        </div>

    </div>

</div>