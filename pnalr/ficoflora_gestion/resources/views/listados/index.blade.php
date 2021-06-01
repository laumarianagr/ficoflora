
@extends('master')

@section('titulo-seccion')
    Listados con todos los datos del sistema
@stop

@section('breadcrumbs')
    <li><a href="{{route('listados.index')}}"><span>Listados</span></a></li>

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

        <div class="col-md-12 col-xlg-10 col-xlg-offset-1">


            <div class="panel-group bl-primary" id="accordion">

                <div class="col-sm-6">
                    <div class="panel panel-accordion b-none">
                        <div class="panel-heading light">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse"  href="#catalogo">
                                    Catálogo
                                </a>
                            </h4>
                        </div>
                        <div id="catalogo" class="accordion-body collapse">
                            <div class="panel-body list">

                                <a href="{{route('listado.registros')}}"> Registros</a>
                            </div>
                        </div>
                    </div>
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
                                <a href="{{route('listado.especies')}}">Especie</a>
                                <a href="{{route('listado.sinonimias')}}"> Sinonimias</a>
                                <a href="{{route('listado.autores')}}">Autoridades</a>
                                <a href="{{route('listado.especificos')}}">Epítetos específicos</a>
                                <a href="{{route('listado.varietales')}}">Epítetos varietales</a>
                                <a href="{{route('listado.formas')}}">Epítetos de formas</a>

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
                                <a href="{{route('listado.phylums')}}">Phyla</a>
                                <a href="{{route('listado.clases')}}">Clases</a>
                                <a href="{{route('listado.subclases')}}">Subclases</a>
                                <a href="{{route('listado.ordenes')}}">Órdenes</a>
                                <a href="{{route('listado.familias')}}">Familias</a>
                                <a href="{{route('listado.generos')}}">Géneros</a>

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
                                <a href="{{route('listado.libros')}}"> Libros</a>
                                <a href="{{route('listado.revistas')}}"> Revistas</a>
                                <a href="{{route('listado.trabajos')}}"> Trabajos Académicos</a>
                                <a href="{{route('listado.enlaces')}}">Sitios Web</a>
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
                                <a href="{{route('listado.entidades')}}"> Entidades Federales</a>
                                <a href="{{route('listado.localidades')}}"> Localidades</a>
                                <a href="{{route('listado.lugares')}}"> Lugares</a>
                                <a href="{{route('listado.sitios')}}"> Sitios</a>
                                {{--<a href="{{route('listado.ubicaciones')}}"> Ubicaciones</a>--}}
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
        localStorage.setItem("menu", "m-listados");
    </script>

@stop



