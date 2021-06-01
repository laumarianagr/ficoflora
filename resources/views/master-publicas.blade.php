<!doctype html>
<html lang="en"  class="fixed sidebar-left-collapsed">
<head>
    @yield('title')

    <meta name="description" content="Catálogo de macroalgas bénticas marinas de Venezuela, validación taxonómica de registros, ilustración morfoanatómica, datos taxonómicos, ecológicos, geográficos, bibliográficos, mapas y fotografías."/>
    <meta name="keywords" content="ficoflora, macroalgas, algas bénticas marinas, catálogo de algas, sistemática de algas, phycoflora, macroalgae, marine benthic algae, algae catalog, systematic algae, UCV, FIBV, UPEL." />
    <meta name="author" content="Yusneyi Carballo Barrera (CENEAC UCV) :: Santiago Gómez Acevedo (IBE UCV). Web design & programming: Yusneyi Carballo Barrera"/>
    <meta charset="UTF-8">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112824303-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-112824303-1');
    </script>

    <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico')}}" />

    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css')}}">

    <link rel="stylesheet" href="{{ asset('css_publicas/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/temporal.css')}}">

    <script type='text/javascript' src='{{ asset('plugins/modernizr/modernizr.js')}}'></script>

    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Serif">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Boogaloo">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Economica:700,400italic">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Satisfy">
    <!-- end: CSS -->

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    @section('css_section')
    @show

</head>

<body>
    <div class="p-container">

        {{--Cabecera de la página--}}
        @include('_parciales._page-header_publicas')
        {{--END Cabecera de la página--}}

        @section('css_section')
        @show

        @section('id-menu') {{-- identifica página en el menú --}}
        @show

        {{--Cuerpo de la páginas--}}
        <div class="p-body">
            {{--Contenido de la pagina--}}
            <div class="p-content" role="main">

                {{--Cabecera del Contenido --}}
                {{--@include('parciales._content-header')--}}
                {{--END Cabecera del Contenido --}}

                <div class="content-body row">
                    @yield('content')
                </div>
            </div>
            {{--END Contenido--}}

        </div>
        {{--END Cuerpo de la página--}}

        @include('_parciales._page-footer_publicas')

    </div>

{{--Scripts--}}
@section('script_section')
    <script>
        var root_url = "<?php echo Request::root(); ?>/";
    </script>

    <!-- start: Java Script -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-1.11.2.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/bootstrap/js/bootstrap.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/typeahead/typeahead.bundle.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js/busquedas/typeahead_busqueda_especies.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js_publicas/flexslider.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js_publicas/carousel.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js_publicas/jquery.cslider.js')}}'></script>
    <script type='text/javascript' src='{{ asset('js_publicas/slider.js')}}'></script>

    <script type='text/javascript' def src='{{ asset('js_publicas/custom.js')}}'></script>
    <script type='text/javascript' def src='{{ asset('js_publicas/functions.js')}}'></script>
    <!-- end: Java Script -->

@show

<script>

        $('ul.navbar-nav li  a.m-menu').click(function(){
            localStorage.setItem("menu", $(this).parent().attr('id'));
            console.log($(this).parent().attr('id'));
        });

        $('ul.navbar-nav li.active').removeClass("active");
        var menu = document.getElementById(localStorage.getItem("menu"));
        console.log(menu);
        $(menu).addClass("active");

        function copyToClipboard(elemento) { //copia del texto de la referencia bibliográfica a Ficoflora Venezuela
            var $temp = $("<input>")
            $("body").append($temp);
            $temp.val($(elemento).text()).select();
            document.execCommand("copy");
            $temp.remove();
        }

    </script>

    <div id="p1" style="visibility:hidden; z-index: 100;">
        Web Ficoflora Venezuela (<span id="agno3"></span>). Referencia: Web Ficoflora Venezuela. <span id="agno4"></span>. <b>Catálogo digital de la Ficoflora de Venezuela</b>.
        Publicación electrónica. Universidad Central de Venezuela, Caracas. Editores: Santiago Gómez, Yusneyi Carballo Barrera, Mayra García & Nelson Gil.
        Consultado el <span id="fecha2"></span>, en <a href="http://www.ciens.ucv.ve/ficofloravenezuela/" target="_blank" title="Web Ficoflora Venezuela">
            http://www.ciens.ucv.ve/ficofloravenezuela/</a>
    </div>

{{--END Scripts--}}
</body>

</html>