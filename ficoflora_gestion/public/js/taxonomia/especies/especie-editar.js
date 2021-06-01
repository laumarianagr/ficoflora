/**
 * Created by Lupita on 22/08/2015.
 * Edited by Yusneyi Carballo Barrera 22/08/2017
 */

function nuevaOpcionSelects(taxo, data){

    var $id_elem ='#'+taxo+'.select' //$("#familia.select") o $("#genero.select")
    console.log($element);
    var $element = $($id_elem); // the element that Select2 is initialized on
    //var $element = $("#genero.select"); // the element that Select2 is initialized on
    var $option = $("<option selected></option>"); // the new base option
    $option.val(data.id); // set the id
    $option.text(data.nombre); // set the text
    $element.append($option); // add it to the list of selections
    $element.trigger("change"); // tell Select2 to update
}


//Procesa el formulario de nuevo EPITETO ESPECÍFICO
$('#jv_especifico').submit(function(e){

    e.preventDefault();

    var taxo = 'especie';

    var validated = $('#jv_especifico').valid();
    var action = $(this).attr('action');
    var postData = $(this).serializeArray();

    if(validated) {

        $.ajax({
            type: "post",
            url:action,
            data: postData,
            beforeSend: function(){
                $('#nueva_taxonomia').prop( "disabled", true );

            },
            success: function (data) {
                console.log(data);
                nuevaOpcionSelects(taxo, data);
                $.magnificPopup.close();
                toastr.success( "Registro creado correctamente" , "¡Listo!");

            },
            error: function ( response, json, errorThrown ) {
                var errors = response.responseJSON;
                var errorsHtml = '';

                console.log(errors);
//                        console.log(response.responseText, response.status);


                $.each( errors, function( key, value ) {
                    //                                errorsHtml += '<li>' + value[0] + '</li>';
                    errorsHtml += value[0] + '</br>';
                    console.log(value[0]);
                });
                //                            toastr.error( errorsHtml , "Error " + response.status +': '+ errorThrown);
                toastr.error( errorsHtml , "¡Error!");
            },
            complete: function(){
                $('#nueva_taxonomia').prop( "disabled", false );
            }
        });
    }
});

//Procesa el formulario de nuevo EPÍTETO VARIETAL
$('#jv_varietal').submit(function(e){

    e.preventDefault();

    var taxo = 'variedad';

    var validated = $('#jv_varietal').valid();
    var action = $(this).attr('action');
    var postData = $(this).serializeArray();

    if(validated) {

        $.ajax({
            type: "post",
            url:action,
            data: postData,
            beforeSend: function(){
                $('#nueva_taxonomia').prop( "disabled", true );

            },
            success: function (data) {
                console.log(data);
                nuevaOpcionSelects(taxo, data);

                $.magnificPopup.close();
                toastr.success( "Registro creado correctamente" , "¡Listo!");

            },
            error: function ( response, json, errorThrown ) {
                var errors = response.responseJSON;
                var errorsHtml = '';

                console.log(errors);
//                        console.log(response.responseText, response.status);


                $.each( errors, function( key, value ) {
                    //                                errorsHtml += '<li>' + value[0] + '</li>';
                    errorsHtml += value[0] + '</br>';
                    console.log(value[0]);
                });
                //                            toastr.error( errorsHtml , "Error " + response.status +': '+ errorThrown);
                toastr.error( errorsHtml , "¡Error!");
            },
            complete: function(){
                $('#nueva_taxonomia').prop( "disabled", false );
            }
        });
    }
});


//Procesa el formulario de nuevo EPÍTETO FORMA
$('#jv_forma').submit(function(e){

    e.preventDefault();

    var taxo = 'forma';

    var validated = $('#jv_forma').valid();
    var action = $(this).attr('action');
    var postData = $(this).serializeArray();

    if(validated) {

        $.ajax({
            type: "post",
            url:action,
            data: postData,
            beforeSend: function(){
                $('#nueva_taxonomia').prop( "disabled", true );

            },
            success: function (data) {
                console.log(data);
                nuevaOpcionSelects(taxo, data);

                $.magnificPopup.close();
                toastr.success( "Registro creado correctamente" , "¡Listo!");

            },
            error: function ( response, json, errorThrown ) {
                var errors = response.responseJSON;
                var errorsHtml = '';

                console.log(errors);
//                        console.log(response.responseText, response.status);


                $.each( errors, function( key, value ) {
                    //                                errorsHtml += '<li>' + value[0] + '</li>';
                    errorsHtml += value[0] + '</br>';
                    console.log(value[0]);
                });
                //                            toastr.error( errorsHtml , "Error " + response.status +': '+ errorThrown);
                toastr.error( errorsHtml , "¡Error!");
            },
            complete: function(){
                $('#nueva_taxonomia').prop( "disabled", false );
            }
        });
    }
});


//Procesa el formulario de nueva SUBESPECIE
$('#jv_subespecie').submit(function(e){

    e.preventDefault();

    var taxo = 'subespecie';

    var validated = $('#jv_subespecie').valid();
    var action = $(this).attr('action');
    var postData = $(this).serializeArray();

    if(validated) {

        $.ajax({
            type: "post",
            url:action,
            data: postData,
            beforeSend: function(){
                $('#nueva_taxonomia').prop( "disabled", true );

            },
            success: function (data) {
                console.log(data);
                nuevaOpcionSelects(taxo, data);

                $.magnificPopup.close();
                toastr.success( "Registro creado correctamente" , "¡Listo!");

            },
            error: function ( response, json, errorThrown ) {
                var errors = response.responseJSON;
                var errorsHtml = '';

                console.log(errors);
//                        console.log(response.responseText, response.status);


                $.each( errors, function( key, value ) {
                    //                                errorsHtml += '<li>' + value[0] + '</li>';
                    errorsHtml += value[0] + '</br>';
                    console.log(value[0]);
                });
                //                            toastr.error( errorsHtml , "Error " + response.status +': '+ errorThrown);
                toastr.error( errorsHtml , "¡Error!");
            },
            complete: function(){
                $('#nueva_taxonomia').prop( "disabled", false );
            }
        });
    }
});


//Procesa el formulario de nuevo AUTOR
$('#jv_autor').submit(function(e){

    e.preventDefault();

    var taxo = 'autor';

    var validated = $('#jv_autor').valid();
    var action = $(this).attr('action');
    var postData = $(this).serializeArray();

    if(validated) {

        $.ajax({
            type: "post",
            url:action,
            data: postData,
            beforeSend: function(){
                $('#nueva_taxonomia').prop( "disabled", true );

            },
            success: function (data) {
                console.log(data);
                nuevaOpcionSelects(taxo, data);

                $.magnificPopup.close();
                toastr.success( "Registro creado correctamente" , "¡Listo!");

            },
            error: function ( response, json, errorThrown ) {
                var errors = response.responseJSON;
                var errorsHtml = '';

                console.log(errors);
//                        console.log(response.responseText, response.status);


                $.each( errors, function( key, value ) {
                    //                                errorsHtml += '<li>' + value[0] + '</li>';
                    errorsHtml += value[0] + '</br>';
                    console.log(value[0]);
                });
                //                            toastr.error( errorsHtml , "Error " + response.status +': '+ errorThrown);
                toastr.error( errorsHtml , "¡Error!");
            },
            complete: function(){
                $('#nueva_taxonomia').prop( "disabled", false );
            }
        });
    }
});


//Procesa el formulario de nuevo GÉNERO
$('#jv_genero').submit(function(e){

    e.preventDefault();

    var taxo = 'genero';

    var validated = $('#jv_genero').valid();
    var action = $(this).attr('action');
    var postData = $(this).serializeArray();

    if(validated) {

        $.ajax({
            type: "post",
            url:action,
            data: postData,
            beforeSend: function(){
                $('#nueva_taxonomia').prop( "disabled", true );

            },
            success: function (data) {
                console.log(data);
                nuevaOpcionSelects(taxo, data);
                //console.log('ADASD' + data.familia_id);
                $("#familia.select").val(data.familia_id).trigger("change")

                $.magnificPopup.close();
                toastr.success( "Registro creado correctamente" , "¡Listo!");

            },
            error: function ( response, json, errorThrown ) {
                var errors = response.responseJSON;
                var errorsHtml = '';

                console.log(errors);
//                        console.log(response.responseText, response.status);


                $.each( errors, function( key, value ) {
                    //                                errorsHtml += '<li>' + value[0] + '</li>';
                    errorsHtml += value[0] + '</br>';
                    console.log(value[0]);
                });
                //                            toastr.error( errorsHtml , "Error " + response.status +': '+ errorThrown);
                toastr.error( errorsHtml , "¡Error!");
            },
            complete: function(){
                $('#nueva_taxonomia').prop( "disabled", false );
            }
        });
    }
});