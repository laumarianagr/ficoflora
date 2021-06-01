@extends('master')

@section('title')
    Caragar archivo
@stop

@section('css_section')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">
@stop

@section('titulo-seccion')
    Exportar datos a archivos
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>

    <li><a href="#"><span>Archivos</span></a></li>
    <li><a href="#"><span>Exportar</span></a></li>

@stop

@section('content')

    <div class="row">


        <div class=" col-xs-12 col-xlg-10" >


            @include('parciales._exito')


            @include('errors._listar')

            <section class="panel form-wizard mb-xs" id="ref_libro">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-up"></a>
                    </div>

                    <h2 class="panel-title">Exportar Datos</h2>
                </header>
                {!! Form::open(['route' => 'archivo.exportar',   'id'=>'jv_archivo', 'files' => true, 'class' => 'form  form-bordered']) !!}

                <div class="panel-body">

                    {{--select CITA NUM AUOTRES libro--}}
                    <div class="col-sm-12 form-group">
                        <label class=" control-label" for="cita_libro">Tipo de archivo a exportar <span class="required">*</span></label>
                        {!! Form::select('tipo', $tipo, null, ['id'=> 'tipo', 'class' => 'form-control select', 'style'=>'width: 100%' ]) !!}
                    </div>

                </div>

                <footer class="panel-footer">
                    {{--Guardar Form Imput--}}
                    <div class="form-group">
                        <div class="col-sm-3 pull-right ">
                            {!! Form::submit('Exportar', ['class' => 'btn btn-primary form-control']) !!}
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
                tipo: "Debe especificar el tipo de archivo que se exportará"
            }
        });


        var $select = $(".select").select2({
            placeholder: "Seleccione una opción",
            allowClear: true
        });



    </script>

@stop
