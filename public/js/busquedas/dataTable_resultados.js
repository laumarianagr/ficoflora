/**
 * Created by Lupita on 04/09/2015.
 */



$(document).ready(function() {

    var table = $('#datatable').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ filas por página",
            "search": "Filtrar",
            "zeroRecords": "Disculpe, no se encontro ninguno.",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "paginate": {
                "previous": "Anterior",
                "next": "Siguiente"
            }

        },
        "pageLength": 15,
        "lengthMenu": [ 15, 25, 50, 75, 100 ],
        "columnDefs": [
            //{ "width": "50%", "targets": 5 },

            {
                "searchable": false,
                "orderable": false,
                "targets": 0
            },

        ],
        "order": [[1, 'asc']]
    });


//Numeracion de filas de la tabla
    table.on('order.dt search.dt', function () {
        table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

});