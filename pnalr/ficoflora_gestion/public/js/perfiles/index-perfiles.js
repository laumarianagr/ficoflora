/**
 * Created by maria-pinzon on 20/06/2015.
 */

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

$(document).ready(function() {

    var datos;
    var row ;

    //Configuración de Notificaciones
    toastr.options = {
        "closeButton": true,
        "positionClass": "toast-top-center"
    }

    var table = $('#datatable').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ filas por página",
            "search": "Buscar",
            "zeroRecords": "Disculpe, no se encontró ninguno.",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "paginate": {
                "previous": "Anterior",
                "next": "Siguiente"
            }
        },
        "columnDefs": [
            //{ "width": "50%", "targets": 5 },

            {
                "searchable": false,
                "orderable": false,
                "targets": 0
            },

        ],
        "order": [[ 1, 'asc' ]]
    });

    //Numeracion de filas de la tabla
    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();



    //Editar Usuario
    $('#datatable tbody').on( 'click', 'td>a.editar-row', function (e) {
        e.stopPropagation();
        var _self  = $(this);

        $(_self.closest('tr').children('.perfil')).editable('toggle');

    } );

    $.fn.editable.defaults.mode = 'inline';

    $('.perfil').editable({
        toggle: 'manual',
        type: 'text',
        url: 'perfiles',

        params: function(params) {
            //originally params contain pk, name and value
            params._token = $("input[name=_token]").val();
            params.tipo = params.value;
            return params;
        },


        ajaxOptions: {
            dataType: 'json',
            type:'patch'
        },
        success: function(data) {
            toastr.success('Nombre del Perfil cambiado correctamente', '¡Listo!')

            console.log(data);
        },
        error: function(response, newValue) {

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
            return ;

        }


    });

    //Modal para eliminar usuario
    $('#datatable tbody').on( 'click', 'td>a.eliminar-row', function () {

        var _self  = $(this);
        console.log(  table.row(_self.parents('tr')).data());

        datos = table.row(_self.parents('tr')).data()
        row = _self.parents('tr');

        $('#modal-eliminar .modal-mensaje').html('<h5>¿Está seguro que desea eliminar el perfil <b>'+ datos[1]+'</b>?</h5>')

        //$('#modal-eliminar').modal('show')
        modal_zoom.magnificPopup('open');


    } );


    //eliminar usuario
    $('#eliminar').on( 'click', function (e) {
        e.preventDefault();
        console.log(datos);
        $('#myModal').modal('hide')

        $.ajax({
            type: "delete",
            url: 'perfiles',
            data: {
                '_token': $("input[name=_token]").val(),
                'tipo': datos[1]
            },

            success: function (data) {
                console.log(data);

                toastr.success('Perfil eliminado correctamente', '¡Listo!')

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



    //crear Perfil
    $('#crear-row').on('click', function (e) {
        e.stopPropagation();
        //$('#modal-crear').modal('show')
        //modal_form.magnificPopup('open');


    });

    $('#crear').on( 'click', function (e) {
        e.preventDefault();
//            console.log ($("input[id=tipo]").val());
        $.ajax({
            type: "post",
            url: 'perfiles',
            data: {
                '_token': $("input[name=_token]").val(),
                'tipo': $("input[id=tipo]").val()

            },

            success: function (data) {
                console.log(data);
                //$('#modal-crear').modal('hide')
                toastr.success('Perfil creado correctamente', '¡Listo!')
                location.reload();// cosas de actualizar  la tabla, luego lo cambio a no ajax

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
