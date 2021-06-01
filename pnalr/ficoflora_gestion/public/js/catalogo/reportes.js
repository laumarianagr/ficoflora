
var datos_fila;
//Modal para eliminar especie
$('#datatable tbody').on( 'click', 'td>a.actualizar', function () {

    var _self  = $(this);
    //console.log(  table.row(_self.parents('tr')).data());

    datos_fila = table.row(_self.parents('tr')).data()
    fila = _self.parents('tr');

    setUbicacion();
    //modal_actualizar.magnificPopup('open');

} );


function setUbicacion(){
    console.log(datos_fila[1]);

    $.ajax({
        type: "get",
        url: root_url + 'reportes/' + datos_fila[1]+'/sinonimia-ubicacion',
        data: {},
        success: function (data) {

            console.log(data);

            if(data[0] != null) {
                var ubicacion = data[0];

                $(".entidad_select").val(ubicacion['entidad_id']).trigger("select2:select").trigger("change");
                if(ubicacion['localidad_id'] != null){
                    $(".localidad_select").val(ubicacion['localidad_id']).trigger("select2:select").trigger("change");

                    if(ubicacion['lugar_id'] != null) {
                        $(".lugar_select").val(ubicacion['lugar_id']).trigger("select2:select").trigger("change");
                        if(ubicacion['sitio_id'] != null) {
                            $(".sitio_select").val(ubicacion['sitio_id']).trigger("select2:select").trigger("change");
                        }
                    }
                }
            }//ubicacion

            if(data[1] != null) {
                $(".sinonimia_select").val(data[1] ).trigger("select2:select").trigger("change");
            }



        },
        error: function (response, json, errorThrown) {
            var errors = response.responseJSON;
            console.log(errors);
            console.log(response.responseText);
        }
    });
}





var modal_actualizar = $('.actualizar').magnificPopup({

    type: 'inline',
    preloader: false,
    focus: '#name',
    modal: true,

    // When elemened is focused, some mobile browsers in some cases zoom in
    // It looks not nice, so we disable it:
    callbacks: {
        beforeOpen: function() {
            if($(window).width() < 700) {
                this.st.focus = false;
            } else {
                this.st.focus = '#name';
            }
        }
    }

});



table.page.len( 25 ).draw();

$(".localidad_select, .lugar_select, .sitio_select").select2({
    data : [],
    placeholder: "Seleccione una opción",


}).val(null).trigger("change").prop("disabled", true);

function actuilizarDatos(id,data ){
    $(id).select2("destroy");
    $(id).html("<option><option>");

    $(id).select2({
        data: data,
        placeholder: "Seleccione una opción",
        allowClear: true

    }).prop("disabled", false);;
}

$(".entidad_select, .sinonimia_select").select2({
    placeholder: "Seleccione una opción",
//            placeholder:  function(){
//                return [{id: null, text:"selec"}];
//            }
    allowClear: true

}).val(null).trigger("change");

$(".entidad_select").on("select2:select", function (e) {
    actuilizarDatos(".localidad_select", localidades[$(this).val()]);
    $(".lugar_select").val(null).trigger("change").prop("disabled", true);
    $(".sitio_select").val(null).trigger("change").prop("disabled", true);
});

$(".localidad_select").on("select2:select", function (e) {
    actuilizarDatos(".lugar_select", lugares[$(this).val()]);
    $(".sitio_select").val(null).trigger("change").prop("disabled", true);

});

$(".lugar_select").on("select2:select", function (e) {
    actuilizarDatos(".sitio_select", sitios[$(this).val()]);
});

$(".entidad_select").on("select2:unselect", function (e) {
    $(".localidad_select").val(null).trigger("change").prop("disabled", true);
    $(".lugar_select").val(null).trigger("change").prop("disabled", true);
    $(".sitio_select").val(null).trigger("change").prop("disabled", true);
});

$(".localidad_select").on("select2:unselect", function (e) {
    $(".lugar_select").val(null).trigger("change").prop("disabled", true);
    $(".sitio_select").val(null).trigger("change").prop("disabled", true);
});

$(".lugar_select").on("select2:unselect", function (e) {
    $(".sitio_select").val(null).trigger("change").prop("disabled", true);
});



$("#jv_sinonimia_ubicacion").validate({

    highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
        $(element).remove();
    },
    rules: {
        sinonimia: {
            require_from_group: [1, ".grupo_necesario"]
        },
        entidad: {
            require_from_group: [1, ".grupo_necesario"]

        }

    },
    messages: {
        sinonimia: "Debe especificar una sinonimia y/o una ubicación",
        entidad: "Debe especificar una sinonimia y/o una ubicación",

    }
});

$('.agregar').on('click', function(){
    $(".entidad_select").val(null).trigger("change")
    $(".sinonimia_select").val(null).trigger("change")

});


$('#agregar_sinonimia_ubicacion').on( 'click', function (e) {
    e.preventDefault();
    var valid = $('#jv_sinonimia_ubicacion').valid();

    var postData = $('#jv_sinonimia_ubicacion').serializeArray();

            console.log(valid);

    if(valid) {

        $.ajax({
            type: "post",
            url: root_url+'reportes/'+registro_id+'/sinonimia-ubicacion',
            data:
                postData,
//                    {
//                        '_token': $("input[name=_token]").val(),
//                        'sinonimia': $('#sinonimia_select').val(),
//                        'entidad': $('#entidad_select').val(),
//                        'localidad': $('#localidad_select').val(),
//                        'lugar': $('#lugar_select').val(),
//                        'sitio': $('#sitio_select').val(),
//                    },

            success: function (data) {
                console.log(data);

                toastr.success('Relación con sinonimia creada correctamente', '¡Listo!')
                location.reload();// cosas de actualizar  la tabla, luego lo cambio


            },
            error: function ( response, json, errorThrown ) {
                var errors = response.responseJSON;
                var errorsHtml = '';
                console.log(errors);
                console.log(response.responseText);

                $.each( errors, function( key, value ) {
                    //                                errorsHtml += '<li>' + value[0] + '</li>';
                    errorsHtml += value[0];
                    console.log(value[0]);
                });
                //                            toastr.error( errorsHtml , "Error " + response.status +': '+ errorThrown);
                toastr.error( errorsHtml , "¡Error!");

            }

        });
    }
});

$('.modal-dismiss').on('click', function(){
    $(".localidad_select").val(null).trigger("change").prop("disabled", true);
    $(".lugar_select").val(null).trigger("change").prop("disabled", true);
    $(".sitio_select").val(null).trigger("change").prop("disabled", true);
});


//
//$("#jv_actualizar_sinonimia_ubicacion").validate({
//
//    highlight: function(element) {
//        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
//    },
//    success: function(element) {
//        $(element).closest('.form-group').removeClass('has-error');
//        $(element).remove();
//    },
//    rules: {
//        sinonimia: {
//            require_from_group: [1, ".grupo_necesarios"]
//        },
//        entidad: {
//            require_from_group: [1, ".grupo_necesarios"]
//
//        }
//
//    },
//    messages: {
//        sinonimia: "Debe especificar una sinonimia y/o una ubicación",
//        entidad: "Debe especificar una sinonimia y/o una ubicación",
//
//    }
//});
//
//$('#actualizar_sinonimia_ubicacion').on( 'click', function (e) {
//    e.preventDefault();
//    var valid = $('#jv_actualizar_sinonimia_ubicacion').valid();
//
//    //console.log($('#jv_actualizar_sinonimia_ubicacion'));
//    var postData = $('#jv_actualizar_sinonimia_ubicacion').serializeArray();
//
//    console.log(valid);
//
//    if(valid) {
//
//        $.ajax({
//            type: "patch",
//            url: root_url+'reportes/'+registro_id+'/sinonimia-ubicacion/'+ datos_fila[1],
//            data:
//                postData,
////                    {
////                        '_token': $("input[name=_token]").val(),
////                        'sinonimia': $('#sinonimia_select').val(),
////                        'entidad': $('#entidad_select').val(),
////                        'localidad': $('#localidad_select').val(),
////                        'lugar': $('#lugar_select').val(),
////                        'sitio': $('#sitio_select').val(),
////                    },
//
//            success: function (data) {
//                console.log(data);
//
//                toastr.success('Reporte actualizado correctamente', '¡Listo!')
//                //location.reload();// cosas de actualizar  la tabla, luego lo cambio
//
//
//            },
//            error: function ( response, json, errorThrown ) {
//                var errors = response.responseJSON;
//                var errorsHtml = '';
//                console.log(errors);
//                console.log(response.responseText);
//
//                $.each( errors, function( key, value ) {
//                    //                                errorsHtml += '<li>' + value[0] + '</li>';
//                    errorsHtml += value[0];
//                    console.log(value[0]);
//                });
//                //                            toastr.error( errorsHtml , "Error " + response.status +': '+ errorThrown);
//                toastr.error( errorsHtml , "¡Error!");
//
//            }
//
//        });
//    }
//});


