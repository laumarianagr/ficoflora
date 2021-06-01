/**
 * Created by Lupita on 03/10/2015.
 */
var global_index = 0;

var especie_id,
    referencia_id,
    tipo_referencia,
    sinonimiasIds = [],
    sinonimiasNombres = [],
    ubicaciones = [];

var postDataEspecie = [],
    postDataReferencia = [];

//
//(function( $ ) {
//    'use strict';

$('#catalogo').bootstrapWizard({
    tabClass: 'wizard-steps',
    //previousSelector: '#anterior_paso',
    //nextSelector: '#siguiente',
    firstSelector: null,
    lastSelector: null,

    onNext: function (tab, navigation, index, newindex) {
        global_index = index;
        console.log('global next ' + global_index);

        $('#pasos div.pasos').removeClass("active");
        $('#pasos div#tab_'+global_index).addClass("active");
    },

    onPrevious:function (tab, navigation, index, newindex){

        //if(index >= 0){

        global_index = index;
        //}

        console.log('antes '+ global_index);

        $('#pasos div.pasos').removeClass("active");
        $('#pasos div#tab_'+global_index).addClass("active");

    },
    onTabClick: function( tab, navigation, index, newindex ) {
        return false;
    },
    onTabChange: function( tab, navigation, index, newindex ) {
        var totalTabs = navigation.find('li').size() - 1;
        $('#finalizar')[ newindex != totalTabs ? 'addClass' : 'removeClass' ]( 'hidden' );

        $('#siguiente_paso')[ ((newindex > 1) && (newindex !=  totalTabs )) ? 'removeClass' : 'addClass' ]( 'hidden' );
        $('#anterior_paso')[ newindex == 0 ? 'addClass' : 'removeClass' ]( 'hidden' );
    }
});


//
//}).apply( this, [ jQuery ]);


$('#anterior_paso').on('click', function(e) {
    //if(global_index >0 ){
    $('#catalogo').bootstrapWizard('previous');
    //}

});


$('#siguiente_paso').on('click', function(e){

    console.log('ajax '+global_index);

    switch (global_index){
        case 0:
            //setEspercie();
            break;

        case 1:
            //var validated = $(".form_ref").valid();
            break;

        case 2:
            //setRelacionSinominia();
            $('#catalogo').bootstrapWizard('next');

            break;
    }

    //$('#catalogo').bootstrapWizard('next');

});


//==================================================<<<<<
//  P A S O  1  -  ESPECIE
//==================================================<<<<<


$("#jv_especie-temporal").validate({

    highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
        $(element).remove();
    },
    rules: {
        phylum: "required",
        clase: "required",
        orden: "required",
        familia: "required",
        genero: "required",
        especie: "required",
        autor: "required"
    },
    messages: {
        phylum: "Este campo es obligatorio",
        clase: "Este campo es obligatorio",
        orden: "Este campo es obligatorio",
        familia: "Este campo es obligatorio",
        genero: "Este campo es obligatorio",
        especie: "Este campo es obligatorio",
        autor: "Este campo es obligatorio"
    }
});


// Buscar ESPECIES
//----------------------------<<<<<<<<<<<<
$('#seleccionar_especie').on('click', function(e) {

    e.preventDefault();

    var validated = $("#jv_especie_select").valid();

    if(validated) {
        especie_id = $('#select_especie').val(); //guardo el id en la variable
        $('#catalogo').bootstrapWizard('next'); //seguimos al siguiente paso

    }
});

$('#jv_especie-temporal').submit(function(e) {

    e.preventDefault();
    var validated = $("#jv_especie-temporal").valid();
    postDataEspecie


    if(validated) {

        postDataEspecie = $(this).serializeArray();


        especie_id = null;
        //var phylum = $('#phylum').val();
        //var clase = $('#clase').val();
        //var subclase = $('#subclase').val();
        //var orden = $('#orden').val();
        //var familia = $('#familia').val();
        //var genero = $('#genero').val();
        //var especifico = $('#especie').val();
        //var varietal = $('#variedad').val();
        //var forma = $('#forma').val();
        //var autor = $('#autor').val();

        $('#catalogo').bootstrapWizard('next'); //seguimos al siguiente paso

    }

});


//==================================================<<<<<
//  P A S O  2  -  REFERENCIA
//==================================================<<<<<

// Formularios de referencias
//----------------------------<<<<<<<<<<<<
$('.form_ref').submit(function(e){

    e.preventDefault();

    tinyMCE.triggerSave(); //Pasa al textarea lo que está en el editor de titulos

     postDataReferencia = $(this).serializeArray();

    console.log(postDataReferencia);

    $('#catalogo').bootstrapWizard('next');

});


//para saber que tipo de referencia se esta creando
$('#crear_libro').on('click', function(){
    tipo_referencia = 'L';
});

$('#crear_revista').on('click', function(){
    tipo_referencia = 'R';
});

$('#crear_catalogo').on('click', function(){
    tipo_referencia = 'C';
});

$('#crear_trabajo').on('click', function(){
    tipo_referencia = 'T';
});

$('#crear_enlace').on('click', function(){
    tipo_referencia = 'E';
});


//==================================================<<<<<
//  P A S O  3  -  SINONIMIA
//==================================================<<<<<

// Busqueda de SINONIMIAS
//----------------------------<<<<<<<<<<<<
$('#seleccionar_sinonimia').on('click', function(e) {

    e.preventDefault();

    var validated = $("#jv_sinonimia_select").valid();

    if(validated) {

        var _this = $('#select_sinonimia');

        var sinonimia_id = $('#select_sinonimia').val(),
            sinonimia_text = $('option:selected', _this).text();

        sinonimiasIds.push(sinonimia_id); // se van guardando los id de las sinonimias en la variable

        $('#lista_sinonimia').append('<li> <b><em>' +sinonimia_text + '</em></b> </li>')
        //$('#lista_sinonimia').append('<li> <b><em>' + data['sinonimia'] + '</em></b> ' + data['autor'] + '</li>')

    }

});

$("#jv_sinonimia-temporal").validate({

    highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
        $(element).remove();
    },
    rules: {
        genero: "required",
        especie: "required",
        autor: "required"
    },
    messages: {
        genero: "Este campo es obligatorio",
        especie: "Este campo es obligatorio",
        autor: "Este campo es obligatorio"
    }
});


// Formularios de SINONIMIAS
//----------------------------<<<<<<<<<<<<
$('#jv_sinonimia-temporal').submit(function(e){

    e.preventDefault();

    var validated = $("#jv_sinonimia-temporal").valid();

    console.log(validated);

    if(validated) {
        console.log($('#s-genero').val());

        var genero = $('#s-genero').val();
        var especie = $('#s-especie').val();
        var variedad = $('#s-variedad').val();
        var forma = $('#s-forma').val();
        var subespecie = $('#s-subespecie').val();
        var autor = $('#s-autor').val();

        var nombre = genero+' '+ especie;

        if(variedad != ''){
            nombre = nombre+' var. '+variedad;
        }

        if(forma != ''){
            nombre = nombre+' f. '+forma;
        }

        if( (variedad != '') && (forma != '')) {
            nombre = nombre+' var. '+variedad+' f. '+forma;;
        }

        if(subespecie != ''){
            nombre = nombre+' subsp. '+subespecie;
        }

        nombre = nombre+' '+autor;

        sinonimiasNombres.push(nombre);// se van guardando los id de las sinonimias en la variable
        console.log(sinonimiasNombres);

        $('#jv_sinonimia-temporal')[0].reset();
        $('#lista_sinonimia').append('<li> <b><em>' + genero+' '+ especie+' '+ variedad+' '+forma +' '+subespecie + '</em></b> ' + autor + '</li>')

    }
});



//==================================================<<<<<
//  P A S O  4  -  UBICACIÓN
//==================================================<<<<<

// Formularios de UBICACION
//----------------------------<<<<<<<<<<<<
$('#jv_ubicacion').submit(function(e){

    e.preventDefault();

    console.log('aqui'+$(this).attr('action'));
    var action = $(this).attr('action');
    var postData = $(this).serializeArray();
    postData.push({ name: "especie", value: especie_id });

    //console.log(postData);
    var validated = $("#jv_ubicacion").valid();
    console.log(validated);

    if(validated) {


        var ubicacion = $('#entidad').val()+'_'+$('#latitud_entidad').val()+'_'+$('#longitud_entidad').val();
        var texto = $('#entidad').val();

        if($('#localidad').val() != ''){
            ubicacion = ubicacion+'|'+$('#localidad').val()+'_'+$('#latitud_localidad').val()+'_'+$('#longitud_localidad').val();
            texto = texto+', '+$('#localidad').val();

            if($('#lugar').val() != ''){
                ubicacion = ubicacion+'|'+$('#lugar').val()+'_'+$('#latitud_lugar').val()+'_'+$('#longitud_lugar').val();
                texto = texto+' ('+$('#lugar').val();
      
                if($('#sitio').val() != '') {
                    ubicacion = ubicacion + '|' + $('#sitio').val() + '_' + $('#latitud_sitio').val() + '_' + $('#longitud_sitio').val();
                    texto = texto+' ['+$('#sitio').val()+']';

                }
                texto = texto+')'

            }
        }
      
    ubicaciones.push(ubicacion); // guardamos las ubicaciones que se crean

        console.log(ubicaciones);


        $('#jv_ubicacion')[0].reset();
        $('#ubicacion').bootstrapWizard('first');

        $('#lista_ubicacion').append('<li>' + texto + '</li>')

        toastr.success('Ubicación agregada', "¡Listo!");
    }
});



//==================================================<<<<<
//  FINALIZAR
//==================================================<<<<<

$('#form_catalogo').submit(function(e) {

    //e.preventDefault();

    $('#form_catalogo').append($("<input>").attr({"type":"hidden","name":"referencia"}).val(tipo_referencia));

    var input;

    $.each(postDataReferencia, function(i, field){
        input = $("<input>").attr({"type":"hidden","name":field.name}).val(field.value);
        $("#form_catalogo").append(input);
    });

    $('#form_catalogo').append($("<input>").attr({"type":"hidden","name":"especie_id"}).val(especie_id));

    if(especie_id == null){
        $.each(postDataEspecie, function(i, field){
            input = $("<input>").attr({"type":"hidden","name":field.name}).val(field.value);
            $("#form_catalogo").append(input);
        });
    }

    $('#form_catalogo').append($("<input>").attr({"type":"hidden","name":"sinonimias_ids"}).val(sinonimiasIds));
    $('#form_catalogo').append($("<input>").attr({"type":"hidden","name":"sinonimias_nombres"}).val(sinonimiasNombres));
    $('#form_catalogo').append($("<input>").attr({"type":"hidden","name":"ubicaciones"}).val(ubicaciones));




    //e.preventDefault();


    //
    //if((especie_id == null) || (referencia_id == null)){
    //    console.log('error');
    //}else{
    //    var action = $(this).attr('action');
    //
    //    $.ajax({
    //        type: "post",
    //        url: action,
    //        data: {
    //            '_token': $("input[name=_token]").val(),
    //            'especie': especie_id,
    //            'referencia': referencia_id,
    //            'tipo': tipo_referencia,
    //            'sinonimias': sinonimias,
    //            'ubicaciones': ubicaciones
    //        },
    //        beforeSend: function () {
    //            $('#siguiente').prop("disabled", true);
    //        },
    //        success: function (data) {
    //            console.log(data);
    //
    //            toastr.success('', "¡Listo!");
    //
    //        },
    //        error: function (response, json, errorThrown) {
    //            var errors = response.responseJSON;
    //            var errorsHtml = '';
    //
    //            console.log(errors);
    //            console.log(response.responseText, response.status);
    //
    //
    //            $.each(errors, function (key, value) {
    //                //                                errorsHtml += '<li>' + value[0] + '</li>';
    //                errorsHtml += value[0] + '</br>';
    //                console.log(value[0]);
    //            });
    //            //toastr.error( errorsHtml , "Error " + response.status +': '+ errorThrown);
    //            toastr.error(errorsHtml, "¡Error!");
    //
    //
    //        },
    //        complete: function () {
    //            $('#siguiente').prop("disabled", false);
    //
    //        }
    //    });
    //}


});