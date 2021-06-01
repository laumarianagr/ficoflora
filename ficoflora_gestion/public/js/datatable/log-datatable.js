/**
 * Created by Lupita on 21/08/2015.
 */


var table = $('#datatable').DataTable({
    "language": {
        "lengthMenu": "Mostrar _MENU_ filas por página",
        "search": "Buscar",
        "zeroRecords": "No hay registros disponibles",
        "info": "Página _PAGE_ de _PAGES_",
        "infoEmpty": "",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "paginate": {
            "previous": "Anterior",
            "next": "Siguiente"
        }
    },
    "pageLength": 15,
    "lengthMenu": [ 5,10,15, 25, 50, 75, 100 ],
    "columnDefs": [
        {
            //"visible":false,
            //"targets": 1
        },
        {
            "searchable": false,
            "orderable": false,
            "targets":[0,1]
        }

    ],
    "order": [[ 7, 'desc' ]]
});

//Esconde la columna de los ids
//table.column(1).visible( false );

//Numeracion de filas de la tabla
table.on( 'order.dt search.dt', function () {
    table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
}).draw();

