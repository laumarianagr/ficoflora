
@extends('master')

@section('titulo-seccion')
    Estadísticas
@stop

@section('breadcrumbs')
    <li><a href="{{route('estadisticas.index')}}"><span>Estadísticas</span></a></li>

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

        {{--<div class="col-md-6 col-lg-6 col-xl-3">--}}
            {{--<section class="panel panel-horizontal">--}}
                {{--<a href="{{route('estadisticas.especies')}}" class="on-click"></a>--}}
                {{--<header class="panel-heading">--}}
                    {{--<div class="panel-heading-icon icon-sm bg-primary mt-sm">--}}
                        {{--<i class="fa fa-list-alt"></i>--}}
                    {{--</div>--}}
                {{--</header>--}}
                {{--<div class="panel-body">--}}
                    {{--<h3 class="text-semibold mt-sm">Registros del Catálogo</h3>--}}
                    {{--<p>Estadísticas de los registros del catálogo.</p>--}}
                {{--</div>--}}
            {{--</section>--}}
        {{--</div>--}}


        <div class="col-md-6 col-lg-6 col-xl-3">
            <section class="panel panel-horizontal">
                <a href="{{route('estadisticas.especies')}}" class="on-click"></a>
                <header class="panel-heading">
                    <div class="panel-heading-icon icon-sm bg-primary mt-sm">
                        <i class="fa fa-list"></i>
                    </div>
                </header>
                <div class="panel-body">
                    <h3 class="text-semibold mt-sm">Especies</h3>
                    <p>Estadísticas de las especies.</p>
                </div>
            </section>
        </div>


        <div class="col-md-6 col-lg-6 col-xl-3">
            <section class="panel panel-horizontal">
                <a href="{{route('estadisticas.taxonomias')}}" class="on-click"></a>
                <header class="panel-heading">
                    <div class="panel-heading-icon icon-sm bg-primary mt-sm">
                        <i class="fa fa-sitemap"></i>
                    </div>
                </header>
                <div class="panel-body">
                    <h3 class="text-semibold mt-sm">Taxonómicas</h3>
                    <p>Estadísticas de registros taxonómicos.</p>
                </div>
            </section>
        </div>


        <div class="col-md-6 col-lg-6 col-xl-3">
            <section class="panel panel-horizontal">
                <a href="{{route('estadisticas.bibliograficas')}}" class="on-click"></a>
                <header class="panel-heading">
                    <div class="panel-heading-icon icon-sm bg-primary mt-sm">
                        <i class="fa fa-book"></i>
                    </div>
                </header>
                <div class="panel-body">
                    <h3 class="text-semibold mt-sm">Bibliográficas</h3>
                    <p>Estadísticas de registros bibliográficos.</p>
                </div>
            </section>
        </div>


        <div class="col-md-6 col-lg-6 col-xl-3">
            <section class="panel panel-horizontal">
                <a href="{{route('estadisticas.geograficas')}}" class="on-click"></a>
                <header class="panel-heading">
                    <div class="panel-heading-icon icon-sm bg-primary mt-sm">
                        <i class="fa fa-map-marker"></i>
                    </div>
                </header>
                <div class="panel-body">
                    <h3 class="text-semibold mt-sm">Geográficas</h3>
                    <p>Estadísticas de registros geográficos.</p>
                </div>
            </section>
        </div>







    </div>




@stop

@section('script_section')
    @parent

    <script>
        localStorage.setItem("menu", "m-estadisticas");
    </script>

@stop



