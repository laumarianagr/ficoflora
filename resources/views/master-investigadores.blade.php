<!doctype html>
<html lang="en"  class="fixed sidebar-left-collapsed">
<head>
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

    <title>Ficoflora Venezuela</title>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico')}}" />


    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-4.0.0/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.7/css/dataTables.bootstrap.css')}}">

    <link rel="stylesheet" href="{{ asset('css/ficoflora.css')}}">
    <link rel="stylesheet" href="{{ asset('css/temporal.css')}}">

    <script type='text/javascript' src='{{ asset('plugins/modernizr/modernizr.js')}}'></script>

    @section('css_section')
    @show

</head>

<body>


<div class="p-container">

    {{--Cabecera de la página--}}
    @include('_parciales._page-header')
    {{--END Cabecera de la página--}}

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

    @include('_parciales._page-footer')



</div>

{{--Scripts--}}
@section('script_section')
    <script>
        var root_url = "<?php echo Request::root(); ?>/";
    </script>
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-1.11.2.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/bootstrap/js/bootstrap.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/toastr/js/toastr.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/select2-4.0.0/js/select2.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/jquery.dataTables.min.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/DataTables-1.10.7/js/dataTables.bootstrap.js')}}'></script>

    <script type='text/javascript' src='{{ asset('plugins/typeahead/typeahead.bundle.js')}}'></script>

    <script type='text/javascript' src='{{ asset('js/busquedas/typeahead_busqueda_especies.js')}}'></script>

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
    <b>Web Ficoflora Venezuela.</b>  {{Carbon\Carbon::now()->year}}. <b>Catálogo digital de la Ficoflora de Venezuela.</b>
    Publicación electrónica. Universidad Central de Venezuela, Caracas.
    Editores: Santiago Gómez, Yusneyi Carballo Barrera, Mayra García & Nelson Gil.
    Consultado el {{Carbon\Carbon::now()->day}} de {{$mes}}  de {{Carbon\Carbon::now()->year}},
    de <a>http://www.ciens.ucv.ve/ficofloravenezuela/</a>
</div>


{{--END Scripts--}}
</body>

</html>