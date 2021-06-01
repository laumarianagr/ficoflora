/**
 * Created by Lupita on 21/08/2015.
 */
$(document).ready(function() {

    var datos_tabla;
    var row ;


    //Modal para eliminar especie
    $('#datatable tbody').on( 'click', 'td>a.eliminar-row', function () {

        var _self  = $(this);
        //console.log(  table.row(_self.parents('tr')).data());

        datos_tabla = table.row(_self.parents('tr')).data()
        row = _self.parents('tr');
        modal_zoom.magnificPopup('open');

    } );

    //eliminar usuario
    $('#eliminar').on( 'click', function (e) {
        e.preventDefault();

        $('#modal-eliminar').modal('hide')

        $.ajax({
            type: "delete",
            url: root_url+''+taxo_tabla+'/'+datos_tabla[1],
            data: {
                '_token': $("input[name=_token]").val()
            },

            success: function (data) {
                console.log(data);

                toastr.success('Elemento eliminado correctamente', '¡Listo!')

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
});