/**
 * Created by Lupita on 14/09/2015.
 */


$(document).ready(function() {


    var table = $('#datatable-reportes').DataTable({
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
        "pageLength": 5,
        "lengthMenu": [ 5,10,15, 25, 50, 75, 100 ],
        "columnDefs": [
            //{ "width": "50%", "targets": 5 },

            {
                "orderable": false,
                "targets": 0
            },

        ],
        "order": [[2, 'desc']]
    });
    table.column(1).visible( false );
    table.column(2).visible( false );



    $('#sort-autor').on('click', function(){

        var sort ="asc";

        if($(this).hasClass('dt-sorting')){

            if($(this).hasClass('asc')){
                $(this).addClass('desc').removeClass('asc');
                $("#sort-autor i").addClass('fa-sort-amount-desc').removeClass('fa-sort-amount-asc');
                sort = "desc";

            }else{
                $(this).addClass('asc').removeClass('desc');
                $("#sort-autor i").addClass('fa-sort-amount-asc').removeClass('fa-sort-amount-desc');

            }
        }else{
            $('#sort-fecha').removeClass('dt-sorting');
            $('#sort-fecha i').removeClass('fa-sort-amount-desc fa-sort-amount-asc');
            $(this).addClass('dt-sorting').addClass('asc');
            $("#sort-autor i").addClass('fa-sort-amount-asc').removeClass('fa-sort-amount-desc');

        }

        table.order([ 1, sort ]).draw();

    });

    $('#sort-fecha').on('click', function(){


        var sort ="asc";

        if($(this).hasClass('dt-sorting')){

            if($(this).hasClass('asc')){
                $(this).addClass('desc').removeClass('asc');
                $("#sort-fecha i").addClass('fa-sort-amount-desc').removeClass('fa-sort-amount-asc');

                sort = "desc";
            }else{
                $(this).addClass('asc').removeClass('desc');
                $("#sort-fecha i").addClass('fa-sort-amount-asc').removeClass('fa-sort-amount-desc');

            }
        }else{
            $('#sort-autor').removeClass('dt-sorting');
            $('#sort-autor i').removeClass('fa-sort-amount-desc fa-sort-amount-asc');
            $(this).addClass('dt-sorting').addClass('asc');
            $("#sort-fecha i").addClass('fa-sort-amount-asc').removeClass('fa-sort-amount-desc');
        }

        table.order([ 2, sort ]).draw();

    });





    var table_referencias = $('#datatable-referencias').DataTable({
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
        "pageLength": 5,
        "lengthMenu": [ 5,10,15, 25, 50, 75, 100 ],
        "columnDefs": [
            //{ "width": "50%", "targets": 5 },

            {
                "orderable": false,
                "targets": 0
            },

        ],
        "order": [[2, 'desc']]
    });
    table_referencias.column(1).visible( false );
    table_referencias.column(2).visible( false );

    $('#sort-autor-ref').on('click', function(){

        var sort ="asc";

        if($(this).hasClass('dt-sorting')){

            if($(this).hasClass('asc')){
                $(this).addClass('desc').removeClass('asc');
                $("#sort-autor-ref i").addClass('fa-sort-amount-desc').removeClass('fa-sort-amount-asc');
                sort = "desc";

            }else{
                $(this).addClass('asc').removeClass('desc');
                $("#sort-autor-ref i").addClass('fa-sort-amount-asc').removeClass('fa-sort-amount-desc');

            }
        }else{
            $('#sort-fecha-ref').removeClass('dt-sorting');
            $('#sort-fecha-ref i').removeClass('fa-sort-amount-desc fa-sort-amount-asc');
            $(this).addClass('dt-sorting').addClass('asc');
            $("#sort-autor-ref i").addClass('fa-sort-amount-asc').removeClass('fa-sort-amount-desc');

        }

        table_referencias.order([ 1, sort ]).draw();

    });

    $('#sort-fecha-ref').on('click', function(){


        var sort ="asc";

        if($(this).hasClass('dt-sorting')){

            if($(this).hasClass('asc')){
                $(this).addClass('desc').removeClass('asc');
                $("#sort-fecha-ref i").addClass('fa-sort-amount-desc').removeClass('fa-sort-amount-asc');

                sort = "desc";
            }else{
                $(this).addClass('asc').removeClass('desc');
                $("#sort-fecha-ref i").addClass('fa-sort-amount-asc').removeClass('fa-sort-amount-desc');

            }
        }else{
            $('#sort-autor-ref').removeClass('dt-sorting');
            $('#sort-autor-ref i').removeClass('fa-sort-amount-desc fa-sort-amount-asc');
            $(this).addClass('dt-sorting').addClass('asc');
            $("#sort-fecha-ref i").addClass('fa-sort-amount-asc').removeClass('fa-sort-amount-desc');
        }

        table_referencias.order([ 2, sort ]).draw();

    });

});