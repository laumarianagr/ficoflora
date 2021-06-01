/**
 * Created by Lupita on 09/08/2015.
 */
var global_index = 0;

var especie_id,
    referencia_id,
    referencia,
    tipo_referencia;



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
        $('#anterior_paso')[ newindex != 4 ? 'addClass' : 'removeClass' ]( 'hidden' );
        //$('#anterior_paso')[ newindex == 2 ? 'addClass' : 'removeClass' ]( 'hidden' );
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
            //$('#catalogo').bootstrapWizard('next');

            break;
    }

    //$('#catalogo').bootstrapWizard('next');

});






//==================================================<<<<<
//  P A S O  1  -  ESPECIE
//==================================================<<<<<

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

// Formularios de ESPECIES
//----------------------------<<<<<<<<<<<<
$('#jv_especie').submit(function(e){

    e.preventDefault();

    var action = $(this).attr('action');
    var postData = $(this).serializeArray();

    var validated = $("#jv_especie").valid();

    if(validated) {

        $.ajax({
            type: "post",
            url: action,
            data: postData,
            beforeSend: function () {
                $('#siguiente').prop("disabled", true);
            },
            success: function (data) {
                console.log(data);

                var mensaje = "Especie creada correctamente";
                //if (!data['nuevo']) {
                //    mensaje = "Especie seleccionada correctamente";
                //}

                especie_id = data['especie']; //guardo el id en la variable

                toastr.success(mensaje, "¡Listo!");

                $('#catalogo').bootstrapWizard('next');//seguimos al siguiente paso

            },
            error: function (response, json, errorThrown) {
                var errors = response.responseJSON;
                var errorsHtml = '';

                console.log(errors);
                console.log(response.responseText, response.status);

                $.each(errors, function (key, value) {
                    errorsHtml += value[0] + '</br>';
                    console.log(value[0]);
                });
                //toastr.error( errorsHtml , "Error " + response.status +': '+ errorThrown);
                toastr.error(errorsHtml, "¡Error!");


            },
            complete: function () {
                $('#siguiente').prop("disabled", false);

            }
        });

    }
});







//==================================================<<<<<
//  P A S O  2  -  REFERENCIA
//==================================================<<<<<

// Formularios de referencias
//----------------------------<<<<<<<<<<<<


$('#referencia_libro').submit(function(e){

    e.preventDefault();

    tinyMCE.triggerSave(); //Pasa al textarea lo que está en el editor de titulos

  
    var action = $(this).attr('action');
    var postData = $(this).serializeArray();


    $.ajax({
        type: "post",
        url: action,
        data: postData,
        beforeSend: function(){
            $('#siguiente').prop( "disabled", true );
        },
        success: function (data) {
            console.log(data);

            var mensaje = "Referencia creada correctamente";;
            if(!data['nuevo']){
                mensaje = "Referencia seleccionada correctamente";
            }
            tipo_referencia = 'L';

            referencia_id = data['id']; //guardo el id en la variable
            referencia= data; //guardo el id en la variable

            toastr.success( mensaje, "¡Listo!");

            $('#catalogo').bootstrapWizard('next'); //seguimos al siguiente paso


        },
        error: function ( response, json, errorThrown ) {
            var errors = response.responseJSON;
            var errorsHtml = '';

            console.log(errors);
            console.log(response.responseText, response.status);


            $.each( errors, function( key, value ) {
                //                                errorsHtml += '<li>' + value[0] + '</li>';
                errorsHtml += value[0] + '</br>';
                console.log(value[0]);
            });
            //toastr.error( errorsHtml , "Error " + response.status +': '+ errorThrown);
            toastr.error( errorsHtml , "¡Error!");



        },
        complete: function(){
            $('#siguiente').prop( "disabled", false );

        }
    });

});








//==================================================<<<<<
//  FINALIZAR
//==================================================<<<<<
//
$('#form_catalogo').submit(function(e) {

    $('#form_catalogo').append($("<input>").attr({"type":"hidden","name":"referencia"}).val(referencia_id));
    $('#form_catalogo').append($("<input>").attr({"type":"hidden","name":"especie"}).val(especie_id));
    $('#form_catalogo').append($("<input>").attr({"type":"hidden","name":"tipo"}).val(tipo_referencia));



});

//$('#form_catalogo').submit(function(e) {
//
//    e.preventDefault();
//
//
//    if((especie_id == null) || (referencia_id == null)){
//        console.log('error');
//    }else{
//        var action = $(this).attr('action');
//
//        $.ajax({
//                type: "post",
//                url: action,
//                data: {
//                '_token': $("input[name=_token]").val(),
//                'especie': especie_id,
//                'referencia': referencia_id,
//                'tipo': tipo_referencia,
//            },
//                beforeSend: function () {
//                    $('#siguiente').prop("disabled", true);
//                },
//                success: function (data) {
//                    console.log(data);
//
//                    toastr.success('', "¡Listo!");
//
//                },
//                error: function (response, json, errorThrown) {
//                    var errors = response.responseJSON;
//                    var errorsHtml = '';
//
//                    console.log(errors);
//                    console.log(response.responseText, response.status);
//
//
//                    $.each(errors, function (key, value) {
//                        //                                errorsHtml += '<li>' + value[0] + '</li>';
//                        errorsHtml += value[0] + '</br>';
//                        console.log(value[0]);
//                    });
//                    //toastr.error( errorsHtml , "Error " + response.status +': '+ errorThrown);
//                    toastr.error(errorsHtml, "¡Error!");
//
//
//                },
//                complete: function () {
//                    $('#siguiente').prop("disabled", false);
//
//                }
//            });
//    }
//
//
//});