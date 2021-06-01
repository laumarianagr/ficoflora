<header>

    <nav class="navbar navbar-default">
        <div class="container-fluid w-940">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('index')}}"  title="página Inicio">
                    <img src="{{ asset('img/logo.png')}}" class="img-responsive">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
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
                    <li id="m-proyecto"><a class="m-menu" href="{{route('proyecto_creditos')}}">Créditos</a></li>
                    <!--<li id="m-proyecto"><a class="m-menu" href="{{route('sidebar')}}">SIDEBAR</a></li>-->


                    <!-- botón cerrar sesión
                    <li><a href="{//route('auth.logout')}}" role="menuitem" tabindex="-1"><i class="fa fa-sign-out"></i> Cerrar</a></li>
                    -->
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="bar-buscar">
       <div class="bg-color">
           <div class="container-fluid w-940">

               <form class="navbar-form navbar-right" role="search" action="{{route('buscar.especies')}}" method="POST">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <i class="fa fa-search mr-sm text-light"></i>
                   <div class="form-group">
                       {!! Form::text('especie', null, ['id'=>'especie', 'class' => 'form-control typeahead header', 'autocomplete' => 'off', 'placeholder' => 'indique nombre de la especie']) !!}
                   </div>
               </form>
           </div>
       </div>

    </div>

</header>