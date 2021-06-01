/**
 * Created by Lupita on 21/08/2015.
 */
$(document).ready(function() {

var datos;
var row ;


    //Modal para eliminar especie
    $('#datatable tbody').on( 'click', 'td>a.eliminar-row', function () {

        var _self  = $(this);
        console.log(_self);

        console.log(  table.row(_self.parents('tr')).data());

        datos = table.row(_self.parents('tr')).data()
        row = _self.parents('tr');

        var especie =  datos[2]+' '+datos[3];

        if(datos[4] != '-'){
            especie = especie+' var.'+datos[4];
        }

        if(datos[5] != '-'){
            especie = especie+' f.'+datos[5];
        }

        if(datos[6] != '-'){
            especie = especie+' subsp.'+datos[6];
        }

        //$('#modal-eliminar .modal-mensaje').html('<p>Especie a eliminar: <b>'+ especie+'</b></p>')

        modal_zoom.magnificPopup('open');
    } );

    //eliminar usuario
    $('#eliminar').on( 'click', function (e) {
        e.preventDefault();
        console.log(datos);

        $('#modal-eliminar').modal('hide')

        $.ajax({
            type: "delete",
            url: root_url+'especies/'+datos[1],
            data: {
                '_token': $("input[name=_token]").val()
                //'especie_id': datos[6]
            },

            success: function (data) {
                console.log(data);

                toastr.success('Especie eliminada correctamente', '¡Listo!')

                table
                    .row( row )
                    .remove()
                    .draw();

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
    });


    $('.quitar-sinonimia').on('click', function(){

        var _self  = $(this);
        console.log(  table.row(_self.parents('tr')).data());

        datos = table.row(_self.parents('tr')).data()
        row = _self.parents('tr');

        modal_zoom.magnificPopup('open');
    });

    //Quitar relación con sinonimia
    $('#quitar').on( 'click', function (e) {
        e.preventDefault();
        console.log(datos);

        $('#modal-quitar').modal('hide')

        $.ajax({
            type: "post",
            url: root_url+'especies/'+especie+'/sinonimia/quitar',
            data: {
                '_token': $("input[name=_token]").val(),
                'id': datos[1]
            },

            success: function (data) {
                console.log(data);

                toastr.success('Relación con sinonimia eliminada correctamente', '¡Listo!')

                table
                    .row( row )
                    .remove()
                    .draw();

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
    });




    //agregar relación con sinonimia
    $('#agregar_sinonimia').on( 'click', function (e) {
        e.preventDefault();
        console.log($('#select_sinonimia').val());
        console.log(root_url+'especies/'+especie+'/sinonimia/agregar');
        var valid = $('#jv_sinonimia_select').valid();

        if(valid) {

            $.ajax({
                type: "post",
                url: root_url+'especies/'+especie+'/sinonimia/agregar',
                data: {
                    '_token': $("input[name=_token]").val(),
                    'id': $('#select_sinonimia').val()
                },

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
});