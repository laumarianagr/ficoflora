/**
 * Created by Lupita on 21/08/2015.
 */


var table_geografica = $('#datatable_geografica').DataTable({
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
        //{
        //    "visible":false,
        //    "targets": 1
        //},
        {
            "searchable": false,
            "orderable": false,
            "targets":[0]
        }

    ],
    "order": [[ 1, 'asc' ]]
});

//Esconde la columna de los ids
//table_geografica.column(1).visible( false );

//Numeracion de filas de la tabla
table_geografica.on( 'order.dt search.dt', function () {
    table_geografica.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
}).draw();



var table_especies = $('#datatable_especies').DataTable({
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
        //{
        //    "visible":false,
        //    "targets": 1
        //},
        {
            "searchable": false,
            "orderable": false,
            "targets":[0]
        }

    ],
    "order": [[ 1, 'asc' ]]
});

//Esconde la columna de los ids
//table_especies.column(1).visible( false );

//Numeracion de filas de la tabla
table_especies.on( 'order.dt search.dt', function () {
    table_especies.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
}).draw();

