
@extends('master')

@section('titulo-seccion')
    Registros
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>

@stop

@section('css_section')
    @parent



    <style>
        .tt-selectable{
            cursor: pointer;
        }
        a{
            display: block;
        }
    </style>

@stop

@section('content')


    <div class="row">

        @if($usuario->perfil_id < 3)

            <div class="col-md-6 col-lg-6 col-xl-3">

                <section class="panel panel-horizontal">
                    <a href="{{route('archivo.index')}}" class="on-click"></a>

                    <header class="panel-heading">
                        <div class="panel-heading-icon icon-sm bg-primary">
                            <i class="fa fa-upload"></i>
                        </div>
                    </header>
                    <div class="panel-body">
                        <h3 class="text-semibold mt-sm">Importar</h3>
                        <p>Importar datos desde archivos.</p>
                    </div>
                </section>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-3">

                <section class="panel panel-horizontal">
                    <a href="{{route('archivo.exportar.index')}}" class="on-click"></a>

                    <header class="panel-heading">
                        <div class="panel-heading-icon icon-sm bg-primary">
                            <i class="fa fa-download"></i>
                        </div>
                    </header>
                    <div class="panel-body">
                        <h3 class="text-semibold mt-sm">Exportar</h3>
                        <p>Exportar datos a archivos.</p>
                    </div>
                </section>
            </div>
        @endif

        @if($usuario->perfil_id <= 3)

                <div class="col-md-6 col-lg-6 col-xl-3">
                    <section class="panel panel-horizontal">
                        <a href="{{route('usuario.registros')}}" class="on-click"></a>
                        <header class="panel-heading">
                            <div class="panel-heading-icon icon-sm bg-primary mt-sm">
                                <i class="fa fa-list"></i>
                            </div>
                        </header>
                        <div class="panel-body">
                            <h3 class="text-semibold mt-sm">Mis Registros</h3>
                            <p>Elementos creados por el usuario.</p>
                        </div>
                    </section>
                </div>

            <div class="col-md-6 col-lg-6 col-xl-3">

                <section class="panel panel-horizontal">
                    <a href="{{route('registros.nuevo.index')}}" class="on-click"></a>
                    <header class="panel-heading ">
                        <div class="panel-heading-icon icon-sm bg-primary">
                            <i class="fa fa-plus"></i>
                        </div>
                    </header>
                    <div class="panel-body">
                        <h3 class="text-semibold mt-sm">Nuevo</h3>
                        {{--<p>Sección para la creación de nuevos registros a ser incorporados en la aplicación.</p>--}}
                        <p>Crear un nuevo elemento.</p>
                    </div>
                </section>
            </div>





        @endif



        @if($usuario->perfil_id <= 3)

            <div class="col-md-6 col-lg-6 col-xl-3">
                <section class="panel panel-horizontal">
                    <a href="{{route('temporal.index')}}" class="on-click"></a>
                    <header class="panel-heading">
                        <div class="panel-heading-icon icon-sm bg-primary mt-sm">
                            <i class="fa fa-envelope"></i>
                        </div>
                    </header>
                    <div class="panel-body">
                        <h3 class="text-semibold mt-sm">Registros recibidos</h3>
                        <p>Registros recibidos para su aprobación.</p>
                    </div>
                </section>
            </div>
        @endif

        @if($usuario->perfil_id == 4)

            <div class="col-md-6 col-lg-6 col-xl-3">
                <section class="panel panel-horizontal">
                    <a href="{{route('usuario.temporales')}}" class="on-click"></a>
                    <header class="panel-heading">
                        <div class="panel-heading-icon icon-sm bg-primary mt-sm">
                            <i class="fa fa-list"></i>
                        </div>
                    </header>
                    <div class="panel-body">
                        <h3 class="text-semibold mt-sm">Registros enviados</h3>
                        <p>Registros enviados al equipo editor.</p>
                    </div>
                </section>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-3">

                <section class="panel panel-horizontal">
                    <a href="{{route('temporal.crear')}}" class="on-click"></a>
                    <header class="panel-heading ">
                        <div class="panel-heading-icon icon-sm bg-primary">
                            <i class="fa fa-share"></i>
                        </div>
                    </header>
                    <div class="panel-body">
                        <h3 class="text-semibold mt-sm">Enviar Registro</h3>
                        <p>Sección para enviar registros al equipo editor.</p>
                    </div>
                </section>
            </div>
        @endif

    </div>




@stop

@section('script_section')
    @parent

    <script>
        localStorage.setItem("menu", "m-registros");
    </script>

@stop



