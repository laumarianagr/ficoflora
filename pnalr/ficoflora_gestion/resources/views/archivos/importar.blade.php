@extends('master')

@section('title')
    Caragar archivo
@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
@stop

@section('titulo-seccion')
    Importar datos desde archivos
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>

    <li><a href="#"><span>Archivos</span></a></li>
    <li><a href="#"><span>Importar</span></a></li>

@stop

@section('content')

<div class="row">


    <div class=" col-xs-12 col-xlg-10" >


        @include('parciales._exito')


        @include('errors._listar')
        @include('warnings._listar')



        <section class="panel">
        <div class="panel-body">
            {!! Form::open(['route' => 'archivo.modelo',   'id'=>'jv_modelo', 'files' => true, 'class' => 'form  form-bordered']) !!}
            <div class="col-sm-9 col-sm-10 form-group ">
            <label class=" control-label" for="cita_libro">Descargar archivo modelo</label>

                {!! Form::select('modelo', $tipo, null, ['id'=> 'modelo', 'class' => 'form-control select', 'style'=>'width: 100%' ]) !!}

        </div>




            <div class="col-sm-3 col-md-2 form-group ">
        <label class=" control-label " for="cita_libro"> </label>

                <a id="archivo_modelo" class="btn btn-primary"  style='display:block;'>Descargar </a>
        {{--{!! Form::button('Descargar', ['id'=>'descargar', 'class' => 'btn btn-primary form-control', 'style'=>'max-width:100px; display:block;']) !!}--}}

        </div>
            {!! Form::close() !!}

        </div>
        </section>

        <section class="panel form-wizard mb-xs" id="ref_libro">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-up"></a>
                </div>

                <h2 class="panel-title">Importar Datos</h2>
            </header>
            {!! Form::open(['route' => 'archivo.guardar',   'id'=>'jv_archivo', 'files' => true, 'class' => 'form  form-bordered']) !!}

            <div class="panel-body">


                {{--select CITA NUM AUOTRES libro--}}
                <div class="col-sm-12 form-group">
                    <label class=" control-label" for="cita_libro">Tipo de archivo a importar <span class="required">*</span></label>
                    {!! Form::select('tipo', $tipo, null, ['id'=> 'tipo', 'class' => 'form-control select', 'style'=>'width: 100%' ]) !!}

                </div>
                {{--select CITA NUM AUOTRES libro--}}
                <div class="col-sm-12 form-group">
                    <label class=" control-label">Archivo <span class="required">*</span></label>
                    {!! Form::file('archivo',  ['id'=>'archivo', 'class' => 'form-control']) !!}


                </div>





            </div>

            <footer class="panel-footer">
                {{--Guardar Form Imput--}}
                <div class="form-group">
                    <div class="col-sm-3 pull-right ">
                        {!! Form::submit('Importar', ['id'=>'importar', 'class' => 'btn btn-primary form-control']) !!}
                    </div>

                </div>

            </footer>

            {!! Form::close() !!}


        </section>


    </div>

    @include('errors._log')
</div>










@stop

@section('script_section')
    @parent

    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/additional-methods.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/isloading/jquery.isloading.min.js')}}'></script>


    <script type="text/javascript">
        var jvalidate = $("#jv_archivo").validate({
            ignore: [],
            rules: {
                archivo:{
                    required: true,
                    extension: "xls|xlsx"

                },
                tipo: "required"

            },
            messages: {
                archivo: {
                    required: "No ha seleccionado ningun archivo",
                    extension: "Tipo de archivo inválido, formatos permitidos .xls o .xlsx"
                },
                tipo: "Debe especificar el tipo de archivo que se importara"
            }
        });

         $("#jv_modelo").validate({

            rules: {
                modelo: "required"

            },
            messages: {
                modelo: "Debe especificar el archivo modelo a descargar"
            }
        });

        var $select = $(".select").select2({
            placeholder: "Seleccione una opción",
            allowClear: true
        });



        var modelo = $("#modelo.select").select2({
            placeholder: "Seleccione una opción"
        });

        var ruta = root_url+'archivos/modelo/';

        modelo.on("select2:select", function (e) {

           $('#archivo_modelo').attr('href',ruta+$(this).val());
        });

        $('#archivo_modelo').on("click", function (e) {
            $("#jv_modelo").valid();

        });





        $(document).ready(function() {

            var table = $('#datatable').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ filas por página",
                    "search": "Filtrar",
                    "zeroRecords": "Disculpe, no se encontró ninguno.",
                    "info": "Página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                    }

                },
                "pageLength": 10,
                "lengthMenu": [ 10, 15, 25, 50, 75, 100 ],
                "columnDefs": [
                    //{ "width": "50%", "targets": 5 },

                    {
                        "searchable": false,
                        "orderable": false,
                        "targets": 0
                    },

                ],
                "order": [[3, 'asc']]
            });


//Numeracion de filas de la tabla
            table.on('order.dt search.dt', function () {
                table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();

        });




            // Action on Click
            $( "#jv_archivo" ).submit(function(e) {
//            $( "#importar" ).on('click',function(e) {

                var validated = $("#jv_archivo").valid();

                if(validated) {
                    $.isLoading({
                        text: "Importando los datos",
                        tpl: '<div class="isloading-overlay">  <div class="isloading-wrapper">Importando los datos <i class="fa fa-spinner fa-pulse"></i> </div> </div>'
                    });
                }

            });
//
//




    </script>

@stop
