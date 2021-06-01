/**
 * Created by Lupita on 08/10/2015.
 */




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

            var mensaje = "Referencia creada correctamente";

            toastr.success( mensaje, "¡Listo!");
            setTimeout(function(){
                window.location.replace(root_url+'referencias/libros/'+data);

            }, 2000);


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


$('#referencia_revista').submit(function(e){

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

            var mensaje = "Referencia creada correctamente";

            toastr.success( mensaje, "¡Listo!");
            setTimeout(function(){
                window.location.replace(root_url+'referencias/revistas/'+data);

            }, 2000);


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

$('#referencia_trabajo').submit(function(e){

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

            var mensaje = "Referencia creada correctamente";

            toastr.success( mensaje, "¡Listo!");
            setTimeout(function(){
                window.location.replace(root_url+'referencias/trabajos/'+data);

            }, 2000);


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