<header>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img/logo.png')}}" class="img-responsive">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li id="m-inicio" class="active"><a class="m-menu" href="#">Inicio</a></li>
                    <li id="m-proyectos"><a class="m-menu" href="#">Proyecto</a></li>
                    <li id="m-catalogo"><a hre class="m-menu" f="#">Catálogo Nacional</a></li>
                    <li id="m-publicaciones"><a class="m-menu" href="#">Publicaciones</a></li>
                    <li id="m-buscar" class="dropdown">
                        <a href="#" class="dropdown-toggle m-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Búsquedas</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('buscar.especies.index')}}">Especies</a></li>
                            <li><a href="{{route('buscar.taxonomia.index')}}">Taxonomía</a></li>
                            <li><a href="{{route('buscar.ubicacion.index')}}">Ubicación</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Créditos</a></li>

                </ul>

                <form class="navbar-form navbar-right" role="search" action="{{route('buscar.especies')}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <i class="fa fa-search mr-sm"></i>
                    <div class="form-group">
                        {!! Form::text('especie', null, ['id'=>'especie', 'class' => 'form-control typeahead', 'autocomplete' => 'off', 'placeholder' => 'buscar especies']) !!}
                    </div>
                </form>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>