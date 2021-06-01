/**
 * Created by Lupita on 30/09/2015.
 */
$(document).ready(function() {

    var datos;
    var row;



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
            url: root_url+'sinonimias/'+sinonimia+'/especie/quitar',
            data: {
                '_token': $("input[name=_token]").val(),
                'id': datos[1]
            },

            success: function (data) {
                console.log(data);

                toastr.success('Relación con especie quitada correctamente', '¡Listo!')

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