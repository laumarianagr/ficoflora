<!-- start: header -->
<header class="p-header">
    <div class="logo-container">
        <a href="{{route('inicio')}}" class="logo">
            <img src="{{ asset('img/ficoflora_logo.png')}}" height="35" alt="usuario" />
        </a>
        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <!-- start: search & user box -->
    <div class="p-header-right">


        <span class="separator"></span>

        <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="{{ asset('img/!logged-user.jpg')}}" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
                </figure>
                <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                    <span class="name">{!! $usuario->nombre!!} {!!$usuario->apellido!!}</span>
                    <span class="role">{!! $perfil->tipo !!}</span>
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled">
                    <li class="divider"></li>
                    <li>
                        <a href="{{route('usuario.index', [$usuario->usuario])}}" role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fa fa-user"></i> Perfil</a>
                    </li>
                    {{--<li>--}}
                        {{--<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>--}}
                    {{--</li>--}}
                    <li>
                        <a href="{{route('cuenta.editar')}}" role="menuitem" tabindex="-1"><i class="fa fa-cog"></i> Configuración</a>
                    </li>
                    <li>
                        <a href="{{route('auth.logout')}}" role="menuitem" tabindex="-1"><i class="fa fa-sign-out"></i> Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>
<!-- end: header -->