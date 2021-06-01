<!doctype html>
<html lang="en"  class="fixed">
<head>
    <meta charset="UTF-8">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <title>Ficoflora Venezuela</title>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico')}}" />

    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/css/toastr.css')}}">

    <link rel="stylesheet" href="{{ asset('css/temporal.css')}}">

    <link rel="stylesheet" href="{{ asset('css/admin.css')}}">

    <link rel="stylesheet" href="{{ asset('plugins/select2-4.0.0/css/select2.min.css')}}">

    <script type='text/javascript' src='{{ asset('plugins/modernizr/modernizr.js')}}'></script>
        
    @section('css_section')
    @show

</head>
    
<body>


    <div class="p-container">
        @include('errors._permisos-error')

        {{--Cabecera de la página--}}
        @include('parciales._page-header')
        {{--END Cabecera de la página--}}

        {{--Cuerpo de la páginas--}}
        <div class="p-body">

            {{--Menu izquierdo--}}
            @include('parciales._sidebar-left')
            {{--END Menu izquierdo--}}

            {{--Contenido de la pagina--}}
            <div class="p-content " role="main">

                {{--Cabecera del Contenido --}}
                @include('parciales._content-header')
                {{--END Cabecera del Contenido --}}



                <div class="content-body row">

                    @yield('content')
                </div>
            </div>

            {{--END Contenido--}}

        </div>
        {{--END Cuerpo de la página--}}

    </div>

{{--Scripts--}}
    @section('script_section')
        <script>
            var root_url = "<?php echo Request::root(); ?>/";

            
        </script>
        <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-1.11.2.min.js')}}'></script>
        <script type='text/javascript' src='{{ asset('plugins/bootstrap/js/bootstrap.min.js')}}'></script>
        <script type='text/javascript' src='{{ asset('plugins/toastr/js/toastr.min.js')}}'></script>

        <script type='text/javascript' src='{{ asset('plugins/nanoscroller/nanoscroller.js')}}'></script>
        <script type='text/javascript' src='{{ asset('js/theme.js')}}'></script>

{{--        <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.js')}}'></script>--}}


        <script type='text/javascript' src='{{ asset('js/componentes.js')}}'></script>

        <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.min.js')}}'></script>

        <script type='text/javascript' src='{{ asset('plugins/select2-4.0.0/js/select2.min.js')}}'></script>
        <script type='text/javascript' src='{{ asset('plugins/magnific-popup/jquery.magnific-popup.min.js')}}'></script>



    @show

    <script>
        //            var menu = document.getElementById(localStorage.getItem("menu"));
        //            $(menu).addClass("nav-active");

        $('ul.nav-main li a').click(function(){
            localStorage.setItem("menu", $(this).parent().attr('id'));
        });

        $('ul.nav-main li.nav-active').removeClass("nav-active");
        var menu = document.getElementById(localStorage.getItem("menu"));
        $(menu).addClass("nav-active");

        //            var menu = document.getElementById(localStorage.getItem("menu"));
        //            $('ul.navigation li.nav-active').removeClass("nav-active");
        //            $(menu).addClass("nav-active");

    </script>
{{--END Scripts--}}
</body>

</html>