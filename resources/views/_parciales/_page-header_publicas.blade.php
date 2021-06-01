<?php
$page="";
?>
<header>
    <!--start: Container -->
    <div class="container">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"  aria-expanded="false">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{route('index')}}" title="página Inicio">
                        <img src="{{ asset('img/logo.png')}}" class="img-responsive">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav">
                        <li id="m-index"><a class="m-menu" href="{{route('index')}}">Inicio</a></li>
                        <li id="m-proyecto"><a class="m-menu" href="{{route('proyecto')}}">Proyecto</a></li>
                        <li id="m-catalogo"><a class="m-menu" href="{{route('catalogo')}}">Catálogo</a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Consultar<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li id="m-especie"><a class="m-menu" href="{{route('buscar.especies.index')}}">Especie</a></li>
                                <li id="m-taxonomia"><a  class="m-menu" href="{{route('buscar.taxonomia.index')}}">Clasificación Taxonómica</a></li>
                                <li id="m-ubicacion"><a class="m-menu" href="{{route('buscar.ubicacion.index')}}">Ubicación</a></li>
                                <li id="m-referencia"><a class="m-menu" href="{{route('buscar.referencias.index')}}">Referencias Bibliográficas</a></li>

                                <li class="divider"></li>

                                <li class="nav-header pl-sm">Otros recursos</li>
                                <li><a href="http://www.ciens.ucv.ve/ficofloravenezuela/pnalr/index.php" target="_blank" title="ir al Ficoflora PNALR">Ficoflora PNALR</a></li>
                                <li id="m-otroscatalogos"><a class="m-menu" href="{{route('otroscatalogos')}}">Otros Catálogos</a></li>
                            </ul>
                        </li>
                        <li id="m-contactos"><a class="m-menu" href="{{route('contactos')}}">Contactos</a></li>
                        <li id="m-proyecto"><a class="m-menu" href="{{route('proyecto_creditos')}}">Créditos</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <!--end: Row -->
    </div>
    <!--end: container -->

    <!-- start: Section search -->
    <div class="bar-buscar">
        <div class="bg-color">
            <div class="container-fluid w-940">

                <form class="navbar-form navbar-right" role="search" action="{{route('buscar.especies')}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="hidden-xs" style="display: inline"><i class="fa fa-search mr-sm text-light"></i></div>
                    <div class="form-group">
                        {!! Form::text('especie', null, ['id'=>'especie', 'class' => 'form-control typeahead header', 'autocomplete' => 'off', 'placeholder' => 'indique nombre de la especie']) !!}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end: Section search -->

</header>