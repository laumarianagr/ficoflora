
@extends('master')

@section('titulo-seccion')
    Buscar
@stop

@section('breadcrumbs')
    <li><a href="{{route('buscar.index')}}"><span>Buscar</span></a></li>

@stop

@section('css_section')
    @parent

@stop

@section('content')


    <div class="row">


        <div class="col-md-6 col-lg-6 col-xl-3">
            <section class="panel panel-horizontal p-relative">
                <a href="{{route('buscar.especies.index')}}" class="on-click"></a>
                <header class="panel-heading">
                    <div class="panel-heading-icon icon-sm bg-primary mt-sm">
                        <i class="fa fa-list"></i>
                    </div>
                </header>
                <div class="panel-body">
                    <h3 class="text-semibold mt-sm">Especie</h3>
                    <p>Buscar especies, sinonimias, autoridades o epítetos</p>
                </div>
            </section>
        </div>

        <div class="col-md-6 col-lg-6 col-xl-3">

            <section class="panel panel-horizontal p-relative">
                <a href="{{route('buscar.taxonomia.index')}}" class="on-click"></a>
                <header class="panel-heading ">
                    <div class="panel-heading-icon icon-sm bg-primary">
                        <i class="fa fa-sitemap"></i>
                    </div>
                </header>
                <div class="panel-body">
                    <h3 class="text-semibold mt-sm">Taxonomía</h3>
                    {{--<p>Sección para la creación de nuevos registros a ser incorporados en la aplicación.</p>--}}
                    <p>Buscar elementos de las categorías taxonómicas</p>
                </div>
            </section>
        </div>





            <div class="col-md-6 col-lg-6 col-xl-3">

                <section class="panel panel-horizontal p-relative">
                    <a href="{{route('buscar.referencia.index')}}" class="on-click"></a>

                    <header class="panel-heading">
                        <div class="panel-heading-icon icon-sm bg-primary">
                            <i class="fa fa-book"></i>
                        </div>
                    </header>
                    <div class="panel-body">
                        <h3 class="text-semibold mt-sm">Bibliografía</h3>
                        <p>Buscar referencias bibliográficas</p>
                    </div>
                </section>
            </div>


        <div class="col-md-6 col-lg-6 col-xl-3">

            <section class="panel panel-horizontal p-relative">
                <a href="{{route('buscar.ubicacion.index')}}" class="on-click"></a>

                <header class="panel-heading">
                    <div class="panel-heading-icon icon-sm bg-primary">
                        <i class="fa fa-map-marker"></i>
                    </div>
                </header>
                <div class="panel-body">
                    <h3 class="text-semibold mt-sm">Geografía</h3>
                    <p>Buscar una entidad federal, localidad, lugar o sitio</p>
                </div>
            </section>
        </div>


    </div>

@stop

@section('script_section')
    @parent

    <script>
        localStorage.setItem("menu", "m-buscar");
    </script>

@stop