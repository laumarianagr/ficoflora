/**
 * Created by maria-pinzon on 20/06/2015.
 *
 * Hace la paginacion de la tabla, asi como las funcionalidades de ordenamiento
 * y busqueda en esta.
 *
 * Responde a las acciones de eliminación de usuario y edición del tipo de
 * perfil de usuario a las que el administrador tiene acceso.
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
            "zeroRecords": "No existe usuarios con este Perfil.",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "paginate": {
                "previous": "Anterior",
                "next": "Siguiente"
            }
        },
        //Une la columna nombre con la del apellido y la despliega en una sola
        "columnDefs": [
            {
                "render": function(data, type, row) {
                    return data +' '+ row[3];
                },
                "targets": 2
            },
            {
                "visible": false,
                "targets": [ 3 ]
            },
            {
                "searchable": false,
                "orderable": false,
                "targets": 0
            }
        ],
                        "order": [[ 5, 'asc' ]]
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

        row = _self.parents('tr');

        $(_self.closest('tr').children('.perfil')).editable('toggle');


    } );

    $.fn.editable.defaults.mode = 'inline';

    $('.perfil').editable({
        toggle: 'manual',
        source: perfiles,


        type: 'select',
        url: urlAjax,

        params: function(params) {
            //originally params contain pk, name and value
            params._token = $("input[name=_token]").val();
            params.perfil_id = params.value;
            return params;
        },


        ajaxOptions: {
            dataType: 'json',
            type:'patch'

        },
        success: function(data) {
            toastr.success('Perfil cambiado correctamente', '¡Listo!')



            if(paginaPerfil == true){
                table
                    .row( row )
                    .remove()
                    .draw();
            }


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

        $('#modal-eliminar').find('.modal-text').text( )
        $('#modal-eliminar .modal-mensaje').html('<h5>¿Está seguro que desea eliminar el usuario <b>'+ datos[2]+' '+datos[3]+'</b>?</h5>')

        //$('#myModal').modal('show')
        modal_zoom.magnificPopup('open');


    } );


    //eliminar usuario
    $('#eliminar').on( 'click', function (e) {
        e.preventDefault();
        console.log(datos);
        $('#myModal').modal('hide')

        $.ajax({
            type: "delete",
            url: 'usuarios',
            data: {
                '_token': $("input[name=_token]").val(),
                'usuario': datos[1]
            },

            success: function (data) {
                console.log(data);

                toastr.success('Usuario eliminado correctamente', '¡Listo!')

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
                // toastr.error( errorsHtml , "Error " + response.status +': '+ errorThrown);
                toastr.error( errorsHtml , "¡Error!");

            }

        });
    });






    $("#jv_usuarios").validate({

        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
            $(element).remove();
        },

        rules: {

            usuario: "required",
            nombre: "required",
            apellido: "required",
            email: "required",
            password: "required",
            password_confirmation: "required"

        },
        messages: {
            usuario: "Este campo es obligatorio",
            nombre: "Este campo es obligatorio",
            apellido: "Este campo es obligatorio",
            email: "Este campo es obligatorio",
            password: "Este campo es obligatorio",
            password_confirmation: "Este campo es obligatorio"
        }
    });




    $('#jv_usuarios').submit(function(e) {
//

        e.preventDefault();
        var valid = $('#jv_usuarios').valid();
        var action = $(this).attr('action');

        var postData = $('#jv_usuarios').serializeArray();

        console.log(valid);

        if(valid) {
//
            $.ajax({
                type: "post",
                url: action,
                data:postData,
//
                success: function (data) {
                    console.log(data);

                    toastr.success('Usuario creado correctamente', '¡Listo!')
                    location.reload();// cosas de actualizar  la tabla, luego lo cambio


                },
                error: function ( response, json, errorThrown ) {
                    var errors = response.responseJSON;
                    var errorsHtml = '';
                    console.log(errors);
                    console.log(response.responseText);

                    $.each( errors, function( key, value ) {
                         errorsHtml += '<li>' + value[0] + '</li>';
                        //errorsHtml += value[0];
                        console.log(value[0]);
                    });
                    //                            toastr.error( errorsHtml , "Error " + response.status +': '+ errorThrown);
                    toastr.error( errorsHtml , "¡Error!");

                }

            });
        }
    });






} );