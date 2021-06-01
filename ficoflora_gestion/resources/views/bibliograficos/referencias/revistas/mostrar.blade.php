@extends('master')

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/magnific-popup/magnific-popup.css')}}">
@stop
@section('titulo-seccion')
    Información de la Revista
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="#"><span>Bibliográficos</span></a></li>
    <li><a href="#"><span>Revista</span></a></li>

@stop


@section('content')

    <div class="row" >
        <div class="col-md-12 mostrar-cabecera">

            <section class="panel panel-featured-left panel-featured-primary">
                <div class="panel-body">
                    <div class="widget-summary">
                     
                        <div class="widget-summary-col">
                            <div class="summary">
                                <div class="info">
                                    <strong class="amount">{{$revista->autores}}, {{$revista->fecha}}{{$revista->letra}}</strong>
                                </div>
                                <p class="text-md">{!! $texto !!}</p>

                            </div>
                            @if($usuario->perfil_id <=3)


                                <div class="summary-footer">
                                    <a class="" href="{{route('usuario.revistas')}}"><i class="fa fa-user pr-xs"></i>Mis revistas</a>

                                    @if($revista->creador_id == $usuario->id || $usuario->perfil_id <=2)

                                    | <a href="{{route('revista.editar', [$revista->id])}}"><i class="fa fa-pencil pr-xs"></i>Editar </a>
                                    @endif

                            </div>
                                
                                @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>


        <div class="col-md-12 ">

            <section class="panel tabla-mostrar-datos ">
                <div class="panel-body">
                    <h4 class="">Información de la Referencia: </h4>
                    <table class="table table-striped">
                        <tr><td><h5><b>Cita:</b></h5> {{$revista->cita}}, {{$revista->fecha}}{{$revista->letra}}</td></tr>
                        <tr><td><h5><b>Autores:</b></h5> {{$revista->autores}}</td></tr>
                        <tr><td><h5><b>Año:</b></h5> {{$revista->fecha}}</td></tr>
                        <tr><td><h5><b>Título:</b></h5> {{$revista->titulo}}</td></tr>
                        <tr><td><h5><b>Nombre:</b></h5> {{$revista->nombre}}</td></tr>

                        <tr><td><h5><b>Volumen:</b></h5> {{$revista->volumen}}</td></tr>

                        <tr><td><h5><b>Número:</b></h5> {{$revista->numero}}</td></tr>
                        <tr><td><h5><b>Páginas:</b></h5> {{$revista->intervalo}}</td></tr>

                        <tr><td><h5><b>ISBN:</b></h5> {{$revista->isbn}}</td></tr>
                        <tr><td><h5><b>ISSN:</b></h5> {{$revista->issn}}</td></tr>
                        <tr><td><h5><b>DOI:</b></h5> {{$revista->enlace}}</td></tr>
                        <tr><td><h5><b>Enlace:</b></h5> {{$revista->archivo}}</td></tr>
                        <tr><td><h5><b>Archivo:</b></h5> {{$revista->archivo}}</td></tr>
                        <tr><td><h5><b>Comentarios:</b></h5> {{$revista->comentarios}}</td></tr>
                    </table>
                </div>
            </section>
        </div>



    </div>

    <div class="row">
        <div class="col-xs-12">

            <div class="panel">
                <div class="panel-body">

                    <div class=" mb-md tabla-mostrar-datos ">
                        <h4 class="">Especies con registros asociados a la referencia: </h4>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <h5 class="mt-xs mb-xs">Número de especies: <b>{{$total}}</b></h5>
                        </div>
                        <div class="col-sm-4 ">
                            @if($usuario->perfil_id <=3)
                                <a class="agregar modal-with-form btn btn-default pull-right" href="#modal-agregar-registro"  id="crear-row" data-toggle="tooltip" title="Crear" > <i class="fa fa-plus-circle"></i> Crear Registro</a>
                                <a class="text-dark pt-xs dp-iblock pull-right mr-md" href="{{route('usuario.reportes')}}"><i class="fa fa-user pr-xs"></i>Mis registros </a>

                            @endif
                        </div>
                    </div>

                    <hr class="dotted short mb-lg mt-sm">

                    <table id="datatable"  class="table table-hover table-striped table-bordered listas-resultados" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="numeros-dataTabla">N°</th>
                            <th class="numeros-dataTabla">id</th>
                            <th class="th-dataTable ">Registro</th>
                            {{--<th class="th-dataTable acciones-col">Acciones</th>--}}
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($especies as $especie)

                            <tr>
                                <td></td>
                                <td>{{$especie['id']}}</td>

                                <td class="perfil">
                                    <a href="{{route('reporte.mostrar', [$especie['id']])}}">
                                        ({{$revista->cita}}, {{$revista->fecha}}{{$revista->letra}}) | <em>{{$especie['nombre']}}</em> <span class="autores">{{$especie['autor']}}</span>
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                    </table>


                </div>

            </div>
        </div>
    </div>



    {{--Modal nueva Sinonimia/Ubicación--}}
    @include('bibliograficos.referencias.modales.modal-agregar-registro')





@stop

@section('script_section')
    @parent
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/registros/validate_taxonomia.js')}}'></script>


    <script type='text/javascript' src='{{ asset('js/examples.modals.js')}}'></script>


    <script>
        var referencia = <?php echo $revista->id ?>;


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
            "pageLength": 50,
            "lengthMenu": [ 5,10,15, 25, 50, 75, 100 ],
            "columnDefs": [
                {
                    "visible":false,
                    "targets": 1
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets":[0]
                }

            ],
            "order": [[ 2, 'asc' ]]
        });

        //Esconde la columna de los ids
        //table.column(1).visible( false );

        //Numeracion de filas de la tabla
        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        }).draw();



        $(".select").select2({
            placeholder: "Seleccione una opción",
            allowClear: true
        }).val(null).trigger("change");



        $('#jv_especie_select').submit(function(e) {
//

            e.preventDefault();
            var valid = $('#jv_especie_select').valid();
            var action = $(this).attr('action');


            $('#jv_especie_select').append($("<input>").attr({"type":"hidden","name":"referencia"}).val(referencia));
            $('#jv_especie_select').append($("<input>").attr({"type":"hidden","name":"tipo"}).val('R'));
            var postData = $('#jv_especie_select').serializeArray();

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

                        toastr.success('Registro creado correctamente', '¡Listo!')
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


        $('.agregar').on('click', function(){
            $("#select_especie").val(null).trigger("change")
        });




    </script>

@stop
