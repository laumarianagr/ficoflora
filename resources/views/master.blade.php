<!doctype html>
<html lang="en"  class="fixed sidebar-left-collapsed">
<head>
    <meta charset="UTF-8">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <title>Ficoflora Venezuela</title>

    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins\select2-4.0.0\css\select2.min.css')}}">

    <link rel="stylesheet" href="{{ asset('css/ficoflora.css')}}">

    <script type='text/javascript' src='{{ asset('plugins/modernizr/modernizr.js')}}'></script>

    @section('css_section')
    @show

</head>

<body>


<div class="p-container">

    {{--Cabecera de la página--}}
    {{--@include('parciales._page-header')--}}
    {{--END Cabecera de la página--}}

    {{--Cuerpo de la páginas--}}
    <div class="p-body">

        {{--Menu izquierdo--}}
        {{--@include('parciales._sidebar-left')--}}
        {{--END Menu izquierdo--}}

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

</div>

{{--Scripts--}}
@section('script_section')
    <script>
        var root_url = "<?php echo Request::root(); ?>/";
    </script>
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-1.11.2.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/bootstrap/js/bootstrap.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins\toastr\js\toastr.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins/jquery/jquery-validation/jquery.validate.min.js')}}'></script>
    <script type='text/javascript' src='{{ asset('plugins\select2-4.0.0\js\select2.min.js')}}'></script>

@show
{{--END Scripts--}}
</body>

</html>