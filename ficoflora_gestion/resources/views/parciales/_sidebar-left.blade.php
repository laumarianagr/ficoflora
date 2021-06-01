<!-- start: sidebar -->
<div id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title">
            Menú Principal
        </div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li id="m-inicio" >
                        <a href="{{route('inicio')}}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Inicio</span>
                        </a>
                    </li>

                    {{--<li id="m-secciones" class="nav-parent">--}}
                        {{--<a>--}}
                            {{--<i class="fa fa-copy" aria-hidden="true"></i>--}}
                            {{--<span>Secciones</span>--}}
                        {{--</a>--}}
                        {{--<ul class="nav nav-children">--}}
                            {{--<li>--}}
                                {{--<a href="pages-signup.html">--}}
                                    {{--página 1--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="pages-signin.html">--}}
                                 {{--página 2--}}
                                {{--</a>--}}
                            {{--</li>--}}

                        {{--</ul>--}}
                    {{--</li>--}}

                    <li id="m-registros">
                        <a href="{{route('registros.index')}}" >
                            {{--<span class="pull-right label label-primary">182</span>--}}
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            <span>Registros</span>
                        </a>
                    </li>
                    <li id="m-listados">
                        <a href="{{route('listados.index')}}" >
                            {{--<span class="pull-right label label-primary">182</span>--}}
                            <i class="fa fa-list" aria-hidden="true"></i>
                            <span>Listados</span>
                        </a>
                    </li>
                    <li id="m-buscar">
                        <a href="{{route('buscar.index')}}" >
                            {{--<span class="pull-right label label-primary">182</span>--}}
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <span>Buscar</span>
                        </a>
                    </li>
                    <li id="m-estadisticas">
                        <a href="{{route('estadisticas.index')}}" >
                            {{--<span class="pull-right label label-primary">182</span>--}}
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                            <span>Estadísticas</span>
                        </a>
                    </li>
                    <li id="m-log">
                        <a href="{{route('log.index')}}" >
                            <span class="pull-right label label-primary"></span>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span>Log</span>
                        </a>
                    </li>
                    @if($usuario->admin())
                        <li id="m-perfiles">
                            <a href="{{route('perfiles.index')}}" >
                                <i class="fa fa-sitemap" aria-hidden="true"></i>
                                <span>Perfiles</span>
                            </a>
                        </li>
                        <li id="m-usuarios">
                            <a href="{{route('usuarios.index')}}" >
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span>Usuarios</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </nav>

            <hr class="separator" />



        </div>

    </div>

</div>
<!-- end: sidebar -->
