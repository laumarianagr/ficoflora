/**
 * Created by Lupita on 28/02/2016.
 */

$(document).ready(function() {

    var id;


    //Modal para eliminar especie
    $('.eliminar-img').on('click', function () {


         id = $(this).attr('id');
        console.log(id);


        modal_zoom.magnificPopup('open');
    });

    //eliminar usuario
    $('#eliminar-img').on('click', function (e) {
        e.preventDefault();
        console.log('#img-'+id);
        console.log(id);
        $('#modal-eliminar-img').modal('hide')

        $.ajax({
            type: "delete",
            url: root_url + 'imagenes/' + id,
            data: {
                '_token': $("input[name=_token]").val()
                //'especie_id': datos[6]
            },

            success: function (data) {
                console.log(data);

                toastr.success('Imagen eliminada correctamente', '¡Listo!')

                $('#img-'+id).remove();

            },
            error: function (response, json, errorThrown) {
                var errors = response.responseJSON;
                var errorsHtml = '';
                console.log(errors);
                console.log(response.responseText);

                $.each(errors, function (key, value) {
                    //                                errorsHtml += '<li>' + value[0] + '</li>';
                    errorsHtml += value[0];
                    console.log(value[0]);
                });
                //                            toastr.error( errorsHtml , "Error " + response.status +': '+ errorThrown);
                toastr.error(errorsHtml, "¡Error!");

            }

        });
    });



    $("#jv_agregar-img").validate({
        rules: {
            pequena: "required",
            completa: "required",
            tipo: "required",
            leyenda: "required"


        },
        messages: {
            pequena: "Este campo es obligatorio",
            completa: "Este campo es obligatorio",
            tipo: "Este campo es obligatorio",
            leyenda: "Este campo es obligatorio"

        }
    });



});


