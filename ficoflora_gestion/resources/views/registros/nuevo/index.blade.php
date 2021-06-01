
@extends('master')

@section('titulo-seccion')
    Nuevo registro
@stop

@section('breadcrumbs')
    <li><a href="{{route('registros.index')}}"><span>Registros</span></a></li>
    <li><a href="#"><span>Nuevo</span></a></li>
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

        <div class=" col-xlg-10 col-xlg-offset-1">


            <div class="panel-group bl-primary" id="accordion">


                <div class="col-sm-6">
                    {{--<div class="panel panel-accordion b-none">--}}
                        {{--<div class="panel-heading light">--}}
                            {{--<h4 class="panel-title">--}}
                                {{--<a class="accordion-toggle" data-toggle="collapse"  href="#catalogo">--}}
                                    {{--Catálogo--}}
                                {{--</a>--}}
                            {{--</h4>--}}
                        {{--</div>--}}
                        {{--<div id="catalogo" class="accordion-body collapse">--}}
                            {{--<div class="panel-body list">--}}

                                {{--<a href="{{route('reporte.crear')}}"> Registro</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="panel panel-accordion b-none ">
                        <div class="panel-heading light">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapse1">
                                    Especies
                                </a>
                            </h4>
                        </div>
                        <div id="collapse1" class="accordion-body collapse ">
                            <div class="panel-body list">
                                <a href="{{route('especie.crear')}}">Especie</a>
                                <a href="{{route('sinonimia.crear')}}"> Sinonimia</a>
                                <a href="{{route('autor.crear')}}">Autoridad</a>
                                <a href="{{route('especifico.crear')}}">Epíteto específico</a>
                                <a href="{{route('varietal.crear')}}">Epíteto varietal</a>
                                <a href="{{route('forma.crear')}}">Epíteto de forma</a>
                                <a href="{{route('subespecie.crear')}}">Subespecie</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-accordion b-none ">
                        <div class="panel-heading light">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" href="#collapse1One">
                                    Taxonómicos
                                </a>
                            </h4>
                        </div>
                        <div id="collapse1One" class="accordion-body collapse ">
                            <div class="panel-body list">
                                <a href="{{route('phylum.crear')}}">Phylum</a>
                                <a href="{{route('clase.crear')}}">Clase</a>
                                <a href="{{route('subclase.crear')}}">Subclase</a>
                                <a href="{{route('orden.crear')}}">Orden</a>
                                <a href="{{route('familia.crear')}}">Familia</a>
                                <a href="{{route('genero.crear')}}">Género</a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-accordion b-none">
                        <div class="panel-heading light">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse"  href="#collapse1Two">
                                    Bibliográficos
                                </a>
                            </h4>
                        </div>
                        <div id="collapse1Two" class="accordion-body collapse">
                            <div class="panel-body list">
                                <a href="{{route('referencias.crear')}}"> Referencia</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-accordion b-none">
                        <div class="panel-heading light">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse"  href="#collapse1Three">
                                    Geográficos
                                </a>
                            </h4>
                        </div>
                        <div id="collapse1Three" class="accordion-body collapse">
                            <div class="panel-body list">
                                <a href="{{route('entidad.crear')}}"> Entidad Federal</a>
                                <a href="{{route('localidad.crear')}}"> Localidad</a>
                                <a href="{{route('lugar.crear')}}"> Lugar</a>
                                <a href="{{route('sitio.crear')}}"> Sitio</a>
                                {{--<a href="{{route('ubicacion.crear')}}"> Ubicacion</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script_section')
    @parent

    <script>
        localStorage.setItem("menu", "m-registros");
    </script>

@stop